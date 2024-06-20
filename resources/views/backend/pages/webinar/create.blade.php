@extends('backend/layouts/layoutMaster')

@section('title', 'Create Webinar')

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
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add New Webinar</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewADForm" action="{{route('admin.webinar.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-webinar-title" name="title" placeholder="Enter title" value="{{old('title')}}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-webinar-description">Description</label>
                            <textarea class="form-control" id="add-webinar-description" name="description" placeholder="Enter description" rows="3" value="{{old('description')}}" maxlength="150"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-link">Link <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-webinar-link" name="link" placeholder="Enter link" value="{{old('link')}}" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-password">Password Of Metting Link </label>
                            <input type="text" class="form-control" id="add-webinar-password" name="password" placeholder="Enter password" value="{{old('password')}}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-start-date">Start Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="add-webinar-start-date" name="start_date" placeholder="Enter start date" value="{{old('start_date')}}" min="{{date('Y-m-d\TH:i')}}" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-end-date">End Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="add-webinar-end-date" name="end_date" placeholder="Enter end date" value="{{old('end_date')}}" min="{{date('Y-m-d\TH:i')}}" required/>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="add-webinar-image">Thumbnail <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="add-webinar-image" name="image" placeholder="Select image" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Status <span class="text-danger">*</span></label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option disabled value="">Select status</option>
                                <option value="Active" {{old('status') == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Inactive" {{old('status') == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
