@extends('layouts.app')

@section('content')
<div class="frame" data-sec="{{ $category->slug }}">
  <nav class="trail" aria-label="路径"><a href="/">首页</a><span aria-hidden="true">›</span><span>{{ $category->name }}</span></nav>

  <section class="cover cover--bin">
    <div class="cover-head">
      <p class="leaf-tags"><span class="tag tag--sec">{{ $category->name }}</span></p>
      <h1>{{ $category->name }}</h1>
      <p class="cover-lede">{{ $category->lede }}</p>
    </div>
    <img class="cover-art" src="/img/{{ $category->scene }}" alt="">
  </section>

  <section class="bin">
    <div class="bin-head"><h2>全部文章</h2><span class="bin-count">{{ $articles->count() }} 篇</span></div>
    <div class="bin-row">
      @forelse ($articles as $article)
        @include('partials.tile', ['article' => $article])
      @empty
        <p class="cover-note">这个栏目还没有文章。</p>
      @endforelse
    </div>
  </section>
</div>
@endsection
