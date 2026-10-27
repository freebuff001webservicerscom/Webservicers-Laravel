<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public const TYPE_SERVICE = 'service';

    public const TYPE_COMPANY = 'company';

    public const TYPE_LEGAL = 'legal';

    /** @var list<string> */
    protected $fillable = [
        'slug',
        'type',
        'title',
        'description',
        'theme',
        'status',
        'content',
    ];

    /** @var array<string, string> */
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
