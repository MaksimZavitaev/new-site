<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PageController extends PublicController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $link)
    {
        $view = "pages/${link}";
        if (view()->exists($view)) {
            $page = Page::whereLink("/${link}")->active()->withoutTrashed()->first();

            if ($page) {
                $v = $page->getVariables();

                $children = $page
                    ->parent
                    ->children()
                    ->get(['name', 'link'])
                    ->filter(function ($item) use ($page) {
                        return $item->id !== $page->id;
                    });

                return view($view, compact('page', 'v', 'children'));
            }
            logger("Page ${link} not found!");
        } else {
            logger("Template ${view} not found!");
        }

        return abort(404);
    }
}
