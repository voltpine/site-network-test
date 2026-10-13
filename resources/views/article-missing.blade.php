@extends('layouts.app', ['title' => '找不到这篇文章'.config('seo.title_separator').$site->name])

@section('content')
<div class="frame" data-sec="{{ $category->slug }}">
  <nav class="trail" aria-label="路径"><a href="/">首页</a><span aria-hidden="true">›</span><a href="{{ $category->path() }}">{{ $category->name }}</a></nav>

  <section class="cover">
    <div class="cover-head">
      <h1>这篇文章还没有写好</h1>
      <p class="cover-lede">链接可能已经过期，或者文章正在整理中。先看看「{{ $category->name }}」栏目里的其他内容。</p>
      <p class="cover-ask"><a class="pop" href="{{ $category->path() }}">回到 {{ $category->name }}</a></p>
    </div>
  </section>
</div>
@endsection
