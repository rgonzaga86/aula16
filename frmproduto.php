<?php 

$idcliente = isset($_GET["idproduto"]) ? $_GET["idproduto"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  produto where idproduto= :idproduto";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idproduto",$idproduto);
            $stmt->execute();
            header("Location:listarproduto.php");
        }


        if($idprodutos){
            //estou buscando os dados do produto no BD
            $sql = "SELECT * FROM  produto where idproduto= :idproduto";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idproduto",$idproduto);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($produtos);
        }
        if($_POST){
            if($_POST["idproduto"]){
                $sql = "UPDATE produto SET quantidade =:quantidade, valor =:produto, quantidade:quantidade, valor: valor WHERE idproduto =:idproduto";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor", $_POST["vendedor"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->bindValue(":quantidade", $_POST["quantidade"]);
                $stmt->bindValue(":valor", $_POST["valor"]);
                $stmt->bindValue(":idproduto", $_POST["idproduto"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendas(vendedor,produto,quantidade,valor) VALUES (:vendedor,:produto,:quantidade, :valor)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor",$_POST["nome"]);
                $stmt->bindValue(":produto",$_POST["produto"]);
                $stmt->bindValue(":quantidade",$_POST["quantidade"]);
                $stmt->bindValue(":valor",$_POST["valor"]);
                $stmt->execute(); 
            }
            header("Location:listarproduto.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Cadastro de Vendas</h1>
<form method="POST">
Produto <input type="text" name="text"       value="<?php echo isset($vendas) ? $cliente->email : null ?>"><br><br>
Quant  <input type="text" name="text"       value="<?php echo isset($vendas) ? $cliente->email : null ?>"><br><br>
Valor <input type="text" name="text"       value="<?php echo isset($vendas) ? $cliente->email : null ?>"><br>
<br>
<input type="hidden"     name="idproduto"   value="<?php echo isset($cliente) ? $cliente->idcliente : null ?>">
<input type="submit">
</form>
<a href="listarproduto.php">volta</a>
</body>
</html>