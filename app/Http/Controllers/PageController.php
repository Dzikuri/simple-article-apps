<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about(Request $request)
    {
        $pages = Page::where("id", $request->id)->first();
        // $data['page'] = $pages;
		return view("page.about", $pages);
        
    }

    public function contact(Request $request)
    {
        $pages = Page::where("id", $request->id)->first();
        // $data['page'] = $pages;
		return view("page.contact", $pages);
        
    }
}
