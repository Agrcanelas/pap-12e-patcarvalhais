<?php
require_once 'ligacao.php';
session_start();

$_SESSION["sessionmaxtime"] = time();

$con = ligaBD();

if($stm = $con->prepare("SELECT * from Utilizadores where nome_user =? and pwd_user = ?"))
{
    $stm-> bind_param("ss", $_POST["nome_user"], md5($_POST["pwd_user"]));

    $stm->execute();

    $stm->store_result();

    if($stm->num_rows>0)
    {
        $_SESSION["login"]=1;
        $_SESSION["browser"]= $_SERVER["HTTP_USER_AGENT"];
        header("location: admin/mostra_reg.php");
    }else
    {
        echo '<script>alert("Os dados não são válios.")</script>';
        header("Refresh: 0; url=index.php");
    }

}
?>
