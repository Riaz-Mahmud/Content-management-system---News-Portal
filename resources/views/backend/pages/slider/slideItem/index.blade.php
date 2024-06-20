@extends('backend/layouts/layoutMaster')

@section('title', 'Slide Item List')

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

    @can('admin.slide.item.create')
    <div class="row g-8 mb-4">
        <div class="card-tools">
            <a href="{{route('admin.slide.item.create', Crypt::encrypt($data['slide']->id)) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-2"></i>
                Add New
            </a>
        </div>
    </div>
    @endcan

    <div class="card">
        <div class="card-header border-bottom">

            <h5 class="card-title">Slide Item List</h5>

        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>News</th>
                        <th>Status</th>
                        @if(auth()->user()->can('admin.slide.item.edit') || auth()->user()->can('admin.slide.item.delete'))
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['rose'] as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                @if ($item->news) {{ $item->news->title }} @else {{ $item->label }} @endif
                            </td>
                            <td>
                                @if ($item->news) {{ $item->news->description }} @else
                                    @if ($item->description) {{ $item->description }} @else N/A @endif
                                @endif
                            </td>
                            <th>
                                <a href="{{ $item->imageMain }}" target="_blank">
                                    <img src="{{ $item->image }}" alt="image" width="100px">
                                </a>
                            </th>
                            <th>
                                @if ($item->news)
                                    <a href="{{ route('admin.news.show', Crypt::encrypt($item->news->id)) }}" target="_blank">
                                        {{ $item->news->title }}
                                    </a>
                                @else N/A @endif
                            </th>
                            <td>
                                @if ($item->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            @if(auth()->user()->can('admin.slide.item.edit') || auth()->user()->can('admin.slide.item.delete'))
                            <td>
                                @can('admin.slide.item.edit')
                                <a href="{{ route('admin.slide.item.edit', $item->hashId) }}" class="btn btn-sm btn-primary mb-1 mt-1" title="Edit">
                                    <i class="fa fa-edit text-white"></i>
                                </a>
                                @endcan
                                @can('admin.slide.item.delete')
                                <form action="{{ route('admin.slide.item.delete', $item->hashId) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mb-1 mt-1" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                </form>
                                @endcan
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- div for paginate --}}
            <div class="d-flex justify-content-center mt-3 mb-3">
                {{ $data['rose']->links() }}
            </div>
        </div>
    </div>

@endsection
