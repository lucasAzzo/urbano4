var formulario = $("form");
formulario.on("submit", function (e) {
    $.each(formulario.find('.form-control'), function () {
        if ($(this).is(':invalid') && ($(this).attr('required') == 'required' || $(this).attr('required') == true)) {
            e.preventDefault();
            return false;
        }
    });
    return true;
});