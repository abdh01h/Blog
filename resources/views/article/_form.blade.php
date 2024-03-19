@csrf
<div class="col-12">
    <label for="title" class="form-label">{{ __("Title") }}</label>
    <div class="input-group has-validation">
        <input type="text" name="title" id="title" class="form-control form-control-lg @error('title') is-invalid @enderror" placeholder="{{ __("Title of the article") }}" @isset($article) value="{{ $article->title }}" @else value="{{ old('title') }}" @endisset >
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="col-12 mt-3">
    <label for="content" class="form-label">{{ __("Content") }}</label>
    <div class="input-group has-validation">
        <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" name="content" id="content" rows="15" placeholder="{{ __("Write something here...") }}" required>@isset($article){{ $article->content }}@else{{ old('content') }}@endisset</textarea>
        @error('content')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="col-12 mt-3">
    <label for="category" class="form-label">{{ __("Categories") }}</label>
    <select name="categories[]" class="form-select form-select-lg mb-3 @error('categories') is-invalid @enderror" id="category" aria-label="category" required multiple>
        @foreach ($categories as $key => $title)
            <option value="{{ $key }}"
            @if(isset($selectedCategories) && in_array($key, $selectedCategories))
                selected
            @endif
            {{ in_array($key, old("categories") ?: []) ? "selected": "" }}
            >{{ $title }}</option>
        @endforeach
    </select>
    @error('categories')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="col-lg-12 mt-4">
    <hr>
    <div class="d-flex flex-row-reverse">
        <button type="submit" class="btn btn-lg btn-primary">
            {{ $submitText }}
        </button>
    </div>
</div>
