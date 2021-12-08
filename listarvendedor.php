<?php
include('conexao.php');

try{
    $sql = "SELECT * from vendedor";
    $qry = $con->query($sql);
    $vendedor = $qry->fetchAll(PDO::FETCH_OBJ);
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
    
<h1>Lista de Vendedores</h1>
<hr>
<a href="frmvendedor.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>Vendedor</th>
           <th>Data de admissao</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($vendedor as $vendedor) { ?>
        <tr>
            <td><?php echo $vendedor->idvendedor ?></td>
            <td><?php echo $vendedor->nome ?></td>
            <td><?php echo $vendedor->dataadmissao ?></td>
            <td><a href="frmvendedor.php?idvendedor=<?php echo $vendedor->idvendedor ?>">Editar</a></td>
            <td><a href="frmvendedor.php?op=del&idvendedor=<?php echo  $vendedor->idvendedor ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>