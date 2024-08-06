@extends('backend/layouts/layoutMaster')

@section('title', 'Edit Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/animate-css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/backend/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')

@endsection

@section('content')
    @if ($errors->any()|| session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row">
        <div class="col-md-12">
            @include('backend.pages.profile.navbar')
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <form action="{{route('admin.profile.update', $data['user']->email)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $data['profile']->image }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="profile_image" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-label-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>

                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') ?? $data['profile']->first_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') ?? $data['profile']->last_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') ?? $data['profile']->phone }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></i></label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" placeholder="Date of Birth" value="{{ old('date_of_birth') ?? $data['profile']->date_of_birth }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="about" class="form-label">About <span class="text-danger">*</span></label>
                                <textarea id="about" name="about" class="form-control" cols="40" rows="2" spellcheck="true" maxlength="200" required>{{ old('about') ?? $data['profile']->about }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mailing_address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea type="text" id="mailing_address" name="mailing_address" class="form-control" placeholder="Address" required>{{ old('mailing_address') ?? $data['profile']->mailing_address }}</textarea>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
