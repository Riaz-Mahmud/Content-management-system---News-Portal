@extends('backend/layouts/layoutMaster')

@section('title', 'Role List')

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/libs/toastr/toastr.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{asset('assets/backend/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>

    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/libs/toastr/toastr.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('js/custom/backend/allUsersList.js')}}"></script>

    <script>
        function roleUpdate(id, role) {

            // rander option for select id chooseRole
            var options = '';
            options += '<option selected disabled>Choose Role</option>';
            options += '<option value="">N/A</option>';
            @foreach ($data['roles'] as $role )
                if(role == '{{$role->name}}'){
                    options += '<option value="{{$role->hashId}}" selected>{{$role->name}}</option>';
                }else{
                    options += '<option value="{{$role->hashId}}">{{$role->name}}</option>';
                }
            @endforeach

            $('#chooseRole').html(options);

            $('#upgradeRoleModalUserId').val(id);
            $('#upgradeRoleModal').modal('show');
        }

        // when click on upgradeRoleBtn
        $('#upgradeRoleBtn').click(function() {
            var userId = $('#upgradeRoleModalUserId').val();
            var roleId = $('#chooseRole').val();

            if (userId == '' ) {
                toastr.error('Please select a user');
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.role.update.user') }}",
                type: "POST",
                data: {
                    "userId": userId,
                    "roleId": roleId,
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('#upgradeRoleModal').modal('hide');

                        toastr.success(response.message);

                        $('.datatables-users').DataTable().ajax.reload();

                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(response) {
                    toastr.error(response.message);
                }
            });
        });

    </script>

@endsection

@section('content')

    @if ($errors->any() || session('error'))
        @include('backend._partials.errorMsg')
    @endif

    @if (session('success'))
        @include('backend._partials.successMsg')
    @endif

   <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                        <thead>
                            <tr>
                            <th></th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->

    <!-- Upgrade Role Modal -->
    @include('backend.pages.user.role_update')

@endsection
