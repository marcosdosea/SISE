<?php
/**
 * Autor: Daniel Lima
 * Date: 11/05/2017
 */
session_start();

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

require_once '../inc/seguranca.php';

// Obtendo a ação a ser desempenha pela controladora.
if(isset($_REQUEST['action']))
    $action = $_REQUEST['action'];
else header( 'Location : home');

// Conjunto de ações a depender da ação.
switch($action){

    case 'processarInscricao':

        $gerenciadoraUsuario = new GerenciadorUsuario();
        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();
        $gerenciadoraPagamento = new GerenciadorPagamento();
        $gerenciadoraParcela = new GerenciadorParcela();

        //TESTANDO SE JÁ EXISTE INSCRIÇÃO
        $inscricao = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'],$_GET['evento']);
        if ($inscricao->getIdUsuario() != null) header("Location: detalhe?evento=" . $_GET['evento']);

        //CRIANDO A INSCRICAO DO USUARIO NO EVENTO
        $novaInscricao = new InscricaoEvento($_SESSION['codigo'],$_GET['evento']);
        $gerenciadoraInscricaoEvento->adicionar($novaInscricao);

        //CALCULANDO VALOR TOTAL
        $valorEscolhido = $gerenciadoraEventos->obter($_GET['evento'])->getValorEvento();

        $filhos = $gerenciadoraEventos->obterMiniCursos($_GET['evento']);

        /*for ($i = 0 ; $i < sizeof($filhos); $i++) {
            if (isset($_POST[''.$filhos[$i]->getIdEvento()])) {
                $novaInscricao = new InscricaoEvento($_SESSION['codigo'],$filhos[$i]->getIdEvento());
                $gerenciadoraInscricaoEvento->adicionar($novaInscricao);

                $valorEscolhido = $valorEscolhido + $filhos[$i]->getValorEvento();
            }
        }*/

        //CADASTRANDO PAGAMENTO

        $valor = $valorEscolhido;
        $qntdParcelas = $_POST['qntdParcela'];
        if (isset($_POST['pagamento'])) $tipoPagamento = $_POST['pagamento'];

        echo 'Valor - ' . $valor;
        echo 'Parcelas - ' . $qntdParcelas;

        if ($valor > 0) {
            $pagamento = new Pagamento(null,$valor,$qntdParcelas,'A',$_SESSION['codigo'], $_GET['evento'],$tipoPagamento);
            //TESTAR SE O ID REALMENTE É O DO PAGAMENTO
            $idPagamento = $gerenciadoraPagamento->adicionar($pagamento);

            $usuario = $gerenciadoraUsuario->obterById($_SESSION['codigo']);

            if($tipoPagamento == 'C'){

            }else if($tipoPagamento == 'B'){
                //INSERE O USUARIO NO ASAAS CASO NAO TENHA SIDO INSERIDO
                if ($usuario->getIdAsaasUsuario() == null || $usuario->getIdAsaasUsuario() == "") {
                    require_once "../gerenciador/Asaas/ClienteAsaas.php";

                    $dadosCliente['name'] = $usuario->getNomeUsuario();
                    $dadosCliente['email'] = $usuario->getEmailUsuario();
                    $dadosCliente['phone'] = "";
                    $dadosCliente['mobilePhone'] = "";
                    /*if ($usuario->getTel1Usuario() != null) {
                        $dadosCliente['phone'] = $usuario->getTel1Usuario();
                        $dadosCliente['mobilePhone'] = $usuario->getTel1Usuario();
                    }*/
                    $dadosCliente['cpfCnpj'] = $usuario->getCpfUsuario();

                    $userAsaas = inserirCliente($dadosCliente);
                    $userAsaasArray = json_decode($userAsaas, true);

                    $usuario->setIdAsaasUsuario($userAsaasArray['id']);
                    $gerenciadoraUsuario->atualizarIdAsaas($usuario);
                }

                //INSERIR AS COBRANÇAS

                require_once "../gerenciador/Asaas/CobrancaAsaas.php";

                if ($qntdParcelas == 1) {
                    $dadosCobranca['customer'] = $usuario->getIdAsaasUsuario();
                    $dadosCobranca['billingType'] = 'BOLETO';
                    $dadosCobranca['value'] = $valor / $qntdParcelas;
                    $dataAtual = date ("Y-m-d");
                    $dadosCobranca['dueDate'] = date('Y-m-d', strtotime($dataAtual. ' + 2 days'));

                    $cobranca = inserirCobranca($dadosCobranca);
                    $cobrancaArray = json_decode($cobranca,true);
                    $cobrancaNova = new Parcela(null,$dadosCobranca['value'],2,'ABERTO','REFERENCIA',$idPagamento,$cobrancaArray['id']);
                    $gerenciadoraParcela->adicionar($cobrancaNova);
                } else if ($qntdParcelas > 1) {
                    $dadosCobranca['customer'] = $usuario->getIdAsaasUsuario();
                    $dadosCobranca['billingType'] = 'BOLETO';

                    $dadosCobranca['installmentValue'] = $valor / $qntdParcelas;
                    $dadosCobranca['installmentCount'] = $qntdParcelas;

                    $dataAtual = date ("Y-m-d");
                    $dadosCobranca['dueDate'] = date('Y-m-d', strtotime($dataAtual. ' + 2 days'));

                    $cobranca = inserirCobrancaParcelada($dadosCobranca);
                    $installmentArray = json_decode($cobranca, true);
                    $idInstallment = $installmentArray['installment'];

                    $todasParcelas = getTodasParcelas($idInstallment);
                    $todasParcelasArray = json_decode($todasParcelas, true);

                    $todasParcelasArray = $todasParcelasArray['data'];

                    $todasParcelasArray = array_reverse($todasParcelasArray);

                    foreach ($todasParcelasArray as $parcelaAtual) {
                        //PERSISTIR A COBRANCA EM PARCELA
                        $cobrancaNova = new Parcela(null,$dadosCobranca['value'],2,'ABERTO','REFERENCIA',$idPagamento, $parcelaAtual['id']);
                        $gerenciadoraParcela->adicionar($cobrancaNova);
                    }
                }
            }


        }
        header("Location: detalhe?evento=" . $_GET['evento']);
        break;
    case 'cancelarInscricao':
        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();
        $gerenciadoraParcela = new GerenciadorParcela();
        $gerenciadoraPagamento = new GerenciadorPagamento();

        //VER SE O EVENTO EXISTE
        $evento = $gerenciadoraEventos->obter($_GET['evento']);
        if ($evento == null || $evento->getIdEvento() == null) header("Location: detalhe?evento=" . $_GET['evento']);

        //VER SE ESTÁ INSCRITO
        $inscricao = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'], $_GET['evento']);
        if ($inscricao == null || $inscricao->getIdEvento() == null) header("Location: detalhe?evento=" . $_GET['evento']);

        $pagamento = $gerenciadoraPagamento->obterPorUsuarioEvento($_SESSION['codigo'], $_GET['evento']);

        if ($pagamento != null && $pagamento->getIdPagamento() != null) {

            $parcelas = $gerenciadoraParcela->obterTodosPorPagamento($pagamento->getIdPagamento());

            //APAGAR AS COBRANCAS NO ASAAS
            require_once "../gerenciador/Asaas/CobrancaAsaas.php";

            $pagou = false;
            for ($i =0 ; $i < sizeof($parcelas); $i++) {
                $parcelaAsaas = json_decode(getCobranca($parcelas[$i]->getIdParcelaAsaas()), true);
                if ($parcelaAsaas['status'] == 'RECEIVED') $pagou = true;
            }
            if ($pagou == true) {
                header("Location: detalhe?evento=" . $_GET['evento'] . "&msg=erroCancelar");
                break;
            } else {

                for ($i =0 ; $i < sizeof($parcelas); $i++) {
                    removerCobranca($parcelas[$i]->getIdParcelaAsaas());
                }

                //APAGAR AS PARCELAS NA PERSISTENCIA
                for ($i =0 ; $i < sizeof($parcelas); $i++) {
                    $gerenciadoraParcela->remover($parcelas[$i]);
                }

                //APAGAR O PAGAMENTO NA PERSISTENCIA
                $gerenciadoraPagamento->remover($pagamento);

            }
        }

        //APAGAR A INSCRIÇÃO NOS MINI CURSOS CADASTRADOS
        $filhos = $gerenciadoraEventos->obterMiniCursos($_GET['evento']);

        for ($i = 0; $i < sizeof($filhos); $i++) {
            $inscricaoMinicurso = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'],$filhos[$i]->getIdEvento());
            if ($inscricaoMinicurso != null && $inscricaoMinicurso->getIdEvento() != null) {
                $gerenciadoraInscricaoEvento->remover($inscricaoMinicurso);
            }
        }

        // APAGAR A INSCRICAO NO EVENTO
        $gerenciadoraInscricaoEvento->remover($inscricao);

        header("Location: home");

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