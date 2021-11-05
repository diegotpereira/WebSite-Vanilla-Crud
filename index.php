<?php
    include('funcoes.php');
    include_once './Database.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/jstable.css" />

    <script src="js/jstable.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="css/index.css">
    
    <title>WebSite coom Vanilla + Mysql</title>
    
</head>
<body>
    <div class="container">
        <h1 class="mt-5 text-center text-danger">WebSite coom Vanilla + Mysql</h1>

        <span id="mensagem_sucesso"></span>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-md-6">Dados do Cliente</div>
                    <div class="col col-md-6" align="right"></div>
                    <button type="button" name="add_dados" id="add_dados" class="btn btn-success btn-sm">Adicionar</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="cliente_tabela" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Email</th>
                            <th>Genero</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo buscar_cinco_principais_dados($conexao) ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/index.js"></script>
</body>
</html>

<div class="modal" id="cliente_modal" tabindex="-1">
    <form method="POST" id="cliente_form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Adicionar Clientes</h5>
                    <button type="button" class="btn-close" id="fechar_modal" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" />
                        <span class="text-danger" id="nome_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sobrenome</label>
                        <input type="text" name="sobrenome" id="sobrenome" class="form-control" />
                        <span class="text-danger" id="sobrenome_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" />
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gênero</label>
                        <select name="genero" id="genero" class="form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="acao" id="acao" value="Adicionar" />
                    <button type="button" class="btn btn-primary" id="btn_acao">Adicionar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal-backdrop fade show" id="modal_backdrop" style="display:none;"></div>
<script src="js/fechar_modal.js"></script>