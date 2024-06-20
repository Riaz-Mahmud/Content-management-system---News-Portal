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
                    <a href="{{route('news.create')}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Create Article <i class="fal fa-plus"></i></a>

                    <a href="{{route('blog.create')}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Create Blog <i class="fal fa-plus"></i></a>

                    <a href="{{route('profile.edit', $data['rose']->email)}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Edit Profile <i class="fal fa-edit"></i></a>

                    <a href="{{route('profile.change-password',$data['rose']->email)}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Change Password <i class="fal fa-edit"></i></a>

                    <a href="{{route('profile.social')}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Social Media  <i class="fal fa-plus"></i></a>

                    <a href="{{route('profile.publication')}}" class="btn big-btn color-bg flat-btn" style="margin-bottom: 5px; display:block; margin-top: 5px; margin-left: 40px; margin-right:40px;">Publication <i class="fal fa-plus"></i></a>

                </div>
            </div>
        @endif
        @if (count($data['rose']['socialMedia'])>0)
            <div class="profile-card-footer fl-wrap">
                <div class="profile-card-footer_title">Follow: </div>
                <div class="profile-card-social">
                    <ul>
                        @foreach ($data['rose']['socialMedia'] as $social)
                            <li>
                                <a href="{{$social->link}}" target="_blank">
                                    <i class="@foreach (config('frontend.socialForUserAdd') as $socialType) @if ($socialType['type'] == $social->type) {{$socialType['icon']}} @endif @endforeach"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
