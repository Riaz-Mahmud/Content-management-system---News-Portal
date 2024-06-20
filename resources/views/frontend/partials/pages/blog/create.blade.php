@extends('frontend.layout.app')

@section('title', 'Create Blog')

@section('css')
    <link type="text/css" rel="stylesheet" href="{{asset('assets/frontend/css/jquery.tagsinput.min.css')}}" >
@endsection

@section('script')
    <script src="{{asset('assets/frontend/js/jquery.tagsinput.min.js')}}"></script>

    <x-head.tinymce-config type="{{ $data['type'] }}" folder="{{ $data['folder_uuid'] }}" />

    <script>
        $(document).ready(function() {

            $('#input-tags').tagsInput();

            // button press data-submit
            $('#data-submit').click(function() {

                var content = tinymce.get('myeditorinstance').getContent();

                if (content == '') {
                    toastr.error('Content is required');
                    return false;
                }

                // check the required fields
                var required = ['title','preview-image', 'content', 'input-tags'];
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

                $('#addNewBlogForm').submit();
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
                <a href="#">Home</a><span>Create Blog</span>
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
                    <h2>Create Blog</h2>
                    <h4>Share your experience with us</h4>

                </div>
                <!--grid-post-wrap-->
                <div class="custom-form">
                    <form class="add-new-user pt-0" id="addNewBlogForm" action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-blog-title">Title <span class="text-danger">*</span></label>
                            <input type="text" id="title" class="title" name="title" placeholder="Enter title" value="{{old('title')}}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-blog-image">Preview Image <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="preview-image" name="image" placeholder="Select image for preview"  accept="image/*" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-blog-image-video">Video</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="add-blog-image-video" name="image-video" placeholder="Select image or video file" accept="video/*" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-blog-description">Short Description (Max 200)</label>
                            <textarea class="form-control" id="add-blog-description" name="description" placeholder="Enter short description (Max 200). If you leave it blank, the first 200 characters of the content will be used." maxlength="255">{{old('description')}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-blog-content">Content <span class="text-danger">*</span></label>
                            <x-forms.tinymce-editor content=""/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label mb-2" for="add-blog-category">Tag <span class="text-danger">*</span></label>
                            <input name="tags" id="input-tags" style="width:100% !important; float: left;border: none;border: 1px solid #e1e1e1;background: #f9f9f9;width: 100%;padding: 8px 30px;border-radius: 4px;color: #000; font-size: 12px; -webkit-appearance: none; font-family: 'Poppins', sans-serif;" placeholder="Add tags by pressing comma" value="{{old('tags')}}" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-blog-source-url">Source URL</label>
                            <input type="text" class="form-control" id="add-blog-source-url" name="source_url" placeholder="Enter source url" value="{{old('source_url')}}" />
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
