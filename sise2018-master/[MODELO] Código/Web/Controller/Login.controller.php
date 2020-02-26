<?php

// Iniciando sessão e importando arquivos necessários.
session_start();
require_once '../../Business/GerenciadorUsuario.class.php';
require_once '../../Model/Usuario.class.php';
require_once '../inc/funcoes.inc.php';

// Obtendo a ação a ser desempenha pela controladora.
$action = 'show_login';
if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];

// Instanciando a gerenciadora de usuários.
$gerenciadoraUsuario = new GerenciadorUsuario();

// Conjunto de ações a depender da ação.
switch ($action) {

    // Realizar o processo de autenticação.
    case 'autentic':
        if ($gerenciadoraUsuario->validaUsuario($_POST['login'], criptografaSenha($_POST['senha']))) {
            $usuario = $gerenciadoraUsuario->obterPeloCPF($_POST['login']);
            $_SESSION['codigo'] = $usuario->getCodigo();
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['sobrenome'] = $usuario->getSobrenome();
            $_SESSION['cpf'] = $usuario->getCpf();
            $_SESSION['matricula'] = $usuario->getMatricula();
            $_SESSION['status'] = $usuario->getStatus();
            $_SESSION['perfilAcesso'] = $usuario->getPerfilAcesso()->getCodigo();
            $_SESSION['email'] = $usuario->getEmail();

            // Verifica se o mesmo possui permissão de 'Administrador' ou 'Chefe de Unidade'.
            $_SESSION['isPerfGerenc'] = $gerenciadoraUsuario->possuiPermissao($_SESSION['perfilAcesso'], true);

            // Verifica se o mesmo possui permissão de 'Edição' ou 'Consulta'.
            $_SESSION['permisEdicao'] = $gerenciadoraUsuario->possuiPermissao($_SESSION['perfilAcesso']);

            if (!empty($usuario->getFoto())) {
                $_SESSION['foto'] = $usuario->getFoto();
            } else {
                $_SESSION['foto'] = 'avatar_null.jpg';
            }
            header("Location: home");
        } else {
            $mensagem = "Login e/ou Senha inválidos.<br>Tente novamente!";
            $erro = true;
            $cpf = $_POST['login'];
            include_once '../View/Login/form_login.php';
        }
        break;

    // Exibir a tela de login.
    case 'show_login':
        if(isset($_SESSION['codigo']))
            header ("Location: Home");
        $erro = false;
        include_once '../View/Login/form_login.php';
        break;

    // Efetuar logout.
    case 'logout':
        unset($_SESSION['codigo']);
        unset($_SESSION['nome']);
        unset($_SESSION['sobrenome']);
        unset($_SESSION['cpf']);
        unset($_SESSION['matricula']);
        unset($_SESSION['status']);
        unset($_SESSION['perfilAcesso']);
        unset($_SESSION['isPerfGerenc']);
        unset($_SESSION['permisEdicao']);
        unset($_SESSION['foto']);
        unset($_SESSION['email']);
        $_SESSION = array();
        session_destroy();
        header("Location: login");
        break;

    case 'show_rec_senha':
        $descricao = 'Recuperar Senha';
        $pagina = "";
        $titulo = "SYSITAC";
        $mostrarMensagem = false;
        include_once '../View/Login/form_rec_senha_usuario.php';
        break;

    case 'rec_senha':
        
        $descricao = 'Recuperar Senha';
        $titulo = "SYSITAC";
        $mostrarMensagem = true;
        $pagina = "";
        if ($gerenciadoraUsuario->verificarEmail($_POST['email'], $_POST['cpf'])) {

            $usuario = $gerenciadoraUsuario->obterPeloCPF($_POST['cpf']);
            $novaSenha = randomPassword();
            $usuario->setSenha(criptografaSenha($novaSenha));
            if ($gerenciadoraUsuario->atualizarSenha($usuario)) {
                $isValido = enviarEmailRecSenha($_POST['email'], $novaSenha);

                if ($isValido) {
                    $panel = "success";
                    $mensagem = "Senha recuperada com sucesso! Verifique sua caixa de e-mail";
                } else {
                    $panel = "danger";
                    $mensagem = "Falha ao enviar o e-mail com sua nova senha, contate administrador!";
                }
            } else {
                $panel = "danger";
                $mensagem = "Senha não recuperada, tente novamente mais tarde!";
            }
        } else {
            $panel = "danger";
            $mensagem = "Email não pertence ao CPF informado!";
            }

        include_once '../View/Login/form_rec_senha_usuario.php';

        break;
}
?>