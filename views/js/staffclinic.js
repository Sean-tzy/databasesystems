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
                'first': 'First', 
                'last': 'Last', 
                'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 
                'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' 
            }
        }
    });
}

$(function () {
    var datehired = $('#datehired');
    datehired.attr('placeholder', '  /  /  ');
    datehired.flatpickr({
      monthSelectorType: 'static',
      dateFormat: 'm/d/Y',
      static: true
    });

    newStaff();

    $("#btn-new").click(function(){
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
          if (result.value) {
            window.location = 'staffclinic';
          }
        });
    });   

    $("#btn-save").click(function () {
        let requiredFields = [
            { id: "#firstname", label: "First Name" },
            { id: "#lastname", label: "Last Name" },
            { id: "#mi", label: "Middle Initial" },
            { id: "#prc", label: "PRC" },
            { id: "#designation", label: "Designation" }
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

        let trans_type = $("#trans_type").val();
        if (trans_type == 'New'){
            var text = 'Save new staff?';
        }else{
            var text = 'Edit existing staff?';
        }

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
            saveStaff();
          }
        });
    });

    function newStaff(){
        $("#firstname").val('');
        $("#lastname").val('');
        $("#mi").val('');
        $("#extension").val('');
        $("#designation").val('').trigger('change');
        $("#prc").val('');
        $("#empid").val('');
        $("#mobile").val('');
        $("#alternate").val('');
        $("#address").val('');
         
        $("#firstname").focus();
    }

    function saveStaff(){
        let trans_type = $("#trans_type").val();
        let encodedby = $("#encodedby").val();

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let mi = $("#mi").val();
        let extension = $("#extension").val();
        let designation = $("#designation").val();
        let prc = $("#prc").val();
        let empid = $("#empid").val();
        let mobile = $("#mobile").val();
        let alternate = $("#alternate").val();

        let raw_datehired = $("#datehired").val();
        let datehired = '';

        if (raw_datehired !== "") {
            let parts = raw_datehired.split("/");
            datehired = parts[2] + "-" + parts[0] + "-" + parts[1];
        }

        let address = $("#address").val();

        let staffclinic = new FormData();
        staffclinic.append("trans_type", trans_type);
        staffclinic.append("encodedby", encodedby);

        staffclinic.append("firstname", firstname);
        staffclinic.append("lastname", lastname);
        staffclinic.append("mi", mi);
        staffclinic.append("extension", extension);
        staffclinic.append("designation", designation);
        staffclinic.append("prc", prc);
        staffclinic.append("empid", empid);
        staffclinic.append("mobile", mobile);
        staffclinic.append("alternate", alternate);
        staffclinic.append("datehired", datehired);
        staffclinic.append("address", address);

        $.ajax({
            url:"ajax/staffclinic_save_record.ajax.php",
            method: "POST",
            data: staffclinic,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"text",
            success:function(answer){
                let empid = answer;
                if (empid != 'error' && empid != 'existing'){
                  Swal.fire({
                      title: 'Staff details successfully saved!',
                      icon: 'success',
                      confirmButtonText: 'Got it',
                      customClass: {
                        confirmButton: 'btn btn-success waves-effect waves-light'
                      },
                      buttonsStyling: false
                  }).then(function (result) {
                      if (result.value) {
                          window.location = 'staffclinic';
                      }
                  });
                }
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

    $('#modal-search-staff').on('shown.bs.modal', function () {
        $.ajax({
            url: "ajax/staff_list.ajax.php",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(answer) {
                $(".staffListTable").DataTable().clear();   
                for (var i = 0; i < answer.length; i++) {
                    let si = answer[i];
                    let empid = si.empid;
                    let lastname = si.lastname;
                    let firstname = si.firstname;
                    let mi = si.mi;
                    let designation = si.designation;
                    sl.row.add([empid, lastname, firstname, mi, designation]);
                }
                sl.draw();
            }
        });
    });

    $('.staffListTable tbody').on('dblclick', 'tr', function () {
        var data = sl.row(this).data(); 
        var empid = data[0]; 

        $("#modal-search-staff").modal("hide");
        $("#trans_type").val("Update");

        var data = new FormData();
        data.append("empid", empid);
        $.ajax({
            url:"ajax/staffclinic_search_record.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(answer){
                $("#firstname").val(answer["firstname"]);
                $("#lastname").val(answer["lastname"]);
                $("#si").val(answer["si"]);
                $("#extension").val(answer["extension"]);
                $("#designation").val(answer["designation"]).trigger('change');
                $("#prc").val(answer["prc"]);
                $("#empid").val(answer["empid"]);
                $("#mobile").val(answer["mobile"]);
                $("#alternate").val(answer["alternate"]);

                var date_hired = answer["datehired"]; 
                if (date_hired) {
                    var parts = date_hired.split('-'); 
                    var formattedDate = parts[1] + '/' + parts[2] + '/' + parts[0]; 
                    $("#datehired").val(formattedDate);
                }

                $("#address").val(answer["address"]);
            }
        });    
    });
});