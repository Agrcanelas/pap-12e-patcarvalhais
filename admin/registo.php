<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .erro{
            color: red;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../estilo.css" />
    <link rel="stylesheet" type="text/css"
        href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <title>Formulário de registo de produtos no inventário</title>
</head>

<body>
    <!-- *** Cabeçalho da página *** -->
    <?php include '../header.php';?>
    <div class="flex">
    <!-- *** Barra de navegação *** -->
    <?php include 'menu_admin.php';?>
    <!-- *** Conteúdo *** -->
    <div class="contents">
    <h2>Formulário de registo de produtos no inventário</h2>
    <?php
        require_once '../ligacao.php';
        require_once '../testa_sessao.php'; 
        if (testaSessao()) 
        { 
            if ($con = ligaBD()) 
            {
    
        //quando faz o update, leva na url o id
        if(isset($_GET["id"]))
        {
            $operacao = "update";
            $con = ligaBD();
            $stm = $con->prepare("SELECT * from inventario WHERE id_reg = ?");
            $stm->bind_param("i", $_GET["id"]);
            $stm->execute();
            $res = $stm->get_result();
            $row = $res->fetch_assoc();
            $con->close();
        }
        else
            $operacao = "insert";
        
        //verificar se o formulário já foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            require("../validacao.php");
            $validacao = validarFormulario();
        }

    ?>
    <!-- Distinguir no action se é uma operação de insert ou update -->
    <form action="<?php ($operacao=="update")? $_SERVER["PHP_SELF"] . "?id=" . $_GET["id"] : $_SERVER["PHP_SELF"];?>" method="post">
        <fieldset>
            <legend>Dados do produto</legend>
            <table>
                <tbody>
                    <tr>
                        <td><label>Nome*:</label></td> 
                        <td><input name="nome_reg" size="45" type="text" value = "<?php
                            // código para preservar os dados no formulário após o envio
                            if($_POST){
                                if(!empty($_POST["nome_reg"]))
                                    echo htmlentities ($_POST["nome_reg"], ENT_QUOTES);
                            } else if ($operacao =="update")
                            echo $row["nome_reg"];
                        ?>"/>
                        <?php
                        // se o formulário foi enviado e se o campo nome está vazio
                        if ($_POST && in_array("nome_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                    
                     <tr>
                        <td><label>Quantidade*:</label></td>
                        <td><input name="quant_reg" type="text"  value = "<?php
                          // código para preservar os dados no formulário após o envio
                          if($_POST){
                            if(!empty($_POST["quant_reg"]))
                            echo htmlentities ($_POST["quant_reg"], ENT_QUOTES);
                        } else if ($operacao =="update")
                        echo $row["quant_reg"];
                        ?>"/>
                        <?php
                        // se o formulário foi enviado e se o campo idade está vazio
                        if ($_POST && in_array("quant_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                    <tr>
                        <td><label>Tipo*:</label></td>
                        <td><input name="tipo_reg" type="text"  value = "<?php
                          // código para preservar os dados no formulário após o envio
                          if($_POST){
                            if(!empty($_POST["tipo_reg"]))
                            echo htmlentities ($_POST["tipo_reg"], ENT_QUOTES);
                        } else if ($operacao =="update")
                        echo $row["tipo_reg"];
                        ?>"/>
                        <?php
                        // se o formulário foi enviado e se o campo idade está vazio
                        if ($_POST && in_array("tipo_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Situação:</legend>
            <table>
                <tbody>
                <label>Estado: 
                    <?php
                        // se o formulário foi enviado e se o campo estado_reg está vazio
                        if ($_POST && in_array("estado_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?>
                    <input type="radio" name="estado_reg"  value="Bom" 
                    <?php
                        if($_POST){
                            if($_POST["estado_reg"]=="Bom") echo "checked";
                        }else if ($operacao=="update")
                        if($row["estado_reg"]=="Bom") echo "checked";
                    ?> > Bom 
                    <input type="radio" name="estado_reg"  value="Sinais de uso" 
                    <?php
                        if($_POST){
                            if($_POST["estado_reg"]=="Sinais de uso") echo "checked";
                        }else if ($operacao=="update")
                        if($row["estado_reg"]=="Sinais de uso") echo "checked";
                    ?> > Sinais de uso 
                    <input type="radio" name="estado_reg"  value="Não funciona" 
                    <?php
                        if($_POST){
                            if($_POST["estado_reg"]=="Não funciona") echo "checked";
                        }else if ($operacao=="update")
                        if($row["estado_reg"]=="Não funciona") echo "checked";
                    ?> > Não funciona
                </label>   
            
                    <tr>
                        <td><label>Observações:</label></td>
                        <td><input name="obs_reg" type="text"  value = "<?php
                          // código para preservar os dados no formulário após o envio
                          if($_POST){
                            if(!empty($_POST["obs_reg"]))
                            echo htmlentities ($_POST["obs_reg"], ENT_QUOTES);
                        } else if ($operacao =="update")
                        echo $row["obs_reg"];
                        ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <fieldset>
            <legend>Dados aquisição:</legend> 
            <table>
                <tbody>
                    <tr>
                        <td><label>Loja*:</label></td> 
                        <td><input name="loja_reg" size="45" type="text" value = "<?php
                            // código para preservar os dados no formulário após o envio
                            if($_POST){
                                if(!empty($_POST["loja_reg"]))
                                    echo $_POST["loja_reg"];
                            }else if ($operacao=="update")
                            echo $row["loja_reg"];
                            ?>">
                        <?php
                        // se o formulário foi enviado e se o campo nome está vazio
                        if ($_POST && in_array("loja_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                    <tr>
                        <td><label>Preço*:</label></td> 
                        <td><input name="preco_reg" size="25" type="text" value = "<?php
                            // código para preservar os dados no formulário após o envio
                            if($_POST){
                                if(!empty($_POST["preco_reg"]))
                                    echo $_POST["preco_reg"];
                                }else if ($operacao=="update")
                                echo $row["preco_reg"];
                                ?>">
                        <?php
                        // se o formulário foi enviado e se o campo nome está vazio
                        if ($_POST && in_array("preco_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                    <tr>
                        <td><label>Link*:</label></td> 
                        <td><input name="link_reg" size="25" type="text" value = "<?php
                            // código para preservar os dados no formulário após o envio
                            if($_POST){
                                if(!empty($_POST["link_reg"]))
                                    echo $_POST["link_reg"];
                                }else if ($operacao=="update")
                                echo $row["link_reg"];
                                ?>">
                        <?php
                        // se o formulário foi enviado e se o campo nome está vazio
                        if ($_POST && in_array("link_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                    <tr>
                        <td><label>Data*:</label></td> 
                        <td><input name="data_reg" size="25" type="date" value = "<?php
                            // código para preservar os dados no formulário após o envio
                            if($_POST){
                                if(!empty($_POST["data_reg"]))
                                    echo $_POST["data_reg"];
                                }else if ($operacao=="update")
                                echo $row["data_reg"];
                                ?>">
                        <?php
                        // se o formulário foi enviado e se o campo nome está vazio
                        if ($_POST && in_array("data_reg", $validacao))
                                echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
                        ?></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
        <p>* campos obrigatórios</p>
        <p><input name="enviar" type="submit" value="Submeter" /></p>
    </form>

    <?php if($_POST && count($validacao)!=0)
    {
        $con = ligaBD();
        //na situação da operação INSERT
        if($operacao=="insert")
        {
            $stm = $con->prepare("INSERT into inventario values(0,?,?,?,?,?,?,?,?,?)");
            date_default_timezone_set("Europe/Lisbon");
            
            $stm->bind_param("sssssssss", $_POST["nome_reg"], $_POST["quant_reg"], $_POST["tipo_reg"], $_POST["estado_reg"], 
            $_POST["obs_reg"], $_POST["loja_reg"],$_POST["preco_reg"], $_POST["link_reg"], $_POST["data_reg"]);

            if($stm->execute())
            {
                echo '<script>alert("Registo inserido com sucesso.")</script>';
                header("Refresh: 5; url=mostra_reg.php");
            }else
            {
                echo '<script>alert("Ocorreu um erro a inserir o registo.")</script>';
                header("Refresh: 5; url=mostra_reg.php");
            }
            $stm->close();
        }

        //na situação da operação UPDATE
        if($operacao=="update")
        {
            $stm = $con->prepare("UPDATE inventario set nome_reg=?, quant_reg=?, tipo_reg=?, estado_reg=?, 
            obs_reg=?, loja_reg=?, preco_reg=?, link_reg=?, data_reg=? WHERE id_reg=?");
            date_default_timezone_set("Europe/Lisbon");
            $stm->bind_param("sssssssssi", $_POST["nome_reg"], $_POST["quant_reg"], $_POST["tipo_reg"], $_POST["estado_reg"], 
            $_POST["obs_reg"], $_POST["loja_reg"],$_POST["preco_reg"], $_POST["link_reg"], 
            $_POST["data_reg"], $_GET["id"]);
            if($stm->execute())
            {
                echo '<script>alert("Registo atualizado com sucesso.")</script>';
                header("Refresh: 2; url=mostra_reg.php");
            }else
            {
                echo '<script>alert("Ocorreu um erro a atualizar o registo.")</script>';
                header("Refresh: 2; url=mostra_reg.php");
            }
            $stm->close();
        }
        /*$con->close();*/
    }
}}
    ?>
</div>
</div>
<!-- *** Rodapé *** -->
<?php include '../footer.php';?>
</body>
</html>