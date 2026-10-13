<!doctype html>
<html lang="en" data-sec="{{ $site->theme === 'default' ? '' : $site->theme }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>{{ $title ?? $site->name }}</title>
<meta name="description" content="{{ $description ?? $site->tagline }}">
@if (config('seo.noindex'))
<meta name="robots" content="noindex, nofollow">
@endif
<link rel="canonical" href="{{ $site->baseUrl() . request()->getPathInfo() }}">
<meta property="og:site_name" content="{{ $site->name }}">
<meta property="og:locale" content="zh_CN">
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:title" content="{{ $title ?? $site->name }}">
<meta property="og:description" content="{{ $description ?? $site->tagline }}">
<meta property="og:url" content="{{ $site->baseUrl() . request()->getPathInfo() }}">
<meta name="twitter:card" content="summary">
<meta name="color-scheme" content="light dark">
<link rel="stylesheet" href="/css/site.css">
<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect x='4' y='4' width='56' height='56' rx='17' fill='%23f0a35a'/%3E%3C/svg%3E">
@stack('head')
</head>
<body>
@include('partials.sprite')
<a class="skipper" href="#bay-main">跳到主要内容</a>

<header class="ledge">
  <div class="ledge-in">
    <a class="ledge-brand" href="/">
      <svg class="mark" viewBox="0 0 64 64" width="36" height="36" aria-hidden="true" focusable="false"><rect class="mark-tile" x="4" y="4" width="56" height="56" rx="17"/><rect class="mark-body" x="19" y="10" width="26" height="46" rx="8"/><rect class="mark-isle" x="23" y="15" width="14" height="14" rx="5"/><circle class="mark-lens" cx="30" cy="22" r="3.2"/></svg>
      <span class="ledge-name">{{ $site->name }}</span>
    </a>
    <nav class="ledge-nav" aria-label="主菜单">
      <ul class="ledge-list">
        @foreach ($site->categories as $navCategory)
        <li><a class="ledge-pill" data-sec="{{ $navCategory->slug }}" href="{{ $navCategory->path() }}"><svg class="gl" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><use href="#gl-{{ ['gms' => 'cog', 'google-play' => 'bag', 'apk' => 'box', 'vpn' => 'shield'][$navCategory->slug] ?? 'cog' }}"/></svg><span>{{ $navCategory->name }}</span></a></li>
        @endforeach
      </ul>
    </nav>
  </div>
</header>

<main class="ground" id="bay-main">
@yield('content')
</main>

<footer class="coda">
  <div class="frame coda-in">
    <div class="coda-say">
      <p class="coda-line">{{ $site->tagline }}</p>
      <p class="coda-brand"><svg class="mark" viewBox="0 0 64 64" width="36" height="36" aria-hidden="true" focusable="false"><rect class="mark-tile" x="4" y="4" width="56" height="56" rx="17"/><rect class="mark-body" x="19" y="10" width="26" height="46" rx="8"/><rect class="mark-isle" x="23" y="15" width="14" height="14" rx="5"/><circle class="mark-lens" cx="30" cy="22" r="3.2"/></svg> <span>{{ $site->name }}</span><span class="dots" aria-hidden="true"><i></i><i></i><i></i></span></p>
    </div>
    <div class="coda-recent">
      <p class="coda-cap">最近更新</p>
      <ul class="coda-list">
        @foreach ($site->articles()->published()->orderByDesc('published_at')->take(3)->get() as $recent)
        <li><a href="{{ $recent->path() }}">{{ $recent->title }}</a></li>
        @endforeach
      </ul>
    </div>
    <nav class="coda-nav" aria-label="站内导航">
      <ul>
        @foreach ($site->categories as $navCategory)
        <li><a data-sec="{{ $navCategory->slug }}" href="{{ $navCategory->path() }}">{{ $navCategory->name }}</a></li>
        @endforeach
      </ul>
    </nav>
    <p class="coda-note">{{ $site->name }}是独立的安卓使用指南，与 Google、华为、小米、OPPO、vivo 等厂商无关联；Google、Android、Google Play 为其所有者的商标。</p>
    <p class="coda-copy">© {{ date('Y') }} {{ $site->name }}</p>
  </div>
</footer>
</body>
</html>
