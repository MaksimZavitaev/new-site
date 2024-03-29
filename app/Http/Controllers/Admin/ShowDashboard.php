<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowDashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('admin.dashboard.index', [
            'users' => User::count(),
            'pages' => Page::count(),
        ]);
    }
}
