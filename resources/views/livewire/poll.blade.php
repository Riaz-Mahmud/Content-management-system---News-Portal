<div>
    @if (count($data) > 0)
        <div class="box-widget fl-wrap ">
            <div class="widget-title">Polls</div>
            <div class="box-widget-content">
                <div class="wrapper">
                    <h3 style="font-size: medium;">{{$data['question']}}</h3>
                    <div class="poll-area">
                        @foreach ($data['items'] as $item)
                            <input type="radio" name="poll" id="opt-{{$item['hashId']}}" class="poll-response-submit" wire:click="responseSubmit('{{$data['hashId']}}', '{{$item['hashId']}}')">
                            <label for="opt-{{$item['hashId']}}" class="opt-{{$item['hashId']}}
                                @php
                                    if (isset($data['userPollResponse'])) {
                                        if(!Auth::check()){
                                            $cookie = json_decode(Cookie::get('poll_response'));
                                            if($cookie != null && $cookie->value == $item['id'] ){
                                                echo 'selected ';
                                            }
                                        }else {
                                            if($data['userPollResponse']->poll_item_id == $item['id'] ){
                                                echo 'selected ';
                                            }
                                        }
                                        echo 'selectall ';
                                    }
                                @endphp">
                                <div class="row">
                                    <div class="column">
                                    <span class="circle"></span>
                                    <span class="text">{{$item['option']}}</span>
                                    </div>
                                    <span class="percent">{{$item['percentage']}}%</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
