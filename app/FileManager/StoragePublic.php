<?php

namespace App\FileManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoragePublic
{
    private $folder;

    public function __construct($folder)
    {
        $this->folder = $folder;
    }

    public function fileUpload($file = '')
    {
        $fileName = $file->getClientOriginalName();
        Storage::disk('public')->put($fileName, $file);
    }
}