<?php

namespace App\Models;

use App\Traits\HasApproval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class File extends Model
{
    use HasApproval, SoftDeletes;

    const APPROVAL_PROPERTIES = [
        'title',
        'overview_short',
        'overview'
    ];

    protected $fillable = [
        'title',
        'identifier',
        'overview_short',
        'overview',
        'price',
        'live',
        'approved',
        'finished'
    ];

    public function getRouteKeyName()
    {
        return 'identifier';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function scopeFinished(Builder $builder)
    {
        return $builder->where('finished', true);
    }

    public function isFree(): bool
    {
        return $this->price === 0;
    }


    public function needsApproval(array $approvalProps): bool
    {
        return (
            Arr::only($this->toArray(), self::APPROVAL_PROPERTIES) != $approvalProps
            || $this->uploads()->unapproved()->count()
        );

    }

    public function createApproval(array $approvalProps)
    {
        $this->approvals()->create($approvalProps);
    }

    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
}
