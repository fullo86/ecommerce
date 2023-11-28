@extends('frontpage/layouts/main')
@section('alertConfirmEmail')
@if (Session::has('status'))
<div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-failed' }}">
    {{ Session::get('message') }}
</div>
@endif
@endsection