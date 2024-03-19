@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(Session::get('title'))
                @include('_partials.multi_alert')
            @endif
            <div class="card">
                <div class="card-header"><h2>{{ $article->title }}</h2></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <strong>{{ __('Last Update: ') }}</strong>
                            {{ date('d M, Y', strtotime($article->updated_at)) }}
                        </div>
                        @if(Auth::id() == $article->user_id)
                            <div>
                                <a href="{{ route('article.edit', $article) }}" class="badge text-bg-info text-decoration-none">
                                    {{ __('Edit') }}
                                </a>
                                <a href="{{ route('article.destroy', $article) }}" class="badge text-bg-danger text-decoration-none" onclick="event.preventDefault();
                                document.getElementById('delete-article').submit(); return confirm('{{ __('Are you sure?') }}');">
                                    {{ __('Delete') }}
                                </a>
                                <form action="{{ route('article.destroy', $article) }}" method="post" id="delete-article">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </div>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('Categories: ') }}</strong>
                        @foreach ($categories as $key => $category)
                            <span class="badge bg-secondary">{{ $categories[$key] }}</span>
                        @endforeach
                    </li>
                  </ul>
                <div class="card-body">
                    {!! nl2br(e($article->content)) !!}
                </div>
                <div class="card-footer">
                    <strong>{{ __('Author: ') }}</strong>
                    <a href="{{ route('article.userArticles', $article->user->id) }}" style="text-decoration: none">
                        {!! Avatar::create($article->user->name)->setDimension(21)->setFontSize(10)->toSvg() !!}
                        {{ $article->user->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card" id="comment-form">
                <div class="card-header">
                    <strong>{{ __('Comments') }}</strong>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="{{ route('comments.store', $article) }}" method="POST">
                            @method('POST')
                            @csrf
                            <div class="input-group mb-3">
                                <textarea class="form-control" name="content" aria-label="With textarea" placeholder="{{ __('Type your comment here...') }}"></textarea>
                                <button type="submit" class="btn btn-success" id="button-addon2">{{ __('Comment') }}</button>
                              </div>
                        </form>
                    </li>
                    @forelse($comments as $comment)
                        <li class="list-group-item d-flex justify-content-between" style="background: #f7f7f7">
                            <div>
                                <a href="{{ route('article.userArticles', $comment->user->id) }}" class="text-decoration-none">
                                    {!! Avatar::create($comment->user->name)->setDimension(21)->setFontSize(10)->toSvg() !!}
                                    {{ $comment->user->name }}
                                </a>
                            </div>
                            <div class="d-flex justify-content-end">
                                @if(Auth::id() == $comment->user_id)
                                    <form class="form-inline" action="{{ route('comments.destroy', $comment) }}" method="post" id="delete-article">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <button type="submit" class="badge text-bg-danger text-decoration-none border-0" onclick="return confirm('{{ __('Are you sure?') }}');">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                @endif
                                <div class="ps-1">
                                    {{ date('d M, Y', strtotime($comment->created_at)) }}
                                    {{ __('at') }}
                                    {{ date('h:i A', strtotime($comment->created_at)) }}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item" id="comments">{{ $comment->content }}</li>
                    @empty
                        <li class="list-group-item text-center" id="comments">{{ __("There's no comments to view") }}</li>
                    @endforelse
                </ul>
            </div>
            <div class="d-flex justify-content-center mt-2">
                {{ $comments->onEachSide(2)->links() }}
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body text-center">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                    {{ __('to view the comments') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

@endsection
