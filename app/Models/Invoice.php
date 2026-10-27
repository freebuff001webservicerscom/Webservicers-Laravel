<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    public const STATUSES = ['unpaid', 'paid', 'overdue', 'refunded'];

    /** @var list<string> */
    protected $fillable = [
        'user_id',
        'order_id',
        'number',
        'description',
        'amount',
        'status',
        'issued_on',
        'due_on',
        'paid_on',
    ];

    /** @var array<string, string> */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'issued_on' => 'date',
            'due_on' => 'date',
            'paid_on' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->whereIn('status', ['unpaid', 'overdue']);
    }
}
