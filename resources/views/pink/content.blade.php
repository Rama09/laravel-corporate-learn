@if($portfolio && count($portfolio) > 0)
<div id="content-home" class="content group">
    <div class="hentry group">
        <div class="section portfolio">

            <h3 class="title">Последние работы</h3>

            @foreach($portfolio as $key => $item)
                @if($key == 0)
                    <div class="hentry work group portfolio-sticky portfolio-full-description">
                        <div class="work-thumbnail">
                            <a class="thumb"><img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->max }}" alt="0081" title="0081" /></a>
                            <div class="work-overlay">
                                <h3><a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h3>
                                <p class="work-overlay-categories"><img src="{{ asset(env('THEME')) }}/images/categories.png" alt="Categories" /> тег: <a href="#">{{ $item->filter->title }}</a></p>
                            </div>
                        </div>
                        <div class="work-description">
                            <h2><a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h2>
                            <p class="work-categories">тег: <a href="#">{{ $item->filter->title }}</a></p>
                            <p>{{ str_limit($item->text, 200) }}</p>
                                <a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}" class="read-more">|| Подробнее</a>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div class="portfolio-projects">
                    @continue
                @endif
                        <div class="related_project {{ $key==4 ? ' related_project_last' : NULL }}">
                            <div class="overlay_a related_img">
                                <div class="overlay_wrapper">
                                    <img src="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->mini }}" alt="0061" title="0061" />
                                    <div class="overlay">
                                        <a class="overlay_img" href="{{ asset(env('THEME')) }}/images/projects/{{ $item->img->path }}" rel="lightbox" title=""></a>
                                        <a class="overlay_project" href="{{ route('portfolio.show', ['alias' => $item->alias]) }}"></a>
                                        <span class="overlay_title">{{ $item->title }}</span>
                                    </div>
                                </div>
                            </div>
                            <h4><a href="{{ route('portfolio.show', ['alias' => $item->alias]) }}">{{ $item->title }}</a></h4>
                            <p>{{ str_limit($item->text, 60) }}</p>
                        </div>
            @endforeach
                    </div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- START COMMENTS -->
    <div id="comments">
    </div>
    <!-- END COMMENTS -->
</div>
@endif