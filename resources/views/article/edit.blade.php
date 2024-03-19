@extends('layouts.app')

@section('title', __("Edit" . ': ' . $article->title))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">{{ __("Edit") }}: {{ $article->title }}</div>
                <div class="card-body">
                    <form action="{{ route('article.update', $article) }}" method="post" class="row">
                        @method('PATCH')
                        @include('article._form', ['submitText' => __('Edit')])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
