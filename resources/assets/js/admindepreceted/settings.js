'use strict';

$(function () {

    let dtOverrideGlobals = {
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        autoWidth: false,
        ajax: "/admin/roles",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'actions', name: 'Actions', orderable: false, searchable: false, width: '5%'}
        ],
        orderCellsTop: true,
        order: [[2, 'desc']],
        pageLength: 10,
        dom: '<"row me-2"' +
            '<"col-md-2"<"me-3"l>>' +
            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
            '>t' +
            '<"row mx-2"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',

        buttons: [
            {
                extend: 'collection',
                className: 'btn btn-label-secondary dropdown-toggle mx-3',
                text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="ti ti-printer me-2" ></i>Print',
                        className: 'dropdown-item',
                        customize: function (win) {
                            //customize print view for dark
                            $(win.document.body)
                                .css('color', headingColor)
                                .css('border-color', borderColor)
                                .css('background-color', bodyBg);
                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('color', 'inherit')
                                .css('border-color', 'inherit')
                                .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="ti ti-file-text me-2" ></i>Csv',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'excel',
                        text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                        className: 'dropdown-item',
                    },
                    {
                        extend: 'copy',
                        text: '<i class="ti ti-copy me-2" ></i>Copy',
                        className: 'dropdown-item',
                    }
                ]
            },
            {
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New Role</span>',
                className: 'add-new btn btn-primary',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': '#addRoleModal'
                }
            }
        ],
        columnDefs: [
            {
                searchable: false,
                orderable: false,
                targets: 0,
                width: "5%"
            },
        ]
    };
    let table = $('.datatable-Role').DataTable(dtOverrideGlobals);

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('.datatable-Role tbody').on('click', 'td:not(:first-child, :last-child)', (event) => {
        let row = table.row(event.currentTarget).data(),
            permission = row.permission_ids;

        $('#submitAddRole').attr('data-id', row.id);
        permission.forEach(function (val, index) {
            $('#permission_id_'+val).prop('checked', true);
        });

        $('input[name="title"]').val(row.title);

        let modalSelector = document.getElementById('addRoleModal')
        modalSelector.addEventListener('hidden.bs.modal', function () {
            $('#addNewRoleForm').trigger("reset");
            $('#submitAddRole').attr('data-id', null);

            $('input[name="permissions[]"]').prop('checked', false);
        });

        let bsModalAddRole = new bootstrap.Modal(modalSelector)
        bsModalAddRole.show();
    });

    $('#submitAddRole').on('click', function () {
        let savedIds = $(this).attr('data-id'),
            savesForm = $(this).parent().parent(),
            hiddenPut = $('input[name="_method"]');

        if (savedIds === ''|| typeof savedIds === 'undefined') {
            hiddenPut.prop('disabled', true);
            savesForm.attr('action', "/admin/roles").submit();
        } else {
            hiddenPut.prop('disabled', false);
            savesForm.attr('action', "/admin/roles/" + savedIds).submit();
        }
    });
});
