<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Page;
use App\Support\ContentFlattener;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /**
     * Service pages catalogue (Online store → Products).
     */
    public function products(): View
    {
        return $this->index(Page::TYPE_SERVICE, 'admin.pages.products', 'Products');
    }

    /**
     * Company + legal pages catalogue (Online store → Store pages).
     */
    public function storePages(): View
    {
        $pages = Page::query()
            ->whereIn('type', [Page::TYPE_COMPANY, Page::TYPE_LEGAL])
            ->orderBy('type')
            ->orderBy('id')
            ->get();

        return view('admin.pages.store', [
            'pages' => $pages,
            'title' => 'Store pages',
        ]);
    }

    /**
     * Content editor for one page.
     */
    public function edit(Page $page): View
    {
        return view('admin.pages.edit', [
            'page' => $page,
            'themes' => $this->themes(),
            'contentFields' => ContentFlattener::flatten($page->content),
        ]);
    }

    /**
     * Persist page meta + flattened content edits.
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:190'],
            'description' => ['nullable', 'string', 'max:500'],
            'theme' => ['nullable', 'string', 'max:40'],
            'status' => ['required', 'in:published,draft'],
        ]);

        $paths = array_column($contentFields = ContentFlattener::flatten($page->content), 'path');

        $content = ContentFlattener::hydrate(
            $page->content,
            array_intersect_key((array) $request->input('content'), array_flip($paths)),
        );

        $page->update($data + ['content' => $content]);

        Activity::record('page.updated', 'Page "'.$page->slug.'" updated');

        return back()->with('status', 'Page saved — the public site now serves the new content.');
    }

    /**
     * @param  'service'|'company'|'legal'  $type
     */
    private function index(string $type, string $view, string $title): View
    {
        return view($view, [
            'pages' => Page::query()->where('type', $type)->orderBy('id')->get(),
            'title' => $title,
        ]);
    }

    /**
     * @return list<string>
     */
    private function themes(): array
    {
        return [
            'theme-google',
            'theme-shopping',
            'theme-meta',
            'theme-insta',
            'theme-seo',
            'theme-gmb',
            'theme-analytics',
            'theme-violet',
            'theme-indigo',
        ];
    }
}
