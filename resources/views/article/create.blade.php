@extends('layouts.app')

@section('title', __('Create New Article'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Create New Article</div>
                <div class="card-body">
                    <form action="{{ route('article.store') }}" method="post" class="row">
                        @include('article._form', ['submitText' => __('Create')])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
