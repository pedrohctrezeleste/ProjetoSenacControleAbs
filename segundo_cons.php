
<?php

session_start();

include_once("./conexao.php");


/* =========================================
   ATUALIZAR QUANTIDADE
========================================= */

if (isset($_POST['atualizar'])) {

    $quantidade = (int) $_POST['quantidade'];


    /* =========================================
       CONSULTA QUANTIDADE ATUAL
    ========================================= */

    $consulta_atual = "

        SELECT qt_segundo

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

        echo "

            <script>

                alert('Não foi possível localizar a quantidade atual!');

                window.location.href = 'segundo_cons.php';

            </script>

        ";

        exit;

    }


    /* =========================================
       QUANTIDADE ANTERIOR
    ========================================= */

    $quantidade_anterior =
        (int) $dados_atual['qt_segundo'];


    /* =========================================
       ATUALIZA QUANTIDADE
    ========================================= */

    $result_update = "

        UPDATE quantidade

        SET qt_segundo = $quantidade

        WHERE qt_segundo = $quantidade_anterior

    ";


    $resultado_update = mysqli_query(
        $conn,
        $result_update
    );


    /* =========================================
       REGISTRA NO HISTÓRICO
    ========================================= */

    if ($resultado_update) {

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
                '2º Andar',
                $quantidade_anterior,
                $quantidade,
                'Atualização'
            )

        ";


        mysqli_query(
            $conn,
            $historico
        );


        header("Location: sucesso_admin.php");

        exit;


    } else {

        echo "

            <script>

                alert('Erro ao atualizar quantidade!');

            </script>

        ";

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


    <title>Controle - Segundo Andar</title>


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

                        Controle de quantidade — 2º Andar

                    </p>


                </div>


            </div>


        </div>

    </header>



    <!-- CONTEÚDO PRINCIPAL -->

    <main class="container conteudo-principal">


        <div class="painel-quantidades painel-controle">


            <!-- TÍTULO -->

            <div class="titulo-painel">


                <span class="icone-caixa">

                    🏢

                </span>


                <h2>

                    CONTROLE DO 2º ANDAR

                </h2>


            </div>



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

                            2º ANDAR

                        </h3>


                        <p class="descricao-local">

                            Segundo andar

                        </p>



                        <!-- CONSULTA -->

                        <?php

                        $result_quantidade = "

                            SELECT qt_segundo

                            FROM quantidade

                            LIMIT 1

                        ";


                        $resultado = mysqli_query(
                            $conn,
                            $result_quantidade
                        );


                        $row_quantidade =
                            mysqli_fetch_assoc(
                                $resultado
                            );


                        $quantidade_segundo = 0;


                        if (
                            $row_quantidade
                            &&
                            $row_quantidade['qt_segundo'] !== NULL
                        ) {

                            $quantidade_segundo =
                                $row_quantidade['qt_segundo'];

                        }

                        ?>


                        <!-- QUANTIDADE -->

                        <div class="quantidade-atual">

                            <?php

                            echo $quantidade_segundo;

                            ?>

                        </div>


                        <div class="label-disponivel">

                            DISPONÍVEIS

                        </div>



                        <!-- LINHA -->

                        <div class="linha-card"></div>



                        <!-- FORMULÁRIO -->

                        <form
                            action="segundo_cons.php"
                            method="POST"
                            class="form-controle"
                        >


                            <label
                                for="quantidade"
                                class="label-quantidade"
                            >

                                Nova quantidade

                            </label>


                            <div class="input-group input-retirada">


                                <span class="input-group-text">

                                    <i class="bi bi-box-seam"></i>

                                </span>


                                <input
                                    type="number"
                                    id="quantidade"
                                    name="quantidade"
                                    min="0"
                                    required
                                    class="form-control"
                                    placeholder="Digite a nova quantidade"
                                >


                            </div>



                            <!-- BOTÃO -->

                            <button
                                type="submit"
                                name="atualizar"
                                class="botao-excluir"
                            >

                                <i class="bi bi-arrow-repeat"></i>

                                ATUALIZAR

                            </button>


                        </form>


                    </div>


                </div>


            </div>


        </div>



        <!-- VOLTAR -->

        <div class="area-administrador">


            <a
                href="admin.php"
                class="botao-voltar"
            >

                <i class="bi bi-arrow-left"></i>

                VOLTAR


            </a>


        </div>


    </main>


</div>


</body>


</html>
