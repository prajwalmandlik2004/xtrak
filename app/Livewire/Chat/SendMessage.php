<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class SendMessage extends Component
{
    use WithFileUploads;

    public $selectedConversation;
    public $receiverInstance;
    public $body;
    public $attachment;

    protected $listeners = ['updateSendMessage'];

    public function updateSendMessage($conversationId, $receiverData)
    {
        $conversation = Conversation::find($conversationId);
        if ($conversation) {
            $this->selectedConversation = $conversation;
        }

        if (is_array($receiverData) && isset($receiverData['id'])) {
            $receiver = User::find($receiverData['id']);
            if ($receiver) {
                $this->receiverInstance = $receiver;
            }
        }
    }

    public function sendMessage()
    {
        if ($this->body == null && $this->attachment == null) {
            return null;
        }

        $attachmentPath = null;
        if ($this->attachment) {
            $originalName = $this->attachment->getClientOriginalName();
            $attachmentPath = $this->attachment->storeAs('attachments', $originalName, 'public');
        }

        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'body' => $this->body,
            'attachment' => $attachmentPath,
        ]);

        $this->selectedConversation->last_time_message = $createdMessage->created_at;
        $this->selectedConversation->save();

        $this->dispatch('pushMessage', $createdMessage->id);
        $this->dispatch('messageSent');

        $this->reset('body', 'attachment');
    }

    public function removeAttachment()
    {
        $this->attachment = null;
    }

    public function render()
    {
        return view('livewire.chat.send-message');
    }
}
