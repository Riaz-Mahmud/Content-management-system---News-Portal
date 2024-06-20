@extends('backend/layouts/layoutMaster')

@section('title', 'Edit AD')

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
        <div class="" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="card-header border-bottom">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Edit AD</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('admin.ad.update', $data['rows']->hashId)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-slide-title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-slide-title" name="title" placeholder="Enter title" value="{{ old('title') ?? $data['rows']->title}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-slide-description">Description</label>
                            <textarea class="form-control" id="add-slide-description" name="description" placeholder="Enter description" rows="3">{{ old('description') ?? $data['rows']->description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-code">Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-ad-code" name="code" placeholder="Enter code" value="{{old('code') ?? $data['rows']->code}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-height">Height</label>
                            <input type="number" class="form-control" id="add-ad-height" name="height" placeholder="Enter height" value="{{old('height') ?? $data['rows']->height}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-width">Width</label>
                            <input type="number" class="form-control" id="add-ad-width" name="width" placeholder="Enter width" value="{{old('width') ?? $data['rows']->width}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-start-date">Start Date</label>
                            <input type="datetime-local" class="form-control" id="add-ad-start-date" name="start_date" placeholder="Enter start date" value="{{old('start_date') ?? $data['rows']->start_date}}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-end-date">End Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="add-ad-end-date" name="end_date" placeholder="Enter end date" value="{{old('end_date') ?? $data['rows']->end_date}}" min="{{date('Y-m-d\TH:i')}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-url">URL</label>
                            <input type="text" class="form-control" id="add-ad-url" name="url" placeholder="Enter url" value="{{old('url') ?? $data['rows']->url}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-ad-image">Image</label>
                            <input type="file" class="form-control" id="add-ad-image" name="image" placeholder="Enter image" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Status</label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option selected disabled value="">Select status</option>
                                <option value="Active" {{$data['rows']->status == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Inactive" {{$data['rows']->status == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
