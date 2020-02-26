<div class="content-wrapper">
    <section class="content-header">
        <h1>Eventos<small>Meus Eventos</small></h1>
    </section>
    <section class="content" style="padding-bottom: 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid" style="margin-bottom: 0;">
                    <div class="box-header with-border">
                        <h3 class="box-title">Eventos Inscritos</h3>
                    </div>
                    <!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<?php for ($i = 0; $i < 1; $i++) { ?>
                                <a href="detalhe?evento=<?php echo $eventosInscritos[$i]->getIdEvento(); ?>">
                                    <div class="col-md-4 ">
                                        <div class="box box-widget widget-user caixa-evento">
                                            <img class='img-responsive' src='imagens/eventos/<?php echo $eventosInscritos[$i]->getUrlImagem(); ?>'>
                                            <h1 style="font-size: 18px; margin: 10px 0px 0px 5px; " class="uppercase"><?php echo $eventosInscritos[$i]->getNomeEvento(); ?></h1>
                                            <div class="row info-evento">
                                                <div class="col-md-2 col-sm-2 col-xs-10 caixa-calendario">
                                                    <div class="mes-calendario">
                                                        <?php
                                                        setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
                                                        date_default_timezone_set('America/Sao_Paulo');
                                                        echo date('M', strtotime($eventosInscritos[$i]->getDataInicioEvento()));
                                                        ?>
                                                    </div>
                                                    <div class="dia-calendario"> <?php echo date('d', strtotime($eventosInscritos[$i]->getDataInicioEvento())) ?></div>
                                                </div>
                                                <div class="col-md-10 col-sm-10 col-xs-10 caixa-local-evento">
                                                    <div class="line uppercase">-</div>
                                                    <div class="line">
                                                        <i><?php echo date('H', strtotime($eventosInscritos[$i]->getDataInicioEvento()))."h".date('i', strtotime($eventosInscritos[$i]->getDataInicioEvento())) ?></i>
                                                        <i>, -</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
							<?php } ?>

						</div>	
	                </div>
				</div>
            </div>
        </div>
    </section>
</div>
