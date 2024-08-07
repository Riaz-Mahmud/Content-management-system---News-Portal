<div class="header-inner fl-wrap">
    <div class="container">
        <!-- logo holder  -->
        <a href="{{route('home')}}" class="logo-holder"><img src="{{ Storage::url(config('frontend.site.logo')) }}" alt="Logo"></a>
        <!-- logo holder end -->
        <div class="search_btn htact show_search-btn"><i class="far fa-search"></i> <span class="header-tooltip">Search</span></div>

        <!-- header-search-wrap -->
        <div class="header-search-wrap novis_sarch">
            <div class="widget-inner">
                <form action="{{route('search')}}" method="GET">
                    <input name="q" id="se" type="text" class="search" placeholder="Search..." value="" />
                    <button class="search-submit" id="submit_btn"><i class="fa fa-search transition"></i> </button>
                </form>
            </div>
        </div>
        <!-- header-search-wrap end -->

        <!-- nav-button-wrap-->
        <div class="nav-button-wrap">
            <div class="nav-button">
                <span></span><span></span><span></span>
            </div>
        </div>
        <!-- nav-button-wrap end-->
        <!--  navigation -->
        <div class="nav-holder main-menu">
            <nav>
                <ul>
                    @foreach ($menuItems as $menuItem)
                        @if ($menuItem->child)
                            <li>
                                <a href="{{URL::to($menuItem->href)}}" class="@if(url()->current() == URL::to($menuItem->href)) act-link @endif">
                                    {{ $menuItem->label }}<i class="fas fa-caret-down"></i></a>
                                <!--second level -->
                                <ul>
                                    @foreach ($menuItem->child as $child)
                                        <li>
                                            <a href="{{URL::to($child->href)}}">{{ $child->label }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!--second level end-->
                            </li>
                        @else
                            <li>
                                <a href="{{URL::to($menuItem->href)}}" class="@if(url()->current() == URL::to($menuItem->href)) act-link @endif">{{ $menuItem->label }}</a>
                            </li>
                        @endif
                    @endforeach
                    @if (Auth::user())
                        <li>
                            <a><img src="{{ \App\Helpers\ImageHelper::generateImage(Auth::user()->profile->image,'main') }}" alt="User" style="width: 30px; height: 30px; border-radius: 50%;"></a>
                            <ul>
                                <li><a href="{{ route('admin.profile.show', Auth::user()->email) }}">Profile</a></li>
                                @if (Auth::user()->hasPermissionTo('admin.dashboard.index'))
                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                @endif
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        <!-- navigation  end -->
    </div>
</div>
