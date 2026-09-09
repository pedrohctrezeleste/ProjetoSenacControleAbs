<?php

session_start();
include_once("./conexao.php");


// ATUALIZAR QUANTIDADE

if(isset($_POST['atualizar'])){

    $quantidade = $_POST['quantidade'];

    $result_update = "
        UPDATE quantidade
        SET qt_terreo = '$quantidade'
        WHERE qt_terreo IS NOT NULL
    ";

    $resultado_update = mysqli_query($conn, $result_update);

    if($resultado_update){

        echo "<script>
            alert('Quantidade atualizada com sucesso!');
        </script>";

    }else{

        echo "<script>
            alert('Erro ao atualizar!');
        </script>";

    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle térreo</title>

</head>

<body>

<center>

<h1>Controle térreo</h1>

<br>

<h3>Consulta</h3>

<hr>

<br>


<?php

$result_quantidade = "SELECT qt_terreo FROM quantidade";

$resultado = mysqli_query($conn, $result_quantidade);

while($row_quantidade = mysqli_fetch_assoc($resultado)){

    if($row_quantidade['qt_terreo'] !== NULL){

        echo "<table>";

        echo "<tr>";

        echo "<td><b>QUANTIDADE</b></td>";

        echo "<td>: " . $row_quantidade['qt_terreo'] . "</td>";

        echo "</tr>";

        echo "</table><br><hr>";

    }

}

?>


<h3>Atualizar quantidade</h3>


<form method="POST">

    <label>Nova quantidade:</label>

    <br><br>

    <input
        type="number"
        name="quantidade"
        min="0"
        required
    >

    <br><br>

    <button type="submit" name="atualizar">

        ATUALIZAR

    </button>

</form>


<br><br>

<a href="admin.php">VOLTAR</a>

</center>

</body>

</html>
```
