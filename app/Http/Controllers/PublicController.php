<?php


namespace App\Http\Controllers;


use App\Models\Attention;

abstract class PublicController extends Controller
{
    public function __construct()
    {
        \View::share('attentions', Attention::active()->started()->notEnded()->get());
    }
}
