<?php
    /**
     * Autor: Daniel e Marcos
     * Date: 23/11/2019
     */

     session_start(); 
     // Serve para chamar corretamente require_once '../inc/seguranca.php';

     // Requerer gerenciadoras
     require_once '../gerenciador/GerenciadorFrequencia.php';
     require_once '../gerenciador/GerenciadorEvento.php';

     // Requerer models
     require_once '../model/Frequencia.php';

     $action = 'index';
     
     if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];

    // Tomar decisão apos requisicao action
    switch($action) {

        case 'index':
            require_once '../inc/seguranca.php';

            require_once '../view/InicioDaPagina/inicioDaPagina.php';
            require_once '../controller/MenuController.php';

            // Requerer eventos daquele responsavel
            require_once '../persistencia/PersistenciaAdminEvento.php';
            validaTipoUsuario(ORGANIZADOR);

            $gerenciadorEvento = new GerenciadorEvento();

            $eventos = $gerenciadorEvento->listarEventosResponsavel($_SESSION['codigo']);

            require_once '../view/Frequencia/regFrequencia.php';

            require_once '../view/Footer/footer.php';
            require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
        // ---------------------------------------------------------
        case 'buscaInscritos':

            require_once '../inc/seguranca.php';

            require_once '../view/InicioDaPagina/inicioDaPagina.php';
            require_once '../controller/MenuController.php';

            // Requerer eventos daquele responsavel
            require_once '../persistencia/PersistenciaAdminEvento.php';
            validaTipoUsuario(ORGANIZADOR);

            $gerenciadorEvento = new GerenciadorEvento();

            $eventos = $gerenciadorEvento->listarEventosResponsavel($_SESSION['codigo']);

            require_once '../view/Frequencia/regFrequencia.php';
            
            if(isset($_POST["Evento"])) {

                $inscritosEvento = new GerenciadorInscricaoEvento();
                $inscritos = $inscritosEvento->obterInscritosNoEvento($_POST["Evento"]);
            
                var_dump($inscritos);
            }

            require_once '../view/Footer/footer.php';
            require_once '../view/FimDaPagina/fimDaPagina.php';

        break;

    }

?>