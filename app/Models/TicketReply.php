<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketReply extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'ticket_id',
        'user_id',
        'body',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Null user means the support team replied.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isSupport(): bool
    {
        return $this->user_id === null;
    }
}
