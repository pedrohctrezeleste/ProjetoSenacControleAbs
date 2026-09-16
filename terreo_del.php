<?php

session_start();

include_once("./conexao.php");


/* =========================================
   RETIRAR QUANTIDADE
========================================= */

if (isset($_POST['excluir'])) {

    $quantidade = (int) $_POST['quantidade'];


    /* =========================================
       VERIFICA SE A QUANTIDADE É VÁLIDA
    ========================================= */

    if ($quantidade <= 0) {

        header("Location: terreo_del.php");
        exit;

    }


    /* =========================================
       RETIRA A QUANTIDADE
    ========================================= */

    $result_delete = "

        UPDATE quantidade

        SET qt_terreo = qt_terreo - $quantidade

        WHERE qt_terreo >= $quantidade

    ";


    $resultado_delete = mysqli_query(
        $conn,
        $result_delete
    );


    /* =========================================
       VERIFICA SE A RETIRADA FOI REALIZADA
    ========================================= */

    if (
        $resultado_delete
        &&
        mysqli_affected_rows($conn) > 0
    ) {

        /*
         * Retirada realizada com sucesso.
         * Envia o usuário para a página de confirmação.
         */

        header("Location: sucesso.php");
        exit;

    } else {

        /*
         * Não foi possível retirar.
         * Provavelmente a quantidade solicitada
         * é maior que a quantidade disponível.
         */

        header("Location: terreo_del.php?erro=quantidade");
        exit;

    }

}

?>


<!DOCTYPE html>

<html lang="pt-br">


<head>

    <meta charset="UTF-8">


    
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <title>Controle - Térreo</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICONS -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <!-- CSS DO PROJETO -->

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

                        Retirada de absorventes — Térreo

                    </p>

                </div>


            </div>

        </div>

    </header>



    <!-- CONTEÚDO PRINCIPAL -->

    <main class="container conteudo-principal">


        <div class="painel-quantidades painel-controle">


            <!-- MENSAGEM DE ERRO -->

            <?php if (isset($_GET['erro'])) { ?>

                <div
                    class="alert alert-danger text-center"
                    role="alert"
                >

                    <i class="bi bi-exclamation-circle"></i>

                    Não foi possível realizar a retirada.

                    <br>

                    Verifique se a quantidade solicitada
                    está disponível.

                </div>

            <?php } ?>



            <!-- ÁREA DA QUANTIDADE -->

            <div class="row justify-content-center">


                <div class="col-md-6">


                    <div class="card-controle text-center">


                        <!-- ÍCONE -->

                        <div class="icone-local">

                            <i class="bi bi-building"></i>

                        </div>


                        <!-- NOME -->

                        <h3 class="nome-local">

                            TÉRREO

                        </h3>


                        <p class="descricao-local">

                            Portaria

                        </p>



                        <!-- CONSULTA DA QUANTIDADE -->

                        <?php


                        $result_quantidade = "

                            SELECT qt_terreo

                            FROM quantidade

                            LIMIT 1

                        ";


                        $resultado = mysqli_query(
                            $conn,
                            $result_quantidade
                        );


                        $row_quantidade = mysqli_fetch_assoc(
                            $resultado
                        );


                        if (
                            $row_quantidade
                            &&
                            $row_quantidade['qt_terreo'] !== NULL
                        ) {

                        ?>


                            <div class="quantidade-atual">

                                <?php

                                echo $row_quantidade['qt_terreo'];

                                ?>

                            </div>


                            <div class="label-disponivel">

                                DISPONÍVEIS

                            </div>


                        <?php

                        }

                        ?>


                        <!-- LINHA -->

                        <div class="linha-card"></div>



                        <!-- FORMULÁRIO -->

                        <form
                            action="terreo_del.php"
                            method="POST"
                            class="form-controle"
                        >


                            <label
                                for="quantidade"
                                class="label-quantidade"
                            >

                                Quantidade a retirar

                            </label>


                            <div class="input-group input-retirada">


                                <span class="input-group-text">

                                    <i class="bi bi-dash-circle"></i>

                                </span>


                                <input
                                    type="number"
                                    id="quantidade"
                                    name="quantidade"
                                    min="1"
                                    required
                                    class="form-control"
                                    placeholder="Digite a quantidade"
                                >


                            </div>



                            <!-- BOTÃO RETIRAR -->

                            <button
                                type="submit"
                                name="excluir"
                                class="botao-excluir"
                            >

                                <i class="bi bi-trash3"></i>

                                RETIRAR

                            </button>


                        </form>


                    </div>


                </div>


            </div>


        </div>



        <!-- VOLTAR -->

        <div class="area-administrador">


            <a
                href="home.php"
                class="botao-voltar"
            >

                <i class="bi bi-arrow-left"></i>

                VOLTAR AO PAINEL

            </a>


        </div>


    </main>


</div>


</body>

</html>
