@extends('frontend.layout.app')

@section('title', 'Publication | Profile')

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
                                <h3>{{$data['rose']->first_name}} {{$data['rose']->last_name}} Publications:</h3>
                            </div>
                            <div class="grid-post-wrap">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-edit-container fl-wrap block_box">
                                            <div class="custom-form">
                                                <form action="{{route('profile.social.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <label>Type </i><span class="text-danger">*</span></label>
                                                            <select data-placeholder="Select Type" class="chosen-select" name="type" required style="float: left;border: none;border: 1px solid #e1e1e1;background: #f9f9f9;width: 100%;padding: 8px 30px;border-radius: 4px;color: #000; font-size: 12px; -webkit-appearance: none; font-family: 'Poppins', sans-serif;">
                                                                <option value="" disabled selected>Select Social Media Type</option>
                                                                @foreach (config('frontend.socialForUserAdd') as $socialType)
                                                                    <option value="{{$socialType['type']}}">{{$socialType['type']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Link </i> <span class="text-danger">*</span></label>
                                                            <input type="text" name="link" placeholder="Link" value=" {{old('link')}}" required/>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn big-btn color-bg flat-btn"> Add Social Media <i class="fal fa-paper-plane"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: 20px">
                            <div class="grid-post-wrap" style="margin-top: 20px">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-edit-container fl-wrap block_box">
                                            <table class="table" width="100%" id="socialMediaTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Link</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['rose']['socails'] as $socail)
                                                        <tr>
                                                            <td style="text-align: left">{{$socail->type}}</td>
                                                            <td style="text-align: center; margin-left:10px">{{$socail->link}}</td>
                                                            <td style="text-align: center; margin-left:10px">
                                                                <form action="{{ route('profile.social.delete', $socail->hashId) }}" method="POST" class="d-inline-block">
                                                                    @csrf
                                                                    <button type="submit" class="btn " style="text-align: center; margin-left: inherit; margin-top:5px;margin-bottom:5px;display:inline-block" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fal fa-trash" style="margin-left:-0px"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!--pagination-->
                                            {!! $data['rose']['socails']->links('vendor.pagination.profile-page-news') !!}
                                            <!--pagination end-->
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

