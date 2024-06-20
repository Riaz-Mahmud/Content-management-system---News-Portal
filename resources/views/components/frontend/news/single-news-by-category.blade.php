@if ($data!= null)

    <!--list-post-->
    <div class="list-post fl-wrap">
        <div class="list-post-media">
            <a href="{{URL::to($data['slug'])}}">
                <div class="bg-wrap">
                    <div class="bg" data-bg="{{$data['image']}}"></div>
                </div>
            </a>
            <span class="post-media_title">&copy; {{$data['author']}}</span>
        </div>
        <div class="list-post-content">
            @if ($data['category'] != null)

                @foreach ($data['category'] as $category)
                    <a class="post-category-marker" href="{{URL::to($category['slug'])}}" style="margin-right: 2px">{{$category['title']}}</a>
                @endforeach

            @endif
            <h3><a href="{{URL::to($data['slug'])}}">{{$data['title']}}</a></h3>
            <span class="post-date"><i class="far fa-clock"></i> {{$data['date']}}</span>
            <p>{{$data['description']}}</p>
            <ul class="post-opt">
                <li><i class="far fa-comments-alt"></i> {{$data['commentCount']}}</li>
                <li><i class="fal fa-eye"></i> {{$data['viewCount']}}</li>
            </ul>
            <div class="author-link"><a href="{{route('profile.show', $data['author_id'])}}"><img src="{{ $data['author_image'] }}" alt="">  <span>By {{ $data['author'] }}</span></a></div>
        </div>
    </div>
    <!--list-post end-->

@endif
