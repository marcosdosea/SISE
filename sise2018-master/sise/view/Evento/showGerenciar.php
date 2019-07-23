<?php
/**
 * Autor: Daniel Lima
 * Date: 06/01/2018
 */
?>

<div class="content-wrapper" style="height: auto">

    <!-- Título -->
    <section class="content-header">
        <h1>Eventos<small>Gerenciar</small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">
                            <?php if($qntdEventos > 0) { ?>
                            <a href="evento?action=showCadastrar">
                                <!-- Box que delimita o botao -->
                                <div class="col-lg-4 col-xs-6">
                                    <!-- Botao em si -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <p>Você possui </p>
                                            <h3> <?php echo $qntdEventos ?> Eventos!</h3>
                                            <p>Cadastre mais eventos!</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <div class="small-box-footer">Clique para cadastrar <i class="fa fa-arrow-circle-right"></i></div>
                                    </div>
                                </div>
                            </a>
                            <?php } else { ?>
                            <a href="evento?action=cadastrar">
                                <!-- Box que delimita o botao -->
                                <div class="col-lg-4 col-xs-6">
                                    <!-- Botao em si -->
                                    <div class="small-box bg-aqua">
                                        <div class="inner">
                                            <p>Você tem </p>
                                            <h3>0 Eventos!</h3>
                                            <p>Cadastre seu primeiro evento!</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <div class="small-box-footer">Clique para cadastrar<i class="fa fa-arrow-circle-right"></i></div>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <?php if ($eventos != null) { ?>
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Sigla</th>
                                        <th>Nome</th>
                                        <th>Situação</th>
                                        <th></th>
                                    </tr>
                                    <?php foreach ($eventos as $evento) { $status = $gerenciadoraEvento->statusEvento($evento); ?>
                                        <tr>
                                            <td><?= $evento->getSiglaEvento()?></td>
                                            <td><?= $evento->getNomeEvento() ?></td>
                                            <td>&nbsp;
                                                <span class="label <?= $status["label"] ?>"><?= $status["status"] ?></span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-default" title="Gerenciar esse evento"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <a href="#" class="btn btn-facebook" title="Publicar no facebook"><i class="fa fa-facebook"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
