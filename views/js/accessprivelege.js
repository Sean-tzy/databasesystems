if (!$.fn.DataTable.isDataTable('.accessPrivelegeListTable')) {
    var apl = $('.accessPrivelegeListTable').DataTable({
        deferRender: true,
        processing: true,
        autoWidth: true,
        scrollY: 360,
        pageLength: 25,
        lengthMenu: [[25, 50], [25, 50]],
        dom: '<"datatable-header"> <"datatable-scroll"t><"datatable-footer"<"footer-left"f><"footer-right"p>>',
        language: {
            loadingRecords: 'Please wait - loading...',
            processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>',
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: {
                'first': 'First',
                'last': 'Last',
                'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
            }
        },
        columnDefs: [
            {
                targets: 5,
                orderable: false,
                searchable: false,
                className: 'text-center',
                width: '90px'
            }
        ]
    });
}

$(function () {
    newAccessPrivelege();

    $("#btn-new").click(function () {
        Swal.fire({
            title: 'Enlist new user?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                window.location = 'accessprivelege';
            }
        });
    });

    $("#btn-save").click(function () {
        let requiredFields = [
            { id: "#empid", label: "Clinic Staff" },
            { id: "#usertype", label: "User Type" },
            { id: "#diagnostics", label: "Diagnostics" },
            { id: "#clinicstaffaccess", label: "Clinic Staff Access" },
            { id: "#patientregistryaccess", label: "Patient Registry" },
            { id: "#laboratoryassaysaccess", label: "Laboratory Assays" },
            { id: "#reportsaccess", label: "Reports" },
            { id: "#accessprivelegeright", label: "Access Privelege" }
        ];

        let emptyFields = [];
        requiredFields.forEach(function (field) {
            let value = $(field.id).val();
            if (!value || value.trim() === '') {
                emptyFields.push(field.label);
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                title: 'Required Fields Missing',
                icon: 'warning',
                html: '<div style="text-align:left;margin-left:20px;">' +
                    '<p>The following fields are required:</p>' +
                    '<ul>' +
                    emptyFields.map(f => `<li>${f}</li>`).join('') +
                    '</ul></div>',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return;
        }

        Swal.fire({
            title: 'Enlist new user?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                saveAccessPrivelege();
            }
        });
    });
    
    function newAccessPrivelege() {
        $("#trans_type").val("New");
        $("#empid").val('').trigger('change');
        $("#usertype").val('').trigger('change');
        $("#diagnostics").val('').trigger('change');
        $("#clinicstaffaccess").val('').trigger('change');
        $("#patientregistryaccess").val('').trigger('change');
        $("#laboratoryassaysaccess").val('').trigger('change');
        $("#reportsaccess").val('').trigger('change');
        $("#accessprivelegeright").val('').trigger('change');
        $("#empid").focus();
    }

    function saveAccessPrivelege() {
        let accessprivelege = new FormData();
        accessprivelege.append("trans_type", $("#trans_type").val());
        accessprivelege.append("empid", $("#empid").val());
        accessprivelege.append("usertype", $("#usertype").val());
        accessprivelege.append("diagnostics", $("#diagnostics").val());
        accessprivelege.append("clinicstaff", $("#clinicstaffaccess").val());
        accessprivelege.append("patientregistry", $("#patientregistryaccess").val());
        accessprivelege.append("laboratoryassays", $("#laboratoryassaysaccess").val());
        accessprivelege.append("reports", $("#reportsaccess").val());
        accessprivelege.append("accessprivelege", $("#accessprivelegeright").val());

        $.ajax({
            url: "ajax/accessprivelege_save_record.ajax.php",
            method: "POST",
            data: accessprivelege,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "text",
            success: function (answer) {
                if (answer === 'ok') {
                    Swal.fire({
                        title: 'User credentials successsfully saved!',
                        icon: 'success',
                        confirmButtonText: 'Got it',
                        customClass: {
                            confirmButton: 'btn btn-success waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(function (result) {
                        if (result.value) {
                            window.location = 'accessprivelege';
                        }
                    });
                    return;
                }

                Swal.fire({
                    title: 'Oops. Something went wrong!',
                    icon: 'error',
                    confirmButtonText: 'Got it',
                    customClass: {
                        confirmButton: 'btn btn-danger waves-effect waves-light'
                    },
                    buttonsStyling: false
                });
            },
            error: function () {
                Swal.fire({
                    title: 'Oops. Something went wrong!',
                    icon: 'error',
                    confirmButtonText: 'Got it',
                    customClass: {
                        confirmButton: 'btn btn-danger waves-effect waves-light'
                    },
                    buttonsStyling: false
                });
            }
        });
    }

    function loadAccessPrivelege(empid) {
        var searchData = new FormData();
        searchData.append("empid", empid);
        $.ajax({
            url: "ajax/accessprivelege_search_record.ajax.php",
            method: "POST",
            data: searchData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (answer) {
                $("#trans_type").val("Update");
                $("#empid").val(answer["empid"]).trigger('change');
                $("#usertype").val(answer["usertype"]).trigger('change');
                $("#diagnostics").val(answer["diagnostics"]).trigger('change');
                $("#clinicstaffaccess").val(answer["clinicstaff"]).trigger('change');
                $("#patientregistryaccess").val(answer["patientregistry"]).trigger('change');
                $("#laboratoryassaysaccess").val(answer["laboratoryassays"]).trigger('change');
                $("#reportsaccess").val(answer["reports"]).trigger('change');
                $("#accessprivelegeright").val(answer["accessprivelege"]).trigger('change');
            }
        });
    }

    $('#modal-search-accessprivelege').on('shown.bs.modal', function () {
        $.ajax({
            url: "ajax/accessprivelege_list.ajax.php",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (answer) {
                $(".accessPrivelegeListTable").DataTable().clear();
                for (var i = 0; i < answer.length; i++) {
                    let ai = answer[i];
                    apl.row.add([
                        ai.staffname,
                        ai.usertype,
                        ai.diagnostics,
                        ai.reports,
                        ai.accessprivelege,
                        '<button type="button" class="btn btn-sm btn-icon btn-outline-info rounded-pill btn-select-access" data-empid="' + ai.empid + '">' +
                            '<i class="icon-base ti tabler-edit"></i>' +
                        '</button>'
                    ]);
                }
                apl.draw();
            }
        });
    });

    $('.accessPrivelegeListTable tbody').on('click', '.btn-select-access', function () {
        var empid = $(this).data('empid');
        $("#modal-search-accessprivelege").modal("hide");
        loadAccessPrivelege(empid);
    });

    $('.accessPrivelegeListTable tbody').on('dblclick', 'tr', function () {
        var data = apl.row(this).data();
        var staffName = data[0];
        var selectedOption = $('#empid option').filter(function () {
            return $(this).text().trim() === staffName;
        }).first();

        if (selectedOption.length) {
            $("#modal-search-accessprivelege").modal("hide");
            loadAccessPrivelege(selectedOption.val());
        }
    });
});
