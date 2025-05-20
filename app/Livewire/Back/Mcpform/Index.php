<?php

namespace App\Livewire\Back\Mcpform;

use Livewire\Component;
use App\Models\Mcpdashboard;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\IOFactory as WordIOFactory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Mail\MailManager;
use App\Mail\CustomMailable;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Symfony\Component\Mailer\Mailer as SymfonyMailer;
use Illuminate\Mail\Mailer as LaravelMailer;
use Carbon\Carbon;
use Symfony\Component\Mailer\Transport\TransportInterface;
use App\Jobs\SendBatchEmails;
use App\Models\MailAuth;
use PhpOffice\PhpWord\Shared\ZipArchive;

class Index extends Component
{
    use WithFileUploads;
    public $date_mcp, $mcp_code, $designation, $object, $tag_source, $message, $tool;
    public $recip_list_path, $message_doc, $attachments = [];
    public $from, $subject, $launch_date, $pause_min, $pause_max, $batch_min, $batch_max;
    public $work_time_start, $work_time_end, $ref_time, $status, $target_status, $remarks, $notes;


    public $editId;
    public $isEditing = false;

    public $entries;
    public $passcode;
    public $mailOptions = [];

    // protected $rules = [
    //     'date_ctc' => 'required|date',
    //     'ctc_code' => 'required|string|max:255',
    //     'first_name' => 'required|string|max:255',
    //     'last_name' => 'required|string|max:255',
    // ];

    public function mount()
    {
        $this->loadEntries();
        $this->date_mcp = date('Y-m-d');
        $this->mailOptions = MailAuth::all();
    }

    public function loadEntries()
    {
        $this->entries = Mcpdashboard::all();
    }

    public function fetchPasscode()
    {
        $selected = \App\Models\MailAuth::where('email', $this->from)->first();
        $this->passcode = $selected?->passcode ?? '';
    }

    private function generateMcpCode()
    {
        // Extract useful information from form fields
        $designationPart = $this->designation ? strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $this->designation), 0, 2)) : 'XX';

        $objectPart = $this->object ? strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $this->object), 0, 2)) : 'YY';

        $toolPart = $this->tool ? strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $this->tool), 0, 1)) : 'Z';

        // Combine parts to create a base for our code (5 characters so far)
        $baseCode = $designationPart . $objectPart . $toolPart;

        // Generate the remaining characters with randomness to ensure uniqueness
        // Only using alphabetic characters (A-Z)
        $remainingLength = 8 - strlen($baseCode);
        $randomChars = '';
        for ($i = 0; $i < $remainingLength; $i++) {
            $randomChars .= chr(rand(65, 90)); // ASCII codes for A-Z
        }

        $code = $baseCode . $randomChars;

        // Check if this code already exists in the database
        $codeExists = Mcpdashboard::where('mcp_code', $code)->exists();

        // If code already exists, regenerate until we get a unique one
        $attempts = 0;
        while ($codeExists && $attempts < 10) {
            $randomChars = '';
            for ($i = 0; $i < $remainingLength; $i++) {
                $randomChars .= chr(rand(65, 90)); // ASCII codes for A-Z
            }

            $code = $baseCode . $randomChars;
            $codeExists = Mcpdashboard::where('mcp_code', $code)->exists();
            $attempts++;
        }

        // If we still couldn't generate a unique code after several attempts,
        // create a completely random one as a fallback
        if ($codeExists) {
            $code = '';
            for ($i = 0; $i < 8; $i++) {
                $code .= chr(rand(65, 90)); // ASCII codes for A-Z
            }

            // Make sure even the completely random code is unique
            while (Mcpdashboard::where('mcp_code', $code)->exists()) {
                $code = '';
                for ($i = 0; $i < 8; $i++) {
                    $code .= chr(rand(65, 90)); // ASCII codes for A-Z
                }
            }
        }

        return $code;
    }


    public function save()
    {
        // $this->validate();

        $this->mcp_code = $this->generateMcpCode();

        if ($this->isEditing) {
            $entry = Mcpdashboard::find($this->editId);
            if ($entry) {
                $entry->update([
                    'date_mcp' => $this->date_mcp,
                    'mcp_code' => $this->mcp_code,
                    'designation' => $this->designation,
                    'object' => $this->object,
                    'tag_source' => $this->tag_source,
                    'message' => $this->message,
                    'tool' => $this->tool,
                    'recip_list_path' => $recip_list_path,
                    'message_doc' => $message_doc_path,
                    'attachments' => json_encode($attachments_paths),
                    'passcode' => $this->passcode,
                    'from_email' => $this->from,
                    'subject' => $this->subject,
                    'launch_date' => $this->launch_date,
                    'pause_min' => $this->pause_min,
                    'pause_max' => $this->pause_max,
                    'batch_min' => $this->batch_min,
                    'batch_max' => $this->batch_max,
                    'work_time_start' => $this->work_time_start,
                    'work_time_end' => $this->work_time_end,
                    'ref_time' => $this->ref_time,
                    'status' => $this->status,
                    'target_status' => $this->target_status,
                    'remarks' => $this->remarks,
                    'notes' => $this->notes,

                ]);

                session()->flash('message', 'Record updated successfully!');
            }
        } else {
            if (!Storage::disk('public')->exists('mcp/recipients')) {
                Storage::disk('public')->makeDirectory('mcp/recipients');
            }
            if (!Storage::disk('public')->exists('mcp/messages')) {
                Storage::disk('public')->makeDirectory('mcp/messages');
            }
            if (!Storage::disk('public')->exists('mcp/attachments')) {
                Storage::disk('public')->makeDirectory('mcp/attachments');
            }

            $recip_list_path = $this->recip_list_path ? $this->recip_list_path->store('mcp/recipients', 'public') : null;
            $message_doc_path = $this->message_doc ? $this->message_doc->store('mcp/messages', 'public') : null;

            $attachments_paths = [];
            if (!empty($this->attachments)) {
                foreach ($this->attachments as $file) {
                    $attachments_paths[] = $file->store('mcp/attachments', 'public');
                }
            }

            Mcpdashboard::create([
                'date_mcp' => $this->date_mcp,
                'mcp_code' => $this->mcp_code,
                'designation' => $this->designation,
                'object' => $this->object,
                'tag_source' => $this->tag_source,
                'message' => $this->message,
                'tool' => $this->tool,
                'recip_list_path' => $recip_list_path,
                'message_doc' => $message_doc_path,
                'attachments' => json_encode($attachments_paths),
                'from_email' => $this->from,
                'subject' => $this->subject,
                'launch_date' => $this->launch_date,
                'pause_min' => $this->pause_min,
                'pause_max' => $this->pause_max,
                'batch_min' => $this->batch_min,
                'batch_max' => $this->batch_max,
                'work_time_start' => $this->work_time_start,
                'work_time_end' => $this->work_time_end,
                'ref_time' => $this->ref_time,
                'status' => $this->status,
                'target_status' => $this->target_status,
                'remarks' => $this->remarks,
                'notes' => $this->notes,
            ]);

            // 1. Read recipients from Excel
            $spreadsheet = IOFactory::load(storage_path('app/public/' . $recip_list_path));
            $sheet = $spreadsheet->getActiveSheet();

            $recipients = [];
            $startRow = 2;

            foreach ($sheet->getRowIterator($startRow) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);

                $email = $firstName = $lastName = $civility = $domain = '';

                foreach ($cellIterator as $cell) {
                    $col = $cell->getColumn();
                    $val = trim($cell->getFormattedValue());

                    if ($col === 'E') $email = $val;
                    elseif ($col === 'C') $firstName = $val;
                    elseif ($col === 'D') $lastName = $val;
                    elseif ($col === 'B') $civility = $val;
                    elseif ($col === 'G') $domain = $val;
                }

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $recipients[] = [
                        'email' => $email,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'civility' => $civility,
                        'domain' => $domain,
                    ];
                }
            }


            // 2. Read DOCX message content
            $docPath = storage_path('app/public/' . $message_doc_path);
            $reader = WordIOFactory::createReader('Word2007');
            $doc = $reader->load($docPath);
            $text = '';

            foreach ($doc->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    if (method_exists($element, 'getText')) {
                        $text .= $element->getText() . "\n\n";
                    }
                }
            }


            // extract first embedded image (e.g. logo) from Word
            $zip = new ZipArchive();
            $zip->open($docPath);
            $imageName = null;

            for ($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                if (str_starts_with($filename, 'word/media/') && preg_match('/\.(jpg|jpeg|png)$/i', $filename)) {
                    $imageData = $zip->getFromIndex($i);
                    $imageName = 'public/mailer/extracted_logo.png';
                    Storage::put($imageName, $imageData);
                    break;
                }
            }
            $zip->close();


            
            // var_dump($recipients); 
            // dd($recipients); 
            // var_dump($text);


            // 3. Setup mailer dynamically with Gmail SMTP (Symfony Mailer)
            $transport = new EsmtpTransport('smtp.gmail.com', 587, true);
            $transport->setUsername($this->from);
            $transport->setPassword($this->passcode);

            // 2. Create Laravel-compatible Mailer using the transport directly
            $mailer = new LaravelMailer('smtp', app('view'), $transport, app('events'));

            // 4. Schedule sending
            $launchTime = $this->launch_date ? Carbon::parse($this->launch_date) : now();
            $batchMin = $this->batch_min ?? 5;
            $batchMax = $this->batch_max ?? 10;
            $pauseMin = $this->pause_min ?? 5;
            $pauseMax = $this->pause_max ?? 10;

            $subject = $this->subject;
            $sender = $this->from;
            $appPassword = $this->passcode;
            $launchTime = $this->launch_date ? \Carbon\Carbon::parse($this->launch_date) : now();

            dispatch(new SendBatchEmails(
                $recipients,
                $subject,
                $text,
                $attachments_paths,
                $sender,
                $appPassword,
                $this->batch_min,
                $this->batch_max,
                $this->pause_min,
                $this->pause_max
            ))->delay($launchTime);

            session()->flash('message', 'Form submitted and email campaign scheduled ✅');
    

        }

        $this->resetForm();
        $this->loadEntries();
    }


    public $previewMessage = '';
    public $previewRecipientEmail = '';

    public function generatePreview($targetEmail = null)
    {
        // 1. Read message content
        $docPath = storage_path('app/public/' . $this->message_doc->store('temp/message_preview', 'public'));
        $reader = WordIOFactory::createReader('Word2007');
        $doc = $reader->load($docPath);
        $messageTemplate = '';
        foreach ($doc->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                $messageTemplate .= method_exists($element, 'getText') ? $element->getText() . "\n" : '';
            }
        }

        // 2. Read recipients Excel
        $spreadsheet = IOFactory::load(storage_path('app/public/' . $this->recip_list_path->store('temp/recip_preview', 'public')));
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getRowIterator(2) as $row) {
            $data = [];
            foreach ($row->getCellIterator() as $cell) {
                $col = $cell->getColumn();
                $val = trim($cell->getFormattedValue());

                if ($col === 'E') $data['email'] = $val;
                if ($col === 'C') $data['first_name'] = $val;
                if ($col === 'D') $data['last_name'] = $val;
                if ($col === 'B') $data['civility'] = $val;
                if ($col === 'G') $data['domain'] = $val;
            }

            if (filter_var($data['email'] ?? null, FILTER_VALIDATE_EMAIL)) {
                // If filtering by specific email
                if ($targetEmail && $data['email'] !== $targetEmail) continue;

                $this->previewMessage = str_replace(
                    ['{civility}', '{firstName}', '{lastName}', '{domain}'],
                    [$data['civility'] ?? '', $data['first_name'] ?? '', $data['last_name'] ?? '', $data['domain'] ?? ''],
                    $messageTemplate
                );

                $this->previewRecipientEmail = $data['email'];
                break;
            }
        }
    }






    public function edit($id)
    {
        $this->isEditing = true;
        $this->editId = $id;

        $entry = Mcpdashboard::find($id);

        if ($entry) {
            $this->date_mcp = $entry->date_mcp;
            $this->mcp_code = $entry->mcp_code;
            $this->designation = $entry->designation;
            $this->object = $entry->object;
            $this->tag_source = $entry->tag_source;
            $this->message = $entry->message;
            $this->tool = $entry->tool;
            $this->remarks = $entry->remarks;
            $this->notes = $entry->notes;
        }
    }

    public function resetForm()
    {
        $this->reset([
            'date_mcp', 'mcp_code', 'designation', 'object', 'tag_source', 'message', 'tool',
            'recip_list_path', 'message_doc', 'attachments',
            'from', 'subject', 'launch_date', 'pause_min', 'pause_max', 'batch_min', 'batch_max',
            'work_time_start', 'work_time_end', 'ref_time', 'status', 'target_status', 'remarks', 'notes'
        ]);

        $this->isEditing = false;
        $this->editId = null;
        $this->date_mcp = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.back.mcpform.index');
    }
}
