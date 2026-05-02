$(function () {
    let accessLevel = $('body').data('accessLevel');
    if (accessLevel !== 'View') {
        return;
    }

    let activeForm = $('.content-wrapper form').first();
    if (!activeForm.length) {
        return;
    }

    activeForm.find('input:not([type="hidden"])').prop('disabled', true);
    activeForm.find('textarea').prop('disabled', true);
    activeForm.find('select').prop('disabled', true).trigger('change.select2');

    activeForm.find('#btn-new, #btn-save').prop('disabled', true).addClass('disabled');
    activeForm.find('#btn-search').prop('disabled', false).removeClass('disabled');
});
