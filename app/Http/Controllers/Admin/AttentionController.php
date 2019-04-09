<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attentions.index', [
            'attentions' => Attention::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Attention $attention
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Attention $attention)
    {
        return view('admin.attentions.edit', compact('attention'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Attention $attention
     *
     * @return void
     */
    public function update(Request $request, Attention $attention)
    {
        $attention->update($request->all());
        return redirect()->route('admin.attentions.edit', $attention)->whthSuccess('Данные успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attention $attention
     *
     * @return void
     * @throws \Exception
     */
    public function destroy(Attention $attention)
    {
        $attention->delete();
        return redirect()->route('admin.attentions.index')->whthSuccess('Успешно удалено');
    }
}
