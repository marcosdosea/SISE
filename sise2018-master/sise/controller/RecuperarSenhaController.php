<?php
/**
 * Autor: Gabriel Santana
 * Date: 06/09/2017
 * Time: 15:12
 */

    // Requerimento das Gerenciadoras
    require_once '../gerenciador/GerenciadorRecuperarSenha.php';
    require_once '../gerenciador/GerenciadorUsuario.php';

    // Requerimento das Models
    require_once '../model/RecuperarSenha.php';
    require_once '../model/Usuario.php';

    // Requerimento das Funções
    require_once '../inc/funcoes.php';
    require_once '../inc/email/email.php';


    // Obtendo a ação a ser desempenha pela controladora.
    $action = 'emitirRecuperacao';
    $pagina = 'Recuperar Senha';
    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];



switch($action) {
    // Permite recuperar a senha do USUARIO.
    case 'emitirRecuperacao':
        // Requires para o caso
        require_once '../view/InicioDaPagina/inicioDaPagina.php';

        // Inicio do case EmitirRecuperação
        if (!isset ($_POST['cpf']))
            header("Location: login");
         elseif (isset($_POST['cpf']))
        {
            // Objetos das gerenciadoras
            $gerenciadoraRecuperarSenha = new GerenciadorRecuperarSenha();
            $gerenciadoraUsuario = new GerenciadorUsuario();


            // Obtendo o usuario pelo CPF
            $usuario = $gerenciadoraUsuario->obterPeloCPF($_POST['cpf']);

            // Redirecionamento caso usuario seja nulo
            if(is_null($usuario))
                header("Location: login?mensagem=userInvalid");
            else {
                if ($usuario->getEmailUsuario() != $_POST['email']){
                    header("Location: login?mensagem=userInvalid");
                } else {
                    $recuSenha = $gerenciadoraRecuperarSenha->obterValidoByIdUser($usuario->getIdUsuario());

                    if (!is_null($recuSenha))
                        header("Location: login?mensagem=recEncontrada");
                    else {
                            // Gerando token
                            $token = randString(100);

                            // Alimentando a Requisicao
                            $novaRequisicao = new RecuperarSenha();
                            $novaRequisicao->setIdUsuario($usuario->getIdUsuario());
                            $novaRequisicao->setUtilizado('N');
                            $novaRequisicao->setToken($token);

                            //$gerenciadoraRecuperarSenha->adicionar($novaRequisicao);

                        $email = $usuario->getEmailUsuario();

                        $mensagem= "Você solicitou uma alteração de senha pelo SISE. <br>
                            <a href='http://www.sise.itatechjr.com.br/recupSenha?action=showRecuperacao&email={$email}&token={$token}'>Clique aqui para alterar sua senha!</a>
                        ";
                        $msg = "msg teste";
                            if (enviarEmail($msg, $email))
                                header("Location: login?mensagem=sucessoRec");
                            else
                                header("Location: login?mensagem=erroEmail");
                        }
                    }
                }
        }
        break;

    // Action para preenchimento da Nova senha do USUARIO.
    case 'showRecuperacao':
        // Objetos das Gerenciadoras
        $gerenciadoraRecuperarSenha = new GerenciadorRecuperarSenha();
        $gerenciadoraUsuario = new GerenciadorUsuario();

        // Recebendo o Email e o Token da URL.
        $emailURL = $_GET['email'];
        $tokenURL = $_GET['token'];

        // Recebendo as informações do Usuario a partir do EMAIL da URL.
        $usuario = $gerenciadoraUsuario->obterByEmail($emailURL);

        // Recebendo o token do banco para validação.
        $recupSenha = $gerenciadoraRecuperarSenha->obterValidoByIdUser($usuario->getIdUsuario());

        // Chegando se o token é valido
        if (is_null($recupSenha))
            header("Location: login?invalidReq");

        // Testando Usuario pelo email, caso NULO volta para a home.
        if(is_null($usuario->getEmailUsuario()))
            header("Location: login?invalidUser");

        // Testando igualdade entre o token da URL e do banco, caso diferentes, volta para home.
        if ($tokenURL != ($tokenBD = $recupSenha->getToken())) {
            header("Location: login?invalidToken");
        } else {
            // Views para atualização da senha. Apenas serão mostradas caso todas as condições anteriores forem validas
            require_once '../view/InicioDaPagina/inicioDaPagina.php';
            require_once '../view/RecuperarSenha/viewRecuperacao.php';
        }
        break;
}
?>