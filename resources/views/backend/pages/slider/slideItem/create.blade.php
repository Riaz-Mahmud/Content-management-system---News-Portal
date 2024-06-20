@extends('backend/layouts/layoutMaster')

@section('title', 'Create Slide Item')

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
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add New Slide Item</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('admin.slide.item.store', Crypt::encrypt($data['rose']->id))}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label required" for="add-slide-type">Type</label>
                            <select class="form-select" id="add-slide-type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="image">Image</option>
                                <option value="news">News</option>
                            </select>
                        </div>
                        <div class="mb-3 image-item">
                            <label class="form-label" for="add-slide-title">Title</label>
                            <input type="text" class="form-control" id="add-slide-title" name="title" placeholder="Enter title" value="{{old('title')}}" />
                        </div>
                        <div class="mb-3 image-item">
                            <label class="form-label" for="add-slide-description">ShortDescription</label>
                            <textarea class="form-control" id="add-slide-description" name="description" placeholder="Enter description" rows="3" value="{{old('description')}}"></textarea>
                        </div>
                        <div class="mb-3 image-item">
                            <label class="form-label" for="add-slide-image">Image</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="add-slide-image" name="image" placeholder="Enter image" value="{{old('image')}}" />
                            </div>
                        </div>
                        <div class="mb-3 news-item">
                            <label class="form-label required" for="add-slide-news">News</label>
                            <select class="form-select" id="add-slide-news" name="news">
                                <option value="">Select News</option>
                                @foreach ($data['news'] as $news)
                                    <option value="{{Crypt::encrypt($news->id)}}">{{$news->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4 image-item news-item">
                            <label class="form-label" for="user-plan">Status</label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option selected disabled value="">Select status</option>
                                <option value="Active" {{old('status') == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Inactive" {{old('status') == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        $(document).ready(function () {
            $('#add-slide-type').on('change', function () {
                if (this.value == 'image') {
                    $('.news-item').hide();
                    $('.image-item').show();
                } if (this.value == 'news') {
                    $('.image-item').hide();
                    $('.news-item').show();
                }
            });
        });

    </script>
@endsection
