@extends('backend/layouts/layoutMaster')

@section('title', $data['rose']->title . ' - News')

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
        <div class="card overflow-hidden">
            <div class="card-body">
                <h4 class="d-flex align-items-center mt-2">
                    <span class="badge bg-label-secondary p-2 rounded me-3">
                        <i class='bx bxs-captions' ></i>
                    </span>
                    {{$data['rose']->title}}
                </h4>
                {{-- content create by seciton  --}}
                <h6 class="d-flex align-items-center mt-2">
                    <span class="p-2">
                        <i class='bx bx-copyright' ></i>
                    </span>
                    {{$data['rose']->createBy->name}}

                    <span class="p-2">
                        <i class='bx bx-calendar' ></i>
                    </span>
                    {{date('d-M-Y h:i A', strtotime($data['rose']->created_at))}}

                    <span class="p-2">
                        <i class='bx bx-show'></i>
                    </span>
                    {{$data['rose']->view_count}}

                    <span class="p-2">
                        <i class='bx bx-comment-detail bx-sm' ></i>
                    </span>
                    {{$data['rose']->comment_count}}
                </h6>

                <hr class="container-m-nx">

                <p style="white-space: pre-line;">
                    {!!$data['rose']->content!!}
                </p>

                <hr class="container-m-nx">

                {{-- categories --}}
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="align-items-center mt-2">
                            <span class="p-2">
                                <i class='bx bxs-category' ></i>
                            </span>
                            Categories
                        </h6>
                        @if ($data['categories']->count() > 0)
                            @foreach ($data['categories'] as $cat)
                                <span class="badge bg-primary">{{$cat->title}} </span>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Tags --}}
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="align-items-center mt-2">
                            <span class="p-2">
                                <i class='bx bxs-tag' ></i>
                            </span>
                            Tags
                        </h6>
                        @if ($data['tags']->count() > 0)
                            @foreach ($data['tags'] as $tag)
                                <span class="badge bg-info">{{$tag->label}} </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
