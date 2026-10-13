<article class="tile" data-sec="{{ $article->category->slug }}">
  <a class="tile-art" href="{{ $article->path() }}" aria-hidden="true" tabindex="-1">
    <img src="/img/{{ $article->category->scene ?? 'scene-gms.svg' }}" alt="" loading="lazy" decoding="async">
  </a>
  <div class="tile-body">
    <h3 class="tile-title"><a href="{{ $article->path() }}">{{ $article->title }}</a></h3>
    <p class="tile-lede">{{ $article->description }}</p>
    <p class="tile-foot"><span class="tag tag--sec">{{ $article->category->name }}</span><time datetime="{{ $article->published_at?->toDateString() }}">{{ $article->published_at?->toDateString() }}</time></p>
  </div>
</article>
