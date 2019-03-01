<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();
        $app = new Application();
        $app->page_id = $data['page_id'];
        $app->form_id = $data['form_id'];
        $app->data = $data;
        $app->user_ip = $request->getClientIp();
        $app->user_agent = $request->userAgent();
        $app->save();
    }
}
