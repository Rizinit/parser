@php
/**
* @var \App\Models\Article $article
*/
@endphp

@extends('layouts.index')
@section('title', 'Новости')
@section('content')
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-4 mb-2">
                <h4>{{ $article->title }}</h4>
                <p>
                    {{ $article->description }}
                    <a href="{!! url('article', $article->id) !!}" class="btn btn-info">Подробнее</a>
                </p>
            </div>
        @endforeach
    </div>
@endsection
