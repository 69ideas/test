<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Comments extends Controller
{
  public function store(Requests\Admin\ManageComment $request){
      $comment=new Comment();
      $comment->user_id=\Auth()->user()->id;
      $comment->event_id=$request->get('event');
      $comment->comment=$request->get('comment');
      $comment->save();
      return redirect()->back()->with('success_message','Your comment was added');

  }
}
