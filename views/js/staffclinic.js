if (!$.fn.DataTable.isDataTable('.staffListTable')) {
    var sl = $('.staffListTable').DataTable({
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
                first: 'First',
                last: 'Last',
                next: $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                previous: $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
            }
        }
    });
}

$(function () {

    if ($('#datehired').length && typeof $.fn.flatpickr !== 'undefined') {
        $('#datehired').flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y',
            static: true
        });
    }

    newStaff();

    // =========================
    // NEW BUTTON
    // =========================
    $("#btn-new").click(function () {
        Swal.fire({
            title: 'Enlist new staff?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                window.location = 'staffclinic';
            }
        });
    });

    // =========================
    // SAVE BUTTON
    // =========================
    $("#btn-save").click(function () {

        let requiredFields = [
            { id: "#firstname", label: "First Name" },
            { id: "#lastname", label: "Last Name" },
            { id: "#mi", label: "Middle Initial" },
            { id: "#designation", label: "Designation" }
        ];

        let emptyFields = [];

        requiredFields.forEach(function (field) {
            let el = $(field.id);
            if (el.length === 0) return;

            let value = el.val();
            if (!value || value.trim() === '') {
                emptyFields.push(field.label);
            }
        });

        if (emptyFields.length > 0) {
            Swal.fire({
                title: 'Required Fields Missing',
                icon: 'warning',
                html:
                    '<div style="text-align:left;margin-left:20px;">' +
                    '<p>The following fields are required:</p>' +
                    '<ul>' +
                    emptyFields.map(f => `<li>${f}</li>`).join('') +
                    '</ul></div>',
                confirmButtonText: 'OK',
                customClass: { confirmButton: 'btn btn-primary' },
                buttonsStyling: false
            });
            return;
        }

        let trans_type = $("#trans_type").val();
        let text = trans_type === 'New' ? 'Save new staff?' : 'Edit existing staff?';

        Swal.fire({
            title: text,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                saveStaff();
            }
        });
    });

    // =========================
    // PRINT BUTTON (ADDED)
    // =========================
    $("#btn-print").click(function () {
        window.open("reports/sample.php", "_blank");
    });

    // =========================
    // RESET FORM
    // =========================
    function newStaff() {
        $("#firstname").val('');
        $("#lastname").val('');
        $("#mi").val('');
        $("#extension").val('');
        $("#designation").val('').trigger('change');
        $("#prc").val('');
        $("#empid").val('');
        $("#mobile").val('');
        $("#alternate").val('');
        $("#datehired").val('');
        $("#address").val('');
        $("#firstname").focus();
    }

    // =========================
    // SAVE FUNCTION
    // =========================
    function saveStaff() {

        let raw_datehired = $("#datehired").val();
        let datehired = '';

        if (raw_datehired !== "") {
            let parts = raw_datehired.split("/");
            datehired = parts[2] + "-" + parts[0] + "-" + parts[1];
        }

        let form = new FormData();
        form.append("trans_type", $("#trans_type").val());
        form.append("encodedby", $("#encodedby").val());
        form.append("firstname", $("#firstname").val());
        form.append("lastname", $("#lastname").val());
        form.append("mi", $("#mi").val());
        form.append("extension", $("#extension").val());
        form.append("designation", $("#designation").val());
        form.append("prc", $("#prc").val());
        form.append("empid", $("#empid").val());
        form.append("mobile", $("#mobile").val());
        form.append("alternate", $("#alternate").val());
        form.append("datehired", datehired);
        form.append("address", $("#address").val());

        $.ajax({
            url: "ajax/staffclinic_save_record.ajax.php",
            method: "POST",
            data: form,
            cache: false,
            contentType: false,
            processData: false,

            success: function (answer) {
                console.log("RESPONSE:", answer);
                answer = answer.trim();

                if (answer === "ok") {
                    Swal.fire({
                        title: "Saved!",
                        text: "Staff saved successfully!",
                        icon: "success"
                    }).then(() => location.reload());
                } else if (answer === "existing") {
                    Swal.fire("Staff already exists!", "", "warning");
                } else {
                    Swal.fire({
                        title: "ERROR",
                        html: "<pre style='text-align:left'>" + answer + "</pre>",
                        icon: "error"
                    });
                }
            },

            error: function (xhr) {
                console.log("AJAX ERROR:", xhr.responseText);

                Swal.fire({
                    title: "PHP ERROR",
                    html: "<pre style='text-align:left'>" + xhr.responseText + "</pre>",
                    icon: "error"
                });
            }
        });
    }

});