@extends('frontend.layout.app')

@section('title', 'Change Password | Profile')

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />


    <!--section   -->
    <section class="hero-section" style="z-index: 0">
        <div class="bg-wrap hero-section_bg">
            <div class="bg" data-bg="{{Storage::url('assets/image/background/1.jpg')}}"></div>
        </div>
        <div class="container">
            <div class="hero-section_title">
                <h2>{{$data['rose']->first_name}} {{$data['rose']->last_name}}’s Den</h2>
            </div>
            <div class="clearfix"></div>
            <div class="breadcrumbs-list fl-wrap">
                <a href="{{route('home')}}">Home</a><span>Profile</span>
            </div>
            <div class="scroll-down-wrap scw_transparent">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
    </section>
    <!-- section end  -->
    <!--section   -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('frontend.partials.pages.profile.profileSidebar')
                </div>
                <div class="col-md-8">
                    <div class="main-container fl-wrap fix-container-init">
                        {{-- author proifle edit start --}}
                        <div>
                            <div class="section-title">
                                <h3>{{$data['rose']->first_name}} {{$data['rose']->last_name}} Change Password:</h3>
                            </div>
                            <div class="grid-post-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-edit-container fl-wrap block_box">
                                            <div class="custom-form">
                                                <form action="{{route('profile.update-password.store', $data['rose']->email)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Current Password <i class="fal fa-lock"></i> <span class="text-danger">*</span></label>
                                                            <input type="password" name="old_password" placeholder="Old Password" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>New Password <i class="fal fa-lock"></i> <span class="text-danger">*</span></label>
                                                            <input type="password" name="password" placeholder="New Password" required/>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Retype Password <i class="fal fa-lock"></i>  <span class="text-danger">*</span></label>
                                                            <input type="password" name="confirm_password" placeholder="Retype New Password" required/>
                                                        </div>


                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn big-btn color-bg flat-btn">Update Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- author proifle edit end --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="limit-box fl-wrap"></div>
    </section>


    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection

@section('page-js')

    <script>
        $(document).ready(function() {

        });
    </script>
@endsection

