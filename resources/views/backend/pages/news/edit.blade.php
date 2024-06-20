@extends('backend/layouts/layoutMaster')

@section('title', 'Edit News')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/jquery.tagsinput.min.css')}}" >
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/frontend/js/jquery.tagsinput.min.js')}}"></script>
    <x-head.tinymce-config type="{{ $data['type'] }}" folder="{{ $data['folder_uuid'] }}" />
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
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Edit News</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('admin.news.update', Crypt::encrypt($data['rose']->id))}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-slide-title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-slide-title" name="title" placeholder="Enter title" value="{{old('title', $data['rose']->title)}}" required>
                        </div>

                        {{-- category --}}
                        <div class="mb-3">
                            <label class="form-label required" for="add-slide-category">Category <span class="text-danger">*</span></label>
                            <select class="form-select js-select-category-multiple" name="categories[]" multiple="multiple" id="add-news-category" required>
                                <option value="">Select Category</option>
                                @foreach ($data['categories'] as $category)
                                    @if (in_array($category->id, $data['rose']->categories->pluck('id')->toArray()))
                                        <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="add-news-image">Preview Image <span class="text-muted"> Max 1 MB (Optional)</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="add-news-image" name="image" placeholder="Select image for preview"  accept="image/*" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-news-image-video">Video <span class="text-muted"> Max 10 MB (Optional)</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="add-news-image-video" name="image-video" placeholder="Select image or video file" accept="video/*" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="add-news-description">Short Description (Max 200)</label>
                            <span class="text-muted">If you leave it blank, the first 200 characters of the content will be used.</span>
                            <textarea class="form-control" id="add-news-description" name="description" placeholder="Enter short description (Max 200)." maxlength="255" rows="4">{{old('description', $data['rose']->description)}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="add-news-content">Content</label>
                            <x-forms.tinymce-editor content="{{$data['rose']->content}}"/>
                        </div>

                        {{-- tags --}}
                        <div class="mb-3">
                            <label class="form-label mb-2" for="add-news-tag">Tag <span class="text-danger">*</span></label>
                            <input name="tags" id="input-tags"  placeholder="Add tags by pressing comma" value="{{old('tags', $data['rose']->tags->implode('label', ', '))}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="add-news-source-url">Source URL</label>
                            <input type="text" class="form-control" id="add-news-source-url" name="source_url" placeholder="Enter source url" value="{{old('source_url' , $data['rose']->source_url)}}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Status</label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option selected disabled value="">Select status</option>
                                <option value="Active" {{$data['rose']->status == 'Active' ? 'selected' : ''}}>Active</option>
                                <option value="Inactive" {{$data['rose']->status == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                                <option value="Pending" {{old('status') == 'Pending' ? 'selected' : ''}}>Pending</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        $(document).ready(function() {

            $('.js-select-category-multiple').select2();
            $('#input-tags').tagsInput();
        });
    </script>
@endsection
