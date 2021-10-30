<!doctype html>
<html>

    <head>

        <!-- Importações e Dados -->
        <title>Cactus - Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css">

    </head>

    <body>

        <!-- Corpo da Pagina -->
        <div class="container border my-5 py-5 shadow p-3 mb-5 bg-light rounded">
            <div class="row justify-content-center">
                
                <div class="col-sm-5">
                    <img src="img/logo.png" class = "mx-auto d-block" style = "width: 250px">
                </div>
                
                <div class="col-sm-7">
                    <center>
                        <h1 class="display-2 text-primary">Login</a></h1><br/><br/>
                        <form action="../backend/login.php" method="post">
                        
                            <h5>CPF<br/></h5>
                            <input type="text" name="cpf" class="form-control w-75" maxlength="11" placeholder="Digite aqui..."><br/><br/>
                            <h5>Senha<br/></h5>
                            <input type="password" name="senha" class="form-control w-75" maxlength="30" placeholder="Digite aqui..."><br/><br/>
                            <button type="submit" class="btn btn-outline-primary w-50">Entrar</button><br/><br/>
                            Não possui uma conta? <a href="cadastro.php">Cadastrar-se</a></br>
                            Esqueceu sua senha? <a href="redefinir.php">Redefinir senha</a></br></br>
                            Apenas olhando? <a href="index.php">Ir ao site</a>

                        </form>
                    </center>
                </div>
                
            </div>
        </div>

    </body>

    <footer>

        <!-- Rodapé -->
        <center>
            Yago Russo</br>
            <div class="d-flex w-75">
                <hr class="my-auto flex-grow-1">
                <div class="px-4">© 2018-2021</div>
                <hr class="my-auto flex-grow-1">
            </div>
        </center>
        <br/><br/>

    </footer>

</html>
