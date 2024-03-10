<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class FileService
{
    public function upload($file, $dir)
    {
        $name = $file->getClientOriginalName();
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($dir, $fileName, 'public');

        return ['path' => $dir . '/' . $fileName, 'name' => $name, 'type' => $file->getMimeType(), 'size' => $file->getSize()];
    }

    public function delete($path)
    {
        Storage::disk('public')->delete($path);
    }
}
