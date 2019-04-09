<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends PublicController
{
    public function __invoke()
    {
        $page = Page::whereLink('/')->first();
        if (!$page) {
            return abort(404);
        }
        $v = $page->getVariables();
        return view('home', compact('page', 'v'));
    }
}
