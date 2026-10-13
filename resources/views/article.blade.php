@extends('layouts.app', [
    'title' => $article->title.config('seo.title_separator').$site->name,
    'description' => $article->description,
    'ogType' => 'article',
])

@push('head')
<meta property="article:published_time" content="{{ $article->published_at?->toAtomString() }}">
<meta property="article:modified_time" content="{{ $article->updated_at?->toAtomString() }}">
<meta property="article:section" content="{{ $category->name }}">
@endpush

@section('content')
<div class="frame" data-sec="{{ $category->slug }}">
  <nav class="trail" aria-label="路径"><a href="/">首页</a><span aria-hidden="true">›</span><a href="{{ $category->path() }}">{{ $category->name }}</a></nav>

  <article class="leaf">
    <header class="leaf-head">
      <p class="leaf-tags"><a class="tag tag--sec" href="{{ $category->path() }}">{{ $category->name }}</a></p>
      <h1>{{ $article->title }}</h1>
      <p class="leaf-meta"><span>更新于 <time datetime="{{ $article->published_at?->toDateString() }}">{{ $article->published_at?->toDateString() }}</time></span><span>阅读约 {{ $article->reading_minutes }} 分钟</span></p>
    </header>

    <figure class="leaf-art">
      <img src="/img/{{ $category->scene }}" alt="">
    </figure>

    @if ($article->summary)
    <section class="bubble" aria-labelledby="bubble-cap">
      <p class="bubble-head" id="bubble-cap"><span class="dots" aria-hidden="true"><i></i><i></i><i></i></span> 先看结论</p>
      <p class="bubble-body">{{ $article->summary }}</p>
    </section>
    @endif

    <div class="prose">
      {!! $article->body !!}
    </div>
  </article>

  @if ($related->isNotEmpty())
  <section class="nextup" aria-labelledby="nextup-cap">
    <h2 id="nextup-cap">接着看</h2>
    <div class="bin-row">
      @foreach ($related as $item)
        @include('partials.tile', ['article' => $item])
      @endforeach
    </div>
  </section>
  @endif
</div>
@endsection
