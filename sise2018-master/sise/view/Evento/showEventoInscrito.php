<div class="content-wrapper" style="min-height: auto;">
    <section class="content-header">
        <h1><?php echo $evento->getNomeEvento(); ?><small>Detalhes da Inscrição</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-black" style="background: url('imagens/eventos/<?php echo $evento->getUrlImagem(); ?>') center center;">
                        <h3 class="widget-user-username"><?php echo $evento->getNomeEvento(); ?></h3>
                        <!--<h3 class="widget-user-username"><?php ?></h3>-->
                    </div>
                    <div class="box-body">
                        <!-- botoes para pagamento com url do boleto e situação do mesmo -->
                        <?php if ($parcelas != null && sizeof($parcelas) > 0) { ?>
                            <div class="row">

                                <?php
                                    if (isset($_GET['msg'])) {
                                        if ($_GET['msg'] == 'erroCancelar') { ?>
                                            <div class="col-md-12">
                                                <div class="callout callout-warning">
                                                    <h5>Você já pagou por esse evento e para sua segurança não removemos a sua inscrição.</h5>
                                                    <h5>Por favor entre em contato com o suporte! ( projetos@itatechjr.com.br )</h5>
                                                </div>
                                            </div>
                                        <?php }

                                        if ($_GET['msg'] == 'hora') { ?>
                                            <div class="col-md-12">
                                                <div class="callout callout-warning">
                                                    <h4>Você não possui horas suficientes.</h4>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                ?>

                                <div class="col-md-12">
                                    <h4>Pagamento</h4>
                                </div>
                                <?php for ($i=0; $i < sizeof($parcelas); $i++) { ?>
                                    <div class="col-md-2">
                                        <?php if ($cobranca[$i]['status'] == 'PENDING') { ?>
                                            <i class="fa fa-circle-o text-red"></i>
                                            <span>Pendente</span>
                                        <?php

                                        } else if ($cobranca[$i]['status'] == 'RECEIVED') {
                                        ?>
                                            <i class="fa fa-circle-o text-green"></i>
                                            <span>Pago</span>
                                        <?php
                                        }
                                        ?>
                                        <a href="<?php echo $cobranca[$i]['bankSlipUrl']; ?>" target="_blank"><button <?php if($evento->getDataInicioEvento() <= date('Y-m-d H:i:s:u')) echo 'disabled';?> class="btn btn-block btn-warning"><?php if (sizeof($parcelas) == 1) echo 'Abrir Boleto'; else echo 'Boleto - Parcela ' . ($i+1); ?></button></a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!is_null($certificado )) { ?> <!--Botao emitir certificado so aparece quando certificado estiver pronto e liberado-->
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Certificado</h4>
                                </div>
                                <div class="col-md-2">
                                    <a href="certificado?action=emitir&idEvento=<?php echo $evento->getIdEvento(); ?>"
                                       target="_blank">
                                        <button class="btn btn-block btn-warning"> Emitir Certificado</button>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- vizualizar mini cursos marcados -->
                        <?php if ($minicursos != null && sizeof($minicursos > 0)) { ?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Minicursos Inscritos</h4>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th><?php if (!is_null($inscricoesMinicursos)) { ?>
                                                    <!--Opção certificado so aparece quando certificado estiver pronto e liberado-->
                                                        Certificado
                                                <?php } ?>
                                            </th>
                                        </tr>
                                        <?php for ($i = 0; $i < sizeof($minicursos); $i++) { ?>
                                            <tr>
                                                <th><?php echo $minicursos[$i]->getNomeEvento(); ?></th>
                                                <th><?php echo $minicursos[$i]->getDescricaoEvento(); ?></th>
                                                <th>
                                                    <?php
                                                    $objDate = new DateTime($minicursos[$i]->getDataInicioEvento());
                                                    $data = $objDate->format('d-m-Y');
                                                    $hora = $objDate->format('H:i');
                                                    echo $data;
                                                    ?>
                                                </th>
                                                <th><?php echo $hora; ?></th>
                                                <th><?php if (!is_null($inscricoesMinicursos)) { ?> <!--Botao emitir certificado so aparece quando certificado estiver pronto e liberado-->
                                                        <a href="certificado?action=emitir&idEvento=<?php echo $inscricoesMinicursos[$i]->getIdEvento(); ?>"
                                                           target="_blank">
                                                           <button class="btn btn-block btn-warning"> Emitir Certificado</button>
                                                        </a>
                                                    <?php } ?></th>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        <!-- descrição do evento -->
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Descrição do Evento</h4>
                                <p><?php echo $evento->getDescricaoEvento(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-10">
                            <h5>Data do Evento: <?php echo date('d/m/Y', strtotime($evento->getDataInicioEvento())); ?></h5>
                        </div>
                        <div class="col-md-2">
                            <!-- TESTE -->
                            <?php

                            ?>
                            <!-- Cancelar inscrição -->
                            <?php
                            if($evento->getFimInscricoesEvento() > date('Y-m-d H:i:s:u')){
                                echo '<button type="button" class="btn btn-block btn-warning bt-sm pull-right" data-toggle="modal" data-target="#myModal">
                                          Cancelar inscrição
                                      </button>';
                            }
                            ?>
                            <!-- Modal (Cancelar inscrição) -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Cancelar inscrição</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Realmente deseja cancelar inscrição no evento?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                            <a href="inscricaoEvento?action=cancelarInscricao&evento=<?php echo $evento->getIdEvento(); ?>">
                                                <button type="button" class="btn btn-primary">Sim</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>