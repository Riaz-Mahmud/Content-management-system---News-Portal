@if ($data['news'])
    <div class="col-md-6">
        <!--list-post-->
        <div class="list-post fl-wrap">
            <a class="post-category-marker" href="{{ $data['news']['category']->slug}}">{{$data['news']['category']->title}}</a>
            <div class="list-post-media">
                <a href="{{ URL::to($data['news']['slug']) }}">
                    <div class="bg-wrap">
                        <div class="bg" data-bg="{{ $data['news']['image'] }}"></div>
                    </div>
                </a>
                <span class="post-media_title">&copy; {{ $data['news']['author'] }}</span>
            </div>
            <div class="list-post-content">
                <h3><a href="{{ URL::to($data['news']['slug']) }}">{{ $data['news']['title'] }}</a></h3>
                <span class="post-date"><i class="far fa-clock"></i> {{ $data['news']['date'] }}</span>
            </div>
        </div>
        <!--list-post end-->
    </div>
@endif

