<?php
/**
 * Autor: John Hed
 * Date: 15/07/2017
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="height: auto">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-size: 45px">
            Certificado
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                <a href="certificado?action=cad">
                    <div class="info-box bg-green">
                    <span class="info-box-icon" style="padding-top: 20px">
              <i class="fa fa-file-text" aria-hidden="true"></i>
                    </span>
                        <div class="info-box-content">
                        <span class="info-box-number">
                            <h3>Cadastrar</h3>
                        </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <a href="certificado?action=list">
                    <div class="info-box bg-blue">
                    <span class="info-box-icon" style="padding-top: 20px">
                        <i class="fa fa-search" aria-hidden="true"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number"><h3>Consultar</h3></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
            </div>

        </div>
        <!-- /.row -->
        <!--Tabela dos últimos certificados-->

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ultimos Eventos</h3>

              <!--  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table">
                    <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nome Evento</th>
                        <th>Progresso</th>
                        <th style="width: 80px"></th>
                    </tr>
                    <?php
                    $status = null;
                    $progress = null;
                    $progressValor = null;
                    $bg = null;

                    for ($i = 0; $i < sizeOf($eventos); $i++) {
                        if ($certEventoStatus[$i] == '0') {
                            $status = 'Certificado não Cadastrado';
                            $progress = 'progress-bar-danger';
                            $progressValor = '2';
                            $bg = 'label-danger';
                        } else if ($certEventoStatus[$i] == '1') {
                            $status = 'Cadastrado, mas não Liberado';
                            $progress = 'progress-bar-yellow';
                            $progressValor = '50';
                            $bg = 'label-warning';
                        } else {
                            $status = 'Cadastrado e Liberado';
                            $progress = 'progress-bar-green';
                            $progressValor = '100';
                            $bg = 'label-success';
                        }

                        ?>
                        <tr>
                            <td><?= $i+1; ?>.</td>
                            <td><?=$eventos[$i]->getNomeEvento();?></td>

                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar <?= $progress ?>"
                                         style="width: <?= $progressValor; ?>%"></div>
                                </div>
                            </td>
                            <td><span class="label  <?= $bg; ?>">
                                    <?= $status ?>
                                </span></td>
                        </tr>

                    <?php } ?>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
