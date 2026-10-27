<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'reference',
        'customer_name',
        'customer_email',
        'service',
        'amount',
        'status',
        'placed_on',
    ];

    /** @var array<string, string> */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'placed_on' => 'date',
        ];
    }

    public function scopePaid(Builder $query): Builder
    {
        return $query->whereIn('status', ['paid', 'in_progress', 'completed']);
    }

    public function scopeBetween(Builder $query, string $from, string $to): Builder
    {
        return $query->whereBetween('placed_on', [$from, $to]);
    }
}
