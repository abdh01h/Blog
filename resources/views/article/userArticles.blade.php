@extends('layouts.app')

@section('title', __('All Articles'))

@section('content')
<div class="container">
    @auth
        @if(Session::get('title'))
            @include('_partials.multi_alert')
        @endif
    @endauth
    <div class="row justify-content-center mt-4">
        @isset($articles)
            <div class="col-12 mb-3 ms-2">
                <h2 class="text-primary">{{ __("All Articles from ") . $articles[0]->name }}</h2>
            </div>
            @foreach ($articles as $article)
                <div class="col-6">
                    <div class="card border-light mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                {{ __('By: ') }}
                                <a href="{{ route('article.userArticles', $article->user_id) }}" style="text-decoration: none">
                                    {!! Avatar::create($article->user->name)->setDimension(21)->setFontSize(10)->toSvg() !!}
                                    @if(Auth::id() == $article->user->id)
                                        {{ 'You' }}
                                    @else
                                        {{ $article->user->name }}
                                    @endif
                                </a>
                            </div>
                            <div>{{ date('d M, Y', strtotime($article->created_at)) }}</div>
                        </div>
                        <div class="card-body">
                            <div>
                                <a href="{{ route('article.show', $article) }}">{{ $article->title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-1">
                {{ $articles->onEachSide(2)->links() }}
            </div>
        @else
            <div class="col-12">
                <div class="text-center">{{ __("You don't have anything to view!") }}</div>
            </div>
        @endisset
    </div>
</div>
@endsection
