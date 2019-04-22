<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VariableResource;
use App\Models\Page;
use App\Models\PageVariable;
use App\Models\Variable;
use DB;
use Illuminate\Http\Request;

class PageVariableController extends Controller
{
    public function index(Request $request, $page)
    {
        return Page::findOrFail($page)
            ->getVariablesFlatMap()
            ->sortBy('sort')
            ->values();
    }

    public function show(Request $request, $page, $key)
    {
        $variable = Page::find($page)->variables()->wherePivot('key', $key)->get();

        $code = $variable ? 200 : 404;

        return response()->json(VariableResource::collection($variable), $code);
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

    public function updateSort(Request $request)
    {
        $collect = collect($request->all())->mapWithKeys(function ($item) {
            return $item;
        });
        $variables = Variable::whereIn('id', $collect->keys())->get();

        DB::transaction(function () use ($variables, $collect) {
            foreach ($variables as $variable) {
                $variable->sort = $collect[$variable->id];
                $variable->save();
            }
        });
    }

    /**
     * @param Request $request
     * @param string $page
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(Request $request, Page $page)
    {
        $items = $request->all();
        $variable = new Variable();
        DB::transaction(function () use ($page, &$variable, $items) {
            if (isset($items['variable_id'])) {
                $pageVariable = PageVariable::where('id', $items['variable_id']);
            } else {
                $pageVariable = PageVariable::where('key', $items['key']);
            }
            $pageVariable = $pageVariable->first() ?? new PageVariable();

            $pageVariable->key = $items['key'];
            $pageVariable->is_list = $items['is_list'] ?? false;
            $pageVariable->page_id = $page->id;
            $pageVariable->save();

            $variable->type = $items['type'];
            $variable->data = $items;
            $variable->page_variable_id = $pageVariable->id;
            $variable->save();
        });

        return new VariableResource($variable);
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
        DB::transaction(function () use ($key) {
            if (is_numeric($key)) {
                Variable::find($key)->delete();
            } else {
                $variable = PageVariable::where('key', $key)->first();
                $variable->delete();
            }
        });

        return response()->json(true);
    }

    public function storeList(Request $request, Page $page)
    {
        $pageVariable = new PageVariable();
        $pageVariable->page_id = $page->id;
        $pageVariable->key = $request->input('key');
        $pageVariable->is_list = true;
        $pageVariable->save();

        return $pageVariable;
    }

    public function updateList(Request $request, $page_id, $id)
    {
        $pageVariable = PageVariable::findOrFail($id);
        $pageVariable->key = $request->input('key');
        $pageVariable->save();

        return $pageVariable;
    }

    public function destroyList(Request $request, $page_id, $id)
    {
        return response()->json(PageVariable::findOrFail($id)->delete());
    }
}
