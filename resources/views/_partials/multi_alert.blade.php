<div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('title') }}:</strong> {{ session()->get('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@section('script')
<script>
    $.noConflict()
    jQuery(document).ready(function($){

        setTimeout(function () {
            $('.alert-{{ session()->get('type') }}').fadeOut(function () {
                $('.alert').remove()
            })
        }, 5000);

    })
</script>
@endsection
