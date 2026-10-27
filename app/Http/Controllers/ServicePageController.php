<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ServicePageController extends Controller
{
    /**
     * Render a service landing page from the SQLite page catalogue.
     */
    public function __invoke(string $slug): View
    {
        $row = Page::query()
            ->where('slug', $slug)
            ->where('type', Page::TYPE_SERVICE)
            ->published()
            ->first();

        abort_unless($row, 404);

        $page = $row->content;

        return view('service', [
            'page' => $page,
            'metaTitle' => $row->title ?: ($page['crumb'].' — WebServicers'),
            'description' => $row->description ?: Str::limit(strip_tags($page['lead']), 155),
        ]);
    }
}
