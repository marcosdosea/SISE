<div class="content-wrapper" style="min-height: auto;">
    <section class="content-header">
        <h1><?php echo $evento->getNomeEvento(); ?><small>Detalhes do Evento</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-widget widget-user">

                    <div class="widget-user-header bg-black" style="background: url('imagens/eventos/<?php echo $evento->getUrlImagem(); ?>') center center;">
                        <h3 class="widget-user-username"><?php echo $evento->getNomeEvento(); ?></h3>
                        <h3 class="widget-user-username"><?php echo "R$ ".$evento->getValorEvento(); ?></h3>
                    </div>
                    <div class="box-body"  style="">
                        <div class="row">
                            <div class="col-md-12">
                                <p><?php echo $evento->getDescricaoEvento(); ?></p>
                            </div>
                        </div>
                        <?php if ($filhos != null && sizeof($filhos > 0)) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Minicursos</h3>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Data</th>
                                            <th>Hora</th>
                                            <th>Valor</th>
                                        </tr>
                                        <?php for ($i = 0; $i < sizeof($filhos); $i++) { ?>
                                            <tr>
                                                <th><?php echo $filhos[$i]->getNomeEvento(); ?></th>
                                                <th><?php echo $filhos[$i]->getDescricaoEvento(); ?></th>
                                                <th>
                                                    <?php
                                                    $objDate = new DateTime($filhos[$i]->getDataInicioEvento());
                                                    $data = $objDate->format('d-m-Y');
                                                    $hora = $objDate->format('H:i');
                                                    echo $data;
                                                    ?>
                                                </th>
                                                <th><?php echo $hora; ?></th>
                                                <th>R$ <?php echo $filhos[$i]->getValorEvento(); ?></th>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="box-footer">
                        <div class="col-md-10">
                            <h5>Fim das inscrições: <?php echo date('d/m/Y', strtotime($evento->getFimInscricoesEvento())); ?></h5>
                        </div>
                        <div class="col-md-2">
                            <a href="detalhe?action=inscricao&evento=<?php echo $evento->getIdEvento(); ?>"> <button class="btn btn-block btn-warning bt-sm pull-right" type="button">INSCREVA-SE</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>