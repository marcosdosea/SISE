<?php
    /**
     * Autor: Paulo David
     * Date: 24/02/2017
     * Time: 23:02
     * UPDATE
     * Autor: John Hed
     * Date: 17/07/2017
     * Descrição:
     * erro no metodo obterTodos, havia uma virgula antes do FROM
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Cidade.php';

    class PersistenciaCidade implements DaoGenerico {

        function inserir($Cidade)
        {
            //Prepara a conexão
            $Conexao = DbConnection::retornaConexao();

            //Prepara a query
            $SQL = 'INSERT INTO tb_cidade (nome_cidade,id_estado)                                
            VALUES 
            (:nome_cidade,:id_estado)';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_cidade', $Cidade->getNomeCidade(), PDO::PARAM_STR);
            $statement->bindValue(':id_estado', $Cidade->getIdEstado(), PDO::PARAM_INT);
     
        }

        function atualizar($Cidade)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_cidade SET
                            nome_cidade = :nome_cidade,
                            id_estado = :id_estado,
                        WHERE id_cidade = :id_cidade';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_cidade', $Cidade->getNomeCidade(), PDO::PARAM_STR);
            $statement->bindValue(':id_estado', $Cidade->getIdEstado(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function remover($Cidade)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_cidade WHERE id_cidade = :id_cidade;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_cidade', $Cidade->getIdCidade(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_cidade as idCidade,
                            nome_cidade as nomeCidade,
                            id_estado as idEstado
                        FROM tb_cidade;';

            // Executa a query e cria o array de objetos Cidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != false && !empty($statement))
                foreach($statement as $linha)
                    $resultado[] = new Cidade($linha['idCidade'], $linha['nomeCidade'], $linha['idEstado']);

            return $resultado;
        }

        function obterById($IdCidade)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_cidade as idCidade,
                            nome_cidade as nomeCidade,
                            id_estado as idEstado
                        FROM tb_cidade
                        WHERE id_cidade = :idCidade;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idCidade', $IdCidade, PDO::PARAM_INT);

            // Executa a query e obtém os dados do tipo Cidade by ID
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if($resultado != false && !empty($resultado))
                $resultado = new Cidade($resultado['idCidade'], $resultado['nomeCidade'], $resultado['idEstado']);
            else
                $resultado = null;

            return $resultado;
        }
    }
?>