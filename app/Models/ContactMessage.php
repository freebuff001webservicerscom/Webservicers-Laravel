<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'service',
        'message',
        'status',
    ];

    public function scopeUnread(Builder $query): Builder
    {
        return $query->where('status', 'new');
    }
}
