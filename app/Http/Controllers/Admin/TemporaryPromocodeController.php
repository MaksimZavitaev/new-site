<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use App\Models\TmpPromocode;
use Illuminate\Http\Request;

class TemporaryPromocodeController extends Controller
{
    public function index()
    {
        $promocodes = TmpPromocode::with('parent')->get();
        return view('admin.promocodes.temporary.index', compact('promocodes'));
    }

    public function create()
    {
        return view('admin.promocodes.temporary.create', ['parents' => Promocode::pluck('name', 'id')]);
    }

    public function store(Request $request)
    {
        $promocode = new TmpPromocode($request->input());
        $promocode->active = $request->has('active') ? $request->input('active') : false;
        $promocode->save();
        return redirect()->route('admin.promocodes.temporary.edit', $promocode)->withSuccess('Сохранено');
    }

    public function edit(TmpPromocode $promocode)
    {
        $parents = Promocode::pluck('name', 'id');
        return view('admin.promocodes.temporary.edit', compact('promocode', 'parents'));
    }

    public function update(Request $request, TmpPromocode $promocode)
    {
        $promocode->active = $request->has('active') ? $request->input('active') : false;
        $promocode->update($request->input());
        return redirect()->route('admin.promocodes.temporary.edit', $promocode)->withSuccess('Обновлено');
    }

    public function destroy(TmpPromocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocodes.temporary.index')->withSuccess('Удалено');
    }
}
