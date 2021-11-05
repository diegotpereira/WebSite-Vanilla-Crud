<?php
    include('funcoes.php');
    include_once('./Database.php');

    $startGET = filter_input(INPUT_GET, "start", FILTER_SANITIZE_NUMBER_INT);

    $start = $startGET ? intval($startGET) : 0;

    $lengthGET = filter_input(INPUT_GET, "length", FILTER_SANITIZE_NUMBER_INT);

    $length = $lengthGET ? intval($lengthGET) : 10;

    $searchQuery = filter_input(INPUT_GET, "searchQuery", FILTER_SANITIZE_STRING);

    $buscar = empty($searchQuery) || $searchQuery === "null" ? "" : $searchQuery;

    $sortColumnIndex = filter_input(INPUT_GET, "sortColumn", FILTER_SANITIZE_NUMBER_INT);

    $sortDirection = filter_input(INPUT_GET, "sortDirection", FILTER_SANITIZE_STRING);

    $column = array("nome", "sobrenome", "email", "genero");

    $QUERY = "SELECT * FROM tabela_cliente";

    $QUERY .= '
               WHERE id LIKE "%'.$buscar.'%"
               OR nome LIKE "%'.$buscar.'%"
               OR sobrenome LIKE "%'.$buscar.'%"
               OR email LIKE "%'.$buscar.'%"
               OR genero LIKE "%'.$buscar.'%"
               ';

               if ($sortColumnIndex != '') {
                   # code...
                   $QUERY .= 'ORDER BY '.$column[$sortColumnIndex].' '.$sortDirection.' ';

               } else {
                   # code...
                   $QUERY .= 'ORDER BY id DESC ';
               }

               $QUERY1 = '';
               if ($length != -1) {
                   # code...
                  $QUERY1 = ' LIMIT ' . $start . ', ' . $length;
               }

               $demostracao = $conexao->prepare($QUERY);
               $demostracao->execute();

               $number_filter_row = $demostracao->rowCount();
               $result = $conexao->query($QUERY . $QUERY1);

               $data = array();

               foreach($result as $row) {
                   $sub_array = array();
                   $sub_array[] = $row['nome'];
                   $sub_array[] = $row['sobrenome'];
                   $sub_array[] = $row['email'];
                   $sub_array[] = $row['genero'];

                   $sub_array[] = '<button type="button" onclick="buscar_dados('.$row["id"].')" class="btn btn-warning btn-sm">Editar</button>&nbsp;<button type="button" class="btn btn-danger btn-sm" onclick="deletar_dados('.$row["id"].')">Deletar</button>';

                   $data[] = $sub_array;
               }

               $saida = array(
                "registroTotal" => conte_todos_dados($conexao),
                "registrosFiltrados" => $number_filter_row,
                "data" => $data
            );

            echo json_encode($saida);
?>