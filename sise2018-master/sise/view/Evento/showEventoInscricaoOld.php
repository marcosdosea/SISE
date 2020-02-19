<div class="content-wrapper" style="min-height: auto;">
    <section class="content-header">
        <h1><?php echo $evento->getNomeEvento(); ?><small>Inscrição</small></h1>
    </section>
    <section class="content" style="padding-bottom: 0;">
        <form action="inscricaoEvento?action=processarInscricao&evento=<?php echo $evento->getIdEvento(); ?>" method="post">
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
                                        <h3>Escolha os Minicursos</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-striped">

                                            <tr>
                                                <th></th>
                                                <th>Nome</th>
                                                <th>Descrição</th>
                                                <th>Data</th>
                                                <th>Hora</th>
                                                <th>Valor</th>
                                            </tr>


                                            <?php for ($i = 0; $i < sizeof($filhos); $i++) { ?>
                                                <tr>
                                                    <th><input type="checkbox" class="checkJS" name="<?php echo $filhos[$i]->getIdEvento(); ?>" onclick="atualizarValor(<?php echo $filhos[$i]->getIdEvento().','.$filhos[$i]->getValorEvento(); ?>,processarHorario())" value="<?php echo $filhos[$i]->getIdEvento(); ?>"></th>
                                                    <th style="font-weight: normal; "><?php echo $filhos[$i]->getNomeEvento(); ?></th>
                                                    <th style="font-weight: normal; "><?php echo $filhos[$i]->getDescricaoEvento(); ?></th>
                                                    <th style="font-weight: normal; ">
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
                                                    </th>
                                                    <th style="font-weight: normal; ">
                                                        <?php
                                                        echo "<span id='h". $filhos[$i]->getIdEvento() ."'>". $hora ."</span>";
                                                        ?>
                                                    </th>
                                                    <th style="font-weight: normal; ">R$ <?php echo $filhos[$i]->getValorEvento(); ?>,00</th>
                                                </tr>
                                            <?php } ?>


                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                            //VALOR TOTAL DO EVENTO COM MINI CURSOS
                            if ($valorTotalPossivel != 0) {
                                ?>

                                <div class="row" id="pagamento" style="<?php if ($evento->getValorEvento() == 0) echo "display: none;"?>">
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
                                                <input class="form-control" type="text" value="Boleto"
                                                       disabled="disabled">
                                            </div>
                                        </div>
                                        <?php
                                    }

                                    if ($pagamentoCartao) {
                                        ?>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <input name="pagamento" value="C" type="radio">
                                            </span>
                                                <input class="form-control" type="text" value="Cartão de Crédito"
                                                       disabled="disabled">
                                            </div>
                                        </div>
                                        <?php
                                    }
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
                                <br>
                            <?php } ?>
                        </div>

                        <div class="box-footer">
                            <div class="col-md-10">
                                <h5>Fim das inscrições: <?php echo date('d/m/Y', strtotime($evento->getFimInscricoesEvento())); ?></h5>
                            </div>
                            <div class="col-md-2">
                                <button id="enviar" type="submit" class="btn btn-block btn-warning bt-sm pull-right" type="button">Confirmar Inscrição</button>
                            </div>
                            <div class="col-md-12">
                                <div id="mensagem" class="callout callout-warning" style="display: none;">Você não pode se inscrever em duas programações que acontecerrão ao mesmo tempo. Por favor, revise suas esolhas.</div>
                            </div>
                            <input type="hidden" id="valorFinal" value="<?php echo $evento->getValorEvento(); ?>">
                            <input type="hidden" id="qntdParcelasPermitidas" value="<?php echo $evento->getQntdParcelasPermitidas(); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
