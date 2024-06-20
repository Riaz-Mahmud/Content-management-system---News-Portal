<div class="top-bar fl-wrap">
    <div class="container">
        <div class="date-holder">
            <span class="date_num"></span>
            <span class="date_mounth"></span>
            <span class="date_year"></span>
        </div>
        <div class="header_news-ticker-wrap">
            <div class="hnt_title">Hot News :</div>
            <div class="header_news-ticker fl-wrap">
                <ul>
                    @foreach ($data['items'] as $item)
                        <li><a href="{{ URL::to($item['slug']) }}">{{ $item['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="n_contr-wrap">
                <div class="n_contr p_btn"><i class="fas fa-caret-left"></i></div>
                <div class="n_contr n_btn"><i class="fas fa-caret-right"></i></div>
            </div>
        </div>

        <x-frontend.social-icon.social-icon :position="'top'" />

    </div>
</div>
