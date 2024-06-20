@extends('backend/layouts/layoutMaster')

@section('title', 'Security')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/pages/page-account-settings.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/backend/js/pages-account-settings-security.js') }}"></script>
@endsection

@section('content')


    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Security
    </h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            @include('backend.pages.profile.header')
        </div>
    </div>
    <!--/ Header -->

    <div class="row">
        <div class="col-md-12">

            @include('backend.pages.profile.navbar')

            @if (Auth::user()->id == $data['profile']->user_id)
                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.updatePassword') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="currentPassword" id="currentPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="newPassword" name="newPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <p class="fw-semibold mt-2">Password Requirements:</p>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">
                                            Minimum 6 characters long - the more, the better
                                        </li>
                                        <li class="mb-1">At least one lowercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->
            @endif

            <!-- Recent Devices -->
            <div class="card mb-4">
                <h5 class="card-header">Recent Devices</h5>
                <div class="table-responsive">
                    <table class="table border-top">
                        <thead>
                            <tr>
                                <th class="text-truncate">Platform</th>
                                <th class="text-truncate">Browser</th>
                                <th class="text-truncate">IP Address</th>
                                <th class="text-truncate">Login Date</th>
                                <th class="text-truncate">Location</th>
                                <th class="text-truncate">Timezone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['rows'] as $log)
                                <tr>
                                    <td class="text-truncate"><i
                                            class='bx
                                @if ($log->platform == 'Windows') bx-windows @elseif ($log->platform == 'Mac') bxl-apple @elseif ($log->platform == 'Linux') bx-laptop @elseif ($log->platform == 'Android') bxl-android @elseif ($log->platform == 'iOS') @else bx-desktop @endif text-info me-3'></i>
                                        <span class="fw-semibold">{{ $log->platform }}</span></td>
                                    <td class="text-truncate">{{ $log->browser }}</td>
                                    <td class="text-truncate">{{ $log->ip_address }}</td>
                                    <td class="text-truncate">
                                        {{ Carbon\Carbon::parse($log->created_at)->format('d, M Y g:i A') }}</td>
                                    <td class="text-truncate">{{ $log->city }}, {{ $log->country }}, {{ $log->postal_code }} </td>
                                    <td class="text-truncate">{{ $log->timezone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Recent Devices -->

        </div>
    </div>
@endsection
