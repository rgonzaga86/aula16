<?php 

$idvendas = isset($_GET["idvendas"]) ? $_GET["idvendas"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendas where idvendas= :idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            header("Location:listarvendas.php");
        }


        if($idvendas){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  vendas where idvendas= :idvendas";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendas",$idvendas);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if($_POST){
            if($_POST["idvendas"]){
                $sql = "UPDATE vendas SET vendas =:vendas, idvendedor =:idvendedor, idproduto= :idproduto, quantidade =:quantidade, valor= : valor WHERE idvendas =:idvendas";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor", $_POST["vendedor"]);
                $stmt->bindValue(":produto", $_POST["produto"]);
                $stmt->bindValue(":quantidade", $_POST["quantidade"]);
                $stmt->bindValue(":valor",$_POST["valor"]);
                $stmt->bindValue(":idvendas", $_POST["idvendas"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendas(vendas,vendendor, produto, quantidade, valor) VALUES (:vendas,:vendedor,:produto, :quantidade, :valor)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor",$_POST["vendedor"]);
                $stmt->bindValue(":produto",$_POST["produto"]);
                $stmt->bindValue(":quantidade",$_POST["quantidade"]);
                $stmt->bindValue(":valor",$_POST["valor"]);
                $stmt->bindValue(":idvendas",$_POST["idvendas"]);
                $stmt->execute(); 
            }
            header("Location:listarvendas.php");
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
Vendedor  <input type="text" name="nome"        value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br><br>
Produto <input type="text" name="text"        value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br><br>
Quantidade <input type="number" name="number"        value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br><br>
Valor <input type="text" name="text"        value="<?php echo isset($vendas) ? $vendas->vendas : null ?>"><br><br>

<input type="hidden"     name="idvendas"   value="<?php echo isset($vendas) ? $vendas->idvendas : null ?>">
<input type="submit">
</form>
<a href="listarvendas.php">volta</a>
</body>
</html>