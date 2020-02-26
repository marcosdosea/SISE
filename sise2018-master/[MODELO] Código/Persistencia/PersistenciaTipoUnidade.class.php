<?php
	require_once 'DbConnection.class.php';
	require_once 'DaoGenerico.interface.php';
	require_once '../../Model/TipoUnidade.class.php';

	class PersistenciaTipoUnidade implements DaoGenerico{
		function inserir($tipoUnidade){
			// Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'INSERT INTO TB_TIPO_UNIDADE (descricao) VALUES (:descricao);';

			$statement = $Conexao->prepare($SQL);

			$statement->bindValue(':descricao', $tipoUnidade->getDescricao(), PDO::PARAM_STR);

			// Executa a query
			$statement->execute();
		}

		function atualizar($tipoUnidade){
			// Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'UPDATE TB_TIPO_UNIDADE SET
						descricao = :descricao
					WHERE id_tipo_unidade = :codigo;';

			$statement = $Conexao->prepare($SQL);

			$statement->bindValue(':descricao', $tipoUnidade->getDescricao(), PDO::PARAM_STR);
			$statement->bindValue(':codigo', $tipoUnidade->getCodigo(), PDO::PARAM_INT);

			// Executa a query
			$statement->execute();
		}

		function remover($tipoUnidade){
			// Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'DELETE FROM TB_TIPO_UNIDADE WHERE id_tipo_unidade = :codigo;';

			$statement = $Conexao->prepare($SQL);
			$statement->bindValue(':codigo', $tipoUnidade->getCodigo(), PDO::PARAM_INT);

			// Executa a query
			$statement->execute();
		}

		function obterTodos(){
			// Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'SELECT
						id_tipo_unidade as Codigo,
						descricao as Descricao
					FROM TB_TIPO_UNIDADE;';

			// Executa a query e cria o array de objetos TipoUnidade
			$statement = $Conexao->query($SQL);
			$statement = $statement->fetchAll(PDO::FETCH_ASSOC);
			$resultado = null;
			if($statement != false && !empty($statement))
				foreach($statement as $linha)
					$resultado[] = new TipoUnidade($linha['Codigo'], $linha['Descricao']);

			return $resultado;
		}

		function obterById($IdTipoUnidade){
			// Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'SELECT
						id_tipo_unidade as Codigo,
						descricao as Descricao
					FROM TB_TIPO_UNIDADE
					WHERE id_tipo_unidade = :codigo;';

			$statement = $Conexao->prepare($SQL);
			$statement->bindValue(':codigo', $IdTipoUnidade, PDO::PARAM_INT);

			// Executa a query e obtém os dados do Tipo Unidade
			$statement->execute();
			$resultado = $statement->fetch(PDO::FETCH_ASSOC);
			if($resultado != false && !empty($resultado))
				$resultado = new TipoUnidade($resultado['Codigo'], $resultado['Descricao']);
			else
				$resultado = null;

			return $resultado;
		}
	}
?>