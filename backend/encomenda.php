<?php
session_start();

    include ('conexao.php');

    $cpf = $_SESSION['cpf'];
    $id = $_POST['id'];
    $tamanho = $_POST['tamanho'];

    $query = "INSERT INTO tb_encomenda (id_roupa, cpf_usuario, tm_encomenda) VALUES ($id, '$cpf', '$tamanho')";
    $insert = mysqli_query ($conexao, $query);

    echo "<SCRIPT Language='javascript'>
        alert('Encomenda Efetuada!');
        location.href='../frontend/index.php';
        </SCRIPT>";

?>