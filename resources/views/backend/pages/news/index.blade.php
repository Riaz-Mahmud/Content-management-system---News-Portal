@extends('backend/layouts/layoutMaster')

@section('title', 'News List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <style>
        /* Additional styling for cards */
        .news-card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.2s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-card img {
            object-fit: cover;
            height: 150px;
        }

        .news-actions {
            display: flex;
            gap: 10px;
        }

        .news-meta {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
@endsection

@section('content')

    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">News List</h5>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Add News</a>
        </div>

        @foreach ($data['rows'] as $key => $item)
            <div class="col-md-4 mb-4">
                <div class="card news-card">
                    <img src="{{ $item->image_src }}" alt="{{ $item->title }}" class="card-img-top">
                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($item->title, 100) }}</h6>
                        {{-- description --}}
                        <p class="card-text">{{ Str::limit($item->description, 80) }}</p>
                        <hr>
                        <p class="news-meta">By {{ $item->createBy->name }} | {{ $item->created_at->format('M d, Y h:i A') }}</p>

                        <div class="news-actions">
                            <a href="{{ route('admin.news.show', $item->hashId) }}" class="btn btn-sm btn-info" title="View" target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>
                            @can('admin.news.edit')
                                <a href="{{ route('admin.news.edit', $item->hashId) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fa fa-edit text-white"></i>
                                </a>
                            @endcan
                            @can('admin.news.delete')
                                <form action="{{ route('admin.news.delete', $item->hashId) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="form-check form-switch">
                            <form id="newsStatusChange{{ $key }}" action="{{ route('admin.news.status', $item->hashId) }}" method="POST">
                                @csrf
                                <input class="form-check-input" onchange="document.getElementById('newsStatusChange{{ $key }}').submit()" type="checkbox" {{ $item->status == 'Active' ? 'checked' : '' }} style="cursor: pointer;" title="Change status">
                            </form>
                            <span class="badge {{ $item->status == 'Active' ? 'bg-success' : 'bg-danger' }}">{{ $item->status }}</span>
                        </div>

                        <div>
                            <form id="newsCommentStatusChange{{ $key }}" action="{{ route('admin.news.status.comment', $item->hashId) }}" method="POST">
                                @csrf
                                <input class="form-check-input" onchange="document.getElementById('newsCommentStatusChange{{ $key }}').submit()" type="checkbox" {{ $item->can_comment == 'yes' ? 'checked' : '' }} style="cursor: pointer;" title="Comments Status {{ $item->can_comment == 'yes' ? 'On' : 'Off' }}">
                                {{-- text --}}
                                <span class="badge bg-info">Comments {{ $item->can_comment == 'yes' ? 'On' : 'Off' }}</span>

                            </form>
                            <a href="{{ route('admin.news.comments', $item->hashId) }}" class="btn btn-sm btn-primary mt-1" title="View Comments" target="_blank">
                                <i class="fa fa-comments"></i> <span>{{ $item->comments->count() }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $data['rows']->links() }}
        </div>
    </div>

@endsection
