<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Photos extends Controller
{
    public function __construct()
    {
        view()->share('active_photos', 'active');
        view()->share('active_menu', 'active');
        view()->share('open_menu', 'menu-open');
    }
    public function index()
    {
        $photos = \App\Photo::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.photos', 15));

        $page_title = 'Photo';

        return view('admin.photos.index', compact('photos', 'page_title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Adding Image';
        $photo = new Photo();
        $submit_text = "Add Image";

        return view('admin.photos.add', compact('photo', 'page_title', 'submit_text'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\AdminArticleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Admin\ManagePhoto $request)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);
        $photo = new Photo();
        $photo->name=$request->get('name');
        $photo->sort_order=$request->get('sort_order');
        $photo->save();
        $photo->replace_image('image', 'image', $request, $photo->id);
        $photo->save();
        return redirect()->route('admin.photo.index')->with('success_message', 'Image was added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        $page_title = 'Editing Image';
        $submit_text = "Save changes";

        return view('admin.photos.edit', compact('photo', 'page_title', 'submit_text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Photo $photo,Requests\Admin\ManagePhoto $request)
    {
        $photo->name=$request->get('name');
        $photo->sort_order=$request->get('sort_order');
        $photo->save();
        $photo->replace_image('image', 'image', $request, $photo->id);
        $photo->save();
        return redirect()->route('admin.photo.index')->with('success_message', 'Image was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('admin.photo.index')->with('success_message', 'Image was deleted');

    }
}
