$(function () {

    function clearResetFields() {
        $('#username-validate').val('');
        $('#password-validate').val('');
        $('#loginUser').val('');
        $('#loginPass').val('');
    }

    clearResetFields();

    setTimeout(function () {
        clearResetFields();
    }, 300);

    setTimeout(function () {
        clearResetFields();
    }, 1000);

    function getEmptyFields(requiredFields) {
        let emptyFields = [];

        requiredFields.forEach(function (field) {
            let value = $(field.id).val();

            if (!value || value.trim() === '') {
                emptyFields.push(field.label);
            }
        });

        return emptyFields;
    }
    function showRequiredFieldsWarning(emptyFields) {
        Swal.fire({
            title: 'Required Fields Missing',
            icon: 'warning',
            html: `
                <div style="text-align:left;">
                    <p>Please fill in the following fields:</p>
                    <ul>
                        ${emptyFields.map(field => `<li>${field}</li>`).join('')}
                    </ul>
                </div>
            `,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    }

    function showResultPopup(title, icon) {
        Swal.fire({
            title: title,
            icon: icon,
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-primary'
            },
            buttonsStyling: false
        });
    }

    function setResetState(validated) {
        $('#loginUser, #loginPass, #btn-reset').prop('disabled', !validated);
        $('#username-validate, #password-validate, #btn-validate').prop('disabled', validated);

        if (validated) {
            $('#reset-fields').show();
        } else {
            $('#reset-fields').hide();
        }
    }

    function getPostData() {
        return {
            action: '',
            currentUsername: $('#username-validate').val(),
            currentPassword: $('#password-validate').val(),
            loginUser: $('#loginUser').val(),
            loginPass: $('#loginPass').val()
        };
    }

    setResetState(false);

        $('#btn-validate').on('click', function (e) {
            e.preventDefault();

            const requiredFields = [
                { id: '#username-validate', label: 'Current Username' },
                { id: '#password-validate', label: 'Current Password' }
            ];

            const emptyFields = getEmptyFields(requiredFields);

            if (emptyFields.length > 0) {
                showRequiredFieldsWarning(emptyFields);
                return;
            }

            let data = getPostData();
            data.action = 'validate';

            $.ajax({
                url: 'ajax/settings_reset.ajax.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        setResetState(true);
                        $('#loginUser').focus();
                    } else {
                        showResultPopup(response.message, 'error');
                        setResetState(false);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    showResultPopup('Validation request failed.', 'error');
                }
            });
        });

        $('#btn-reset').on('click', function (e) {
            e.preventDefault();

            const requiredFields = [
                { id: '#loginUser', label: 'New Username' },
                { id: '#loginPass', label: 'New Password' }
            ];

            const emptyFields = getEmptyFields(requiredFields);

            if (emptyFields.length > 0) {
                showRequiredFieldsWarning(emptyFields);
                return;
            }

            Swal.fire({
                title: 'Do you want to reset your login credential?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then(function (result) {

                if (!result.isConfirmed) {
                    return;
                }

                let data = getPostData();
                data.action = 'reset';

                $.ajax({
                    url: 'ajax/settings_reset.ajax.php',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            showResultPopup(response.message, 'success');

                            $('#username-validate').val('');
                            $('#password-validate').val('');
                            $('#loginUser').val('');
                            $('#loginPass').val('');

                            setResetState(false);
                        } else {
                            showResultPopup(response.message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        showResultPopup('Reset request failed.', 'error');
                    }
                });

            });
        });

});