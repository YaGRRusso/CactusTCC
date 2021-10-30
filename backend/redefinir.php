<?php

    include ('conexao.php');

    require_once('phpmailer/src/PHPMailer.php');
    require_once('phpmailer/src/SMTP.php');
    require_once('phpmailer/src/Exception.php');
    
    use phpmailer\PHPMailer\PHPMailer;
    use phpmailer\PHPMailer\SMTP;
    use phpmailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true);

    $cpf = mysqli_real_escape_string ($conexao, $_POST['cpf']);
    $email = mysqli_real_escape_string ($conexao, $_POST['email']);
    $senha = rand(10000, 99999);

    $mensagem =     "<center>Olá, clique a baixo para redefinir sua senha:</br>
                    <a href='../frontend/redefinicao.php/?em=$email'>REDEFINIR SENHA</a></br></br>
                    Utilize o código <h1>$senha</h1></center>";
    
    $verify = "SELECT * FROM tb_usuario WHERE em_usuario = '$email' AND cpf_usuario = '$cpf';";
    $result = mysqli_query ($conexao, $verify);
    $emailbanco= mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {

        $query = "UPDATE tb_usuario SET
        sn_usuario = '$senha'
        WHERE cpf_usuario = $cpf;";

        $update = mysqli_query ($conexao, $query);

        try {
            //	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'yagocabral.gr179@academico.ifsul.edu.br';
                $mail->Password = 'senhaif3011.';
                $mail->Port = 587;
             
                $mail->setFrom('yagocabral.gr179@academico.ifsul.edu.br'); // email utilizado no envio do email from
                $mail->addAddress("$email"); // email para onde será enviado
                $mail->setLanguage('br');
                
             
            //Conteudo
                $mail->isHTML(true);                                  // Se o email for em HTML você tem que deixar como true
                $mail->Subject = utf8_decode('Redefinição de senha Cactus'); // o utf8 é para não ter problema na acentuação
                $mail->Body    = "$mensagem"; // mensagem
                $mail->AltBody = 'Erro';
            
                $mail->send();

            echo "<SCRIPT Language='javascript'>
            alert('Email enviado!');
            location.href='../frontend/redefinir.php';
            </SCRIPT>";
            
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }

    } else {

        echo "<SCRIPT Language='javascript'>
        alert('Dados não conferem!');
        location.href='../frontend/redefinir.php';
        </SCRIPT>";
        
    };

?>