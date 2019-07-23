<?php
/**
 * Autor: John Hed
 * Date: 17/07/2017
 * UPDATE
 * Autor: Gabriel Santana
 * Date: 06/08/2017
 * Description:
 * Case Emitir, para realizar a emissao de certificado ao clicar no botão.
 * === Atualização 2 ===
 * Autor: Gabriel Santana
 * Date: 04/09/2017
 * Message:
 * 1- Remoção dos Objetos das persistencias, pois não sao usadas.
 * 2- Objetos das gerenciadoras alocados dentro de cada caso especifico, não sendo necessario carregar todos sempre.
 * 3- Atualização de acesso de algumas variaveis. De $respectivaPersistencia-> para $respectivaGerenciadora->
 * 4- Reidentação de algumas partes.
 */

session_start();
require_once '../inc/seguranca.php';

// Requerimento das Gerenciadoras
require_once '../gerenciador/GerenciadorEvento.php';
require_once '../gerenciador/GerenciadorCertificado.php';
require_once '../gerenciador/GerenciadorAdminEvento.php';
require_once '../gerenciador/GerenciadorEndereco.php';
require_once '../gerenciador/GerenciadorUsuario.php';
require_once '../gerenciador/GerenciadorFrequencia.php';
require_once '../gerenciador/GerenciadorInfoFrequencia.php';
require_once '../gerenciador/GerenciadorCidade.php';
require_once '../gerenciador/GerenciadorEstado.php';
require_once '../gerenciador/GerenciadorInscricaoEvento.php';

// Requerimento das Models
require_once '../model/Certificado.php';
require_once '../model/Evento.php';
require_once '../model/Usuario.php';
require_once '../model/AdminEvento.php';
require_once '../model/InfoFrequencia.php';
require_once '../model/Endereco.php';
require_once '../model/Qualidade.php';
require_once '../model/Cidade.php';
require_once '../model/Estado.php';
require_once '../model/InscricaoEvento.php';

// Requerimento das Funções
require_once '../inc/funcoes.php';

// Obtendo a ação a ser desempenha pela controladora.
$action = 'show';
$pagina = 'Certificados';

if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];

// Conjunto de ações a depender da ação.
switch ($action) {
    // Permite remover um certificado do sistema.
    case 'del':
        echo 'DELETAR USUARIO';

        break;
    // Permite listar os Certificados no sistema.
    case 'list':
        // Objetos das Gerenciadoras
        $gerenciadoraAdminEvento = new GerenciadorAdminEvento();
        $gerenciadoraCertificado = new GerenciadorCertificado();
        $gerenciadoraEvento = new GerenciadorEvento();

        // Inicio case List
        $mensagem = '';
        $eventos = array();
        $certificadosList = array();
        require_once '../inc/seguranca.php';

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';

        if (isset($_POST['buscarEvento'])) {
            $nomeEvento = $_POST['nomeEvento'];
            //Obter eventos cadastrados pelo usuaário
            $eventos = $gerenciadoraAdminEvento->obter($_SESSION['codigo']);

            // $evento= $gerenciadoraEvento->obter($e->getIdEvento());
            // $eventos = $persistenciaEvento->obterEventosByNomeAndUsuario($nomeEvento, $_SESSION['codigo']);
            if (!is_null($eventos)) {
                foreach ($eventos as $e) {
                    if (!is_null($gerenciadoraCertificado->obterByIdEvento($e->getIdEvento()))) {
                        array_push($certificadosList, $gerenciadoraCertificado->obterByIdEvento($e->getIdEvento()));
                    }
                }
            } else {
                $mensagem = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i>Nenhum evento encontrado.</h4>
               
              </div>';
            }


        } else {
            $eventosAdm = $gerenciadoraAdminEvento->obter($_SESSION['codigo']);
            $eventos = array();
            foreach ($eventosAdm as $evt) {
                array_push($eventos, $gerenciadoraEvento->obter($evt->getIdEvento()));
            }
            if (!is_null($eventos)) {
                foreach ($eventos as $e) {
                    if (!is_null($gerenciadoraCertificado->obterByIdEvento($e->getIdEvento()))) {
                        array_push($certificadosList, $gerenciadoraCertificado->obterByIdEvento($e->getIdEvento()));
                    }

                }
            } else {
                $mensagem = '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i>Nenhum evento encontrado.</h4>
               
              </div>';
            }
        }

        if (@$_GET["deletado"] == 1) {
            echo modalSucesso("Certificado Deletado com Sucesso!");
        }
        if (@$_GET["editado"] == 1) {
            echo modalSucesso("Certificado Editado com Sucesso!");
        }

        if (@$_GET["cadastrado"] == 1) {
            echo modalSucesso("Certificado Cadastrado com Sucesso!");
        }

        require_once '../view/Certificado/listCertificado.php';
        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';

        break;
    // Permite mostrar a tela home.
    case 'show':
        require_once '../inc/seguranca.php';

        // Objetos das Gerenciadoras
        $gerenciadoraAdminEvento = new GerenciadorAdminEvento();
        $gerenciadoraCertificado = new GerenciadorCertificado();
        $gerenciadoraEvento = new GerenciadorEvento();

        // Inicio case show
        $eventosAdm = $gerenciadoraAdminEvento->obter($_SESSION['codigo']);
        $eventos = array();
        $certEventoStatus = array();
        if (!is_null($eventosAdm)) {
            foreach ($eventosAdm as $evt) {
                array_push($eventos, $gerenciadoraEvento->obter($evt->getIdEvento()));
                if (is_null($gerenciadoraCertificado->obterByIdEvento($evt->getIdEvento()))) {
                    array_push($certEventoStatus, 0);
                } else {
                    array_push($certEventoStatus, $gerenciadoraCertificado->obterByIdEvento($evt->getIdEvento()));
                }
            };
        }
        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';


        require_once '../view/Certificado/homeCertificado.php';

        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
    //  Permite a emissão do certificado
    case 'emitir':
        // Objetos das gerenciadoras
        $gerenciadoraEndereco = new GerenciadorEndereco();
        $gerenciadoraEvento = new GerenciadorEvento();
        $gerenciadoraAdminEvento = new GerenciadorAdminEvento();
        $gerenciadoraCertificado = new GerenciadorCertificado();
        $gerenciadoraUsuario = new GerenciadorUsuario();
        $gerenciadoraFrequencia = new GerenciadorFrequencia();
        $gerenciadoraInfoFrequencia = new GerenciadorInfoFrequencia();
        $gerenciadoraCidade = new GerenciadorCidade();
        $gerenciadoraEstado = new GerenciadorEstado();
        $gerenciadoraInscricaoEvento = new GerenciadorInscricaoEvento();

        // Inicio case emitir

        if($gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'], $_GET['idEvento'])->getIdUsuario() == null){
            echo 'NÃO INSCRITO NO EVENTO';
            return;
            //chamar view
        }
        // Coletando informações do Evento
        $evento = $gerenciadoraEvento->obter($_GET['idEvento']);
        if ($evento == null) {
            header("Location: home");
        }

        // Coletando informações de cadastro no evento
        $inscricaoEvento = $gerenciadoraInscricaoEvento->obterInscricao($_SESSION['codigo'], $_GET['idEvento']);
        $inscricaoIdEvento = $inscricaoEvento->getIdEvento();

        // Coletando informações do certificado
        $certificado = $gerenciadoraCertificado->obterByIdEvento($_GET['idEvento']);
        if ($certificado == null) {
           // header("Location: home");
           //header("Location: detalhe?evento=" . $_GET['idEvento']);
            echo "<script>location.href='detalhe?evento=" . $evento->getIdEventoPai(). "'</script>";
        }

        // Coletando Informações do usuario
        $usuario = $gerenciadoraUsuario->obter($_SESSION['codigo']);

        // Coletar informações referente ao endereço do EVENTO
        $enderecoEven = $gerenciadoraEndereco->obterPorId($evento->getIdEndereco());
        $cidadeEven = $gerenciadoraCidade->obter($enderecoEven->getIdCidade());
        $estadoEven = $gerenciadoraEstado->obter($cidadeEven->getIdEstado());
        $nomeCid = utf8_encode($cidadeEven->getNomeCidade());

        // Coletando as informações para montagem do periodo no certificado
        $quantDias = $gerenciadoraEvento->obterQuantDias($_GET['idEvento']);
        $dias = $gerenciadoraEvento->obterDiasEvento($_GET['idEvento']);


        $diaInicio = fragmentarData($dias[0]); // Pega a data inicial do evento e fragmenta em [ANO],[MES],[DIA]
        $diaFinal = fragmentarData($dias[sizeof($dias) - 1]); // Pega a data final do evento e fragmenta em [ANO],[MES],[DIA]


        // Funcao com as condições para a montagem do texto relacionando com as comparações de DATA, MES, ANO
        $textoDataFinal = montarTextoPeriodoCertificado($diaInicio, $diaFinal);

        $listaFrequenciaUsuarioPorDia;
        $listaInformacaoFrequenciaPorDia;

        $i = 0;
        while ($i < $quantDias) {
            $listaFrequenciaUsuarioPorDia[$i] = $gerenciadoraFrequencia->obterQntFreqByDia($dias[$i], $_GET['idEvento'], $_SESSION['codigo']);
            $listaInformacaoFrequenciaPorDia[$i] = $gerenciadoraInfoFrequencia->obterQuantByDiaEvento($dias[$i], $_GET['idEvento']);
            $i++;
        }

        //if ($certificado != null) {
        if ($inscricaoIdEvento == null){
            header('Location: home');
        }elseif($certificado != null) {
            $cargaHoraria = round(frequenciaEvento($quantDias, $listaFrequenciaUsuarioPorDia, $listaInformacaoFrequenciaPorDia), 1);
            $partMinEvento = ($evento->getPartMinEvento()/$quantDias);// Ambos serão requisitadas do banco
            $partMinEvento = $partMinEvento/100;

            if ($cargaHoraria >= $partMinEvento) {
                // Inicio da formação do PDF Certificado
                // require('../inc/fpdf/fpdf.php'); // Requerindo a biblioteca fpdf
                require_once('../inc/TCPDF/tcpdf.php');
                // create new PDF document
                $pdf = new TCPDF('L', 'cm', 'A4', true, 'UTF-8', false);
                define('FDPF_FONTPATH', '../inc/fpdf/font/'); // Coletando as fontes da biblioteca fpdf

                // setando as margens
                $pdf->SetMargins(3, 5);
                $pdf->SetHeaderMargin(0);
                $pdf->SetFooterMargin(0);

                // Seta a escala da imagem
                $pdf->setImageScale(100);

                // add a pagina
                $pdf->AddPage();

                $pdf->SetFont('dejavusans', '', 14);
                $bMargin = $pdf->getBreakMargin();

                // Pega o modo de quebra de pagina atual
                $auto_page_break = $pdf->getAutoPageBreak();

                // Desativa a quebra de pagina automatica
                $pdf->SetAutoPageBreak(false, 0);

                // Atribuição da imagem do certificado
                $pdf->Image('../imagens/certificados/' . $certificado->getUrlImagemCertificado(), 0, 0, 29.8);
                // Setar o nome Maiusculo
                $nome = utf8_encode(strtoupper($usuario->getNomeUsuario()));
                // Nomeclatura do tipo do usuario para preenchimento do texto certificado
                $tipo = $usuario->getTipoUsuario() == 0 ? "ouvinte" : "Organização";
                $textoCertificado = "Certificamos que <b>$nome</b> portador do CPF.: <b>{$usuario->getCpfUsuario()}</b>
                participou do evento \"<b> {$evento->getNomeEvento()} </b>\" realizado em <b>{$nomeCid}-{$estadoEven->getSiglaEstado()}</b> <b>{$textoDataFinal}</b>
                na qualidade de <b>{$tipo}</b> com frequência de <b>" . ($certificado->getChCertificado() * $cargaHoraria) . " horas.</b>";

                $pdf->SetAutoPageBreak($auto_page_break, $bMargin);

                // Seta o  ponto de começo do conteudo da pagina
                $pdf->setPageMark();
                $pdf->setXY(5.4, 9);
                //$pdf->MultiCell('23', '0.8', "$textoCertificado", '0', 'J');
                $pdf->writeHTML($textoCertificado, true, 0, true, 0);
                $pdf->Output();

            } else {
                //echo "<script>alert('Usuário não possui horas suficientes para emissão!');location.href='detalhe?evento=" . $_GET['idEvento'] . "'</script>";
                echo "<script>location.href='detalhe?evento=" . $evento->getIdEventoPai(). "&msg=hora'</script>";
                //header("Location: detalhe?evento=" . $_GET['idEvento']);
            }
        }

    // Permite cadastrar um Certificado.
    case 'cad':
        // Objetos das gerenciadoras
        $gerenciadoraEvento = new GerenciadorEvento();
        $gerenciadoraAdminEvento = new GerenciadorAdminEvento();
        $gerenciadoraCertificado = new GerenciadorCertificado();

        // Inicio case cadastrar
        $mensagem = '';
        require_once '../inc/seguranca.php';
        /*
        $eventosAdm = $gerenciadoraAdminEvento->obter($_SESSION['codigo']);
        $eventos = array();
        if(!is_null($eventosAdm)){
            foreach ($eventosAdm as $evt) {
                //Verificar se já não tem algum cadastrado
                $certCadastrado = $gerenciadoraCertificado->obterByIdEvento($evt->getIdEvento());
                if (!is_null($certCadastrado)) {
                    array_push($eventos, $gerenciadoraEvento->obter($evt->getIdEvento()));
                }
            };
        }
        */

        if (isset($_POST['cadCertificado'])) {

            $idEvento = $_POST['evento'];
            $evento = $gerenciadoraEvento->obter($idEvento);
            //var_dump($evento);
            $status = $_POST["status"];
            $cargaHoraria = $_POST['cargahoraria'];
            $tipo = $_POST['tipo'];
            // $imagem = $_FILES['imagem']['name'];
            $nomeEvento = removerAcentos($evento->getNomeEvento(), true);
            $extensao = pathinfo($_FILES['imagem']['name']);
            $extensao = "." . $extensao['extension'];
            $imagem = $nomeEvento . $extensao;
            $novo = new Certificado(
                null,
                $cargaHoraria,
                $status,
                $imagem,
                $tipo,
                $idEvento
            );

            // Formato
            if (!preg_match('/^image\/(pjpeg|jpeg|jpg|png|gif|bmp)$/', $_FILES['imagem']['type'])) {
                echo 'Isso não é uma imagem válida';
                exit;
            }
            //Upload imagem evento
            $uploaddir = '../imagens/certificados/';
            $uploadfile = $uploaddir . basename($imagem);

            $gerenciadoraCertificado->inserir($novo);

            header("Location: certificado?action=list&cadastrado=1");
        }
        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';
        require_once '../view/Certificado/cadCertificado.php';
        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;
// Permite Editar um Certificado.
    case 'edit':
        // Objetos das gerenciadoras
        $gerenciadoraEvento = new GerenciadorEvento();
        $gerenciadoraCertificado = new GerenciadorCertificado();

        // Inicio case editar
        $mensagem = '';
        $certificado = $gerenciadoraCertificado->obterById($_GET['certificado']);
        $evento = $gerenciadoraEvento->obter($certificado->getIdEvento());

        if (isset($_POST['cadCertificado'])) {
            $nomeEvento = removerAcentos($evento->getNomeEvento(), true);
            $idEvento = $evento->getIdEvento();
            $status = $_POST["status"];
            $cargaHoraria = $_POST['cargahoraria'];
            $tipo = $_POST['tipo'];

            if (!empty($_FILES['imagem']['name'])) {
                $extensao = pathinfo($_FILES['imagem']['name']);
                $extensao = "." . $extensao['extension'];
                $img = $nomeEvento . $extensao;
                //Deletar a imagem anterior
                unlink("../imagens/certificados/{$certificado->getUrlImagemCertificado()}");

            }
            $imagem = ($_FILES['imagem']['name'] == null ? $certificado->getUrlImagemCertificado() : $img);

            $edit = new Certificado(
                $certificado->getIdCertificado(),
                $cargaHoraria,
                $status,
                $imagem,
                $tipo,
                $idEvento
            );
            //DEPOIS ALTERAR PARA USAR A GERENCIADORA
            $gerenciadoraCertificado->atualizar($edit);

            header("Location: certificado?action=list&editado=1");

        }
        require_once '../inc/seguranca.php';

        require_once '../view/InicioDaPagina/inicioDaPagina.php';
        require_once '../controller/MenuController.php';

        require_once '../view/Certificado/editCertificado.php';

        require_once '../view/Footer/footer.php';
        require_once '../view/FimDaPagina/fimDaPagina.php';
        break;

}
?>