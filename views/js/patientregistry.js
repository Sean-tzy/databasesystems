if (!$.fn.DataTable.isDataTable('.patientListTable')) {
    var pl = $('.patientListTable').DataTable({
        deferRender: true,
        processing: true,
        autoWidth: true,
        scrollY: 360,
        pageLength: 25,
        lengthMenu: [[25, 50], [25, 50]],
        dom: '<"datatable-header"> <"datatable-scroll"t><"datatable-footer"<"footer-left"f><"footer-right"p>>',
        // dom: '<"datatable-header"> <"datatable-scroll"t><"datatable-footer"pf>',
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
    var birthdate = $('#birthdate');
    birthdate.attr('placeholder', 'mm/dd/yyyy');

    birthdate.flatpickr({
        dateFormat: 'm/d/Y',
        allowInput: true,
        clickOpens: false  
    });

    newPatient();

    $("#btn-new").click(function(){
        Swal.fire({
          title: 'Enlist new patient?',
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
            window.location = 'patientregistry';
          }
        });
    });   

    $("#btn-save").click(function () {
        let requiredFields = [
            { id: "#firstname", label: "First Name" },
            { id: "#lastname", label: "Last Name" },
            { id: "#mi", label: "Middle Initial" },
            { id: "#birthdate", label: "Birth Date" },
            { id: "#gender", label: "Gender" }
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
          title: 'Save new patient?',
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
            savePatient();
          }
        });
    });

    function newPatient(){
        $("#firstname").val('');
        $("#lastname").val('');
        $("#mi").val('');
        $("#extension").val('');
        $("#age").val('');
        $("#gender").val('').trigger('change');
        $("#email").val('');
        $("#mobile").val('');
        $("#alternate").val('');
        $("#address").val('');
         
        $("#firstname").focus();
    }

    function savePatient(){
        let trans_type = $("#trans_type").val();
        let encodedby = $("#encodedby").val();

        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let mi = $("#mi").val();
        let extension = $("#extension").val();

        let raw_birthdate = $("#birthdate").val();
        let birthdate = '';
        if (raw_birthdate !== "") {
            let parts = raw_birthdate.split("/");
            birthdate = parts[2] + "-" + parts[0] + "-" + parts[1];
        }

        let gender = $("#gender").val();
        let nationality = $("#nationality").val();
        let email = $("#email").val();
        let mobile = $("#mobile").val();
        let alternate = $("#alternate").val();
        let address = $("#address").val();

        // alert(firstname + ' ' + lastname + ' ' + mi + ' ' + extension + ' ' + birthdate + ' ' + gender + ' ' + nationality + ' ' + email + ' ' + mobile + ' ' + alternate + ' ' + address);

        let patientregistry = new FormData();
        patientregistry.append("trans_type", trans_type);
        patientregistry.append("encodedby", encodedby);

        patientregistry.append("firstname", firstname);
        patientregistry.append("lastname", lastname);
        patientregistry.append("mi", mi);
        patientregistry.append("extension", extension);
        patientregistry.append("birthdate", birthdate);
        patientregistry.append("gender", gender);
        patientregistry.append("nationality", nationality);
        patientregistry.append("email", email);
        patientregistry.append("mobile", mobile);
        patientregistry.append("alternate", alternate);
        patientregistry.append("address", address);

        $.ajax({
            url:"ajax/patient_save_record.ajax.php",
            method: "POST",
            data: patientregistry,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"text",
            success:function(answer){
                let patientid = answer;
                // alert(patientid);
                if (patientid != 'error' && patientid != 'existing'){
                  Swal.fire({
                      title: 'Patient details successfully saved!',
                      icon: 'success',
                      confirmButtonText: 'Got it',
                      customClass: {
                        confirmButton: 'btn btn-success waves-effect waves-light'
                      },
                      buttonsStyling: false
                  }).then(function (result) {
                      if (result.value) {
                          window.location = 'patientregistry';
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

    $('#modal-search-patient').on('shown.bs.modal', function () {
        $.ajax({
            url: "ajax/patient_list.ajax.php",
            method: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(answer) {
                $(".patientListTable").DataTable().clear();   
                for (var i = 0; i < answer.length; i++) {
                    let pi = answer[i];
                    let patientid = pi.patientid;
                    let lastname = pi.lastname;
                    let firstname = pi.firstname;
                    let mi = pi.mi;
                    let gender = pi.gender;
                    let address = pi.address;
                    pl.row.add([patientid, lastname, firstname, mi, address]);
                }
                pl.draw();
            }
        });
    });

    $('.patientListTable tbody').on('dblclick', 'tr', function () {
        var data = pl.row(this).data(); 
        var patientid = data[0]; 

        alert(patientid);
    });
});