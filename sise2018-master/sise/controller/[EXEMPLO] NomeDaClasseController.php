<?php
	// Iniciando a sessão e importando arquivos necessários.
	session_start();
	require_once '../inc/validarAutenticacao.inc.php';
	require_once '../inc/validarPermissaoEdicao.inc.php';
	require_once '../../gerenciador/GerenciadorTipoUnidade.class.php';
	require_once '../../Model/TipoUnidade.class.php';

	// Obtendo informações necessária para alimentar as views.
	$foto = $_SESSION['foto'];
	$titulo = 'SYSITAC';
	$pagina = 'Tipo de Unidade';
	$nomeUsuario = $_SESSION['nome'];

	// Obtendo a ação a ser desempenha pela controladora.
	$action = 'list';
	if(isset($_REQUEST['action']))
		$action = $_REQUEST['action'];

	// Instanciando a gerenciadora de Tipo de Unidade.
	$gerenciadoraTipoUnidade = new GerenciadorTipoUnidade();

	// Conjunto de ações a depender da ação.
	switch($action){

		// Permite a listagem dos tipos de unidade.
		case 'list':
			$lista = $gerenciadoraTipoUnidade->obterTodos();
			$descricao = 'Lista de Tipos de Unidade';
			include_once '../View/Tipo_Unidade/form_list_tipo_unidade.php';
			break;

		// Permite remover um tipo de unidade no sistema.
		case 'del':
			if(isset($_GET['id'])){
				$tipoUnidade = new TipoUnidade($_GET['id']);
				$gerenciadoraTipoUnidade->remover($tipoUnidade);
			}
			header("Location: tipo-unidade");
			break;

		// Permite mostrar a tela de cadastro.
		case 'show_cad':
			$descricao = 'Cadastrar Tipo de Unidade';
			include_once '../View/Tipo_Unidade/form_cad_tipo_unidade.php';
			break;

		// Permite cadastrar um tipo de unidade no sistema.
		case 'cad':
			if(isset($_POST['descricao'])){
				$tipeoUnidade = new TipoUnidade(null, $_POST['descricao']);
                $gerenciadoraTipoUnidade->adicionar($tipoUnidad);
			}
			header("Location: tipo-unidade");
			break;

		// Permite mostrar a tela de edição.
		case 'show_edit':
			if(isset($_GET['id'])){
				$model = $gerenciadoraTipoUnidade->obter($_GET['id']);
				$descricao = 'Alterar Tipo de Unidade';
				include_once '../View/Tipo_Unidade/form_edit_tipo_unidade.php';
			}
			break;

		// Permite alterar um tipo de unidade no sistema.
		case 'edit':
			if(isset($_POST['descricao']) && isset($_POST['id'])){
				$tipoUnidade = new TipoUnidade($_POST['id'], $_POST['descricao']);
				$gerenciadoraTipoUnidade->atualizar($tipoUnidade);
			}
			header("Location: tipo-unidade");
			break;
	}
?>