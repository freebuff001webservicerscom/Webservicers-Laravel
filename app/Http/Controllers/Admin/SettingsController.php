<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Resolve one settings page definition from config/admin.php.
     *
     * @return array<string, mixed>
     */
    private function definition(string $page): array
    {
        $definition = config("admin.settings.{$page}");

        abort_unless(is_array($definition), 404);

        return $definition;
    }

    /**
     * Show one settings page.
     */
    public function edit(string $page): View
    {
        $definition = $this->definition($page);

        $values = [];
        foreach ($definition['fields'] as $key => $field) {
            $values[$key] = Setting::get($key, $field['default'] ?? '');
        }

        return view('admin.settings.edit', [
            'page' => $page,
            'definition' => $definition,
            'values' => $values,
            'pages' => config('admin.settings'),
        ]);
    }

    /**
     * Save one settings page.
     */
    public function update(Request $request, string $page): RedirectResponse
    {
        $definition = $this->definition($page);

        $rules = [];
        foreach ($definition['fields'] as $key => $field) {
            $rules[$key] = [
                ($field['required'] ?? false) ? 'required' : 'nullable',
                'string',
                'max:1000',
            ];
            if (($field['type'] ?? 'text') === 'email') {
                $rules[$key][] = 'email';
            }
            if (($field['type'] ?? 'text') === 'number') {
                $rules[$key] = [($field['required'] ?? false) ? 'required' : 'nullable', 'numeric'];
            }
        }

        $data = $request->validate($rules);

        // Toggles post "1" when on and are absent when off.
        foreach ($definition['fields'] as $key => $field) {
            if (($field['type'] ?? 'text') === 'toggle') {
                $data[$key] = $request->boolean($key) ? '1' : '0';
            }
        }

        Setting::setMany($data);

        Activity::record('settings.updated', $definition['label'].' updated');

        return back()->with('status', $definition['label'].' saved.');
    }
}
