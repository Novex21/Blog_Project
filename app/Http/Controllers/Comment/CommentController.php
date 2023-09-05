<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

use Illuminate\Support\Facades\Gate; //**************


class CommentController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function create() {

      $validator = validator(request()->all(), [
        'content' => 'required',
      ]);
  
      if($validator->fails()) {
        return back()->withErrors($validator);
      }
      $comment = new Comment;
      $comment->content = request()->content;
      $comment->article_id = request()->article_id;
      $comment->user_id = auth()->user()->id;
      $comment->save();

      return back();
    }

    public function delete($id) {
      $comment = Comment::find($id);
      if( Gate::allows('comment-delete', $comment)) { // ပြန်သုံးတဲ့အချိန်မှာ User ကို ထည့်ပေးစရာမလိုပါဘူး။Laravel က သူ့ဘာသာ ထည့်ပေးသွားပါတယ်။
        $comment->delete();
        return back();
      }
      else {
        return back()->with('error', 'Unauthorized');
      }

      //if(Gate::denies('comment-delete', $comment)) {
      //return back()->with('error', 'Unauthorize');
      //}
      //$comment->delete();
      //return back();
      //}
    }
}
