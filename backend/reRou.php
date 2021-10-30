<?php

    include ('conexao.php');

    $id = mysqli_real_escape_string ($conexao, $_POST['id']);

    $query = "UPDATE tb_roupa SET dp_roupa = true WHERE id_roupa = $id;";

    $update = mysqli_query ($conexao, $query);
    $update;

    echo "<SCRIPT Language='javascript'>
    alert('Reativação Efetuada!');
    location.href='../frontend/adicionar.php';
    </SCRIPT>"

?>