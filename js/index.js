function _(element) {
    return document.getElementById(element)
}


function open_modal() {

    _('modal_backdrop').style.display = 'block';
    _('cliente_modal').style.display = 'block'
    _('cliente_modal').classList.add('show')
}

_('add_dados').onclick = function() {
    open_modal();
    // reset_data();
}