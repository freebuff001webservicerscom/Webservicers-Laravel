<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'resource',
        'data',
    ];

    /** @var array<string, string> */
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    /**
     * Fetch every record for one admin resource.
     *
     * @return static[]
     */
    public static function forResource(string $resource)
    {
        return static::where('resource', $resource)->orderByDesc('id')->get();
    }
}
