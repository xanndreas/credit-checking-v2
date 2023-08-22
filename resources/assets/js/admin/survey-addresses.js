'use strict';

// Datatable (jquery)
$(function () {

    let dtOverrideGlobals = {
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        autoWidth:  false,
        ajax: "/admin/survey-addresses",
        columns: [
            {data: 'placeholder', name: 'placeholder'},
            {data: 'batch_number', name: 'batch_number'},
            {data: 'credit_type', name: 'credit_type'},
            {data: 'auto_planner_name', name: 'auto_planner_name'},
            {data: 'request_debtor', name: 'request_debtor.name', searchable: false, orderable: false},
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
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details';
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
        buttons: [
            {
                extend: 'collection',
                className: 'btn btn-label-secondary dropdown-toggle ms-3',
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
            }
        ],
        columnDefs: [
            {
                className: 'control',
                searchable: false,
                orderable: false,
                responsivePriority: 2,
                targets: 0,
                render: function (data, type, full, meta) {
                    return '';
                }
            },
        ]

    };
    let table = $('.datatable-SurveyAddresses').DataTable(dtOverrideGlobals);

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });

    $('.datatable-SurveyAddresses tbody').on('click', 'td:not(:first-child, :last-child)', (event) => {
        let row = table.row(event.currentTarget).data();
        window.location.href = '/admin/survey-addresses/' + row.id + '/detail';
    });

    $('#submitAddSurveyAddresses').on('click', function () {
        let savedIds = $(this).attr('data-id'),
            savesForm = $(this).parent(),
            hiddenPut = $('input[name="_method"]');

        if (savedIds === '' || typeof savedIds === 'undefined') {
            hiddenPut.prop('disabled', true);
            savesForm.attr('action', "/admin/surveys").submit();
        } else {
            hiddenPut.prop('disabled', false);
            savesForm.attr('action', "/admin/surveys/" + savedIds).submit();
        }
    });

});
