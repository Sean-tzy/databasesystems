if (!$.fn.DataTable.isDataTable('.labAssayListTable')) {
    var lal = $('.labAssayListTable').DataTable({
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
                targets: 4,
                render: function (data) {
                    let numericPrice = parseFloat(data);
                    return Number.isNaN(numericPrice) ? data : numericPrice.toString();
                }
            },
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
    newLabAssay();

    $("#btn-new").click(function () {
        Swal.fire({
            title: 'Enlist new laboratory assay?',
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
                window.location = 'labassays';
            }
        });
    });

    $("#btn-save").click(function () {
        let requiredFields = [
            { id: "#abbreviation", label: "Abbreviation" },
            { id: "#description", label: "Description" },
            { id: "#category", label: "Category" },
            { id: "#atype", label: "Type" },
            { id: "#resulttype", label: "Result" },
            { id: "#specimen", label: "Specimen" },
            { id: "#unit", label: "Unit" },
            { id: "#price", label: "Price" }
        ];

        let emptyFields = [];
        requiredFields.forEach(function (field) {
            let value = $(field.id).val();

            if (field.id === "#price") {
                let numericValue = parseFloat(value);
                if (!value || Number.isNaN(numericValue) || numericValue <= 0) {
                    emptyFields.push(field.label);
                }
                return;
            }

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

        let trans_type = $("#trans_type").val();
        let text = trans_type == 'New' ? 'Save new laboratory assay?' : 'Edit existing laboratory assay?';

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
            if (result.value) {
                saveLabAssay();
            }
        });
    });

    function newLabAssay() {
        $("#trans_type").val("New");
        $("#assaycode").val('');
        $("#abbreviation").val('');
        $("#description").val('');
        $("#category").val('').trigger('change');
        $("#atype").val('').trigger('change');
        $("#resulttype").val('').trigger('change');
        $("#specimen").val('').trigger('change');
        $("#unit").val('');
        $("#price").val('0');
        $("#remarks").val('');

        $("#abbreviation").focus();
    }

    function saveLabAssay() {
        let labassay = new FormData();
        labassay.append("trans_type", $("#trans_type").val());
        labassay.append("assaycode", $("#assaycode").val().trim());
        labassay.append("abbreviation", $("#abbreviation").val().trim());
        labassay.append("description", $("#description").val().trim());
        labassay.append("category", $("#category").val());
        labassay.append("atype", $("#atype").val());
        labassay.append("resulttype", $("#resulttype").val());
        labassay.append("specimen", $("#specimen").val());
        labassay.append("unit", $("#unit").val().trim());
        labassay.append("price", $("#price").val());
        labassay.append("remarks", $("#remarks").val().trim());

        $.ajax({
            url: "ajax/labassay_save_record.ajax.php",
            method: "POST",
            data: labassay,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "text",
            success: function (answer) {
                if (answer === 'existing') {
                    Swal.fire({
                        title: 'Assay code already exists!',
                        icon: 'warning',
                        confirmButtonText: 'Got it',
                        customClass: {
                            confirmButton: 'btn btn-warning waves-effect waves-light'
                        },
                        buttonsStyling: false
                    });
                    return;
                }

                if (answer != 'error') {
                    $("#assaycode").val(answer);
                    Swal.fire({
                        title: 'Laboratory assay details successfully saved!',
                        icon: 'success',
                        confirmButtonText: 'Got it',
                        customClass: {
                            confirmButton: 'btn btn-success waves-effect waves-light'
                        },
                        buttonsStyling: false
                    }).then(function (result) {
                        if (result.value) {
                            window.location = 'labassays';
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

    function loadLabAssay(assaycode) {
        var searchData = new FormData();
        searchData.append("assaycode", assaycode);
        $.ajax({
            url: "ajax/labassay_search_record.ajax.php",
            method: "POST",
            data: searchData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (answer) {
                let formattedPrice = parseInt(answer["price"], 10);
                $("#assaycode").val(answer["assaycode"]);
                $("#abbreviation").val(answer["abbreviation"]);
                $("#description").val(answer["description"]);
                $("#category").val(answer["category"]).trigger('change');
                $("#atype").val(answer["atype"]).trigger('change');
                $("#resulttype").val(answer["resulttype"]).trigger('change');
                $("#specimen").val(answer["specimen"]).trigger('change');
                $("#unit").val(answer["unit"]);
                $("#price").val(Number.isNaN(formattedPrice) ? '' : formattedPrice);
                $("#remarks").val(answer["remarks"]);
            }
        });
    }

    $('#modal-search-assay').on('shown.bs.modal', function () {
        $.ajax({
            url: "ajax/labassay_list.ajax.php",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (answer) {
                $(".labAssayListTable").DataTable().clear();
                for (var i = 0; i < answer.length; i++) {
                    let ai = answer[i];
                    lal.row.add([
                        ai.description,
                        ai.assaycode,
                        ai.category,
                        ai.specimen,
                        ai.price,
                        '<button type="button" class="btn btn-sm btn-icon btn-outline-info rounded-pill btn-select-assay" data-assaycode="' + ai.assaycode + '">' +
                            '<i class="icon-base ti tabler-edit"></i>' +
                        '</button>'
                    ]);
                }
                lal.draw();
            }
        });
    });

    $('.labAssayListTable tbody').on('click', '.btn-select-assay', function () {
        var rowData = lal.row($(this).closest('tr')).data();
        var description = rowData[0];
        alert(description);
    });

    $('.labAssayListTable tbody').on('dblclick', 'tr', function () {
        var data = lal.row(this).data();
        var assaycode = data[1];
        $("#modal-search-assay").modal("hide");
        $("#trans_type").val("Update");
        loadLabAssay(assaycode);
    });
});
