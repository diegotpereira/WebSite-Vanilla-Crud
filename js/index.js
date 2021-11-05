var table = new JSTable("#cliente_tabela", {
    serverSide: true,
    deferLoading: '<?php echo conte_todos_dados($conexao); ?>',
    ajax: "buscar.php"
})


function _(element) {
    return document.getElementById(element)
}


function abrir_modal() {

    _('modal_backdrop').style.display = 'block'
    _('cliente_modal').style.display = 'block'
    _('cliente_modal').classList.add('show')
}



function redefinirDados() {
    _('cliente_form').reset()
    _('acao').value = 'Adicionar'
    _('nome_error').innerHTML = ''
    _('sobrenome_error').innerHTML = ''
    _('email_error').innerHTML = ''
    _('modal_title').innerHTML = 'Adicionar Dados'
    _('btn_acao').innerHTML = 'Adicionar'
}
_('add_dados').onclick = function() {
    abrir_modal()
    redefinirDados()
}

function fechar_modal() {
    _('modal_backdrop').style.display = 'none'
    _('cliente_modal').style.display = 'none'
    _('cliente_modal').classList.remove('show')
}



window.onload = function() {
    // your code
    _('btn_acao').onclick = function() {
        var formulario_dados = new FormData(_('cliente_form'))
        _('btn_acao').disabled = true

        fetch('acao.php', {
            method: "POST",
            body: formulario_dados

        }).then(function(response) {
            return response.json()

        }).then(function(responseData) {
            _('btn_acao').disabled = false

            if (responseData.success) {
                _('mensagem_sucesso').innerHTML = responseData.success

                fechar_modal()
                table.update()
            } else {

                if (responseData.nome_erro) {
                    _('nome_erro').innerHTML = responseData.nome_erro

                } else {
                    _('nome_erro').innerHTML = ''

                }

                if (responseData.sobrenome.erro) {
                    _('sobrenome_erro').innerHTML = responseData.sobrenome.erro

                } else {
                    _('sobrenome_erro').innerHTML = ''
                }

                if (responseData.email_erro) {
                    _('email_erro').innerHTML = responseData.email_erro

                } else {
                    _('email_erro').innerHTML = ''
                }
            }
        })
    }
}


function buscar_dados(id) {

    var formulario_dados = new FormData()
    formulario_dados.append('id', id)
    formulario_dados.append('acao', 'buscar')

    fetch('acao.php', {
        method: "POST",
        body: formulario_dados

    }).then(function(response) {
        return response.json()

    }).then(function(responseData) {
        _('nome').value = responseData.nome
        _('sobrenome').value = responseData.sobrenome
        _('email').value = responseData.email
        _('genero').value = responseData.genero
        _('id').value = id
        _('acao').value = 'Atualizar'
        _('modal_title').innerHTML = 'Editar Dados'
        _('btn_acao').innerHTML = 'Editar'

        abrir_modal()
    })
}

function deletar_dados(id) {
    if (confirm("Tem certeza que deseja removê-lo?")) {
        var formulario_dados = new FormData()
        formulario_dados.append('id', id)
        formulario_dados.append('acao', 'deletar')

        fetch('acao.php', {
            method: "POST",
            body: formulario_dados

        }).then(function(response) {
            return response.json()

        }).then(function(responseData) {
            _('mensagem_sucesso').innerHTML = responseData.success
            table.update()
        })
    }
}