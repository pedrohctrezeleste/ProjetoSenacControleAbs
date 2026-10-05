
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

        header("Location: terceiro_del.php");
        exit;

    }


    /* =========================================
       CONSULTA QUANTIDADE ATUAL
    ========================================= */

    $consulta_atual = "

        SELECT qt_terceiro

        FROM quantidade

        LIMIT 1

    ";


    $resultado_atual = mysqli_query(
        $conn,
        $consulta_atual
    );


    $dados_atual = mysqli_fetch_assoc(
        $resultado_atual
    );


    /* =========================================
       VERIFICA SE EXISTE REGISTRO
    ========================================= */

    if (!$dados_atual) {

        header("Location: terceiro_del.php?erro=quantidade");
        exit;

    }


    /* =========================================
       QUANTIDADE ANTERIOR
    ========================================= */

    $quantidade_anterior =
        (int) $dados_atual['qt_terceiro'];


    /* =========================================
       VERIFICA SE POSSUI QUANTIDADE SUFICIENTE
    ========================================= */

    if ($quantidade > $quantidade_anterior) {

        header("Location: terceiro_del.php?erro=quantidade");
        exit;

    }


    /* =========================================
       CALCULA NOVA QUANTIDADE
    ========================================= */

    $quantidade_nova =
        $quantidade_anterior - $quantidade;


    /* =========================================
       ATUALIZA A QUANTIDADE
    ========================================= */

    $result_delete = "

        UPDATE quantidade

        SET qt_terceiro = $quantidade_nova

        WHERE qt_terceiro = $quantidade_anterior

    ";


    $resultado_delete = mysqli_query(
        $conn,
        $result_delete
    );


    /* =========================================
       REGISTRA NO HISTÓRICO
    ========================================= */

    if (
        $resultado_delete
        &&
        mysqli_affected_rows($conn) > 0
    ) {

        $historico = "

            INSERT INTO historico
            (
                andar,
                quantidade_anterior,
                quantidade_nova,
                acao
            )

            VALUES
            (
                '3º Andar',
                $quantidade_anterior,
                $quantidade_nova,
                'Retirada'
            )

        ";


        mysqli_query(
            $conn,
            $historico
        );


        /* =========================================
           REDIRECIONA PARA SUCESSO
        ========================================= */

        header("Location: sucesso.php");
        exit;

    } else {

        header("Location: terceiro_del.php?erro=quantidade");
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


    <title>Controle - Terceiro Andar</title>


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

                        Retirada de absorventes — Terceiro andar

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

                            TERCEIRO ANDAR

                        </h3>


                        <p class="descricao-local">

                            Controle de retirada de absorventes

                        </p>



                        <!-- CONSULTA DA QUANTIDADE -->

                        <?php

                        $result_quantidade = "

                            SELECT qt_terceiro

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


                        $quantidade_terceiro = 0;


                        if (
                            $row_quantidade
                            &&
                            $row_quantidade['qt_terceiro'] !== NULL
                        ) {

                            $quantidade_terceiro =
                                $row_quantidade['qt_terceiro'];

                        }

                        ?>


                        <div class="quantidade-atual">

                            <?php

                            echo $quantidade_terceiro;

                            ?>

                        </div>


                        <div class="label-disponivel">

                            DISPONÍVEIS

                        </div>


                        <!-- LINHA -->

                        <div class="linha-card"></div>



                        <!-- FORMULÁRIO -->

                        <form
                            action="terceiro_del.php"
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
