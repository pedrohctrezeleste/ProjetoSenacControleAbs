
<?php

session_start();

include_once("conexao.php");

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Administrador - Controle de Absorventes</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS do projeto -->

    <link
        rel="stylesheet"
        href="./css/style.css"
    >

</head>


<body>


<div class="pagina">


    <!-- CABEÇALHO -->

    <header class="cabecalho">

        <div class="container">

            <div class="cabecalho-conteudo">

                <div class="icone-flor">

                    🌸

                </div>


                <div>

                    <h1>

 CONTROLE DE ABSORVENTES
                    </h1>

                    <p>


                    </p>

                </div>

            </div>

        </div>

    </header>



    <!-- CONTEÚDO PRINCIPAL -->

    <main class="container conteudo-principal">


        <!-- PAINEL -->

        <div class="painel-quantidades">


            <!-- TÍTULO -->

            <div class="titulo-painel">

                <span class="icone-caixa">

                    <i class="bi bi-shield-lock"></i>

                </span>

                <h2>

                    PAINEL DO ADMINISTRADOR

                </h2>

            </div>



            <?php

            $result_quantidade = "SELECT * FROM quantidade 
                                  ORDER BY id_quantidade DESC 
                                  LIMIT 1";

            $resultado = mysqli_query($conn, $result_quantidade);

            if ($row_quantidade = mysqli_fetch_assoc($resultado)) {

            ?>


                <!-- QUANTIDADES -->

               
<!-- QUANTIDADES -->

<div class="row g-3 text-center">


    <!-- TÉRREO -->

    <div class="col-6 col-md-3">

        <div class="card-andar">

            <div class="numero-andar">
                🏢
            </div>

            <div class="andar-nome">
                TÉRREO
            </div>

            <div class="linha-card"></div>

            <div class="quantidade-numero">
                <?php echo $row_quantidade['qt_terreo']; ?>
            </div>

            <small class="texto-disponivel">
                DISPONÍVEIS
            </small>

            <br>

            <a
                href="./terreo_cons.php"
                class="botao-acessar"
            >
                ATUALIZAR
            </a>

        </div>

    </div>



    <!-- PRIMEIRO ANDAR -->

    <div class="col-6 col-md-3">

        <div class="card-andar">

            <div class="numero-andar">
                1°
            </div>

            <div class="andar-nome">
                PRIMEIRO ANDAR
            </div>

            <div class="linha-card"></div>

            <div class="quantidade-numero">
                <?php echo $row_quantidade['qt_primeiro']; ?>
            </div>

            <small class="texto-disponivel">
                DISPONÍVEIS
            </small>

            <br>

            <a
                href="./primeiro_cons.php"
                class="botao-acessar"
            >
                ATUALIZAR
            </a>

        </div>

    </div>



    <!-- SEGUNDO ANDAR -->

    <div class="col-6 col-md-3">

        <div class="card-andar">

            <div class="numero-andar">
                2°
            </div>

            <div class="andar-nome">
                SEGUNDO ANDAR
            </div>

            <div class="linha-card"></div>

            <div class="quantidade-numero">
                <?php echo $row_quantidade['qt_segundo']; ?>
            </div>

            <small class="texto-disponivel">
                DISPONÍVEIS
            </small>

            <br>

            <a
                href="./segundo_cons.php"
                class="botao-acessar"
            >
                ATUALIZAR
            </a>

        </div>

    </div>



    <!-- TERCEIRO ANDAR -->

    <div class="col-6 col-md-3">

        <div class="card-andar">

            <div class="numero-andar">
                3°
            </div>

            <div class="andar-nome">
                TERCEIRO ANDAR
            </div>

            <div class="linha-card"></div>

            <div class="quantidade-numero">
                <?php echo $row_quantidade['qt_terceiro']; ?>
            </div>

            <small class="texto-disponivel">
                DISPONÍVEIS
            </small>

            <br>

            <a
                href="./terceiro_cons.php"
                class="botao-acessar"
            >
                ATUALIZAR
            </a>

        </div>

    </div>


</div>



            <?php

            }

            ?>


        </div><br><br><br>



        <!-- VOLTAR -->

        <div class="area-administrador">


            <a
                href="./home.php"
                class="botao-administrador"
            >

                <i class="bi bi-house"></i>

                PÁGINA INICIAL

            </a><br><br><br>

            <footer class="rodape">
    © Desenvolvido por Pedro Gaspar
</footer>
        </div>


    </main>


</div>


</body>

</html>
