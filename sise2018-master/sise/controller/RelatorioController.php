<?php

    require_once '../gerenciador/GerenciadorEvento.php';
    require_once '../gerenciador/GerenciadorInscricaoEvento.php';
    require_once '../gerenciador/GerenciadorPagamento.php';
    require_once '../gerenciador/GerenciadorUsuario.php';
    require_once '../gerenciador/GerenciadorParcela.php';
    require_once '../model/Evento.php';
    require_once '../model/InscricaoEvento.php';
    require_once '../model/Pagamento.php';
    require_once '../model/Usuario.php';
    require_once '../model/Parcela.php';
    require_once "../gerenciador/Asaas/CobrancaAsaas.php";

    if (isset($_GET['evento'])) {
        //require_once '../view/InicioDaPagina/inicioDaPagina.php';
        echo '<meta charset="utf-8">';
        $idEvento = $_GET['evento'];

        $gerenciadoraEvento = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();
        $gerenciadoraPagamento = new GerenciadorPagamento();
        $gerenciadoraParcela = new GerenciadorParcela();

        $evento = $gerenciadoraEvento->obter($idEvento);
        echo "<h2>Relatório - " . $evento->getNomeEvento() . "</h2>";
        $miniCursos = $gerenciadoraEvento->obterMiniCursos($evento->getIdEvento());

        echo '<h3>Inscritos - Evento Principal'. '</h3>';
        $inscritos = $gerenciadoraInscricaoEvento->obterInscritosNoEvento($evento->getIdEvento());
        foreach ($inscritos as $pessoa){
            echo utf8_encode($pessoa->getNomeUsuario()) . ' - '. $pessoa->getCpfUsuario();
            if ($evento->getValorEvento() > 0) {
                $pagamentoEvento = $gerenciadoraPagamento->obterPorUsuarioEvento($pessoa->getIdUsuario(),$evento->getIdEvento());
				$parcelasEvento = $gerenciadoraParcela->obterTodosPorPagamento($pagamentoEvento->getIdPagamento());
				$idParcelaAsaas = $parcelasEvento[0]->getIdParcelaAsaas();
                $cobrancaEvento = json_decode(getCobranca($idParcelaAsaas),true);
                echo ' - Parcela ' . ($z+1) . ' ( '. $cobrancaEvento['status'] . ' - Venc. ' . $cobrancaEvento['dueDate'] . ' )    ';
            }
            echo '<br>';
        }
        echo '<br><br>';
        for ($i =0; i<sizeof($miniCursos); $i++) {

            $miniCurso = $miniCursos[$i];
            echo '<h3>Inscritos - ' . $miniCurso->getNomeEvento() . '</h3>';
            $inscritosMC = $gerenciadoraInscricaoEvento->obterInscritosNoEvento($miniCurso->getIdEvento());
            foreach ($inscritosMC as $pessoa){
                echo $pessoa->getNomeUsuario() . ' - '. $pessoa->getCpfUsuario();
                if ($miniCurso->getValorEvento() > 0) {
                    $pagamento = $gerenciadoraPagamento->obterPorUsuarioEvento($pessoa->getIdUsuario(),$evento->getIdEvento());
                    $parcelas = $gerenciadoraParcela->obterTodosPorPagamento($pagamento->getIdPagamento());
                    echo ' - Situação de pagamento: ';
                        for ($z = 0; $z < sizeof($parcelas); $z++){
                            $idParcelaAsaas = $parcelas[$z]->getIdParcelaAsaas();
                            $cobranca = json_decode(getCobranca($idParcelaAsaas),true);
                            echo 'Parcela ' . ($z+1) . ' ( '. $cobranca['status'] . ' - Venc. ' . $cobranca['dueDate'] . ' )    ';
                        }
                    echo  '<br>';
                }

            }

        }


        //require_once '../view/FimDaPagina/fimDaPagina.php';
    }