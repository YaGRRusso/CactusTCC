<?php
    session_start();
?>

<!doctype html>
<html>

    <head>

        <!-- Importações e Dados -->
        <title>Cactus - Principal
        </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    </head>

    <header>

        <!-- Menu de Navegação -->
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: rgb(25, 25, 25);">

          <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" style="width:20px;">
            &nbsp Cactus
          </a>

          <div class="collapse navbar-collapse flex-row-reverse mx-3" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="catalogo.php/?gn=m">Masculino</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="catalogo.php/?gn=f">Feminino</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contato.php">Fale Conosco</a>
              </li>
              <li class="nav-item">
                <?php
                
                    if(isset($_SESSION['nome']))
                    {
                        echo"
                            <ul class='nav-item dropdown float-right pull-left'>
                                <a class='nav-link dropdown-toggle' href='#' data-toggle='dropdown'>Olá, ".$_SESSION['nome']."</a>
                                <div class='dropdown-menu'>
                                    <a class='dropdown-item text-dark' href='encomendas.php'>Encomendas</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item text-dark' href='../backend/logout.php'>Logout</a>
                                </div>
                            </ul>
                        ";
                    }
                    else{      
                        echo "<a class='nav-link' href='login.php'>Login</a>";
                    }

                ?>
              </li>
            </ul>
          </div>

        </nav>

    </header>

    
    <body>

        <!-- Titulo da Pagina -->
        <div class="container-fluid p-0">
            <div class="p-5"
                style="height: 350px; background-image: url('img/roupas.jpg');">
                <center>
                    <a href="index.php"><h1 class="display-2 text-light" style="margin-top: 45px; text-shadow: 10px 3px 12px #000000ee;">Cactus</h1></a></br>
                    <h3 class="display-5 text-light" style="text-shadow: 10px 3px 12px #000000ee;">Marca de roupas próprias</h3>
                </center>
            </div>
        </div>

        <!-- Boas Vindas -->
        <div class="container my-5">
            <center>
                <h2 class="display-5">
                    Confira abaixo suas roupas encomendadas</br>
                </h2>
                <h5 class="display-5 px-5">
                    Gerencie suas encomendas e exclua as que não deseja mais.
                </h5>
            </center>
        </div>

        <!-- Corpo da Pagina -->
        <div class="container my-5">
            <div class="row justify-content-center">

            <style>
                img {
                border-radius: 5px;
                cursor: pointer;
                }

                /* The Modal (background) */
                .modal {
                    display: none; /* Hidden by default */
                    position: fixed; /* Stay in place */
                    z-index: 1; /* Sit on top */
                    padding-top: 100px; /* Location of the box */
                    left: 0;
                    top: 0;
                    width: 100%; /* Full width */
                    height: 100%; /* Full height */
                    overflow: auto; /* Enable scroll if needed */
                    background-color: rgb(0,0,0); /* Fallback color */
                    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
                }

                /* Modal Content (image) */
                .modal-content {
                    margin: auto;
                    display: block;
                    width: 80%;
                    max-width: 700px;
                }

                /* Add Animation */
                .modal-content {  
                    -webkit-animation-name: zoom;
                    -webkit-animation-duration: 0.6s;
                    animation-name: zoom;
                    animation-duration: 0.6s;
                }

                @-webkit-keyframes zoom {
                    from {-webkit-transform:scale(0)} 
                    to {-webkit-transform:scale(1)}
                }

                @keyframes zoom {
                    from {transform:scale(0)} 
                    to {transform:scale(1)}
                }

                /* 100% Image Width on Smaller Screens */
                @media only screen and (max-width: 700px){
                    .modal-content {
                        width: 100%;
                    }
                }
            </style>

                <?php
                    include ('../backend/conexao.php');

                    $cpf = $_SESSION['cpf'];
                    $i = 1;

                    $resultRou = "SELECT * from tb_encomenda where cpf_usuario= '$cpf';";
                    $resultRoou = mysqli_query($conexao, $resultRou);

                    $pasta = array_diff(scandir(getcwd() . "/upload/roupa"), array('..', '.')); //escaneia a pasta upload/roupa e conta quantas imagens tem
                    
                    while($rowRou = mysqli_fetch_assoc($resultRoou)){
                        
                        $id = $rowRou['id_roupa'];
                        $idEnc = $rowRou['id_encomenda'];
                        $tamanho = $rowRou['tm_encomenda'];

                        if ($tamanho == 'p') {
                            $tamanho = '[P] - Pequeno';
                        }
                        elseif ($tamanho == 'm') {
                            $tamanho = '[M] - Médio';
                        }
                        elseif ($tamanho == 'g') {
                            $tamanho = '[G] - Grande';
                        }

                        $resultIm = "SELECT * from tb_roupa where id_roupa= '$id';";
                        $resultImm = mysqli_fetch_assoc(mysqli_query($conexao, $resultIm));

                        $id = $resultImm['id_roupa'];
                        $imagem = $resultImm['im_roupa'];
                        $ext = $resultImm['ex_roupa'];
                        $nome = $resultImm['nm_roupa'];
                        $desc = $resultImm['dc_roupa'];
                        $vl = $resultImm['vl_roupa'];

                        echo"
                        <div class='col-md-12 m-3 p-3 border rounded' style='background-color: rgb(245, 245, 245);'>
                            <div class='row'>

                                <div class='col-md-3 m-3 p-3 border rounded' style='background-color: rgb(245, 245, 245);'>
                                    <img src='upload/roupa/$imagem.$ext' id='myImg$i' class='mx-auto d-block w-100'>

                                    <div id='myModal' class='modal'>
                                        <img class='modal-content p-1 m-3 mx-auto d-block' id='img01'>
                                        <!-- <div id='caption'></div> -->
                                    </div>

                                </div>

                                <div class='col-md-8 m-3 p-3' style='background-color: rgb(245, 245, 245);'>
                                    <h3 class='diplay-5 text-center text-primary'>$nome</h3></br>
                                    <h6 class='diplay-5 text-center border rounded p-2'>$desc</h5></br>
                                    <div class='row'>
                                        <div class='col-md-4 mx-3 p-3'>
                                            <h6 class='diplay-5'>Preço</h6>
                                            <h6 class='diplay-5 text-primary'>R$: $vl</h6></br>
                                        </div>
                                        <div class='col-md-4 mx-3 p-3'>
                                            <h6 class='diplay-5'>Tamanho:</h6>
                                            <h6 class='diplay-5 text-primary'>$tamanho</h6>
                                        </div>
                                        <div class='col-md-2 mx-3 p-3 mx-auto d-block'>
                                        <a href='../backend/exEnc.php/?idEnc=$idEnc'><img src='img/lixo.png' class='mx-auto d-block' style='width: 30px 'style='color: #F93154'></a></br>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <script>

                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = 'none';
                                }
                            }

                            // Get the modal
                            var modal = document.getElementById('myModal');

                            // Get the image and insert it inside the modal - use its 'alt' text as a caption
                            var img = document.getElementById('myImg$i');
                            var modalImg = document.getElementById('img01');
                            img.onclick = function(){
                                modal.style.display = 'block';
                                modalImg.src = this.src;
                                captionText.innerHTML = this.alt;
                            }

                        </script>

                        ";

                        $i++;
                    }

                ?>

                <script>

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg1");
                var modalImg = document.getElementById("img01");
                img.onclick = function(){
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }

                </script>

            </div>
        </div>

        <!-- Divisão Rodapé -->
        <div class="container-fluid p-0">
            <div class="p-5" style="height: 150px; background-image: url('img/roupas.jpg');">
                <div class="container">
                    <h3 class="display-5 text-light text-center" style="text-shadow: 10px 3px 12px #000000ee;">"Nunca desista dos seus sonhos"</h3>
                </div>
            </div>
        </div>

        </body>

        <footer>

        <style>
            .map-container{
            overflow:hidden;
            position:relative;
            height:0;
            }
            .map-container iframe{
            left:0;
            top:0;
            height:80%;
            width:100%;
            position:absolute;
            }
        </style>

        <!-- Rodapé -->
        <div class="container-fluid" style="background-color: rgb(25, 25, 25);">
            <div class="container-sm">
                <div class="row justify-content-center d-flex flex-wrap align-items-center">

                    <div class="col-sm-5 py-5 m-2">
                        <h2 class="display-5 text-center py-2 px-0" style="color:rgb(245, 245, 245)">
                            Quem Somos?</br>
                        </h2>
                        <h5 class="display-5 py-2 px-0" style="color:rgb(230, 230, 230)">
                        A Cactus é uma nova empresa do ramo têxtil criada oficialmente em 2020 localizada
                        em Gravataí, Rio Grande do Sul. A empresa trabalha com a criação de roupas de marca
                        própria feminina e masculina, com foco no que está em alta.

                        </h5>
                    </div>

                    <div class="col-sm-5 p-2 m-2">
                        <div id="map-container-google-1" class="z-depth-1-half map-container mt-5 p-3" style="height: 350px">
                            <iframe src="https://maps.google.com/maps?q=Gravataí, Morada do Vale 2, Edu Chaves, 543&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        </footer>

</html>