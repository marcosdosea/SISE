<?php
    /**
     * Autor: Everton Lima
     * Date: 21/02/2017
     * Time: 20:22
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Estado.php';

    class PersistenciaEstado implements DaoGenerico {

        function inserir($Objeto)
        {
            // Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'INSERT INTO tb_estado (sigla_estado, nome_estado) VALUES (:sigla_estado, :nome_estado);';

			$statement = $Conexao->prepare($SQL);

			$statement->bindValue(':sigla_estado', $Objeto->getSiglaEstado(), PDO::PARAM_STR);
			$statement->bindValue(':nome_estado', $Objeto->getNomeEstado(), PDO::PARAM_STR);

			// Executa a query
			$statement->execute();
        }

        function atualizar($Objeto)
        {
            // Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'UPDATE tb_estado SET
						sigla_estado = :sigla_estado,
						nome_estado = :nome_estado
					WHERE id_estado = :id_estado;';

			$statement = $Conexao->prepare($SQL);

			$statement->bindValue(':id_estado', $Objeto->getIdEstado(), PDO::PARAM_INT);
			$statement->bindValue(':sigla_estado', $Objeto->getSiglaEstado(), PDO::PARAM_STR);
			$statement->bindValue(':nome_estado', $Objeto->getNomeEstado(), PDO::PARAM_STR);
			
			// Executa a query
			$statement->execute();
        }

        function remover($Objeto)
        {
            // Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'DELETE FROM tb_estado WHERE id_estado = :id_estado;';

			$statement = $Conexao->prepare($SQL);
			$statement->bindValue(':id_estado', $Objeto->getIdEstado(), PDO::PARAM_INT);

			// Executa a query
			$statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'SELECT
						id_estado as Codigo,
						sigla_estado as SiglaEstado,
						nome_estado as NomeEstado
					FROM tb_estado;';

			// Executa a query e cria o array de objetos TipoUnidade
			$statement = $Conexao->query($SQL);
			$statement = $statement->fetchAll(PDO::FETCH_ASSOC);
			$resultado = null;
			if($statement != false && !empty($statement))
				foreach($statement as $linha)
					$resultado[] = new Estado($linha['Codigo'], $linha['SiglaEstado'], $linha['NomeEstado']);

			return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obtém a conexão
			$Conexao = DbConnection::retornaConexao();

			// Prepara a query
			$SQL = 'SELECT
						id_estado as Codigo,
						sigla_estado as SiglaEstado,
						nome_estado as NomeEstado
					FROM tb_estado
					WHERE id_estado = :id_estado;';

			$statement = $Conexao->prepare($SQL);
			$statement->bindValue(':id_estado', $IdObjeto, PDO::PARAM_INT);

			// Executa a query e obtém os dados do Tipo Unidade
			$statement->execute();
			$resultado = $statement->fetch(PDO::FETCH_ASSOC);
			if($resultado != false && !empty($resultado))
				$resultado = new Estado($resultado['Codigo'], $resultado['SiglaEstado'], $resultado['NomeEstado']);
			else
				$resultado = null;

			return $resultado;
        }
    }
?>