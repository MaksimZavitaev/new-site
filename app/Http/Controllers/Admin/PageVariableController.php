<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VariableResource;
use App\Models\Page;
use App\Models\PageVariable;
use Illuminate\Http\Request;

class PageVariableController extends Controller
{
    public function index(Request $request, $page)
    {
        return Page::find($page)->getVariablesFlatMap();
    }

    public function show(Request $request, $page, $key)
    {
        $variable = PageVariable::where('page_id', $page)
            ->find($key);

        $code = $variable ? 200 : 404;

        return response()->json($variable, $code);
    }

    /**
     * @param Request $request
     *
     * @param string $page
     * @param string $key
     *
     * @return mixed
     */
    public function update(Request $request, Page $page, $key)
    {
        $items = $request->all();
        $variable = $page->variables()->findOrFail($key);
        $variable->data = $items;
        $variable->key = $items['key'];
        $variable->save();

        return new VariableResource($variable);
    }

    /**
     * @param Request $request
     * @param string $page
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Page $page)
    {
        $items = $request->all();
        $variable = new PageVariable($items);
        $variable->data = collect($items)->except($variable->getFillable());
        $variable = $page->variables()->save($variable);

        return response()->json($variable);
    }

    /**
     * @param Request $request
     * @param $page
     * @param $key
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy(Request $request, Page $page, $key)
    {
        \DB::transaction(function () use ($key) {
            $variable = PageVariable::where('key', $key)->first();
            $variable->delete();
        });

        return response()->json(true);
    }
}
