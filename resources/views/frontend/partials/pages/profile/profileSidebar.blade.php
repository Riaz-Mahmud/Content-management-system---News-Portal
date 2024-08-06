<div class="left_fix-bar fl-wrap">
    <div class="profile-card-wrap fl-wrap">
        <div class="profile-card_media fl-wrap">
            <img src="{{ \App\Helpers\ImageHelper::generateImage($data['user']->profile->image) }}" class="respimg" alt="">
            <div class="profile-card_media_content">
                <h4>{{$data['rose']->first_name}} {{$data['rose']->last_name}}</h4>
                <h5>{{$data['totalYearOfMembership']}}</h5>
            </div>
            <div class="abs_bg"></div>
            <div class="profile-card-stats">
                <ul>
                    <li><span>{{ count($data['rose']['news'])}}</span>Articles</li>
                    <li><span>{{$data['totalViewCount']}}</span> Views</li>
                </ul>
            </div>
        </div>
        <div class="profile-card_content">
            <h4>About</h4>
            <p>{{$data['rose']->about}}</p>
            <div class="pc_contacts">
                <ul>
                    <li>
                        <span>Write:</span> <a href="mailto:{{$data['rose']->email}}">{{$data['rose']->email}}</a>
                    </li>
                    <li>
                        <span>Call:</span> <a href="tel:{{$data['rose']->phone}}">{{$data['rose']->phone}}</a>
                    </li>
                </ul>
            </div>
        </div>
        @if (auth()->check() && auth()->user()->id == $data['rose']->user_id)
            <div class="profile-card-setting fl-wrap">
                <div class="profile-settings row custom-form">
                    <a href="{{route('profile.edit', $data['rose']->email)}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Edit Profile <i class="fal fa-edit"></i></a>
                </div>
            </div>
        @endif
    </div>
</div>
