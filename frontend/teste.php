<!doctype html>
<html>

    <head>

        <!-- Importações e Dados -->
        <title>Cactus - Cadastro</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script>
            function TestaCPF() {
                var cpf = document.getElementById("cpf").value;
                var Soma;
                var Resto;
                Soma = 0;
                if (cpf == "00000000000") {
                    location.href='../frontend/cadastro.php';
                    document.getElementById('cpf').value = "";
                }
                else{
                    for (i = 1; i <= 9; i++) 
                        Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
                    Resto = (Soma * 10) % 11;

                    if ((Resto == 10) || (Resto == 11)) 
                        Resto = 0;
                    if (Resto != parseInt(cpf.substring(9, 10))) {
                        location.href='../frontend/cadastro.php';
                        document.getElementById('cpf').value = "";
                    }
                    else{
                        Soma = 0;
                        for (i = 1; i <= 10; i++) 
                            Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
                        Resto = (Soma * 10) % 11;

                        if ((Resto == 10) || (Resto == 11)) 
                            Resto = 0;
                        if (Resto != parseInt(cpf.substring(10, 11))) {
                            location.href='../frontend/cadastro.php';
                            document.getElementById('cpf').value = "";
                        }
                    }
                }
            }
        </script>

    </head>

    <body>

        <!-- Corpo da Pagina -->
        <div class="container border my-5 py-5 shadow p-3 mb-5 bg-light rounded">
            <div class="row justify-content-center">

                <div class="col-sm-5">
                    <center>
                        <img src="img/logo.png" class="mx-auto d-block" style="width: 250px">
                        <br /><br />
                        <h1 class="display-5">Já possui uma conta?<br /> <a href="login.php">Fazer login</a></h1>
                    </center>
                </div>

                <div class="col-sm-7">
                    <center>
                        <h1 class="display-2 text-primary">Cadastro</h1><br /><br />
                        <form action="../backend/cadUser.php" method=post oninput='senha2.setCustomValidity(senha2.value != senha.value ? "As senhas não são iguais" : "")'>

                            <h5>Nome</h5>
                            <input type="text" name="nome" class="form-control w-75" placeholder="Digite aqui..."><br />
                            <h5>Senha</h5>
                            <input type="password" name="senha" class="form-control w-75" placeholder="Digite aqui..."><br />
                            <h5>Repita a Senha</h5>
                            <input type="password" name="senha2" class="form-control w-75" placeholder="Digite aqui..."><br />
                            <h5>E-mail</h5>
                            <input type="email" name="email" class="form-control w-75" placeholder="Digite aqui..."><br />
                            <h5>CPF</h5>
                            <input type="text" id= "cpf" name="cpf" onblur="TestaCPF()" class="form-control w-75" placeholder="Digite aqui..."><br /><br />
                            <button type="submit" class="btn btn-outline-primary w-50">Cadastrar</button><br /><br />

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
        <br /><br />

    </footer>

</html>