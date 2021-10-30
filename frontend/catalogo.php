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
                    Confira abaixo nossas roupas e conjuntos</br>
                </h2>
                <h5 class="display-5 px-5">
                    Aceitamos encomendas e reservas, confeccionamos roupas de formatura e empresariais, entre em contato e solicite seu orçamento!
                </h5>
            </center>
        </div>

        <!-- Corpo da Pagina -->
        <div class="container my-5">
            <div class="row justify-content-center">

                <?php
                    include ('../backend/conexao.php');

                    if(isset($_GET['gn'])){
                        $genero = $_GET['gn'];

                        if ($genero=='m'){
                            $resultRou = "SELECT * FROM tb_roupa WHERE dp_roupa = true AND gn_roupa= 'm' OR gn_roupa= 'u';";
    
                        } else {
                            $resultRou = "SELECT * FROM tb_roupa WHERE dp_roupa = true AND gn_roupa= 'f' OR gn_roupa= 'u';";
    
                        };
                    };

                    if(isset($_GET['ct'])){
                        $categoria = $_GET['ct'];

                        if ($categoria=='tudo'){
                            $resultRou = "SELECT * from tb_roupa WHERE dp_roupa = true";

                        } else {
                            $resultRou = "SELECT * from tb_roupa WHERE dp_roupa = true AND ct_roupa= '$categoria';";

                        };
                    }
                    
                    $resultRoou = mysqli_query($conexao, $resultRou);


                    $pasta = array_diff(scandir(getcwd() . "/upload/roupa"), array('..', '.')); //escaneia a pasta upload/roupa e conta quantas imagens tem
                    
                    while($rowRou = mysqli_fetch_assoc($resultRoou)){
                        
                        echo "<div class='col-md-3 m-2 p-3 border rounded' style='background-color: rgb(245, 245, 245);'>";

                            $id = $rowRou['id_roupa'];
                            $imagem = $rowRou['im_roupa'];
                            $ext = $rowRou['ex_roupa'];
                            $nome = $rowRou['nm_roupa'];
                            $desc = $rowRou['dc_roupa'];
                            $vl = $rowRou['vl_roupa'];

                            echo "<h3 class='diplay-5 text-center text-primary'>$nome</h3></br>";

                
                            if(isset($_SESSION['adm']))
                            {
                                if($_SESSION["adm"]==1){

                                    echo "<a href='../editar.php/?id=$id'><img src= '../upload/roupa/$imagem.$ext' class='mx-auto d-block w-100'></a></br>";

                                } else {

                                    echo "<a href='../encomendar.php/?id=$id'><img src= '../upload/roupa/$imagem.$ext' class='mx-auto d-block w-100'></a></br>";

                                };
                            };

                            if(!isset($_SESSION['adm'])){
                                echo "<a href='#'><img src= '../upload/roupa/$imagem.$ext' class='mx-auto d-block w-100'></a></br>";
                            }
                            
                            echo "<h6 class='diplay-5 text-center border rounded p-2'>$desc</h6></br><h6 class='diplay-5 text-primary'>R$: $vl</h6>";

                        echo "</div>";

                    }
                ?>

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