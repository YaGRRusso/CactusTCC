<?php

    include ('conexao.php');

    $nome = mysqli_real_escape_string ($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string ($conexao, $_POST['descricao']);
    $valor = mysqli_real_escape_string ($conexao, $_POST['valor']);
    $genero = mysqli_real_escape_string ($conexao, $_POST['genero']);
    $categoria = mysqli_real_escape_string ($conexao, $_POST['categoria']);

    $queryId = "SELECT (id_roupa) FROM tb_roupa ORDER BY id_roupa DESC LIMIT 1;";
    $result = mysqli_query ($conexao, $queryId); //Gerou o Id da ultima roupa criada
    if (mysqli_num_rows($result) > 0) {    
        $ids= mysqli_fetch_assoc($result);
        $id = $ids['id_roupa']+1; //Salvou o id da ultima roupa e acrescenta 1 (descobre o id da roupa sendo atualmente criada)
    }else{
        $id = 1; //Salvou o id da ultima roupa e acrescenta 1 (descobre o id da roupa sendo atualmente criada)
    }

    if($_FILES){
        $arq = $_FILES['imagem'];
        $validos = array("jpg", "gif", "png", "jpeg");
        
        $repeat = count($arq['name']);
        $i=0;
    
        while ($i < $repeat) {
            $nomeIm = $arq['name'][$i];
            $ext = strtolower(pathinfo($nomeIm, PATHINFO_EXTENSION)); //salva a extensão do arquivo em uma variavel
    
            if (in_array($ext,$validos)){ //confere se a extensão do arquivo está dentro da array de extensões válidas
                if (!move_uploaded_file($arq['tmp_name'][$i], '../frontend/upload/roupa/'.$id.".".$ext)) //move o arquivo com nome temporario recem upado para a pasta upload com o seu nome original
                    echo "<SCRIPT Language='javascript'>
                    alert('Erro ao Copiar o Arquivo.');
                    location.href='../frontend/adicionar.php';
                    </SCRIPT>";
            }
            else{
                echo "<SCRIPT Language='javascript'>
                alert('Formato de Imagem não Suportado.');
                location.href='../frontend/adicionar.php';
                </SCRIPT>";
                exit;
            }
            $i++;
        }
    }

    $query = "INSERT INTO tb_roupa (nm_roupa, dc_roupa, vl_roupa, ct_roupa, gn_roupa, im_roupa, ex_roupa, dp_roupa) VALUES ('$nome', '$descricao', $valor, '$categoria', '$genero', '$id', '$ext', true);";
    $insert = mysqli_query ($conexao, $query);

    if ($insert) {
        echo "<SCRIPT Language='javascript'>
        alert('Cadastro Efetuado!');
        location.href='../frontend/adicionar.php';
        </SCRIPT>";
    } else {
        echo "<SCRIPT Language='javascript'>
        alert('Erro Desconhecido!');
        location.href='../frontend/adicionar.php';
        </SCRIPT>";
    }

?>