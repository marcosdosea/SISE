<div class="box-body" >
    <?php
        $linhas = ((int) (sizeof($eventosAbertos) / 3));
        if (sizeof($eventosAbertos)%3 > 0) $linhas++;

        $countEvento = 1;
        for ($l = 0; $l<$linhas; $l++) {
            echo '<div class="row">';

            for ($i = $countEvento; $i < $countEvento+3; $i++) {
                if($i <= sizeof($eventosAbertos)) { ?>
                    <a href="detalhe?evento=<?php echo $eventosAbertos[$i - 1]->getIdEvento(); ?>">
                        <div class="col-md-4">
                            <div class="box box-widget widget-user caixa-evento">
                                <img class='img-responsive'
                                     src='imagens/eventos/<?php echo $eventosAbertos[$i - 1]->getUrlImagem(); ?>'>
                                <h1 style="font-size: 18px; margin: 10px 0px 0px 5px; "
                                    class="uppercase"><?php echo $eventosAbertos[$i - 1]->getNomeEvento(); ?></h1>
                                <div class="row info-evento">
                                    <div class="col-md-2 col-sm-2 col-xs-10 caixa-calendario">
                                        <div class="mes-calendario">
                                            <?php
                                            setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
                                            date_default_timezone_set('America/Sao_Paulo');
                                            echo date('M', strtotime($eventosAbertos[$i - 1]->getDataInicioEvento()));
                                            ?>
                                        </div>
                                        <div class="dia-calendario"> <?php echo date('d', strtotime($eventosAbertos[$i - 1]->getDataInicioEvento())) ?></div>
                                    </div>
                                    <div class="col-md-10 col-sm-10 col-xs-10 caixa-local-evento">
                                        <div class="line uppercase"><!-----></div>
                                        <div class="line">
                                            <i><?php echo date('H', strtotime($eventosAbertos[$i - 1]->getDataInicioEvento())) . "h" . date('i', strtotime($eventosAbertos[$i - 1]->getDataInicioEvento())) ?></i>
                                            <!--<i>, -</i>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            }
            $countEvento += 3;
            echo '</div>';
        }
        ?>
    </div>
</div>
