<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendas";
    $qry = $con->query($sql);
    $vendas = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($clientes);
    //die();
} catch(PDOException $e){
    echo $e->getMessage();

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Lista de Vendas</h1>
<hr>
<a href="frmvendas.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Vendedor</th>
           <th>Produto</th>
           <th>Quantidade</th>
           <th>Valor</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendas as $vendas) { ?>
        <tr>
            <td><?php echo $vendas->idvendas ?></td>
            <td><?php echo $vendedor->text ?></td>
            <td><?php echo $produto->text ?></td>
            <td><?php echo $quantidade-> number ?></td>
            <td><?php echo $valor-> text ?></td>
            <td><a href="frmvendas.php?idvendas=<?php echo $vendas->idvendas ?>">Editar</a></td>
            <td><a href="frmcvendas.php?op=del&idvendas=<?php echo  $vendas->idvendas ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>