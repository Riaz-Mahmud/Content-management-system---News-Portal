@extends('frontend.layout.app')

@section('title', 'Edit Profile | Profile')

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
                                <h3>{{$data['rose']->first_name}} {{$data['rose']->last_name}} Profile update:</h3>
                            </div>
                            <div class="grid-post-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-edit-container fl-wrap block_box">
                                            <div class="custom-form">
                                                <form action="{{route('profile.update', $data['rose']->email)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>First Name <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') ?? $data['rose']->first_name}}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last Name <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') ?? $data['rose']->last_name}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email <i class="fal fa-envelope"></i>  <span class="text-danger">*</span></label>
                                                            <input type="text" name="email" placeholder="Email" value="{{ old('email') ?? $data['rose']->email}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Phone <i class="fal fa-phone"></i>  <span class="text-danger">*</span></label>
                                                            <input type="text" name="phone" placeholder="Phone" value="{{ old('phone') ?? $data['rose']->phone}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Address <i class="fal fa-map-marker"></i>  <span class="text-danger">*</span></label>
                                                            <input type="text" name="mailing_address" placeholder="Address" value="{{ old('mailing_address') ?? $data['rose']->mailing_address}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Country <i class="fal fa-map-marker"></i>  </label>
                                                            <input type="text" name="country" placeholder="Country" value="{{ old('country') ?? $data['rose']->country}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>About <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <textarea name="about" cols="40" rows="2" id="about" spellcheck="true" maxlength="200" required>{{ old('about') ?? $data['rose']->about}}</textarea>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Date of Birth <i class="fal fa-calendar"> <span class="text-danger">*</span></i></label>
                                                            <input type="date" name="date_of_birth" placeholder="Date of Birth" value="{{ old('date_of_birth') ?? $data['rose']->date_of_birth}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Profession <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="profession" placeholder="Profession" value="{{ old('profession') ?? $data['rose']->profession}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Field of Profession <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="field_of_profession" placeholder="Field of Profession" value="{{ old('field_of_profession') ?? $data['rose']->field_of_profession}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Current Job <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="current_job" placeholder="Current Job" value="{{ old('current_job') ?? $data['rose']->current_job}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Job Experience <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="number" name="job_experience" placeholder="Job Experience" value="{{ old('job_experience') ?? $data['rose']->job_experience}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Organization <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="organization" placeholder="Organization" value="{{ old('organization') ?? $data['rose']->organization}}" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Organization Address <i class="fal fa-user"></i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="organization_address" placeholder="Organization Address" value="{{ old('organization_address') ?? $data['rose']->organization_address}}" required/>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Profile Image <i class="fal fa-image"></i> </label>
                                                            <input type="file" name="profile_image" placeholder="Profile Image" value="{{$data['rose']->profile_image}}"/>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn big-btn color-bg flat-btn">Update Profile</button>
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

