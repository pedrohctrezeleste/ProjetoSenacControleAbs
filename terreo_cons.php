<?php

session_start();

include_once("./conexao.php");



// ATUALIZAR QUANTIDADE

if(isset($_POST['atualizar'])){

    $quantidade = (int) $_POST['quantidade'];

    $result_update = "

        UPDATE quantidade

        SET qt_terreo = '$quantidade'

        WHERE qt_terreo IS NOT NULL

    ";

    $resultado_update = mysqli_query($conn, $result_update);

    if($resultado_update){

        header("Location: sucesso_admin.php");
        exit;
        

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

                        Controle de quantidade — Térreo

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

                    CONTROLE DO TÉRREO

                </h2>

            </div>



            <!-- CONSULTA DA QUANTIDADE -->

            <?php

            $result_quantidade = "

                SELECT qt_terreo

                FROM quantidade

                LIMIT 1

            ";

            $resultado = mysqli_query($conn, $result_quantidade);

            $row_quantidade = mysqli_fetch_assoc($resultado);


            /*
             * Define 0 como valor padrão.
             * Assim o card continua aparecendo
             * mesmo quando a quantidade for zero.
             */

            $quantidade_terreo = 0;


            if($row_quantidade && $row_quantidade['qt_terreo'] !== NULL){

                $quantidade_terreo = $row_quantidade['qt_terreo'];

            }

            ?>


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


                        <!-- QUANTIDADE -->

                        <div class="quantidade-atual">

                            <?php

                            echo $quantidade_terreo;

                            ?>

                        </div>


                        <div class="label-disponivel">

                            DISPONÍVEIS

                        </div>


                        <!-- LINHA -->

                        <div class="linha-card"></div>


                        <!-- FORMULÁRIO -->

                        <form
                            action="terreo_cons.php"
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
