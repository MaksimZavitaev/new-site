<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $page = Page::whereLink('/')->first();

        $variables = $page
            ->variables->
            mapWithKeys(function ($item) {
                $key = $item['key'];
                $val = collect($item)->merge($item->data)->forget('data')->filter();
                return [$key => $val];
            })->all();

        return view('home', compact('page', 'variables'));
    }
}
