<?php

namespace App\Support;

use Illuminate\Support\Arr;

/**
 * Turns a nested page-content array into flat, editable form fields and
 * hydrates form input back into the original shape. Used by the admin
 * content editors so every service/company/legal page is editable
 * without hand-writing a form per page.
 */
final class ContentFlattener
{
    private const MAX_DEPTH = 3;

    /**
     * @param  array<string, mixed>  $content
     * @return list<array{path: string, label: string, hint: string, type: string, value: string}>
     */
    public static function flatten(array $content): array
    {
        return self::walk($content, '');
    }

    /**
     * Write flat input back into the content array, preserving the shape
     * of the original data.
     *
     * @param  array<string, mixed>  $content
     * @param  array<string, mixed>  $input
     * @return array<string, mixed>
     */
    public static function hydrate(array $content, array $input): array
    {
        foreach (self::walk($content, '') as $field) {
            $path = $field['path'];

            if (! array_key_exists($path, $input)) {
                continue;
            }

            $raw = $input[$path];

            if (! is_string($raw)) {
                continue;
            }

            $value = match ($field['type']) {
                'textarea-pair' => self::parsePair($raw),
                'textarea-lines' => self::parseLines($raw),
                'textarea-json' => self::parseJson($raw, Arr::get($content, $path)),
                default => $raw === '' ? null : $raw,
            };

            Arr::set($content, $path, $value);
        }

        return $content;
    }

    /**
     * @param  array<string, mixed>  $content
     * @return list<array{path: string, label: string, hint: string, type: string, value: string}>
     */
    private static function walk(array $content, string $prefix): array
    {
        $fields = [];

        foreach ($content as $key => $value) {
            $path = $prefix === '' ? (string) $key : $prefix.'.'.$key;

            if (is_string($value)) {
                $fields[] = [
                    'path' => $path,
                    'label' => self::label((string) $key),
                    'hint' => $prefix,
                    'type' => mb_strlen($value) > 110 || str_contains($value, "\n") ? 'textarea' : 'text',
                    'value' => $value,
                ];

                continue;
            }

            if (is_int($value) || is_float($value)) {
                $fields[] = [
                    'path' => $path,
                    'label' => self::label((string) $key),
                    'hint' => $prefix,
                    'type' => 'text',
                    'value' => (string) $value,
                ];

                continue;
            }

            if (! is_array($value)) {
                continue;
            }

            // Lists of plain scalars: two short values stay on one "a|b"
            // line (pairs like gauge value + label), longer lists use one
            // value per line.
            if (array_is_list($value) && $value !== [] && ! self::hasArray($value)) {
                $isPair = count($value) === 2
                    && array_reduce($value, fn (bool $carry, mixed $item): bool => $carry && mb_strlen((string) $item) <= 90, true);

                $fields[] = [
                    'path' => $path,
                    'label' => self::label((string) $key),
                    'hint' => $prefix,
                    'type' => $isPair ? 'textarea-pair' : 'textarea-lines',
                    'value' => $isPair
                        ? implode('|', array_map(strval(...), $value))
                        : implode("\n", array_map(strval(...), $value)),
                ];

                continue;
            }

            // Structured data: recurse while the depth stays reasonable,
            // otherwise expose a JSON escape hatch.
            if (mb_substr_count($path, '.') < self::MAX_DEPTH && $value !== []) {
                foreach (self::walk($value, $path) as $nested) {
                    $fields[] = $nested;
                }

                continue;
            }

            $fields[] = [
                'path' => $path,
                'label' => self::label((string) $key),
                'hint' => $prefix,
                'type' => 'textarea-json',
                'value' => json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '[]',
            ];
        }

        return $fields;
    }

    /**
     * @param  array<mixed>  $values
     */
    private static function hasArray(array $values): bool
    {
        foreach ($values as $value) {
            if (is_array($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Parse a "a|b" pair line back into two values.
     *
     * @return list<string>
     */
    private static function parsePair(string $raw): array
    {
        $parts = array_map('trim', explode('|', $raw));

        return array_values(array_filter($parts, fn (string $part): bool => $part !== ''));
    }

    /**
     * @return list<string>
     */
    private static function parseLines(string $raw): array
    {
        $lines = array_values(array_filter(array_map('trim', explode("\n", $raw)), fn (string $line): bool => $line !== ''));

        return $lines;
    }

    private static function parseJson(string $raw, mixed $fallback): mixed
    {
        $decoded = json_decode($raw, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $fallback;
    }

    private static function label(string $key): string
    {
        $label = ucfirst(str_replace(['_', '-'], ' ', $key));

        // camelCase → Camel case
        return preg_replace('/(?<!^)[A-Z]/', ' $0', $label) ?? $label;
    }
}
