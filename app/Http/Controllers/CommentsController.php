<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Comment;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Article $article) {

        $request->validate([
            'content'       => ['required', 'max:300'],
        ]);

        $request['user_id'] = Auth::id();

        $article->comments()->create($request->all());

        // $article->comments()->orderBy('id', 'DESC')->get(); // doesn't work

        return redirect()->back();

    }

    public function destroy(Comment $comment)
    {

        if(Auth::id() != $comment->user_id) {
            return abort(404);
        }

        $comment->delete();

        \Session()->flash('type', __('success'));
        \Session()->flash('title', __('Deleted Successful'));
        \Session()->flash('message', __('The Comment Has Been Successfully Deleted.'));

        return back();
    }

}
