@extends('layouts.app')

@section('title', __('Create New Article'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session()->get('title'))
                @include('_partials.multi_alert')
            @endif
            <div class="card">
                <div class="card-header">Create New Article</div>
                <div class="card-body">
                    <div class="row justify-content-center" style="-webkit-user-select: none">
                        {!! Avatar::create(Auth::user()->name)->setDimension(128)->setFontSize(54)->toSvg() !!}
                        <div class="text-center mt-2">
                            <span class="h4">{{ Auth::user()->name }}</span>
                            <span class="text-center text-muted d-block">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <form action="{{ url('profile') }}" method="post" class="row" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-12 mb-1">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 mb-1 mt-2">
                            <label class="mt-1 mb-1">Email</label>
                            <input type="text" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 mb-1 mt-2">
                            <label class="mt-1 mb-1">Old Password</label>
                            <input type="password" name="old-password" class="form-control form-control-lg @error('old-password') is-invalid @enderror" placeholder="********" >
                            @error('old-password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 mb-1 mt-2">
                            <label class="mt-1 mb-1">New Password</label>
                            <input type="password" name="new-password" class="form-control form-control-lg @error('new-password') is-invalid @enderror" placeholder="********" >
                            @error('new-password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-12 mb-1 mt-2">
                            <label class="mt-1 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="********" >
                        </div>

                        <div class="form-group col-lg-12 mt-4">
                            <hr>
                            <div class="d-flex flex-row-reverse">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
