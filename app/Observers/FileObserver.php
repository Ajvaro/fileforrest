<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Str;

class FileObserver
{
    public function creating(File $file)
    {
        $file->identifier = (string) Str::uuid();
    }
}
