/**
 * App user list
 */

'use strict';

// Datatable (jquery)
$(function () {

    var dtUserTable = $('.datatables-users'),
        statusObj = {
            1: { title: 'Pending', class: 'bg-label-warning' },
            2: { title: 'Active', class: 'bg-label-success' },
            3: { title: 'Blocked', class: 'bg-label-danger' }
        };

    var userView = baseUrl + 'admin/profile/';

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            processing: true,

            ajax: {
                url: "/admin/user/getAllUsers",
            },
            columns: [
                // columns according to JSON
                { data: '' },
                { data: 'full_name' },
                { data: 'role' },
                { data: 'phone' },
                { data: 'email' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    // User full name and email
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $name = full['full_name'],
                            $image = full['avatar'];
                        if ($image) {
                            // For Avatar image
                            var $output =
                                '<img src="' + $image + '" alt="Avatar" class="rounded-circle">';
                        } else {
                            // For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6) + 1;
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['full_name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                        }
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar avatar-sm me-3">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="' +
                            userView + full['email'] +
                            '" class="text-body text-truncate"><span class="fw-semibold">' +
                            $name +
                            '</span></a>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    // User Role
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $role = full['role'];

                        if (full['permission']) {

                            var $add = "<span class='badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2' id='roleEditSpan' onclick='roleUpdate(\"" + full['id'] + "\",\"" + full['role'] + "\")' style='cursor: pointer;'>" +
                                "<i class='bx bx-plus bx-xs'></i>" +
                                "</span>";

                            var $edit = "<span class='badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2' id='roleEditSpan' onclick='roleUpdate(\"" + full['id'] + "\",\"" + full['role'] + "\")' style='cursor: pointer;'>" +
                                "<i class='bx bx-edit bx-xs'></i>" +
                                "</span>";

                            return $role == 'N/A'
                                ? "<span class='text-truncate d-flex align-items-center'>" + $add + $role + '</span>'
                                : ($role != 'Super Admin'
                                    ? "<span class='text-truncate d-flex align-items-center'>" + $edit + $role + '</span>' :
                                    "<span class='text-truncate d-flex align-items-center'>" + $role + '</span>');
                        } else {
                            return $role == 'N/A'
                                ? "<span class='text-truncate d-flex align-items-center'>" + $role + '</span>'
                                : ($role != 'Super Admin'
                                    ? "<span class='text-truncate d-flex align-items-center'>" + $role + '</span>' :
                                    "<span class='text-truncate d-flex align-items-center'>" + $role + '</span>');
                        }
                    }
                },
                {
                    // Plans
                    targets: 3,
                    render: function (data, type, full, meta) {
                        var $phone = full['phone'];

                        return '<span class="fw-semibold">' + $phone + '</span>';
                    }
                },
                {
                    // User Status
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var $status = full['status'];

                        return '<span class="badge ' + statusObj[$status].class + '">' + statusObj[$status].title + '</span>';
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'View',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {

                        var url = '{{ route("admin.profile.show", ":email") }}';
                        url = url.replace(':email', full['email']);
                        return '<a href="' + userView + full['email'] + '" class="btn btn-sm btn-icon"><i class="bx bx-show-alt"></i></a>';
                    }
                }
            ],
            order: [[1, 'desc']],
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>' +
                '>t' +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: '_MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(2)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                        )
                            .appendTo('.user_role')
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                            });
                    });
            }
        });
    }

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
});
