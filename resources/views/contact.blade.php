@extends('layouts.app')

@section('title', 'Contact Me')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact Me</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Your Name" value="{{ old('name') }}" autofocus="">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" autofocus="">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="message" class="col-md-4 col-form-label text-md-end">Message</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" cols="15" rows="5">{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send
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
