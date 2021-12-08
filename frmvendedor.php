<?php 

$idvendedor = isset($_GET["idvendedor"]) ? $_GET["idvendedor"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdprojeto";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  vendedor where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            header("Location:listarvendedor.php");
        }


        if($idvendedor){
            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  vendedor where idvendedor= :idvendedor";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idvendedor",$idvendedor);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($cliente);
        }
        if($_POST){
            if($_POST["idvendedor"]){
                $sql = "UPDATE vendedor SET vendedor =:vendedor, dataadmissao: dataadmissao WHERE idvendedor =:idvendedor";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idvendedor", $_POST["vendedor"]);
                $stmt->bindValue(":iddataadmissao", $_POST["iddataadmissao"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO vendedor(vendedor,dataadmissao) VALUES (:vendedor,:dataadmissao)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":vendedor",$_POST["nome"]);
                $stmt->bindValue(":dataadmissao",$_POST["date"]);
                $stmt->execute(); 
            }
            header("Location:listarvendedor.php");
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
<h1>Cadastro de Vendedor</h1>
<form method="POST">
Vendedor  <input type="text" name="nome"        value="<?php echo isset($vendedor) ? $vendedor->vendedor : null ?>"><br><br>
Data de admissão <input type="date" name="date"        value="<?php echo isset($vendedor) ? $vendedor->vendedor : null ?>"><br><br>
<input type="hidden"     name="idvendedor"   value="<?php echo isset($vendedor) ? $vendedor->idvendedor : null ?>">
<input type="submit">
</form>
<a href="listarvendedor.php">volta</a>
</body>
</html>