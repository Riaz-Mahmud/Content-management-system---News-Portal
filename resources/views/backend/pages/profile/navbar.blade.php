<!-- Navbar pills -->
<ul class="nav nav-pills flex-column flex-sm-row mb-4">
    <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'admin.profile.show') active @endif"
        href="{{route('admin.profile.show' , $data['profile']->email)}}">
        <i class='bx bx-user'></i> Profile</a>
    </li>
    @if (Auth::user()->id == $data['profile']->user_id)
        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit', $data['profile']->email) }}"><i class='bx bx-group'></i>
                Edit</a>
        </li>
    @endif
    <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'admin.profile.security') active @endif" href="{{ route('admin.profile.security',$data['profile']->email) }}">
            <i class="bx bx-lock-alt me-1"></i> Security</a>
    </li>
    <li class="nav-item"><a class="nav-link @if(Route::currentRouteName() == 'admin.profile.article.show') active @endif" href="{{route('admin.profile.article.show' , $data['profile']->email)}}">
        <i class='bx bx-news'></i> Articles</a>
    </li>
</ul>
<!--/ Navbar pills -->
