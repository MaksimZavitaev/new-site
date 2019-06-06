<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function index()
    {
        $promocodes = Promocode::with('product')->get();
        return view('admin.promocodes.permanent.index', compact('promocodes'));
    }

    public function create()
    {
        return view('admin.promocodes.permanent.create', ['products' => Product::pluck('code', 'id')]);
    }

    public function store(Request $request)
    {
        $promocode = new Promocode($request->input());
        $promocode->active = $request->has('active') ? $request->input('active') : false;
        $promocode->save();
        return redirect()->route('admin.promocodes.permanent.edit', $promocode)->withSuccess('Сохранено');
    }

    public function edit(Promocode $promocode)
    {
        $products = Product::pluck('code', 'id');
        return view('admin.promocodes.permanent.edit', compact('promocode', 'products'));
    }

    public function update(Request $request, Promocode $promocode)
    {
        $promocode->active = $request->has('active') ? $request->input('active') : false;
        $promocode->update($request->input());
        return redirect()->route('admin.promocodes.permanent.edit', $promocode)->withSuccess('Обновлено');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocodes.permanent.index')->withSuccess('Удалено');
    }
}
