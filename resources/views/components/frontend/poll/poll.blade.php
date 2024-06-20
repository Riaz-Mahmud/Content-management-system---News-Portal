
@if ($data)
    <style>
        ::selection{
            color: #fff;
            background: #6665ee;
        }
        .wrapper{
            margin: 0;
            padding: 0;
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            max-width: 380px;
            width: 100%;
            box-shadow: 0px 0px 5px 5px rgba(0,0,0,0.1);
        }
        .wrapper header{
            font-size: 22px;
            font-weight: 600;
        }
        .wrapper .poll-area{
            margin: 20px 0 15px 0;
        }
        .poll-area label{
            display: block;
            margin-bottom: 10px;
            border-radius: 5px;
            padding: 8px 15px;
            border: 2px solid #e6e6e6;
            transition: all 0.2s ease;
        }
        .poll-area label:hover{
            border-color: #ddd;
        }
        .wrapper label.selected{
            border-color: #6665ee!important;
        }
        .wrapper label .row{
            display: flex;
            pointer-events: none;
            justify-content: space-between;
        }
        .wrapper label .row .column{
            display: flex;
            align-items: center;
        }
        .wrapper label .row .circle{
            height: 19px;
            width: 19px;
            display: block;
            border: 2px solid #ccc;
            border-radius: 50%;
            margin-right: 10px;
            position: relative;
        }
        .wrapper label.selected .row .circle{
            border-color: #6665ee;
        }
        .wrapper label .row .circle::after{
            content: "";
            height: 11px;
            width: 11px;
            background: #6665ee;
            border-radius: inherit;
            position: absolute;
            left: 2px;
            top: 2px;
            display: none;
        }
        .wrapper .poll-area label:hover .row .circle::after{
            display: block;
            background: #e6e6e6;
        }
        .wrapper label.selected .row .circle::after{
        display: block;
        background: #6665ee!important;
        }
        .wrapper label .row span{
            font-size: 16px;
            font-weight: 500;
        }
        .wrapper label .row .percent{
            display: none;
        }
        .wrapper label .progress{
            height: 7px;
            width: 100%;
            position: relative;
            background: #f0f0f0;
            margin: 8px 0 3px 0;
            border-radius: 30px;
            display: none;
            pointer-events: none;
        }
        .wrapper label .progress:after{
            position: absolute;
            content: "";
            height: 100%;
            background: #ccc;
            width: calc(1% * var(--w));
            border-radius: inherit;
            transition: all 0.2s ease;
        }
        .wrapper .label.selected .progress::after{
            background: #6665ee;
        }
        .wrapper label.selectall .progress,
        .wrapper label.selectall .row .percent{
            display: block;
        }
        .wrapper input[type="radio"],
        .wrapper input[type="checkbox"]{
            display: none;
        }
    </style>

    <!-- box-widget  end -->
    <div class="box-widget fl-wrap ">
        <div class="widget-title">Polls</div>
        <div class="box-widget-content">
            <div class="wrapper">
                <h4>{{$data['question']}}</h4>
                <div class="poll-area">
                    @foreach ($data['items'] as $item)
                        <input type="radio" name="poll" id="opt-{{$item['hashId']}}" class="poll-response-submit" data-id="{{$data['hashId']}}">
                        <label for="opt-{{$item['hashId']}}" class="opt-{{$item['hashId']}}
                            @if ($data['userPollResponse'])
                                @if($data['userPollResponse']->poll_item_id == $item['id'] )
                                selected
                                @endif
                                selectall
                            @endif">
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
    <!-- box-widget  end -->

@endif
