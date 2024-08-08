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

$(function() {
    $('#autor-multiple-selected').multiselect({
        nonSelectedText: 'Selecione um ou mais autores'
    });
});
