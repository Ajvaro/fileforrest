<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileApproval extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'overview_short',
        'overview',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function approvalFields()
    {
        return $this->only($this->fillable);
    }
}
