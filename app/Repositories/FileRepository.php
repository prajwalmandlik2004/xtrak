<?php

namespace App\Repositories;

use App\Models\File;

use App\Services\FileService;

class FileRepository implements FileService
{
    public function create(array $files, $owner_ref)
    {
        try {
            $fileService = new FileService();
            foreach ($files as $file) {
                $_file['path'] = $fileService->upload($file, 'files');
                $_file['type'] = $file->getClientOriginalExtension();
                $_file['size'] = $file->getSize();
                $_file['name'] = $file->getClientOriginalName();
                $_file['owner_id'] = $owner_ref;
                if ($_file['path']) {
                    $file = File::create($_file);
                }
            }

            return ['success' => true, 'data' => $files];
        } catch (\Throwable $th) {
            return ['success' => false, 'message' => $th->getMessage()];
        }
    }

    public function delete(File $file)
    {
    }
}
