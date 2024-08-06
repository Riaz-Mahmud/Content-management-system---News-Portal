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

    @include('backend.pages.profile.navbar')

    <!-- User Profile Content -->
    <div class="row">

        @forelse ($data['articles'] as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header flex-grow-0">
                        <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ $data['profile']->image }}" alt="User" class="rounded-circle">
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-1">
                                <div class="me-2">
                                    <h5 class="mb-0">{{ $data['profile']->first_name }}
                                        {{ $data['profile']->last_name }}</h5>
                                    <small
                                        class="text-muted">{{ Carbon\Carbon::parse($article->created_at)->format('d M Y g:i A') }}</small>
                                </div>
                                <div class="dropdown d-none d-sm-block">
                                    <button class="btn p-0" type="button" id="eventList" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="eventList">
                                        @can('admin.news.edit')
                                            <a href="{{ route('admin.news.edit', $article->hashId) }}" class="dropdown-item"
                                                title="Edit">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('admin.news.delete')
                                            <form action="{{ route('admin.news.delete', $article->hashId) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item"
                                                    onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ $article->image }}" alt="Card image cap" style="height: 250px;">
                    <div class="featured-date mt-n4 ms-4 bg-white rounded w-px-100 shadow text-center p-1">
                        <h5 class="mb-0 text-dark">{{ Carbon\Carbon::parse($article->created_at)->format('d M') }}</h5>
                        <span class="text-primary">{{ Carbon\Carbon::parse($article->created_at)->format('Y') }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="text-truncate">{{ $article->title }}</h5>
                        <div class="d-flex gap-2">
                            @foreach ($article->category as $category)
                                @if ($loop->index < 3)
                                    <span class="badge bg-label-primary">{{ $category->title }}</span>
                                @endif
                            @endforeach

                            @if (count($article->category) > 3)
                                <span class="badge bg-label-primary">...</span>
                            @endif

                        </div>
                        <div class="d-flex my-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="card-actions">
                                    <a href="javascript:;" class="text-muted me-3"><i class="bx bx-show me-1"></i>
                                        {{ $article->view_count }}</a>
                                    <a href="javascript:;" class="text-muted"><i class="bx bx-message me-1"></i>
                                        {{ $article->comment_count }}</a>
                                </div>
                            </div>
                            <a href="{{ URL::to($article->slug) }}" class="btn btn-primary ms-auto" role="button"
                                target="_blank"> Details </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No article found!
                </div>
            </div>
        @endforelse

    </div>
    <!--/ User Profile Content -->
@endsection
