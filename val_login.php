<?php

session_start();

include_once("conexao.php");

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM administrador 
        WHERE nome = '$nome' 
        AND senha = '$senha'";

$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) > 0) {

    $dados = mysqli_fetch_assoc($resultado);

    $_SESSION["id_adm"] = $dados["id_adm"];
    $_SESSION["nome_adm"] = $dados["nome"];

    header("Location: loginadmin.php");
    exit();

} else {

    echo "Usuário ou senha incorretos.";

}

?>