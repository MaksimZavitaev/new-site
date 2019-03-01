<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Product;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.forms.index', [
            'forms' => Form::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::pluck('name', 'id');
        return view('admin.forms.create', compact('products'));
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
        $form = Form::create($request->all());
        return redirect()->route('admin.forms.index')->withSuccess('Форма успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  Form $form
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Form $form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        $products = Product::pluck('name', 'id');
        return view('admin.forms.edit', compact('form', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Form $form
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $form->update($request->all());
        return redirect()->route('admin.forms.edit', $form)->withSuccess('Форма успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Form $form
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
