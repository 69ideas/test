<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Faqs extends Controller
{
    public function __construct()
    {
        view()->share('active_faqs', 'active');
        view()->share('active_menu', 'active');
        view()->share('open_menu', 'menu-open');
    }
    public function index()
    {
        $faqs = \App\Faq::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.faqs', 15));

        $page_title = 'Faq';

        return view('admin.faqs.index', compact('faqs', 'page_title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Adding question';
        $faq = new Faq();
        $submit_text = "Add question";

        return view('admin.faqs.add', compact('faq', 'page_title', 'submit_text'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\AdminArticleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Admin\ManageFaq $request)
    {
        $faq = new Faq();
        $faq->fill($request->only('question','answer','sort_order'));
        $faq->save();
        return redirect()->route('admin.faq.index')->with('success_message', 'Question was added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $page_title = 'Editing question';
        $page_second_title = $faq->question;
        $submit_text = "Save changes";

        return view('admin.faqs.edit', compact('faq', 'page_title', 'submit_text', 'page_second_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Faq $faq,Requests\Admin\ManageFaq $request)
    {
        $faq->fill($request->only('question', 'answer','sort_order'));
        $faq->save();
        return redirect()->route('admin.faq.index')->with('success_message', 'Question was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success_message', 'Question was deleted');

    }
}
