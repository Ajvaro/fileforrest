@extends('account.layouts.default')

@section('account.content')

    <h1 class="title">Your files</h1>

    @if($files->count())

        @each('account.files.partials.file', $files, 'file')

    @endif

    <hr>

    {{ $files->links() }}

@endsection