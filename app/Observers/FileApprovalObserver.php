<?php

namespace App\Observers;

use App\Models\FileApproval;

class FileApprovalObserver
{
    public function creating(FileApproval $fileApproval)
    {
        $fileApproval->file->approvals()->delete();
    }
}
