@extends('backend/layouts/layoutMaster')

@section('title', 'User Profile - Profile')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/backend/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/backend/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
@endsection

@section('page-script')

@endsection

@section('content')

    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">User Profile /</span> Profile
    </h4>

    <!-- Header -->
    <div class="row">
        <div class="col-12">
            @include('backend.pages.profile.header')
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <div class="row">
        <div class="col-md-12">
            @include('backend.pages.profile.navbar')
        </div>
    </div>
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="text-muted text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span
                                class="fw-semibold mx-2">Full Name:</span> <span>{{ $data['profile']->first_name }}
                                {{ $data['profile']->last_name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span
                                class="fw-semibold mx-2">Status:</span> <span>Active</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-star"></i><span
                                class="fw-semibold mx-2">Role:</span>
                            <span>{{ Auth::user()->getRoleNames()->first() }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span
                                class="fw-semibold mx-2">Country:</span> <span>{{ $data['profile']->country }}</span></li>
                    </ul>
                    <small class="text-muted text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span
                                class="fw-semibold mx-2">Contact:</span> <span>{{ $data['profile']->phone }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span
                                class="fw-semibold mx-2">Email:</span> <span>{{ $data['profile']->email }}</span></li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->

            @if (Auth::user()->hasPermissionTo('admin.user.delete') && Auth::user()->id != $data['profile']->id)
            <div class="card mb-4">
                <div class="card-body">
                    @if ($data['profile']->status == 'Pending')
                        <a href="{{ route('admin.user.update.status', ['id' => $data['profile']->hashId, 'status' => 'Active']) }}"
                            class="btn btn-label-success suspend-user" onclick=" return confirm('Are you sure you want to Approve this user?');">Approve</a>
                        <a href="{{ route('admin.user.update.status', ['id' => $data['profile']->hashId, 'status' => 'Blocked']) }}"
                            class="btn btn-label-warning suspend-user" onclick=" return confirm('Are you sure you want to Block this user?');">Block</a>
                    @elseif ($data['profile']->status == 'Blocked')
                        <a href="{{ route('admin.user.update.status', ['id' => $data['profile']->hashId, 'status' => 'Active']) }}"
                            class="btn btn-label-success suspend-user" onclick=" return confirm('Are you sure you want to Unblock this user?');">Unblock</a>
                    @else
                        <a href="{{ route('admin.user.update.status', ['id' => $data['profile']->hashId, 'status' =>'Blocked'])}}" class="btn btn-label-warning suspend-user" onclick=" return confirm('Are you sure you want to Block this user?');">Block</a>
                    @endif

                    <a href="{{ route('admin.user.delete', $data['profile']->hashId) }}"
                         class="btn btn-label-danger suspend-user" onclick=" return confirm('Are you sure you want to Delete this user?');">Delete</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!--/ User Profile Content -->
@endsection
