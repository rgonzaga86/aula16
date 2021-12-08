<?php
include('conexao.php');

try{
    $sql = "SELECT * from produto";
    $qry = $con->query($sql);
    $produtos = $qry->fetchAll(PDO::FETCH_OBJ);
    //echo "<pre>";
    //print_r($produtos);
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
    
<h1>Lista de Produtos</h1>
<hr>
<a href="frmproduto.php">Novo Cadastro</a>
<hr>
<table border=1>
    <thead>
        <tr>
           <th>id</th> 
           <th>produtos</th>
           <th>quantidades</th>
           <th colspan=2>Ações</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach($produto as $produto) { ?>
        <tr>
            <td><?php echo $produto->idproduto ?></td>
            <td><?php echo $produto->nome ?></td>
            <td><?php echo $produto->quantidades ?></td>
            <td><a href="frmproduto.php?idproduto=<?php echo $produto->idproduto ?>">Editar</a></td>
            <td><a href="frmproduto.php?op=del&idproduto=<?php echo  $produto->idproduto ?>">Excluir</a></td>

        </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>