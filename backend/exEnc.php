<?php

    include ('conexao.php');

    $idEnc = $_GET['idEnc'];

        $query = "DELETE FROM tb_encomenda WHERE id_encomenda = $idEnc;";
        $update = mysqli_query ($conexao, $query);
        $update;

        echo "<SCRIPT Language='javascript'>
        alert('Exclusão Efetuada!');
        location.href='../../frontend/encomendas.php';
        </SCRIPT>";

?>