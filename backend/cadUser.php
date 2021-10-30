<?php

    include ('conexao.php');

    $cpf = mysqli_real_escape_string ($conexao, $_POST['cpf']);
    $nome = mysqli_real_escape_string ($conexao, $_POST['nome']);
    $senha = mysqli_real_escape_string ($conexao, $_POST['senha']);
    $email = mysqli_real_escape_string ($conexao, $_POST['email']);

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $verifyemail = "SELECT * FROM tb_usuario WHERE em_usuario = '$email';";
    $resultemail = mysqli_query ($conexao, $verifyemail);
    $emailbanco= mysqli_fetch_assoc($resultemail);

    $verifycpf = "SELECT cpf_usuario FROM tb_usuario WHERE cpf_usuario = '$cpf';";
    $resultcpf = mysqli_query ($conexao, $verifycpf);
    $cpfbanco= mysqli_fetch_assoc($resultcpf);

    if ($cpf == null) {
        echo "<SCRIPT Language='javascript'>
        alert('Cpf não existe!');
        location.href='../frontend/cadastro.php';
        </SCRIPT>";

    } elseif (mysqli_num_rows($resultcpf) > 0) {
        
        echo "<SCRIPT Language='javascript'>
        alert('Cpf já cadastrado!');
        location.href='../frontend/cadastro.php';
        </SCRIPT>";

    } elseif (mysqli_num_rows($resultemail) > 0) {

        echo "<SCRIPT Language='javascript'>
        alert('Email já cadastrado!');
        location.href='../frontend/cadastro.php';
        </SCRIPT>";

    } else {

        $query = "INSERT INTO tb_usuario (nm_usuario, sn_usuario, em_usuario, cpf_usuario, fn_usuario) VALUES ('$nome', '$hash', '$email', '$cpf', false);";
        $insert = mysqli_query ($conexao, $query);

        if ($insert){
            echo "<SCRIPT Language='javascript'>
            alert('Cadastro Efetuado!');
            location.href='../frontend/login.php';
            </SCRIPT>";
        } else {
            echo "<SCRIPT Language='javascript'>
            alert('Erro Desconhecido!');
            location.href='../frontend/cadastro.php';
            </SCRIPT>";
        }
    }

?>