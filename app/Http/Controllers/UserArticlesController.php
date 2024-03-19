<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserArticlesController extends Controller
{
    public function index(User $user) {

        $articles = $user->articles()
                        ->join('users', 'users.id', '=', 'articles.user_id')
                        ->select('articles.id', 'articles.title', 'articles.created_at', 'articles.user_id', 'users.name')
                        ->orderBy("articles.created_at", "desc")
                        ->paginate(10);

        return view('article.userArticles', compact('articles'));

    }
}
