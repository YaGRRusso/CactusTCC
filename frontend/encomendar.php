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

          <a class="navbar-brand" href="../index.php">
            <img src="../img/logo.png" style="width:20px;">
            &nbsp Cactus
          </a>

          <div class="collapse navbar-collapse flex-row-reverse mx-3" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../catalogo.php/?gn=m">Masculino</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../catalogo.php/?gn=f">Feminino</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../contato.php">Fale Conosco</a>
              </li>
              <li class="nav-item">
                <?php
                
                    if(isset($_SESSION['nome']))
                    {
                        echo"
                            <ul class='nav-item dropdown float-right pull-left'>
                                <a class='nav-link dropdown-toggle' href='#' data-toggle='dropdown'>Olá, ".$_SESSION['nome']."</a>
                                <div class='dropdown-menu'>
                                    <a class='dropdown-item text-dark' href='../encomendas.php'>Encomendas</a>
                                    <div class='dropdown-divider'></div>
                                    <a class='dropdown-item text-dark' href='../../backend/logout.php'>Logout</a>
                                </div>
                            </ul>
                        ";
                    }
                    else{      
                        echo "<a class='nav-link' href='../login.php'>Login</a>";
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
                style="height: 350px; background-image: url('../img/roupas.jpg');">
                <center>
                    <a href="../index.php"><h1 class="display-2 text-light" style="margin-top: 45px; text-shadow: 10px 3px 12px #000000ee;">Cactus</h1></a></br>
                    <h3 class="display-5 text-light" style="text-shadow: 10px 3px 12px #000000ee;">Marca de roupas próprias</h3>
                </center>
            </div>
        </div>

        <!-- Boas Vindas -->
        <div class="container my-5">
            <center>
                <h2 class="display-5">
                    Encomende sua roupa</br>
                </h2>
                <h5 class="display-5 px-5">
                    Escolha o tamanho de sua roupa e faça sua encomenda abaixo.
                </h5>
            </center>
        </div>

        <!-- Corpo da Pagina -->
        <div class="container my-5">
            <div class="row justify-content-center">

            <style>
                #myImg {
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
                .modal-content{  
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

                input[type="radio"] {
                    visibility: hidden;
                }
                    
                label {
                    background-color: #eee;
                    display: block;
                    border: 1px solid #ccd;
                    height: 30px;
                    width: 30px;
                    margin: 2px;
                    float: right;
                    border-radius: 45%;
                }

                input[type="radio"]:checked+label {
                    border-color: #1266F1;
                }
            </style>

                <?php
                    include ('../backend/conexao.php');

                    $id = $_GET['id'];
                    
                    $sql = "SELECT * FROM tb_roupa where id_roupa = $_GET[id]";
                    $roupa = mysqli_fetch_assoc(mysqli_query($conexao, $sql));

                    $id = $roupa['id_roupa'];
                    $imagem = $roupa['im_roupa'];
                    $ext = $roupa['ex_roupa'];
                    $nome = $roupa['nm_roupa'];
                    $desc = $roupa['dc_roupa'];
                    $vl = $roupa['vl_roupa'];

                    $pasta = array_diff(scandir(getcwd() . "/upload/roupa"), array('..', '.')); //escaneia a pasta upload/roupa e conta quantas imagens tem
                    
                    echo "<div class='col-md-8 mx-5 p-3 border rounded' style='background-color: rgb(245, 245, 245);'>";
                        echo "<img src='../upload/roupa/$imagem.$ext' id='myImg' alt='$nome' class='mx-auto d-block w-100'>";
                    echo "</div>";

                    echo "
                        <div id='myModal' class='modal'>
                            <img class='modal-content p-1 m-3 mx-auto d-block' id='img01'>
                            <!-- <div id='caption'></div> -->
                        </div>
                    ";

                    echo "<div class='col-md-8 mx-5 p-3 border rounded' style='background-color: rgb(245, 245, 245);'>";
                    echo "<form action='../../backend/encomenda.php' method='post'>";
                        echo "<input type='hidden' name='id' value='$id'>";
                        echo "<h3 class='diplay-5 text-center text-primary'>$nome</h3></br>";
                        echo "<h5 class='diplay-5 text-center border rounded p-2'>$desc</h5></br>";
                        echo "<h6 class='diplay-5 text-primary'>";
                            echo "R$: $vl";

                            echo "<input type='radio' id='i1' value='g' name='tamanho'/>";
                            echo "<label for='i1' class='text-center pt-1'>G</label>";

                            echo "<input type='radio' id='i2' value='m' name='tamanho'/>";
                            echo "<label for='i2' class='text-center pt-1'>M</label>";

                            echo "<input type='radio' id='i3' value='p' name='tamanho' checked/>";
                            echo "<label for='i3' class='text-center pt-1'>P</label>";
                            
                            echo "<br/><br/><br/>";
                        echo "</h6>";
                        echo "<center><button type='submit' class='btn btn-outline-primary w-75'>Encomendar</button></center>";
                    echo "</div>";
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
                    var img = document.getElementById("myImg");
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
            <div class="p-5" style="height: 150px; background-image: url('../img/roupas.jpg');">
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