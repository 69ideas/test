<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $top_pages=Page::where('manage_pages',1)->where('on_top',1)->get();
        $bottom_pages=Page::where('manage_pages',1)->where('on_bottom',1)->get();
        view()->share('top_pages', $top_pages);
        view()->share('bottom_pages', $bottom_pages);
    }
}
