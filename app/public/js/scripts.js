function redirect(rota) {
    if( rota == null || rota == undefined) {
        window.location.href = "dashboard";
        return;
    }
    window.location.href = rota;
    return;
}

function _activeModal(router, msg)
{
    const _token = $('input[name="_token"]').val();
    const id = router.split('/');
    link = `<form action=${router} method="post">`;
    link += `<input type="hidden" name="_method" value="DELETE">`;
    link += `<button type="submit" class="btn btn-danger">Excluir</button>`;
    link += `<input type="hidden" name="_token" value="${_token}" autocomplete="off">`;
    link += `</form>`;
    $('#remover_').html(msg);
    $('#btn-remove').html(link);
    $('#excluir_remover').modal('show');
}

const mascaraMoeda = (event) => {
    const onlyDigits = event.target.value
        .split("")
        .filter(s => /\d/.test(s))
        .join("")
        .padStart(3, "0")
    const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
    event.target.value = maskCurrency(digitsFloat)
}

const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency
    }).format(valor)
}

const formatCurrency = (value, currency, localeString) => {
    const options = { style: "currency", currency }
    return value.toLocaleString(localeString, options)
}

$(function() {
    $('#autor-multiple-selected').multiselect({
        nonSelectedText: 'Selecione um ou mais autores'
    });

    $('#rel-autor-multiple-selected').multiselect({
        nonSelectedText: 'Todos'
    });

    $('#assunto-multiple-selected').multiselect({
        nonSelectedText: 'Selecione um ou mais assuntos'
    });


    $("#datepicker").datepicker({
        autoclose: true,
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        endDate: "today",
    });

});
