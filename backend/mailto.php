<?php

    include ('conexao.php');

    $assunto = $_POST['assunto'];
    $mens = $_POST['mens'];

    echo"
        <SCRIPT Language='javascript'>
        location.href='mailto:jaqrusso@gmail.com ?Subject=$assunto &Body=$mens';
        location.href='../frontend/contato.php';
        </SCRIPT>
    ";

?>