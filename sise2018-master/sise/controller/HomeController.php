<?php
/**
 * Autor: Daniel Lima
 * Date: 29/04/2017
 */
session_start();
require_once '../gerenciador/GerenciadorEvento.php';
require_once '../gerenciador/GerenciadorEndereco.php';
require_once '../model/Evento.php';
require_once '../model/Endereco.php';
require_once '../inc/seguranca.php';

// Obtendo a ação a ser desempenha pela controladora.
$action = 'show';
$pagina = 'Home';

if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];

// Conjunto de ações a depender da ação.
switch ($action) {
    case 'show':

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';

        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraEndereco = new GerenciadorEndereco();
        $eventosAbertos = $gerenciadoraEventos->obterTodosAbertos();
        $endereco = array();

            //require_once '../view/Home/showHome.php';
            require_once '../view/Home/showHomeInicio.php';
        if(is_null($eventosAbertos) || sizeof($eventosAbertos) == 0){
            require_once '../view/Home/showHomeSemEventos.php';
        } else {
            require_once '../view/Home/showHomeEventos.php';
        }
        require_once '../view/Home/showHomeFim.php';

        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
}
?>
<?php
/*
    // Conjunto de ações a depender da ação.
    switch($action){

        // Permite a chamada da tela de login
        case 'showLogin':

            $pagina = 'Login';

            require_once '../view/InicioDaPagina/inicioDaPagina.php';
            require_once '../view/Login/showLogin.php';
            require_once '../View/FimDaPagina/fimDaPagina.php';
            break;

        // Permite a validação dos dados
        case 'validar':
            if (!isset($_POST['cpf']) && !isset($_POST['senha'])) {
                header('Location: login');
            } else {
                $gerenciadoraUsuario = new GerenciadorUsuario();
                $usuario = $gerenciadoraUsuario->buscarLogin($_POST['cpf'],criptografaSenha($_POST['senha']));
                if ($usuario == null) {
                    header('Location: login?erro=login');
                } else {
                    header('Location: home');
                }
            }

            break;

        // Permite a recuperação de senha
        case 'recuperar':

            echo 'RECUPERAR SENHA';

            break;
    }
*/
?>