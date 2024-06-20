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
            {{-- title --}}
            <h5 class="mb-0">News Comments List</h5>
            <h6 class="card-title">{{$data['news']->title}} </h6>
        </div>
        <div class="card-datatable table-responsive" width="100%">
            <table class="datatables-users table border-top" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>User</th>
                        <th>Comments</th>
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
                                {{ $item->user->name }}
                            </td>
                            <td>
                                {{ $item->content }} <br>
                                @if ($item->image)
                                    <img src="{{Storage::url($item->image)}}" alt="" width="100px">
                                @endif
                                @if ($item->video)
                                    <video width="70%" controls>
                                        <source src="{{Storage::url($item->video)}}" type="video/mp4">
                                    </video>
                                @endif
                            </td>
                            <td >
                                <div class='align-items-center'>
                                    @if ($item->status == 'Active')
                                        <span class="badge bg-success me-1 mb-1 align-middle">Active</span>
                                    @elseif ($item->status == 'Pending')
                                        <span class="badge bg-warning me-1 mb-1 align-middle">Pending</span>
                                    @else
                                        <span class="badge bg-danger me-1 mb-1 align-middle">Inactive</span>
                                    @endif
                                    <form id="commentsStatusChange{{$key}}" action="{{ route('admin.news.comment.status', [Crypt::encrypt($data['news']->id), $item->hashId]) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        {{-- seletct status --}}
                                        <select name="status" id="status" class="form-select" onchange="document.getElementById('commentsStatusChange{{$key}}').submit()">
                                            <option value="Active" {{ $item->status == 'Active' ? 'selected' : '' }}>Approved</option>
                                            <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Inactive" {{ $item->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('admin.news.comment.delete', [Crypt::encrypt($data['news']->id), $item->hashId]) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mb-1 mt-1" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
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
