<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pid = (int)$request->get('pid', 1);
        $items_per_page = (int)$request->get('ipp', 15);
        $search = $request->get('s', '');
        $query_string = "?s=$search&ipp=$items_per_page";

        if ($search === '') {
            $pages = Page::with('parent')->withCount('childs')->get();
            $pages = collect($pages)
                ->reject(function ($item) use ($pid) {
                    return $item->id === $pid && $item->link !== '/';
                })
                ->filter(function ($item) use ($pid) {
                    return ($item->id === $pid) || ($item->parent_id === $pid);
                });
        } elseif ($search === null) {
            $pages = Page::with('parent')->paginate($items_per_page);
            $pages->withPath($query_string);
        } else {
            $pages = Page::with('parent')->where('name', 'LIKE', "%$search%")->paginate($items_per_page);
            $pages->withPath($query_string);
        }

        return view('admin.pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return redirect()->route('admin.pages.edit', $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pid = (int)$request->get('pid');
        $pages = Page::active()
            ->with('parent')
            ->get()
            ->mapWithKeys(function ($v) {
                $parent = $v->parent ? " ({$v->parent['name']})" : '';
                return [$v->id => $v->name . $parent];
            });
        return view('admin.pages.create', compact('pages', 'pid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $pages = Page::active()
            ->with('parent')
            ->get()
            ->mapWithKeys(function ($v) {
                $parent = $v->parent ? " ({$v->parent['name']})" : '';
                return [$v->id => $v->name . $parent];
            })
            ->filter(function ($v, $k) use ($page) {
                return $page->id !== $k;
            });
        return view('admin.pages.edit', compact('page', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'author_id' => Auth::user()->id,
        ]);

//        dd($request->get('seo'));

        $page = Page::create($request->only(['active', 'author_id', 'parent_id', 'name', 'title', 'slug', 'sort', 'seo', 'breadcrumbs']));

        return redirect()->route('admin.pages.edit', $page)->withSuccess(__('posts.created'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->merge([
            'active' => $request->has('active') ? (bool)$request->get('active') : false,
        ]);
        $page->update($request->only(['active', 'parent_id', 'name', 'title', 'slug', 'sort', 'seo', 'breadcrumbs']));

        return redirect()->route('admin.pages.edit', $page)->withSuccess(__('posts.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->withSuccess('Deleted');
    }

    public function restore(Page $page)
    {
        $page->restore();
        return redirect()->route('admin.pages.edit', $page)->withSuccess('Страница успешно восстановлена.');
    }
}
