<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário Robótica</title>
    <link rel="stylesheet" type="text/css" href="../estilo.css" />
    <link rel="stylesheet" type="text/css"
        href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
</head>
<style>
    table,
    td,
    th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 5px;
    }
</style>
<body>
    <!-- *** Cabeçalho *** -->
    <?php include '../header.php';?>
    <div class="flex">
    <!-- *** Barra de navegação *** -->
    <?php include 'menu_admin.php';?>
    <!-- *** Conteúdo *** -->
    <div class="contents">



<!-- Código para mostrar os registos --->
<?php
require_once '../ligacao.php';
require_once '../testa_sessao.php';  
if (testaSessao()) 
{ 
    if ($con = ligaBD()) 
    {
        if(isset($_GET["id"])){
            $stm = $con->prepare("DELETE from inventario WHERE id_reg = ?");
            $stm->bind_param("i", $_GET["id"]);
            $stm->execute();
        }



        $query = "SELECT * FROM inventario ";
        echo '<h2>INVENTÁRIO DO CPR - LISTAGEM DE INVENTÁRIO</h2>';
        echo '<p style="text-align:center;"><a href="registo.php"><img src="../imgs/plus.png" alt="novo registo" width="100" height="80"></a></p>';
        echo '<table> <tr>
        <th> Designação </th> 
        <th> Quantidade </th> 
        <th> Tipo </th> 
        <th> Estado </th>
        <th> Sala </th>
        <th> Observações </th> 
        <th> Loja </th>
        <th> Preço</th>
        <th> Link </th>
        <th> Data </th> 
        <th> Editar </th>
        <th> Eliminar </th>';
        
        if ($result = $con->query($query)) 
        {
            /* fetch associative array */
            while ($row = $result->fetch_assoc()) 
            {
                echo '<tr>';
                echo"<td>" . $row['nome_reg']."</td>
                <td>". $row['quant_reg']."</td>
                <td>". $row['tipo_reg']."</td>
                <td>". $row['estado_reg']."</td>
                <td>". $row['sala_reg']."</td>
                <td>". $row['obs_reg']."</td>
                <td>". $row['loja_reg']."</td>
                <td>". $row['preco_reg']."</td>
                <td>". $row['link_reg']."</td>
                <td>". $row['data_reg']."</td>
                <td><a href='registo.php?id=". $row['id_reg'] ."'><img src='../imgs/edit.png' width='30' height='22'></a></td>
                    <td><a href='mostra_reg.php?id=". $row['id_reg'] . "'><img src='../imgs/trash.png' width='30' height='22'></a></td>";
                echo '</tr>';
            }   
        echo "</table>"; 
          
	  // Free result set
	  $result -> free_result();
        }
    }
}
?>





</div>
</div>

    <!-- *** Rodapé *** -->
    <?php include '../footer.php';?>
</body>
</html>