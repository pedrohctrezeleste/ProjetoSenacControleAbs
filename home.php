<?php

session_start();

include_once("./conexao.php");

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle de Absorventes</title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link 
    rel="stylesheet" 
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>
    <!-- CSS do projeto -->

    <link rel="stylesheet" href="./css/style.css">

</head>


<body>


<div class="pagina">


    <!-- CABEÇALHO -->
    <header class="cabecalho">
    <div class="cabecalho-conteudo">
        <h1>
            CONSULTE A QUANTIDADE DE ABSORVENTES DISPONÍVEIS EM CADA ANDAR
        </h1>
    </div>
</header>
<br><br>



    <!-- CONTEÚDO PRINCIPAL -->

    <main class="container conteudo-principal">


        <!-- PAINEL -->

        <div class="painel-quantidades">


            <!-- TÍTULO DO PAINEL -->




            <?php

            $result_quantidade = "
                SELECT *
                FROM quantidade
                ORDER BY id_quantidade DESC
                LIMIT 1
            ";

            $resultado = mysqli_query($conn, $result_quantidade);


            while ($row_quantidade = mysqli_fetch_assoc($resultado)) {

            ?>


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
                                href="./terreo_del.php"
                                class="botao-acessar"
                            >

                                RETIRAR

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
                                href="./primeiro_del.php"
                                class="botao-acessar"
                            >

                                RETIRAR

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
                                href="./segundo_del.php"
                                class="botao-acessar"
                            >

                                RETIRAR

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
                                href="./terceiro_del.php"
                                class="botao-acessar"
                            >

                                RETIRAR

                            </a>


                        </div>

                    </div>


                </div>


            <?php

            }

            ?>


        </div> <br>


<p class="mensagem-contribuicao">
    <strong>Faça sua parte 💗</strong><br>
    <span>
        Retirou um absorvente? Contribua também!
    </span><br>
Registre sua retirada e, se puder, doe absorventes. <br>
Cada contribuição ajuda a manter esse recurso disponível para todas. 💗
</p> <br><br><br>




        <!-- ADMINISTRADOR -->

        <div class="area-administrador">


            <a
                href="./loginadm.html"
                class="botao-administrador"
            >

                🔐 ACESSO DO ADMINISTRADOR

            </a><br>
            <footer class="rodape">
    © Desenvolvido por Pedro Gaspar
</footer>

        </div>


    </main>


</div>



</body>

</html>