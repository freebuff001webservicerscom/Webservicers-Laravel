<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Record;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Resolve and validate a resource key from config/resources.php.
     *
     * @return array<string, mixed>
     */
    private function definition(string $resource): array
    {
        $definition = config("resources.{$resource}");

        abort_unless(is_array($definition), 404);

        return $definition;
    }

    /**
     * List every record for one resource.
     */
    public function index(string $resource): View
    {
        $definition = $this->definition($resource);

        return view('admin.records.index', [
            'resource' => $resource,
            'definition' => $definition,
            'records' => Record::forResource($resource),
        ]);
    }

    /**
     * Create form.
     */
    public function create(string $resource): View
    {
        $definition = $this->definition($resource);

        return view('admin.records.form', [
            'resource' => $resource,
            'definition' => $definition,
            'record' => null,
            'data' => [],
        ]);
    }

    /**
     * Persist a new record.
     */
    public function store(Request $request, string $resource): RedirectResponse
    {
        $definition = $this->definition($resource);

        $record = Record::create([
            'resource' => $resource,
            'data' => $this->validated($request, $definition),
        ]);

        Activity::record("{$resource}.created", $definition['singular'].' #'.$record->id.' created');

        return redirect()
            ->route('admin.records.index', $resource)
            ->with('status', "{$definition['singular']} created.");
    }

    /**
     * Edit form.
     */
    public function edit(string $resource, Record $record): View
    {
        $definition = $this->definition($resource);
        abort_unless($record->resource === $resource, 404);

        return view('admin.records.form', [
            'resource' => $resource,
            'definition' => $definition,
            'record' => $record,
            'data' => $record->data,
        ]);
    }

    /**
     * Update an existing record.
     */
    public function update(Request $request, string $resource, Record $record): RedirectResponse
    {
        $definition = $this->definition($resource);
        abort_unless($record->resource === $resource, 404);

        $record->update(['data' => $this->validated($request, $definition)]);

        Activity::record("{$resource}.updated", $definition['singular'].' #'.$record->id.' updated');

        return redirect()
            ->route('admin.records.index', $resource)
            ->with('status', "{$definition['singular']} updated.");
    }

    /**
     * Delete a record.
     */
    public function destroy(string $resource, Record $record): RedirectResponse
    {
        $definition = $this->definition($resource);
        abort_unless($record->resource === $resource, 404);

        $record->delete();

        Activity::record("{$resource}.deleted", $definition['singular'].' #'.$record->id.' deleted');

        return redirect()
            ->route('admin.records.index', $resource)
            ->with('status', "{$definition['singular']} deleted.");
    }

    /**
     * Validate the configured fields and return only those keys.
     *
     * @param  array<string, mixed>  $definition
     * @return array<string, string|null>
     */
    private function validated(Request $request, array $definition): array
    {
        $rules = [];

        foreach ($definition['fields'] as $key => $field) {
            $rules[$key] = [$field['required'] ?? false ? 'required' : 'nullable', 'string', 'max:500'];
        }

        return $request->validate($rules);
    }
}
