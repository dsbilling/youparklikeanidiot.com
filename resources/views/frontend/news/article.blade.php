@extends('layouts.main')
@section('title', $article->title.' - News')

@section('content')

<div class="container">

  <div class="row">

    <div class="col s12">

      <h1 class="post-title">{{ $article->title }}</h1>
      <span class="post-date">Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></span>

      {!! $article->content !!}
    </div>

  </div>

</div>

@endsection
