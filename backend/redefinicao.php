<?php

    include ('conexao.php');

    $email = mysqli_real_escape_string ($conexao, $_POST['email']);
    $cod = mysqli_real_escape_string ($conexao, $_POST['cod']);
    $senha = mysqli_real_escape_string ($conexao, $_POST['senha']);

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $verify = "SELECT * FROM tb_usuario WHERE em_usuario = '$email' AND sn_usuario = '$cod';";
    $result = mysqli_query ($conexao, $verify);
    $emailbanco= mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {

        $query = "UPDATE tb_usuario SET
        sn_usuario = '$hash'
        WHERE em_usuario = '$email';";

        $update = mysqli_query ($conexao, $query);

        echo "<SCRIPT Language='javascript'>
        alert('Senha redefinida!');
        location.href='../frontend/login.php';
        </SCRIPT>";

    } else {
        echo "<SCRIPT Language='javascript'>
        alert('Dados não conferem ou senha já foi redefinida!');
        location.href='../frontend/redefinicao.php';
        </SCRIPT>";
    };

    echo $email;
    echo "</br>";
    echo $cod;
    echo "</br>";
    echo $senha;

?>