@extends('backend/layouts/layoutMaster')

@section('title', 'Edit Category')

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
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add New Slider</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('admin.category.update', Crypt::encrypt($data['rose']->id))}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-slide-title">Title</label>
                            <input type="text" class="form-control" id="add-slide-title" name="title" placeholder="Enter title" value="{{$data['rose']->title}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-2" for="add-category-parent">Parent Category</label>
                            <select class="form-select" id="add-category-parent" name="parent_id">
                                <option value="" selected>N/A</option>
                                @foreach ($data['allCategories'] as $category)
                                    @if ($category->haveChild)
                                        <option value="{{$category->hashId}}" @if ($category->id == $data['rose']->parent_id) selected @endif>{{$category->title}}</option>
                                        @include('backend.pages.category.categoryChild', ['category' => $category, 'level' => 1, 'selected' => $data['rose']->parent_id])
                                    @else
                                        <option value="{{$category->hashId}}">{{$category->title}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Status</label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option selected disabled value="">Select status</option>
                                <option value="Active" {{$data['rose']->status == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Inactive" {{$data['rose']->status == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
