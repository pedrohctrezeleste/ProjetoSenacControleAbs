
<?php

session_start();

include_once("./conexao.php");


/* =========================================
   BUSCAR RETIRADAS
========================================= */

$sql_retiradas = "
    SELECT
        id_historico,
        andar,
        quantidade_anterior,
        quantidade_nova,
        acao,
        data_registro
    FROM historico
    WHERE acao = 'Retirada'
    ORDER BY data_registro DESC
";

$resultado_retiradas = mysqli_query($conn, $sql_retiradas);


/* =========================================
   BUSCAR ATUALIZAÇÕES
========================================= */

$sql_atualizacoes = "
    SELECT
        id_historico,
        andar,
        quantidade_anterior,
        quantidade_nova,
        acao,
        data_registro
    FROM historico
    WHERE acao = 'Atualização'
    ORDER BY data_registro DESC
";

$resultado_atualizacoes = mysqli_query($conn, $sql_atualizacoes);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Histórico | Controle de Absorventes</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- CSS do projeto -->

    <link rel="stylesheet" href="./css/style.css">

</head>


<body>




    <!-- =========================================
         TÍTULO
    ========================================= -->

    <div class="text-center mb-4">

        <h2 class="fw-bold">
            HISTÓRICO DE REGISTROS
        </h2>

        <p class="text-muted">
            Consulte as retiradas e atualizações realizadas no sistema.
        </p>

    </div>


    <!-- =========================================
         HISTÓRICO DE RETIRADAS
    ========================================= -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center mb-3">

                <i class="bi bi-box-arrow-down fs-3 me-2 text-primary"></i>

                <div>

                    <h4 class="fw-bold mb-0">
                        Histórico de Retiradas
                    </h4>

                    <small class="text-muted">
                        Registros de absorventes retirados
                    </small>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead>

                        <tr>

                            <th>DATA</th>

                            <th>ANDAR</th>

                            <th>ANTES</th>

                            <th>RETIRADA</th>

                            <th>DEPOIS</th>

                            <th>AÇÃO</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if ($resultado_retiradas && mysqli_num_rows($resultado_retiradas) > 0) {

                        while ($registro = mysqli_fetch_assoc($resultado_retiradas)) {

                            $quantidade_retirada =
                                (int) $registro['quantidade_anterior']
                                -
                                (int) $registro['quantidade_nova'];

                    ?>

                        <tr>

                            <td>

                                <?= date(
                                    'd/m/Y H:i',
                                    strtotime($registro['data_registro'])
                                ); ?>

                            </td>


                            <td>

                                <span class="badge bg-light text-dark">

                                    <?= htmlspecialchars($registro['andar']); ?>

                                </span>

                            </td>


                            <td>

                                <?= (int) $registro['quantidade_anterior']; ?>

                            </td>


                            <td>

                                <span class="badge bg-danger">

                                    -<?= $quantidade_retirada; ?>

                                </span>

                            </td>


                            <td>

                                <?= (int) $registro['quantidade_nova']; ?>

                            </td>


                            <td>

                                <span class="badge bg-primary">

                                    <i class="bi bi-box-arrow-down me-1"></i>

                                    Retirada

                                </span>

                            </td>

                        </tr>

                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td colspan="6" class="text-muted py-4">

                                <i class="bi bi-info-circle me-1"></i>

                                Nenhuma retirada registrada.

                            </td>

                        </tr>

                    <?php

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =========================================
         HISTÓRICO DE ATUALIZAÇÕES
    ========================================= -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <div class="d-flex align-items-center mb-3">

                <i class="bi bi-pencil-square fs-3 me-2 text-warning"></i>

                <div>

                    <h4 class="fw-bold mb-0">
                        Histórico de Atualizações
                    </h4>

                    <small class="text-muted">
                        Registros de alterações feitas pelo administrador
                    </small>

                </div>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead>

                        <tr>

                            <th>DATA</th>

                            <th>ANDAR</th>

                            <th>ANTES</th>

                            <th>ATUALIZAÇÃO</th>

                            <th>DEPOIS</th>

                            <th>AÇÃO</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if ($resultado_atualizacoes && mysqli_num_rows($resultado_atualizacoes) > 0) {

                        while ($registro = mysqli_fetch_assoc($resultado_atualizacoes)) {

                    ?>

                        <tr>

                            <td>

                                <?= date(
                                    'd/m/Y H:i',
                                    strtotime($registro['data_registro'])
                                ); ?>

                            </td>


                            <td>

                                <span class="badge bg-light text-dark">

                                    <?= htmlspecialchars($registro['andar']); ?>

                                </span>

                            </td>


                            <td>

                                <?= (int) $registro['quantidade_anterior']; ?>

                            </td>


                            <td>

                                <span class="badge bg-warning text-dark">

                                    <?= (int) $registro['quantidade_anterior']; ?>

                                    <i class="bi bi-arrow-right mx-1"></i>

                                    <?= (int) $registro['quantidade_nova']; ?>

                                </span>

                            </td>


                            <td>

                                <?= (int) $registro['quantidade_nova']; ?>

                            </td>


                            <td>

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-pencil-square me-1"></i>

                                    Atualização

                                </span>

                            </td>

                        </tr>

                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td colspan="6" class="text-muted py-4">

                                <i class="bi bi-info-circle me-1"></i>

                                Nenhuma atualização registrada.

                            </td>

                        </tr>

                    <?php

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =========================================
         BOTÃO VOLTAR
    ========================================= -->

  <div class="area-administrador">


    <a
            href="admin.php"
                     class="botao-voltar"
             >

                    <i class="bi bi-arrow-left"></i>

                    VOLTAR AO PAINEL

             </a>

        </div>


</div>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
