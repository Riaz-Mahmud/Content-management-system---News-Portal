 <!-- box-widget -->
 <div class="box-widget fl-wrap" >
    <div class="widget-title">Popular Tags</div>
    <div class="box-widget-content">
        <div class="tags-widget">
            @foreach ($data['items'] as $item)
                <a href="{{URL::to($item['slug'])}}">{{$item['label']}}</a>
            @endforeach
        </div>
    </div>
</div>
<!-- box-widget  end -->
