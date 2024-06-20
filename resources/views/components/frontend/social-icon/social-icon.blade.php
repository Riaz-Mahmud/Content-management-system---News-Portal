@if ($data['position'] == 'top')
    @if (count($data['items'] ) > 0)
        <ul class="topbar-social">
            @foreach ($data['items'] as $item)
                <li><a href="{{$item['href']}}" target="_blank"><i class="{{$item['icon']}}"></i></a></li>
            @endforeach
        </ul>
    @endif
@elseif ($data['position'] == 'footer')
    @if (count($data['items'] ) > 0)
        <div class="footer-social fl-wrap">
            <ul>
                @foreach ($data['items'] as $item)
                    <li><a href="{{$item['href']}}" target="_blank"><i class="{{$item['icon']}}"></i></a></li>
                @endforeach
            </ul>
        </div>
    @endif
@elseif ($data['position'] == 'middle')
    @if (count($data['items'] ) > 0)
        <div class="box-widget fl-wrap">         <br/>
            <div class="widget-title">Follow Us</div>
            <div class="box-widget-content">
                <div class="social-widget">
                    @foreach ($data['items'] as $item)
                        <a href="{{$item['href']}}" target="_blank" class="facebook-soc">
                            <i class="{{$item['icon']}}"></i>
                            <span class="soc-widget-title">Follow</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@elseif ($data['position'] == 'contact-page')
    @if (count($data['items'] ) > 0)
        <div class="">
            <ul>
                @foreach ($data['items'] as $item)
                    <li><a href="{{$item['href']}}" target="_blank"><i class="{{$item['icon']}}"></i></a></li>
                @endforeach
            </ul>
        </div>
    @endif
@endif
