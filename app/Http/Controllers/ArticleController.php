<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy("id", "desc")->paginate(10);

        return view('article.articles', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::select('id', 'title')->get(); // Will bring everything

        $categories = Category::pluck('title', 'id'); // Will bring needed data only

        return view('article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => ['required', 'max:120'],
            'content'       => ['required'],
            'categories'    => ['required'],
        ]);

        // $article = Article::create([
        //     'user_id'       => Auth::user()->id, // Auth::user()->id
        //     'title'         => $request->title,
        //     'content'       => $request->content,
        // ]);

        $user = Auth::user();

        $categoies = array_values($request->categories); // Erase keys and return values

        $article = $user->articles()->create($request->except('categories')); // Use this as a shortcut
        $article->categories()->attach($categoies);

        // $user->articles()->create($request->except('categories'))->categories()->attach(array_values($request->categories)); // Use this as a super shortcut

        // foreach($request->categories as $category) {
        //     $article = Article::find($data->id)->categories()->attach($category);
        // } // You can do it that way as foreach array or use array_values as better method

        $request->session()->flash('type', __('success'));
        $request->session()->flash('title', __('Created Successful'));
        $request->session()->flash('message', __('The Article Has Been Successfully Created.'));

        // return redirect()->to('/');

        return redirect()->route('article.show', $article);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $categories = $article->categories()->pluck('title');

        $comments = Comment::where('article_id', $article->id)->latest()->paginate(10);

        return view('article.article', compact('article', 'categories', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {

        if(Auth::id() != $article->user_id) {
            return abort(404);
        }

        $categories = Category::pluck('title', 'id');

        $selectedCategories = $article->categories()->pluck('id')->toArray(); ;

        return view('article.edit', compact('categories', 'article', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        if(Auth::id() != $article->user_id) {
            return abort(404);
        }

        $request->validate([
            'title'         => ['required'],
            'content'       => ['required'],
            'categories'    => ['required'],
        ]);

        $article->update($request->except('categories')); // Use this as a shortcut

        $article->categories()->sync($request->categories);

        $request->session()->flash('type', __('success'));
        $request->session()->flash('title', __('Updated Successful'));
        $request->session()->flash('message', __('The Article Has Been Successfully Updated.'));

        return redirect()->route('article.show', $article);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        if(Auth::id() != $article->user_id) {
            return abort(404);
        }

        $article->delete();

        \Session()->flash('type', __('success'));
        \Session()->flash('title', __('Deleted Successful'));
        \Session()->flash('message', __('The Article Has Been Successfully Deleted.'));

        return redirect()->to('/');
    }
}
