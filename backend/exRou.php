<?php

    include ('conexao.php');

    $id = mysqli_real_escape_string ($conexao, $_POST['id']);
    $senhaEx = mysqli_real_escape_string ($conexao, $_POST['senhaEx']);

    if ($senhaEx == 'excluir123') {

        $query = "UPDATE tb_roupa SET dp_roupa = false WHERE id_roupa = $id;";
        $update = mysqli_query ($conexao, $query);
        $update;

        echo "<SCRIPT Language='javascript'>
        alert('Exclusão Efetuada!');
        location.href='../frontend/index.php';
        </SCRIPT>";

    } else {

        echo "<SCRIPT Language='javascript'>
        alert('Senha incorreta!');
        location.href='../frontend/editar.php/?id=$id';
        </SCRIPT>";

    }

?>