@extends('backend/layouts/layoutMaster')

@section('title', 'Tags List')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/backend/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/jszip/jszip.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/pdfmake/pdfmake.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/backend/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
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
            <h5 class="card-title">Tags List</h5>

        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th>Label</th>
                        <th>Status</th>
                        @if (auth()->user()->can('admin.tags.edit') ||
                            auth()->user()->can('admin.tags.delete'))
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
                                {{ $item->label }}
                            </td>
                            <td>
                                @if ($item->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            @if (auth()->user()->can('admin.tags.edit') ||
                                auth()->user()->can('admin.tags.delete'))
                                <td>
                                    @can('admin.tags.edit')
                                        <a href="{{ route('admin.tags.edit', Crypt::encrypt($item->id)) }}"
                                            class="btn btn-sm btn-primary mb-1 mt-1" title="Edit">
                                            <i class="fa fa-edit text-white"></i>
                                        </a>
                                    @endcan
                                    @can('admin.tags.delete')
                                        <form action="{{ route('admin.tags.delete', Crypt::encrypt($item->id)) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger mb-1 mt-1"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
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
