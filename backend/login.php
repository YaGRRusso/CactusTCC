<?php
session_start();

    include ('conexao.php');

    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $querySn = "SELECT sn_usuario FROM tb_usuario WHERE cpf_usuario = '$cpf';";
    $resultSn = mysqli_query ($conexao, $querySn);
    $senha_banco= mysqli_fetch_assoc($resultSn);

    $resultRou = "SELECT * FROM tb_usuario WHERE cpf_usuario = '$cpf';";
    $resultRoou = mysqli_query ($conexao, $resultRou);

    while($rowRou = mysqli_fetch_assoc($resultRoou)){
        $cpf = $rowRou['cpf_usuario'];
        $_SESSION["cpf"] = $cpf;
        $nome = $rowRou['nm_usuario'];
        $_SESSION["nome"] = $nome;
        $email = $rowRou['em_usuario'];
        $_SESSION["email"] = $email;
        $adm = $rowRou['fn_usuario'];
        $_SESSION["adm"] = $adm;
    }

    if (password_verify($senha, $senha_banco['sn_usuario'])){
        header ('Location: ../frontend/index.php');
    } else {
        session_destroy();

        echo 
        "<SCRIPT Language='javascript'>
        alert('Usuario ou senha incorreto(s)!');
        location.href='../frontend/login.php';
        </SCRIPT>";
    };
?>