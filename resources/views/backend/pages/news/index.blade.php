@extends('backend/layouts/layoutMaster')

@section('title', 'News List')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/backend/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/jszip/jszip.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/pdfmake/pdfmake.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/buttons.html5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-buttons/buttons.print.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
@endsection

@section('content')

    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">News List</h5>
        </div>
        <div class="card-datatable table-responsive" width="100%">
            <table class="datatables-users table border-top" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Comments</th>
                        <th>Author</th>
                        <th>Backup</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['rows'] as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $item->title }}
                            </td>
                            <td>
                                {{ Str::limit($item->slug, 50) }}
                            </td>
                            <td>
                                {{-- div item center  --}}
                                <div class='align-items-center'>
                                    <div>
                                        <form id="newsCommentStatusChange{{$key}}" action="{{ route('admin.news.status.comment', $item->hashId) }}" method="POST" class="d-inline-block">
                                        @csrf
                                            <input class="form-check input-switch" onchange="document.getElementById('newsCommentStatusChange{{$key}}').submit()" type="checkbox" id="flexSwitchCheckDefault" {{ $item->can_comment == 'yes' ? 'checked' : '' }} style="cursor: pointer; width: 40px; height: 20px;border-radius: 50%;" title="Comments Status {{ $item->can_comment == 'yes' ? 'On' : 'Off' }}">
                                        </form>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.news.comments', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="View" target="_blank">
                                            <i class="fa fa-eye"> </i> <span title="Total comments count"> {{ $item->comments->count() }}</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $item->createBy->name }}
                            </td>
                            <td>
                                @if ($item->source_backup == 'done')
                                    <span class="badge bg-success" title="Backup done">Done</span>
                                @elseif ($item->source_backup == 'pending')
                                    <span class="badge bg-warning" title="Backup pending">Pending</span>
                                @elseif ($item->source_backup == 'failed')
                                    <span class="badge bg-danger" title="Backup failed">Failed</span>
                                @elseif ($item->source_backup == 'processing')
                                    <span class="badge bg-info" title="Backup processing">Processing</span>
                                @elseif ($item->source_backup == 'queue')
                                    <span class="badge bg-info" title="Backup queue">Queue</span>
                                @endif

                                @if ($item->source_backup == 'done')
                                    <a href="{{ route('admin.news.show.backup', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="Open backup folder" target="_blank">
                                        <i class="bx bxs-folder-open"></i>
                                    </a>
                                @elseif ($item->source_backup == 'pending' || $item->source_backup == 'failed')
                                    <a href="{{ route('admin.news.make.backup', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="Make backup">
                                        <i class="bx bxs-download"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <form id="newsStatusChange{{$key}}" action="{{ route('admin.news.status', $item->hashId) }}" method="POST" class="d-inline-block">
                                    @csrf
                                        <input class="form-check input-switch" onchange="document.getElementById('newsStatusChange{{$key}}').submit()" type="checkbox" id="flexSwitchCheckDefault" {{ $item->status == 'Active' ? 'checked' : '' }} style="cursor: pointer; width: 40px; height: 20px;border-radius: 50%;" title="Click to change the status to '{{ $item->status != 'Active' ? 'Active' : 'Inactive' }}'">
                                    </form>
                                    {{ $item->status }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.news.show', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="View" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @can('admin.news.edit')
                                <a href="{{ route('admin.news.edit', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="Edit">
                                    <i class="fa fa-edit text-white"></i>
                                </a>
                                @endcan
                                @can('admin.news.delete')
                                <form action="{{ route('admin.news.delete', $item->hashId) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mb-1 mt-1" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- div for paginate --}}
            <div class="d-flex justify-content-center mt-3 mb-3">
                {{ $data['rows']->links() }}
            </div>
        </div>
    </div>

@endsection
