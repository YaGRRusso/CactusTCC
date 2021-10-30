<?php
    session_start();

    if (isset($_SESSION['adm'])) {
        $valid = $_SESSION['adm'];

        if ($valid==0) {
            echo "<SCRIPT Language='javascript'>
            location.href='../frontend/index.php'
            </SCRIPT>";
        }
        
    } else {
        echo "<SCRIPT Language='javascript'>
        location.href='../frontend/index.php'
        </SCRIPT>";
    }
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
                    Olá, cadastre uma nova roupa!</br>
                </h2>
                <h5 class="display-5 px-5">
                    Adicione os dados e uma imagem da roupa!
                </h5>
            </center>
        </div>

        <!-- Corpo da Pagina -->
        <div class="container my-5">
            <div class="row justify-content-md-center">

                <div class="col-sm-10 p-5 m-2 border rounded" style="background-color: rgb(245, 245, 245);">
                    
                    <center>
                        
                        <h3 class="display-5 px-5 text-center text-primary">
                            Cadastre uma roupa.
                        </h3></br></br>

                        <form action="../backend/cadRou.php" enctype="multipart/form-data" method="POST">

                            <h5>Nome:<br/></h5>
                            <input type="text" name="nome" required="required" class="form-control w-75" maxlength="60" placeholder=""><br/><br/>

                            <h5>Descrição:<br/></h5>
                            <textarea name="descricao" required="required" rows="3" class="form-control w-75" maxlength="255" placeholder=""></textarea><br/><br/>

                            <h5>Valor:<br/></h5>
                            <input type="number" required="required" name="valor" step="0.01" class="form-control w-75" placeholder=""><br/><br/>

                            <h5>Gênero:<br/></h5>
                            <label class="radio form-control w-75"><input type="radio" id="m" value="m" name="genero" checked> Masculino</label>
                            <label class="radio form-control w-75"><input type="radio" id="f" value="f" name="genero"> Feminino</label>
                            <label class="radio form-control w-75"><input type="radio" id="u" value="u" name="genero"> Unissex</label>
                            <br/><br/>

                            <h5>Categoria:<br/></h5>
                                <select class="form-control w-75" name="categoria">
                                    <option value="camiseta">Camiseta</option>
                                    <option value="calca">Calça</option>
                                    <option value="casaco">Casaco</option>
                                    <option value="short">Short</option>
                                    <option value="conjunto">Conjunto</option>
                                </select><br/><br/>

                            <h5>Imagem:<br/></h5>
                            <input type="file" required="required" class="form-control w-75" name="imagem[]" multiple><br/><br/><br/>

                            <button type="submit" class="btn btn-outline-primary w-75">Enviar</button><br/><br/><br/>
                        </form>

                        <div class="d-flex w-75">
                            <hr class="my-auto flex-grow-1">
                        </div>
                        <br/>

                        <h3 class="display-5 px-5 text-center text-success">
                            Redisponibilizar uma roupa.
                        </h3></br></br>

                        <form action="../backend/reRou.php" enctype="multipart/form-data" method="POST">

                            <h5>Id:<br/></h5>
                            <?php echo"
                                <input type='text' name='id' required='required' class='form-control w-75' maxlength='60'><br/><br/>
                            ";?>
                            <button type="submit" class="btn btn-outline-success w-75">Reativar</button>

                        </form>

                    </center>

                </div>

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