@extends('backend/layouts/layoutMaster')

@section('title', 'Create Menu Item')

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
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add New Menu Item</h5>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <form class="add-new-user pt-0" id="addNewUserForm" action="{{route('admin.menu.item.store', $data['menu_hash_id'])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="add-menuItem-title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="add-menuItem-title" name="title" placeholder="Enter title" value="{{old('title')}}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-menuItem-parentId">Parent</label>
                            <select class="form-select" id="add-menuItem-parentId" name="parentId">
                                <option value="" selected disabled>Select Parent Category</option>
                                <option value="">N/A</option>
                                @foreach ($data['rose'] as $menuItem)
                                    @if ($menuItem->haveChild)
                                        <option value="{{$menuItem->hashId}}">{{$menuItem->label}}</option>
                                        @include('backend.pages.menu.menuItem.menuItemChild', ['menuitem' => $menuItem, 'level' => 1, 'selected' => old('parent_id')])
                                    @else
                                        <option value="{{$menuItem->hashId}}">{{$menuItem->label}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-menuItem-href">Href <span class="text-danger">*</span></label>
                            <button type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectHrefModal">
                                Select Page/Category<i class="fas fa-link"></i>
                            </button>
                            <input type="text" class="form-control required" id="add-menuItem-href" name="href" placeholder="Enter href" value="{{old('href')}}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="add-menuItem-order">Order</label>
                            <input type="number" class="form-control" id="add-menuItem-order" name="order" placeholder="Enter order" value="{{old('order')}}" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Status <span class="text-danger">*</span></label>
                            <select id="user-plan" class="form-select" name="status" required>
                                <option selected disabled value="">Select status</option>
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

    {{-- selectHrefModal --}}
    <div class="modal fade" id="selectHrefModal" tabindex="-1" aria-labelledby="selectHrefModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="selectHrefModalLabel">Select Page/Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-0 flex-grow-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Pages</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        @foreach ($data['pages'] as $page)
                                            <a href="#" class="list-group-item list-group-item-action" data-href="{{$page->slug}}">{{$page->title}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Categories</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        @foreach ($data['categories'] as $category)
                                            @if ($category->haveChild)
                                                <a href="#" class="list-group-item list-group-item-action" data-href="{{$category->slug}}">{{$category->title}}</a>
                                                @include('backend.pages.menu.menuItem.categoryChild', ['category' => $category, 'level' => 1, 'selected' => old('parent_id')])
                                            @else
                                                <a href="#" class="list-group-item list-group-item-action" data-href="{{$category->slug}}">{{$category->title}}</a>
                                            @endif

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            $('#selectHrefModal').on('click', 'a', function(e) {
                e.preventDefault();
                $('#add-menuItem-href').val($(this).data('href'));
                $('#selectHrefModal').modal('hide');
            });
        });
    </script>
@endsection
