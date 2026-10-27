<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    public $timestamps = false;

    /** @var list<string> */
    protected $fillable = [
        'user_id',
        'action',
        'subject',
        'data',
        'created_at',
    ];

    /** @var array<string, string> */
    protected function casts(): array
    {
        return [
            'data' => 'array',
            'created_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record one activity line for the current admin.
     */
    public static function record(string $action, ?string $subject = null, ?array $data = null): void
    {
        static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject' => $subject,
            'data' => $data,
            'created_at' => now(),
        ]);
    }
}
