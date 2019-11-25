<?php
/**
 * Autor: Daniel Lima
 * Date: 29/04/2017
 */
session_start();
require_once '../gerenciador/GerenciadorEvento.php';
require_once '../gerenciador/GerenciadorInscricaoEvento.php';
require_once '../gerenciador/GerenciadorPagamento.php';
require_once '../gerenciador/GerenciadorUsuario.php';
require_once '../gerenciador/GerenciadorParcela.php';
require_once '../gerenciador/GerenciadorEstado.php';
require_once '../gerenciador/GerenciadorEndereco.php';
require_once '../gerenciador/GerenciadorCidade.php';
require_once '../gerenciador/GerenciadorCertificado.php';
require_once '../gerenciador/GerenciadorAdminEvento.php';

require_once '../model/Evento.php';
require_once '../model/Estado.php';
require_once '../model/Endereco.php';
require_once '../model/Cidade.php';
require_once '../model/Evento.php';
require_once '../model/InscricaoEvento.php';
require_once '../model/Pagamento.php';
require_once '../model/Usuario.php';
require_once '../model/Parcela.php';
require_once '../model/Certificado.php';
require_once '../model/AdminEvento.php';

require_once '../inc/seguranca.php';
require_once '../inc/funcoes.php';
// Obtendo a ação a ser desempenha pela controladora.
$action = 'show';
$pagina = 'Detalhe do evento';
$mensagem = null;
$msn = null;
if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];

if (isset($_REQUEST['mensagem']))
    $mensagem = $_REQUEST['mensagem'];
// Conjunto de ações a depender da ação.

switch ($action) {
    case 'show':

        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();
        $gerenciadoraPagamento = new GerenciadorPagamento();
        $gerenciadoraParcela = new GerenciadorParcela();

        //Pega o id do evento
        $idEvento;
        if (isset($_GET['evento'])) {
            $idEvento = $_GET['evento'];
        }
        //Testa se a página foi chamada sem id de evento e se o id passado existe no banco
        if ($idEvento == null) {
            header("Location: home");
        } else {
            $evento = $gerenciadoraEventos->obter($idEvento);
            if ($evento == null) {
                header("Location: home");
            }
        }

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';
        //Recebe as mensagens da emissão de certificados
        if ($mensagem == 'error') {
            $msn = modalError('Usuário não possui horas suficientes para emissão!');
        } else if ($mensagem == 'null') {
            $msn = modalError('Certificado não disponível !');
        }
        //TESTAR SE O USUÁRIO ESTÁ INSCRITO NO EVENTO
        $inscricao = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'], $idEvento);
        if ($inscricao->getIdEvento() == null) {
            //$filhos = $gerenciadoraEventos->obterMiniCursos($idEvento);

            //Página para evento ainda não inscrito
            //require_once '../view/Evento/showEventoNaoInscrito.php';
            echo "<script>window.location.href = 'evento?action=inscricao&evento=" . $idEvento . "'</script>";
        } else {
            //Página para evento inscrito
            $inscricoesMinicursos = $gerenciadoraInscricaoEvento->obterTodosMiniCursosInscritos($_SESSION['codigo'], $idEvento);
            $minicursos = null;
            for ($i = 0; $i < sizeOf($inscricoesMinicursos); $i++) {
                $minicursos[$i] = $gerenciadoraEventos->obter($inscricoesMinicursos[$i]->getIdEvento());
            }

            $pagamento = $gerenciadoraPagamento->obterPorUsuarioEvento($_SESSION['codigo'], $idEvento);
            if ($pagamento != null && $pagamento->getIdEvento() != null) $parcelas = $gerenciadoraParcela->obterTodosPorPagamento($pagamento->getIdPagamento());
            else $parcelas = null;

            $gerenciadoraCertificado = new GerenciadorCertificado();
            $certificado = $gerenciadoraCertificado->obterByIdEvento($evento->getIdEvento());

            //ATUALIZAR SITUAÇÃO DA PARCELA
            require_once "../gerenciador/Asaas/CobrancaAsaas.php";
            for ($i = 0; $i < sizeof($parcelas); $i++) {
                $cobranca[$i] = json_decode(getCobranca($parcelas[$i]->getIdParcelaAsaas()), true);
            }

        }
        require_once '../view/Evento/showEventoInscrito.php';
        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
    //Mostra o evento para a pessoa se inscrever
    case 'inscricao':
        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();

        //Pega o id do evento
        $idEvento;
        if (isset($_GET['evento'])) {
            $idEvento = $_GET['evento'];
        }
        //Testa se a página foi chamada sem id de evento e se o id passado existe no banco
        if ($idEvento == null) {
            header("Location: home");
        } else {
            $evento = $gerenciadoraEventos->obter($idEvento);
            if ($evento == null) {
                header("Location: home");
            }
        }

        $inscricao = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'], $idEvento);
        if ($inscricao->getIdEvento() == null) {
            //Página inscrição
            $pagina = "Inscrição";
            require_once '../view/InicioDaPagina/inicioDaPagina.php';

            require_once '../controller/MenuController.php';

            $pagamentoBoleto = true;
            $pagamentoCartao = true;

            $filhos = $gerenciadoraEventos->obterMiniCursos($idEvento);

            //Calcular Valor total possível do evento, para saber se poderá ter pagamento ou não
            $valorTotalPossivel = $evento->getValorEvento();
            if ($filhos != null) {
                foreach ($filhos as $miniCurso) {
                    $valorTotalPossivel = $valorTotalPossivel + $miniCurso->getValorEvento();
                }
            }
            require_once '../view/Evento/showEventoInscricaoCard.php';

            require_once '../view/Footer/footer.php';

            echo '<script type="text/javascript" src="inc/js/precoInscricao.js"></script>';
            echo '<script type="text/javascript" src="inc/js/processarHorarioMiniCursos.js"></script>';

            require_once '../view/FimDaPagina/fimDaPagina.php';

        } else {
            //Página para evento inscrito
            //FALTA
            header("Location: detalhe?evento=" . $inscricao->getIdEvento());
        }
        break;
    case 'showInscritos':

        $gerenciadoraEventos = new GerenciadorEvento();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';
        $inscricoes = $gerenciadoraInscricaoEvento->obterTodosByIdUsuario($_SESSION['codigo']);
        $eventosInscritos = null;

//        foreach($inscricao as $key => $inscricoes){
//            $eventosInscritos[] = $gerenciadoraEventos->obter($inscricao->getIdEvento());
//        }
        echo"<pre>";
        var_dump($inscricoes);

        if (!isset($eventosInscritos)) {
            require_once '../view/Evento/showSemEventoInscrito.php';
        } else {
            require_once '../view/Evento/showTodosEventosInscritos.php';
        }


        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
    //Cadastro de evento, permitido apenas para quem tem o controle administrativo
    case 'showCadastrar':

        validaTipoUsuario(ADMIN);
        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';
        require_once '../view/Evento/showCadEvento.php';
        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;

    case 'cadastrar':

        validaTipoUsuario(ADMIN);
        define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

        if (isset($_POST['cadEvento'])) {
            $gerenciadoraUsuario = new GerenciadorUsuario();
            $gerenciadoraEvento = new GerenciadorEvento();
            $gerenciadoraEndereco = new GerenciadorEndereco();
            $gerenciadoraAdminEvento = new GerenciadorAdminEvento();

            // Pega a data atual do servidor.
            date_default_timezone_set('America/Bahia');
            $horaAtualServidor = date('H:i:s');

            $urlImagem="";
            if(isset($_FILES['imagem'])) {
                $extensao = strtolower(substr($_FILES['imagem']['name'], -4)); //Pegando extensão do arquivo
                $nomeImagem = $_POST['nome'].$extensao; //Definindo um novo nome para o arquivo
                $diretorio = '../imagens/eventos/'; //Diretório para uploads
                $urlImagem = $diretorio.$nomeImagem;
                move_uploaded_file($_FILES['imagem']['tmp_name'], $urlImagem); //Fazer upload do arquivo
            }
            else
                $urlImagem=null;

            $dataIniInsc = $_POST['dataInicioInsc'] . " " . $horaAtualServidor;
            $dataFimInsc = $_POST['dataFimInsc'] . " " . $horaAtualServidor;
            $dataIniEven = $_POST['dataInicio'] . " " . $horaAtualServidor;
            $dataFimEven = $_POST['dataFim'] . " " . $horaAtualServidor;
            $novoEvento = new Evento(null, $_POST['nome'], $_POST['sigla'], $_POST['descricao'],
                $dataIniInsc, $dataFimInsc, $dataIniEven, $dataFimEven,
                null, null,  $urlImagem, $_POST['valor'], $_POST['numParcelas'], $_POST['partMin'], 's');
            // Retorna o ID do ultimo evento inserido para ser usado na montagem do Objeto AdminEvento
            $gerenciadoraEvento->adicionar($novoEvento,$_SESSION['codigo']);
            header('Location: evento?action=gerenciar&mensagem=sucess');
        }
    break;

    case 'gerenciar':

        require_once '../persistencia/PersistenciaAdminEvento.php';
        validaTipoUsuario(ORGANIZADOR);

        $gerenciadoraEvento = new GerenciadorEvento();

        $eventos = $gerenciadoraEvento->listarEventosResponsavel($_SESSION['codigo']);

        if($eventos == null || !$eventos)
            $qntdEventos = 0;
        else
            $qntdEventos = count($eventos);

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';

        require_once '../view/Evento/showGerenciar.php';

        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';

        break;
}

?>

