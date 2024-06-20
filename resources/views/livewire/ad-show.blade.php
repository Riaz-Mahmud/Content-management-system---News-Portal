@if(config('frontend.ads.show'))
    @if ($data['row'] != null)

        @if ($data['place'] == 'home_page')
            <div wire:poll.750ms="refreshAd('{{$data['code']}}')">
                <a @if($data['row']['url'])href="{{URL::to($data['row']['url']) ?? '#'}}"@endif @if($data['row']['url'])target="_blank"@endif>
                    <img  style="width:{{$data['row']['width']}}px; height: {{$data['row']['height']}}px;" src="{{$data['row']['image']}}">
                </a>
            </div>
        @elseif ($data['place'] == 'news_details_page')
            <div class="box-widget fl-wrap" wire:poll.750ms="refreshAd('{{$data['code']}}')">
                <div class="box-widget-content" >
                    <div class="banner-widget fl-wrap" style="width:{{$data['row']['width']}}px; height: {{$data['row']['height']}}px;">
                        <div class="bg-wrap">
                            <a @if($data['row']['url'])href="{{URL::to($data['row']['url']) ?? '#'}}"@endif @if($data['row']['url'])target="_blank"@endif>
                                <img style="width:{{$data['row']['width']}}px; height: {{$data['row']['height']}}px;" src="{{$data['row']['image']}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($data['place'] == 'news_details_page_banner')
            <div class="banner-image" wire:poll.15000ms="refreshAd('{{$data['code']}}')">
                <a @if($data['row']['url'])href="{{URL::to($data['row']['url']) ?? '#'}}"@endif @if($data['row']['url'])target="_blank"@endif>
                    <img src="{{$data['row']['image']}}" alt="" style="width: 100%;height: 100px;">
                </a>
            </div>
        @endif

    @endif
@endif
