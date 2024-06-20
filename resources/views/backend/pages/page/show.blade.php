@extends('backend/layouts/layoutMaster')

@section('title', $data['rows']->title . ' - News')

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
                    {{$data['rows']->title}}
                </h4>

                <h6 class="d-flex align-items-center mt-2">
                    {{$data['rows']->description}}
                </h6>

                <hr class="container-m-nx">

                <p style="white-space: pre-line;">
                    {!!$data['rows']->content!!}
                </p>

                <hr class="container-m-nx">

                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-label-secondary p-2 rounded me-3">
                                <i class='bx bx-calendar' ></i>
                            </span>
                            <span class="text-muted me-2">Created at:</span>
                            <span class="text-dark">
                                {{date('d M Y', strtotime($data['rows']->created_at))}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-label-secondary p-2 rounded me-3">
                                <i class='bx bx-calendar' ></i>
                            </span>
                            <span class="text-muted me-2">Updated at:</span>
                            <span class="text-dark">
                                {{date('d M Y', strtotime($data['rows']->updated_at))}}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
