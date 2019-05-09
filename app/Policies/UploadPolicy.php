<?php

namespace App\Policies;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    use HandlesAuthorization;

    public function touch(User $user, Upload $upload)
    {
        return $user->id == $upload->user->id;
    }
}
