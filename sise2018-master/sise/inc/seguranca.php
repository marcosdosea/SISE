<?php

    define("OUVINTE",0);
    define("ORGANIZADOR",1);
    define("ADMIN",2);
    define("ROOTER",3);

    // Se o usuário não estiver logado ou se o mesmo estiver desativado, força o usuário a efetuar login.
    if(!isset($_SESSION['codigo'])){
        header("Location: login");
        exit();
    }

    //Atualiza o nível de permissão do usuário
    require_once '../gerenciador/GerenciadorUsuario.php';
    $gerenciadoraUsuario = new GerenciadorUsuario();
    if (($usuario = $gerenciadoraUsuario->obter($_SESSION['codigo'])) != null)
        $_SESSION['tipoUsuario'] = $usuario->getTipoUsuario();

    function getTipoUsuarioSessao(){
        switch ($_SESSION['tipoUsuario']) {
            case 'OUVINTE':
                return OUVINTE;
                break;
            case 'ORGANIZADOR':
                return ORGANIZADOR;
                break;
            case 'ADMIN':
                return ADMIN;
                break;
            case 'ROOTER':
                return ROOTER;
                break;
            default:
                return -1;
        }
    }

    function validaTipoUsuario($tipoUsuario) {
        if(getTipoUsuarioSessao() < $tipoUsuario){
            header("Location: home");
            exit();
        }
    }

    function temPermissao($nivelAcesso){
        return (getTipoUsuarioSessao() >= $nivelAcesso);
    }
?>