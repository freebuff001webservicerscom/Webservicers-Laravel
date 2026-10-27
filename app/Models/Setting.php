<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Per-request memo so pages read each key at most once.
     *
     * @var array<string, string|null>
     */
    private static array $memo = [];

    /**
     * Read a setting with an optional default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        if (! array_key_exists($key, self::$memo)) {
            self::$memo[$key] = static::query()->where('key', $key)->value('value');
        }

        return self::$memo[$key] ?? $default;
    }

    /**
     * Persist one or many settings.
     *
     * @param  array<string, string|null>  $values
     */
    public static function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
            self::$memo[$key] = $value;
        }
    }

    public static function enabled(string $key, bool $default = false): bool
    {
        return filter_var(static::get($key, $default ? '1' : '0'), FILTER_VALIDATE_BOOL);
    }
}
