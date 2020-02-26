<?php
    /**
     * Autor: Daniel Lima
     * Date: 10/03/2017
     */

    require_once '../gerenciador/GerenciadorUsuario.php';
    require_once '../model/Usuario.php';
    require_once '../inc/funcoes.php';
    require_once '../inc/email/email.php';

    //$_SESSION['status'] -> recebe o status do login do usuario atual
    //0 -> desativado
    //1-> ativado

    // Obtendo a ação a ser desempenha pela controladora.
    $action = 'showLogin';
    $pagina = 'Login';

    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];

    // Conjunto de ações a depender da ação.
    switch($action){

        // Permite a chamada da tela de login
        case 'showLogin':
            session_start();
            if(isset($_SESSION['codigo']))
                header('Location: home');

            $pagina = 'Login';

            require_once '../view/InicioDaPagina/inicioDaPagina.php';

            require_once '../view/Login/showLogin.php';

            echo '<script type="text/javascript" src="inc/js/validacaoCPFeSENHA.js"></script>';

            require_once '../view/FimDaPagina/fimDaPagina.php';
            break;

        // Permite a validação dos dados
        case 'validar':
            if (!isset($_POST['cpf']) && !isset($_POST['senha'])) {
                header('Location: login');
            } else {
                $gerenciadoraUsuario = new GerenciadorUsuario();
                $usuario = $gerenciadoraUsuario->buscarLogin($_POST['cpf'],criptografaSenha($_POST['senha']));
                if ($usuario == null) {
                    header('Location: login?mensagem=erro');
                } else {
                    session_start();
                    $usuario = $gerenciadoraUsuario->obterPeloCPF($_POST['cpf']);
                    $_SESSION['codigo'] = $usuario->getIdUsuario();
                    $_SESSION['nome'] = $usuario->getNomeUsuario();
                    $_SESSION['cpf'] = $usuario->getCpfUsuario();
                    $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario();

                    header('Location: home');
                }
            }

            break;

        case 'logout':
            session_start();
            unset($_SESSION['codigo']);
            unset($_SESSION['nome']);
            unset($_SESSION['cpf']);
            unset($_SESSION['tipoUsuario']);
            unset($_SESSION['foto']);
            $_SESSION = array();
            session_destroy();
            header('Location: login');

            break;
    }
?>