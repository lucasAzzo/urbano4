var formulario = $("form");
formulario.on("submit", function (e) {
    $.each(formulario.find('.input-field input'), function () {
        if (($(this).attr('required') == 'required' || $(this).attr('required') == true) && $(this).val() == '') {
            e.preventDefault();
            return false;
        }
    });
    $.each(formulario.find('select'), function () {
        if (($(this).attr('required') == 'required' || $(this).attr('required') == true) && $(this).val() == '') {
            e.preventDefault();
            return false;
        }
    });
    return true;
});


