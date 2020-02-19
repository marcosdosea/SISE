<?php
    /**
     * Autor: Felipe
     * Date: 10/03/2017
     * Autor: Joan Vitor
     * Date: 04/11/2019
     */

    session_start();
    //require_once '../inc/seguranca.php';

    // Requerimentos das Gerenciadoras
    require_once '../gerenciador/GerenciadorUsuario.php';
    require_once '../gerenciador/GerenciadorEndereco.php';

    // Requerimentos das Gerenciadoras
    require_once '../model/Endereco.php';
    require_once '../model/Usuario.php';

    require_once '../inc/funcoes.php';

    // Obtendo informações necessária para alimentar as views.

    // Obtendo a ação a ser desempenha pela controladora.
    $action = 'show_edit';
    $pagina = 'Meus Dados';
    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];

    // Instanciando a gerenciadora de Tipo de Unidade.
    //$gerenciadorUsuario = new GerenciadorUsuario();

    // Conjunto de ações a depender da ação.
    switch($action){

    // Permite remover um usuario do sistema.
        case 'del':
            echo 'DELETAR USUARIO';
            break;

    // Permite cadastrar um usuario no sistema.
        case 'cad':
            if (isset($_POST['nome']) && ($_POST['senha1'] == $_POST['senha2'])) {
                $gerenciadoraUsuario = new GerenciadorUsuario();

                $user = $gerenciadoraUsuario->obterPeloCPF($_POST['cpf']);
                if ($user != null) {
                    header('Location: login?mensagem=existe');
                } else {
                    //$novo = new Usuario(null,$_POST['nome'], $_POST['cpf'], null, null, null, $_POST['email'], null, null, null , $_POST['sexo'] , criptografaSenha($_POST['senha1']) , null );
                    $novo = new Usuario(null, $_POST['nome'], $_POST['cpf'], $_POST['email'], criptografaSenha($_POST['senha1']),null, null);

                    $gerenciadoraUsuario->adicionar($novo);
                    header('Location: login?mensagem=sucess');
                }
            }
        break;

    // Permite mostrar a tela de edição.
        case 'show_edit':
			require_once '../inc/seguranca.php';
			
            require_once '../view/InicioDaPagina/inicioDaPagina.php';
            require_once '../controller/MenuController.php';
            $cpfUsuario = $_SESSION['cpf'];
            $gerenciadoraUsuario = new GerenciadorUsuario();
            $usuario = $gerenciadoraUsuario->obterPeloCPF($cpfUsuario);

            // Gerenciadora de Endereço
            $gerenciadoraEndereco = new GerenciadorEndereco();
//            $endereco = $gerenciadoraEndereco->obterPorId($usuario->getIdEndereco());

            require_once '../view/Usuario/showEditarUsuario.php';

            require_once '../view/Footer/footer.php';
            require_once '../view/FimDaPagina/fimDaPagina.php';
        break;

    // Permite alterar um USUARIO.
        case 'edit':
            if (isset($_POST['editar'])) {
                $gerenciadoraUsuario = new GerenciadorUsuario();
                $gerenciadoraEndereco = new GerenciadorEndereco();

                // Obtendo o usuario de acordo com o codigo da sessão
                $usuario = $gerenciadoraUsuario->obterById($_SESSION['codigo']);
                //$imgUsuario = $usuario->getImagemUsuario();

                // Carregando o Objeto com as informações atualizadas e a imagem
                $userEdit = new Usuario(
                    $_SESSION['codigo'],
                    $_POST['nome'],
                    $_POST['cpf'],
                    $_POST['email'],
                    $usuario->getSenhaUsuario(),
                    $usuario->getIdAsaasUsuario());

                //Substitui as informações atuais pelas postadas
                $_SESSION['nome'] = $_POST['nome'];
                $_SESSION['cpf'] = $_POST['cpf'];

                $gerenciadoraUsuario->atualizar($userEdit);
                header('Location: usuario?msg=sucess');
/*
                //Upload imagem Usuario
                $imagem = $_FILES['imagem']['name'];

                // Caso a imagem seja setada imagem retorna não vazio e a imagem é alterada
                if($imagem != ""){

                if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $_FILES['imagem']['type'])) {
                    echo 'Isso não é uma imagem válida';
                    exit;
                }

                // Fazendo o upload da imagem no diretorio
                $uploaddir = '../imagens/usuarios/';
                $uploadfile = $uploaddir . basename($_FILES['imagem']['name']);

                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadfile)) {

                } else {
                    echo "Erro ao enviar a imagem!\n";
                    exit;
                }

                // Carregando o Objeto com as informações atualizadas e a imagem
                    $userEdit = new Usuario(
                        $_SESSION['codigo'],
                        $_POST['nome'],
                        $_POST['cpf'],
                        $_POST['rg'],
                        $usuario->getEmpresaUsuario(),
                        $usuario->getFederadaUsuario(),
                        $_POST['email'],
                        $_POST['telefone1'],
                        $_POST['telefone2'],
                        $usuario->getIdFederacao(),
                        $_POST['sexo'],
                        $usuario->getSenhaUsuario(),
                        $usuario->getIdAsaasUsuario(),
                        $usuario->getTipoUsuario(),
                        $imagem);

                    //Substitui as informações atuais pelas postadas
                    $_SESSION['nome'] = $_POST['nome'];
                    $_SESSION['cpf'] = $_POST['cpf'];
                    $_SESSION['foto'] = $imagem;

                    // Obtendo Endereço
                    $endereco = $gerenciadoraEndereco->obterPorId($usuario->getIdEndereco());
                    if ($endereco != null && $endereco->getIdUsuario() != null) {

                        // Criando o Objeto com as novas informações de endereço
                        $enderecoEdit = new Endereco(
                            $endereco->getIdEndereco(),
                            $_POST['logradouro'],
                            $_POST['numero'],
                            $_POST['bairro'],
                            $endereco->getIdCidade(),
                            $_POST['cep']);

                        // Atualiza as informações referente ao endereço
                        $gerenciadoraEndereco->atualizar($enderecoEdit);
                    } else {
                        //CONSERTAR
                        //$endereco = new Endereco(null, $_POST['logradouro'], $_POST['numero'], $_POST['bairro'], $_SESSION['codigo'],null, $_POST['cep']);
                        //$gerenciadoraEndereco->adicionar($endereco);
                    }

                    // Atualizando as informações do usuario
                    $gerenciadoraUsuario->atualizar($userEdit);
                    header('Location: usuario?msg=sucess');

                }else{

                // Atualizando o cadastro sem a imagem
                $userEdit = new Usuario(
                    $_SESSION['codigo'],
                    $_POST['nome'],
                    $_POST['cpf'],
                    $_POST['rg'],
                    $usuario->getEmpresaUsuario(),
                    $usuario->getFederadaUsuario(),
                    $_POST['email'],
                    $_POST['telefone1'],
                    $_POST['telefone2'],
                    $usuario->getIdFederacao(),
                    $_POST['sexo'],
                    $usuario->getSenhaUsuario(),
                    $usuario->getIdAsaasUsuario(),
                    $usuario->getTipoUsuario(),
                    $usuario->getImagemUsuario()
                );

                //Atualiza variaveis de SESSION
                $_SESSION['nome'] = $_POST['nome'];
                $_SESSION['cpf'] = $_POST['cpf'];

                // Obtendo Endereço
                $endereco = $gerenciadoraEndereco->obterPorId($usuario->getIdEndereco());
                if ($endereco != null && $endereco->getIdUsuario() != null) {

                    // Criando o Objeto com as novas informações de endereço
                    $enderecoEdit = new Endereco(
                        $endereco->getIdEndereco(),
                        $_POST['logradouro'],
                        $_POST['numero'],
                        $_POST['bairro'],
                        $endereco->getIdCidade(),
                        $_POST['cep']);

                    // Atualiza as informações referente ao endereço
                    $gerenciadoraEndereco->atualizar($enderecoEdit);
                } else {
                    //CONSERTAR
                    //$endereco = new Endereco(null, $_POST['logradouro'], $_POST['numero'], $_POST['bairro'], $_SESSION['codigo'],null, $_POST['cep']);
                    //$gerenciadoraEndereco->adicionar($endereco);
                }

                $gerenciadoraUsuario->atualizar($userEdit);
                header('Location: usuario?msg=sucess');
                }
                */
            }
        break;

    // Permite a alteração da senha do USUARIO
        case 'alterarSenha':
            // Objeto da Gerenciadoras
            $gerenciadoraUsuario = new GerenciadorUsuario();

            if ($_GET['idAlterar'] == 2)
            {
                // Requires Exclusivos para essa condição
                require_once '../gerenciador/GerenciadorRecuperarSenha.php';
                require_once '../model/RecuperarSenha.php';
                require_once '../inc/seguranca.php';

                $cpfUsuario = $_SESSION['cpf'];
                // Objetos das gerenciadoras
                $gerenciadoraRecuperarSenha = new GerenciadorRecuperarSenha();

                // Variaveis das gerenciadoras
                $usuario = $gerenciadoraUsuario->obterPeloCPF($cpfUsuario);
                $idUsuario = $usuario->getIdUsuario();

                // Requires das Views para a condição
                require_once '../view/InicioDaPagina/inicioDaPagina.php';
                require_once '../controller/MenuController.php';

                // View de Recuperação de senha quando o usuario está logado
                require_once '../view/RecuperarSenha/viewAlterSenhaSession.php';

                require_once '../view/Footer/footer.php';
                require_once '../view/FimDaPagina/fimDaPagina.php';
            }
            else
            {
                // Obtendo o Objeto da gerenciadora USUARIO pelo CPF citado
                $usuario = $gerenciadoraUsuario->obterPeloCPF($_POST['cpf']);

                    // Testando Usuario pelo CPF, caso NULO volta para a home.
                    if(is_null($usuario))
                      header("Location: home");

                    if (isset($_POST['senha1']) && isset($_POST['senha2']) && $_POST['senha1'] == $_POST['senha2'])
                    {
                      // Requires Exclusivos para essa condição
                       require_once '../gerenciador/GerenciadorRecuperarSenha.php';
                       require_once '../model/RecuperarSenha.php';

                       // Objeto da Gerenciadora RecuperarSenha.
                       // Apenas será solicitada se o usuario e a senha não forem NULOS.
                       $gerenciadoraRecuperarSenha = new GerenciadorRecuperarSenha();

                       // Senha recebida via POST
                       $senhaAlterada = ($_POST['senha1']);

                       // Setando a nova senha do usuario
                       $usuario->setSenhaUsuario(criptografaSenha($senhaAlterada));

                       // Gerenciadora na função Atualizar USUARIO.
                       $gerenciadoraUsuario->atualizar($usuario);
                       header('Location: usuario?action=alterarSenha&idAlterar=2&msg=sucess');

                       // Mudando Token para Utilizado, apos alteração da Senha
                       $token = $gerenciadoraRecuperarSenha->obterValidoByIdUser($usuario->getIdUsuario());

                       // Setando o token como utilizado apos a alteração da senha
                       $token->setUtilizado('S');

                       // Gerenciadora recebendo o Objeto criado com os valores setados acima
                       $gerenciadoraRecuperarSenha->atualizar($token);
                    }
                    else{
                    	header("Location: usuario?action=alterarSenha&idAlterar=2&msg=erro");
                    }
            }
        break;
}
?>