@extends('layouts.app', ['title' => $site->name.config('seo.title_separator').$site->tagline])

@section('content')
<section class="cover">
  <div class="frame">
    <div class="cover-head">
      <h1>{{ $site->tagline }}</h1>
      <p class="cover-lede">
        @foreach ($categories as $category){{ $category->name }}@if (! $loop->last)、@endif @endforeach
        —— 按手机品牌一步步来。
      </p>
      @if ($categories->isNotEmpty())
      <p class="cover-ask"><a class="pop" href="{{ $categories->first()->path() }}">不确定？先看{{ $categories->first()->name }}</a></p>
      @endif
    </div>

    <div class="cover-pick">
      <p class="cover-cue"><b class="decal-n" aria-hidden="true">1</b> 从你的手机开始</p>
      <h2 class="cover-q">你想先解决什么？</h2>
      <ul class="handsets">
        @foreach ($categories as $category)
        <li class="handset" data-sec="{{ $category->slug }}">
          <a class="handset-link" href="{{ $category->path() }}">
            <img src="/img/{{ $category->scene }}" alt="">
            <span class="handset-name">{{ $category->name }}</span>
            <span class="handset-lede">{{ $category->lede }}</span>
          </a>
        </li>
        @endforeach
      </ul>
      <p class="cover-note">HarmonyOS NEXT 不能运行安卓 APK；先在<span class="keycap">设置</span>›<span class="keycap">关于手机</span>确认系统版本。</p>
    </div>
  </div>
</section>

<section class="bins">
  <div class="frame">
    @foreach ($categories as $category)
    @if (($byCategory[$category->id] ?? collect())->isNotEmpty())
    <section class="bin" data-sec="{{ $category->slug }}">
      <div class="bin-head">
        <h2>{{ $category->name }}</h2>
        <a class="bin-count" href="{{ $category->path() }}">全部 {{ $category->articles()->published()->count() }} 篇</a>
      </div>
      <div class="bin-row">
        @foreach ($byCategory[$category->id] as $article)
          @include('partials.tile', ['article' => $article])
        @endforeach
      </div>
    </section>
    @endif
    @endforeach
  </div>
</section>

<section class="latest">
  <div class="frame">
    <div class="band-head"><h2>最新更新</h2></div>
    <ul class="log">
      @foreach ($latest as $article)
      <li class="log-item">
        <a class="log-title" href="{{ $article->path() }}">{{ $article->title }}</a>
        <span class="log-meta"><span class="tag tag--sec" data-sec="{{ $article->category->slug }}">{{ $article->category->name }}</span> <time datetime="{{ $article->published_at?->toDateString() }}">{{ $article->published_at?->toDateString() }}</time></span>
      </li>
      @endforeach
    </ul>
  </div>
</section>
@endsection
