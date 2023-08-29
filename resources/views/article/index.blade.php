@php
/**
* @var \App\Models\Article $article
*/
@endphp

@extends('layouts.index')
@section('title', 'News')
@section('content')
    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{ route('article.parse') }}" class="btn btn-info">Parse</a>
            <a href="{{ route('article.clean') }}" class="btn btn-danger">Clear</a>
        </div>

        @foreach($articles as $article)
            <div class="col-md-4 mb-2">
                <h4>{{ $article->title }}</h4>
                <p>
                    {{ $article->description }}
                    <a href="{{ route('article.show', $article) }}" class="btn btn-info">More</a>
                </p>
            </div>
        @endforeach
    </div>
@endsection
