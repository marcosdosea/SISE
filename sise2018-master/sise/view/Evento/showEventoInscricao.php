<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $evento->getNomeEvento(); ?><small>Inscrição</small></h1>
    </section>
    <section class="content" >


        <div class="row">

            <!--BLoco detalhes do Evento-->
            <div class="col-md-6">

                <form action="inscricaoEvento?action=processarInscricao&evento=<?=$evento->getIdEvento(); ?>" method="post">

                <?php
                //VALOR TOTAL DO EVENTO COM MINI CURSOS
                if ($valorTotalPossivel != 0) {
                    ?>

                    <div  id="pagamento" style="<?php if ($evento->getValorEvento() == 0) echo "display: none;"?>">
                        <div class="col-md-12">
                            <h3>Pagamento</h3>
                        </div>
                        <?php
                        if ($pagamentoBoleto) {
                            ?>
                            <div class="col-md-3">
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <input id="radioPagamento" name="pagamento" value="B" type="radio" <?php if ($evento->getValorEvento() > 0) echo 'required';?> >
                                        </span>
                                    <input class="form-control" type="text" value="Boleto" disabled="disabled">
                                </div>
                            </div>
                            <?php
                        }

                        //if ($pagamentoCartao) {
                            ?>
                            <div class="col-md-3">
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <input id="radioPagamento" name="pagamento" value="C" type="radio">
                                            </span>
                                    <input class="form-control" type="text" value="Cartão de Crédito" disabled="disabled">
                                </div>
                            </div>
                            <?php
                        //}
                        ?>
                        <div class="col-md-3">
                            <select id="comboParcelas" class="form-control" name="qntdParcela" required>
                                <?php for ($i = 1; $i <= $evento->getQntdParcelasPermitidas(); $i++) { ?>
                                    <option value="<?php echo $i; ?>" name="opcoes">
                                        <?php echo $i . " x R$ <span id='". $i ."' name='optionSpan'>" . number_format($evento->getValorEvento() / $i, 2) . "</span>"; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>


                <div class="box-footer">
                    <div class="col-md-8">
                        <h5>Fim das inscrições: <?php echo date('d/m/Y', strtotime($evento->getFimInscricoesEvento())); ?></h5>
                    </div>
                    <div class="col-md-4">
                        <button id="enviar" type="submit" class="btn btn-block btn-facebook bt-sm pull-right" type="button">Confirmar Inscrição</button>
                    </div>
                    <!--<div class="col-md-12">
                        <div id="mensagem" class="callout callout-warning" style="display: block;">
                            Você não pode se inscrever em duas programações que acontecerrão ao mesmo tempo.
                            Por favor, revise suas esolhas.
                        </div>
                    </div>-->
                    <input type="hidden" id="valorFinal" value="<?php echo $evento->getValorEvento(); ?>">
                    <input type="hidden" id="qntdParcelasPermitidas" value="<?php echo $evento->getQntdParcelasPermitidas(); ?>">
                </div>

<!--Pagamento-->
                <!-- Box Comment -->
                <div class="box box-widget">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <img class="img-responsive pad" src="imagens/eventos/<?=$evento->getUrlImagem();?>" alt="Photo" width="100%">

                        <p><?=$evento->getDescricaoEvento(); ?></p>
                        </div>

                </div>
                <!-- /.box -->
            </div>
            <!-- Nibu Cursos-->
            <div class="col-md-6">
                <!-- Box Comment -->
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <h2 class="box-title">Escolha os Minicursos</h2>
                    </div>
                    <?php if ($filhos != null && sizeof($filhos > 0)) {
                        for ($i = 0; $i < sizeof($filhos); $i++) {
                        ?>
                       <div class="box-body">
                           <div class="row">
                               <div class="col-sm-1">
                                   <input type="checkbox" class="checkJS" name="<?php echo $filhos[$i]->getIdEvento(); ?>"
                                          onclick="atualizarValor(<?php echo $filhos[$i]->getIdEvento().','.$filhos[$i]->getValorEvento(); ?>,processarHorario())"
                                          value="<?php echo $filhos[$i]->getIdEvento(); ?>" style="margin-top: 20px" >
                               </div>

                           <div class="col-md-11">

                               <div class="info-box" style="overflow: hidden;border: 1px solid #c9cccf">
                                    <span class="info-box-icon"  style="padding-top: 20px;">
                                        <i class="fa fa-bookmark-o"></i>
                                    </span>

                                   <div class="info-box-content">
                                       <span class="box-title">
                                           <strong>
                                           <?=$filhos[$i]->getNomeEvento(); ?>
                                           </strong>
                                       </span>
                                       <span class="info-box-number">
                                           R$ <?php echo $filhos[$i]->getValorEvento(); ?>,00
                                            <?php
                                            $objDate = new DateTime($filhos[$i]->getDataInicioEvento());
                                            $objDateFinal = new DateTime($filhos[$i]->getDataFimEvento());
                                            $data = $objDate->format('d/m');
                                            $dataFinal = $objDateFinal->format('d/m');
                                            $hora = $objDate->format('H:i');
                                            if($data == $dataFinal){
                                                echo "<span id='d". $filhos[$i]->getIdEvento() ."'>".$data."</span>";
                                            }else{
                                                echo "<span id='d". $filhos[$i]->getIdEvento() ."'>".$data." e ".$dataFinal."</span>";
                                            };
                                            ?>
                                       </span>


                                       <span class="">
                   <?php echo $filhos[$i]->getDescricaoEvento(); ?>
                  </span>
                                   </div>
                                   <!-- /.info-box-content -->
                               </div>
                               <!-- /.info-box -->
                           </div>
                           </div><!--row-->
                       </div><!--Box-body-->
<?php }?>
                        <div class="row">



                        </div>
                    <?php } ?>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!------------------------------------------------------------------------------------------------>

  </form>
    </section>
</div>


