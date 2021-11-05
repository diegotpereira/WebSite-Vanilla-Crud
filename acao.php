<?php
     include('funcoes.php');
     include_once('./Database.php');

    if (isset($_POST['acao'])) {
        # code...
        if ($_POST["acao"] == 'Adicionar' || $_POST["acao"] == 'Atualizar') {
            # code...
            $saida = array();
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $email = $_POST["email"];
            $genero = $_POST["genero"];

            if (empty($nome)) {
                # code...
                $saida['nome_erro'] = 'O campo nome é necessário..!';
            }
            if (empty($sobrenome)) {
                # code...
                $saida['sobrenome_erro'] = 'O campo sobrenome é necessário..!';
            }
            if (empty($email)) {
                # code...
                $saida['email_erro'] = 'O campo email é necessário..!';

            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    # code...
                    $saida['email_erro'] = 'Formato de email inválido..!';
                }
            }
            if (count($saida)) {
                # code...
                echo json_encode($saida);

            } else {
                $dados =  array(
                    ':nome' => $nome,
                    ':sobrenome' => $sobrenome,
                    ':email' => $email,
                    ':genero' => $genero,
                );

                if ($_POST['acao'] == 'Adicionar') {
                    # code...
                    $QUERY = "
                            INSERT INTO tabela_cliente 
                            (nome, sobrenome, email, genero)
                            Values (:nome, :sobrenome, :email, :genero)
                            ";
                    $demonstracao = $conexao->prepare($QUERY);

                    if ($demonstracao->execute($dados)) {
                        # code...
                        $saida['success'] = '
                                              <div class="alert-success">Novos dados adicionados</div>';
                        echo json_encode($saida);
                    }
                }
            }

            if ($_POST['acao'] == 'Atualizar') {
                # code...
                $QUERY = "
                          UPDATE tabela_cliente 
                          SET 
                            nome = :nome,
                            sobrenome = :sobrenome,
                            email = :email,
                            genero = :genero
                          WHERE id = '".$_POST["id"]."' 
                          ";

                          $demonstracao = $conexao->prepare($QUERY);

                          if ($demonstracao->execute($dados)) {
                              # code...
                              $saida['success'] = '<div class="alert alert-success">Dados atualizados</div>';

                              echo json_encode($saida);
                          }
            }
        }

        if ($_POST['acao'] == 'buscar') {
            # code...
            $QUERY = "
                      SELECT * FROM tabela_cliente
                      WHERE id = '".$_POST["id"]."'";
            
            $result = $conexao->query($QUERY);

            $dados = array();

            foreach($result as $row) {
                $dados['nome'] = $row['nome'];
                $dados['sobrenome'] = $row['sobrenome'];
                $dados['email'] = $row['email'];
                $dados['genero'] = $row['genero'];
            }

            echo json_encode($dados);
        }

        if ($_POST['acao'] == 'deletar') {
            # code...
            $QUERY = "
                      DELETE FROM tabela_cliente
                      WHERE id = '".$_POST["id"]."' ";

            if ($conexao->query($QUERY)) {
                # code...
                $saida ['success'] = '<div class="alert alert-success">Dados Deletados</div>';

                echo json_encode($saida);
            }
        }
    }
?>