<?php

session_start();

include_once("conexao.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    ADMINISTRADOR <br><br>
    <?php

$result_quantidade = "SELECT * FROM quantidade 
                      ORDER BY id_quantidade DESC 
                      LIMIT 1";

$resultado = mysqli_query($conn, $result_quantidade);

if ($row_quantidade = mysqli_fetch_assoc($resultado)) {

    echo "<table>";

    echo "<tr><td><b>QUANTIDADE TÉRREO (PORTARIA)</b></td><td>: " . $row_quantidade['qt_terreo'] . "</td></tr>";

    echo "<tr><td><b>QUANTIDADE PRIMEIRO ANDAR</b></td><td>: " . $row_quantidade['qt_primeiro'] . "</td></tr>";

    echo "<tr><td><b>QUANTIDADE SEGUNDO ANDAR</b></td><td>: " . $row_quantidade['qt_segundo'] . "</td></tr>";

    echo "<tr><td><b>QUANTIDADE TERCEIRO ANDAR</b></td><td>: " . $row_quantidade['qt_terceiro'] . "</td></tr>";

    echo "</table>";
}

?><br><br>


    SELECIONE O ANDAR: <br><br>

    <a href="./terreo_cons.php">Térreo</a><br><br>

    <a href="./primeiro_cons.php">Primeiro andar</a><br><br>

    <a href="./segundo_cons.php">Segundo andar</a><br><br>

    <a href="./terceiro_cons.php">Terceiro andar</a><br><br>

</body>
</html>