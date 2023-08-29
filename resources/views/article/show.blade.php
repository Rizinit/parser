@php
/**
 * @var \App\Models\Article $article
 */
@endphp

@extends('layouts.index')
@section('title', 'News / ' . $article->title)
@section('content')
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">All news</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <h1>{{ $article->title }}</h1>
            {!! $article->content !!}
        </div>
    </div>
@endsection
