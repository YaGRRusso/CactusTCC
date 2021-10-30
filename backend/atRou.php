<?php

    include ('conexao.php');

    $id = mysqli_real_escape_string ($conexao, $_POST['id']);
    $nome = mysqli_real_escape_string ($conexao, $_POST['nome']);
    $descricao = mysqli_real_escape_string ($conexao, $_POST['descricao']);
    $valor = mysqli_real_escape_string ($conexao, $_POST['valor']);
    $genero = mysqli_real_escape_string ($conexao, $_POST['genero']);
    $categoria = mysqli_real_escape_string ($conexao, $_POST['categoria']);
    $altIm = mysqli_real_escape_string ($conexao, $_POST['altIm']);

    if ($altIm=='s'){

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
                        echo "Erro ao copiar o arquivo";
                }
                else{
                    echo "Arquivo submetido não era uma imagem";
                    exit;
                }
                $i++;
            }
        }

        $query = "UPDATE tb_roupa SET
        nm_roupa = '$nome',
        dc_roupa = '$descricao',
        vl_roupa = $valor,
        gn_roupa = '$genero',
        ct_roupa = '$categoria',
        im_roupa = '$id',
        ex_roupa = '$ext'
        WHERE id_roupa = $id;";

    } else {

        $query = "UPDATE tb_roupa SET
        nm_roupa = '$nome',
        dc_roupa = '$descricao',
        vl_roupa = $valor,
        gn_roupa = '$genero',
        ct_roupa = '$categoria'
        WHERE id_roupa = $id;";

    }

    $update = mysqli_query ($conexao, $query);

    echo "<SCRIPT Language='javascript'>
    alert('Atualização Efetuada!');
    location.href='../frontend/editar.php/?id=$id';
    </SCRIPT>"

?>