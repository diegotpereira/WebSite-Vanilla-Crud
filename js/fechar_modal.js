function fechar_modal() {
    _('modal_backdrop').style.display = 'none'
    _('cliente_modal').style.display = 'none'
    _('cliente_modal').classList.remove('show')
}

_('fechar_modal').onclick = function() {
    fechar_modal()
}