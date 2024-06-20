@extends('frontend.layout.app')

@section('title', 'Create Blog')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/jquery.tagsinput.min.css')}}" >
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/frontend/js/jquery.tagsinput.min.js')}}"></script>

    <x-head.tinymce-config type="{{ $data['type'] }}" folder="{{ $data['folder_uuid'] }}" />

    <script>
        $(document).ready(function() {

            $('.js-select-category-multiple').select2();
            $('#input-tags').tagsInput();

            // button press data-submit
            $('#data-submit').click(function() {

                var content = tinymce.get('myeditorinstance').getContent();

                if (content == '') {
                    toastr.error('Content is required');
                    return false;
                }

                // check the required fields
                var required = ['title', 'category','preview-image', 'content', 'input-tags'];
                var error = false;
                for (var i = 0; i < required.length; i++) {
                    if ($('#' + required[i]).val() == '') {
                        error = true;
                        toastr.error('The ' + required[i] + ' field is required.');
                        break;
                    }
                }

                // if there is an error, do not submit
                if (error) {
                    return false;
                }

                // var contect = tinyMCE.get('tinymce').getContent();

                $('#addNewArticleForm').submit();
            });
        });
    </script>

@endsection

@section('content')

    <x-frontend.topbar.topbar :code="$data['hotNewses']" />
    <x-frontend.menu.menu-list :code="$data['menu']" />
    <x-frontend.user.user-login-registration />

    <div class="breadcrumbs-header fl-wrap">
        <div class="container">
            <div class="breadcrumbs-header_url">
                <a href="#">Home</a><span>Create Article</span>
            </div>
            <div class="scroll-down-wrap">
                <div class="mousey">
                    <div class="scroller"></div>
                </div>
                <span>Scroll Down To Discover</span>
            </div>
        </div>
        <div class="pwh_bg"></div>
    </div>
    <!--section   -->
    <section>
        <div class="container">
            <div class="main-container fl-wrap">
                <div class="section-title">
                    <h2>Create Article</h2>
                    <h4>Fill in the form below to create a new article</h4>

                </div>
                <!--grid-post-wrap-->
                <div class="custom-form">
                    <form class="add-new-user pt-0" id="addNewArticleForm" action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-article-title">Title <span class="text-danger">*</span></label>
                            <input type="text" id="title" class="title" name="title" placeholder="Enter title" value="{{old('title')}}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-2" for="add-article-category">Category</label>
                            <select class="form-select js-select-category-multiple" name="categories[]" multiple="multiple" id="category" required>
                                <option value="" disabled>Select Category</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-article-image">Preview Image <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="preview-image" name="image" placeholder="Select image for preview"  accept="image/*" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-article-image-video">Video</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="add-article-image-video" name="image-video" placeholder="Select image or video file" accept="video/*" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-article-description">Short Description (Max 200)</label>
                            <textarea class="form-control" id="add-article-description" name="description" placeholder="Enter short description (Max 200). If you leave it blank, the first 200 characters of the content will be used." maxlength="255">{{old('description')}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-article-content">Content <span class="text-danger">*</span></label>
                            <x-forms.tinymce-editor content=""/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-2" for="add-article-tag">Tag <span class="text-danger">*</span></label>
                            <input name="tags" id="input-tags" style="width:100% !important; float: left;border: none;border: 1px solid #e1e1e1;background: #f9f9f9;width: 100%;padding: 8px 30px;border-radius: 4px;color: #000; font-size: 12px; -webkit-appearance: none; font-family: 'Poppins', sans-serif;" placeholder="Add tags by pressing comma" value="{{old('tags')}}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-article-source-url">Source URL</label>
                            <input type="text" class="form-control" id="add-article-source-url" name="source_url" placeholder="Enter source url" value="{{old('source_url')}}" />
                        </div>
                        <button type="button" id="data-submit" class="btn big-btn color-bg data-submit flat-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

    <x-frontend.footer.footer :categories="$data['categories']" :pages="$data['pages']" />

@endsection
