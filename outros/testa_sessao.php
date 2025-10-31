<?php
function testaSessao()
{
    session_start();

    if(isset($_SESSION["sesionmaxtime"]) && (time()-$_SESSION["sessionmaxtime"])>60*60)
    {
        session_destroy();
        echo '<script>alert("A sessão expirou.")</script>';
        header("Refresh: 5; url = index.php");
    }
    else 
        if($_SESSION["login"]==1 && $_SESSION["browser"]==$_SERVER["HTTP_USER_AGENT"])
        {
            return true;
        } 
        else
            {
            echo '<script>alert("A sessão não está ativa.")</script>';
            header("Refresh: 1; url = ../login.php");
            }
    return false;
}
?>