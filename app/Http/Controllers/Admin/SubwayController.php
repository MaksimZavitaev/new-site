<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubwayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subways.index', [
            'subways' => Subway::all(),
            'lines' => collect(Subway::getSubwayLines()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subways.create', [
            'lines' => collect(Subway::getSubwayLines())->pluck('name', 'line'),
        ]);
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
        $subway = Subway::create($request->input());
        return redirect()->route('admin.subways.edit', $subway->id)->withSuccess('Станция метро успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subway $subway
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Subway $subway)
    {
        return redirect()->route('admin.subways.edit', $subway);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Subway $subway
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Subway $subway)
    {
        return view('admin.subways.edit', [
            'subway' => $subway,
            'lines' => collect(Subway::getSubwayLines())->pluck('name', 'line'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Subway $subway
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subway $subway)
    {
        $subway->update($request->input());
        return redirect()->route('admin.subways.edit', $subway)->withSuccess('Станция метро успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subway $subway
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subway $subway)
    {
        $subway->delete();
        return redirect()->route('admin.subways.index')->withSuccess('Станция метро успешно удалена');
    }
}
