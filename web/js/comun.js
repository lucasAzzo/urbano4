
function campo_numerico (event){
    //{{ form_widget(formulario.numero,{'attr':{'onkeypress':'return campo_numerico(event)'}}) }}
    return event.charCode >= 48 && event.charCode <= 57;
}



