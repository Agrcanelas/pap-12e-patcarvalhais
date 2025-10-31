<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário Robótica</title>
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <link rel="stylesheet" type="text/css"
        href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
</head>

<body>

    <!-- *** Cabeçalho da página *** -->
    <?php include 'header.php';?>
    <div class="flex">
    <!-- *** Barra de navegação *** -->
    <?php include 'menu.php';?>
    <!-- *** Conteúdo *** -->
        <div class="contents">
            <div id="absoluteCenteredDiv">
            <?php
            //verificar se o formulário já foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                require("validacao.php");
                $validacao = validarFormulario();
            }
            ?>
            <form action="session.php" method="post">
                <div class="box">
                    <h1>Formulário para entrar</h1>
                    <input class="username" name="nome_user" type="text" placeholder="Nome de utilizador">
                    <?php
                        // se o formulário foi enviado e se o campo username está vazio
                        if ($_POST && in_array("nome_user", $validacao))
                            echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                    ?>
                    <input class="username" name="pwd_user" type="password" placeholder="Palavra passe">
                    
                    <!--<a href="#">-->
                    <input class="button" name="login_user" type="submit" value="Entrar"></a>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- *** Rodapé *** -->
    <?php include 'footer.php';?>
</body>