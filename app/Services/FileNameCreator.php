<?php

namespace App\Services;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileNameCreator
{
    /**
     * @param UploadedFile $file
     * @return string
     */
    public function createName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $time = time();
        $randomStr = Str::random(16);
        $newFileName = $randomStr . $time . '.' . $extension;

        return $newFileName;
    }
}
