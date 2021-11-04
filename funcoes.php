<?php

include_once('./Database.php');

$database = new Database();
$conexao = $database->getConnection();


    function buscar_cinco_principais_dados($conexao) {

        $QUERY = "SELECT * FROM tabela_Cliente ORDER BY id DESC LIMIT 5";

        $result = $conexao->query($QUERY);

        $saida = '';

        foreach($result as $row) {
            $saida .= '
                        <tr>
                        <td>'.$row["nome"].'</td>
                        <td>'.$row["sobrenome"].'</td>
                        <td>'.$row["email"].'</td>
                        <td>'.$row["genero"].'</td>
                        <td><button type="button" onclick="buscar_dados('.$row["id"].')" class="btn btn-warning btn-sm">Editar</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="deletar_dados('.$row["id"].')">Deletar</button></td>
                        </tr>';
        }

        return $saida;
    }

    function conte_todos_dados($conexao){
        
        $QUERY = "SELECT * FROM tabela_cliente";

        $demonstracao = $conexao->prepare($QUERY);

        $demonstracao->execute();

        return $demonstracao->rowCount();
    }


?>