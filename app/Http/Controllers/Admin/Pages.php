<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Pages extends Controller
{
    public function __construct()
    {
        view()->share('active_pages', 'active');
    }

    public function index()
    {
        $pages = \App\Page::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.page', 15));
        
        $page_title = 'Pages';

        return view('admin.pages.index', compact('pages', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Adding page';
        $page = new Page();
        $pages = [0 => '--Not set--'] + Page::where('parent_id', null)->orderBy('sort_order')->pluck('menu_name', 'id')->all();
        $submit_text = "Add page";
        return view('admin.pages.add', compact('pages', 'page', 'page_title', 'submit_text'));
    }

    public function store(Requests\Admin\ManagePage $request)
    {
        $page = new Page();
        $page->fill($request->only('brief','on_top','on_bottom','parent_id', 'title', 'content', 'seo_title', 'seo_description', 'seo_keywords', 'sort_order', 'manage_pages', 'menu_name', 'seo_url'
        ));
        $this->validate($request, [
            'seo_url' => 'required|unique:pages',
        ]);
        if ($request->get('parent_id') == '0') {
            $page->parent_id = null;
        }
        $page->save();

        return redirect()->route('admin.page.index')->with('success_message', 'Page was added');
    }

    public function edit(Page $page)
    {
        $page_title = 'Editing page';
        $submit_text = "Save changes";
        $pages = [0 => '--Not set--'] + Page::where('parent_id', null)->orderBy('sort_order')->pluck('menu_name', 'id')->all();


        return view('admin.pages.edit', compact('pages', 'page', 'page_title', 'submit_text'));
    }

    public function update(Page $page,Requests\Admin\ManagePage $request)
    {
        $page->fill($request->only('brief','on_top','on_bottom','parent_id', 'title', 'content', 'seo_title', 'seo_description', 'seo_keywords', 'sort_order', 'manage_pages', 'menu_name'
        ));
        if ($request->get('parent_id') == '0') {
            $page->parent_id = null;
        }
        $page->save();
        return redirect()->route('admin.page.index')->with('success_message', 'Page was updated');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index')->with('success_message', 'Page was deleted');

    }
}
