<?php
function validarFormulario()
{
    //a variável validacao é do tipo array associativo para guardar os valores do formulário
    $validacao = array();
    //tratamento do botão rádio
    if (!isset($_POST["estado_reg"])) 
    { //caso não exista a variável estado, ela é criada vazia
        $_POST["estado_reg"]= "";
    }
    //vai preencher um array com todos os índices cujo valor está vazio
    foreach($_POST as $key => $value)
    if(empty($_POST[$key]))
        array_push($validacao, $key);
    return $validacao;
}
?>

