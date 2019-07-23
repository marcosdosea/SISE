<?php
    /**
     * Autor: Paulo David
     * Date: 24/02/2017
     * Time: 23:19
     * UPDATE
     * Autor: John Hed
     *  Date: 19/07/2017
     * 1- criação da funcao obterId
     * 2- correcao da função de inserir, faltava executar a query
     * 3- Correção das funções obterTodos e obterById, amabdas tinham um ',' antes do Form
     * 4- Na Função Inserir faltou inserir a linha de executar a query -> $statement->execute();
     * === Atualização 2 ===
     * Autor: Gabriel Santana
     * Date: 04/09/2017
     * Message: Remoção da função ObterByIdUsuario. Substituindo por obterById, pois são iguais.
      */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Endereco.php';

    class PersistenciaEndereco implements DaoGenerico {

        function inserir($Endereco)
        {
            //Prepara a conexão
            $Conexao = DbConnection::retornaConexao();

            //Prepara a query
            $SQL = 'INSERT INTO tb_endereco (
                                logradouro_endereco,
                                numero_endereco,
                                bairro_endereco,
                                id_cidade, 
                                cep_endereco)                                
                         VALUES 
                              ( :logradouro_endereco,
                                :numero_endereco,
                                :bairro_endereco,
                                :id_cidade, 
                                :cep_endereco)';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':logradouro_endereco', $Endereco->getLogradouroEndereco(), PDO::PARAM_STR);
            $statement->bindValue(':numero_endereco', $Endereco->getNumeroEndereco(), PDO::PARAM_INT);
            $statement->bindValue(':bairro_endereco', $Endereco->getBairroEndereco(), PDO::PARAM_STR);
            $statement->bindValue(':id_cidade', $Endereco->getIdCidade(), PDO::PARAM_INT);
            $statement->bindValue(':cep_endereco', $Endereco->getCepEndereco(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function atualizar($Endereco)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_endereco SET
                            logradouro_endereco = :logradouro_endereco,
                            numero_endereco = :numero_endereco,
                            bairro_endereco = :bairro_endereco,
                            cep_endereco = :cep_endereco
                        WHERE id_endereco = :id_endereco';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':logradouro_endereco', $Endereco->getLogradouroEndereco(), PDO::PARAM_STR);

            $statement->bindValue(':numero_endereco', $Endereco->getNumeroEndereco(), PDO::PARAM_STR);
            $statement->bindValue(':bairro_endereco', $Endereco->getBairroEndereco(), PDO::PARAM_STR);
            $statement->bindValue(':cep_endereco', $Endereco->getCepEndereco(), PDO::PARAM_STR);
            $statement->bindValue(':id_endereco', $Endereco->getIdEndereco(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function remover($Endereco)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_endereco WHERE id_endereco = :id_endereco;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_endereco', $Endereco->getIdEndereco(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            logradouro_endereco as logradouroEndereco,
                            numero_endereco as numeroEndereco,
                            bairro_endereco as bairroEndereco,
                            id_cidade as idCidade,
                            cep_endereco as cepEndereco
                        FROM tb_endereco;';

            // Executa a query e cria o array de objetos Endereco
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != false && !empty($statement))
                foreach($statement as $linha)
                    $resultado[] = new Endereco($linha['logradouroEndereco'], $linha['numeroEndereco'], $linha['bairroEndereco'],
                                   $linha['idCidade'], $linha['cepEndereco']);

            return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT  
                            e.id_endereco AS idEndereco,
                            e.logradouro_endereco AS logradouroEndereco,
                            e.numero_endereco AS numeroEndereco,
                            e.bairro_endereco AS bairroEndereco,
                            e.id_cidade AS idCidade,
                            e.cep_endereco AS cepEndereco
                            FROM tb_endereco AS e 
                            WHERE e.id_endereco = :idEndereco;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idEndereco', $IdObjeto, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Pagamento by ID
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if($resultado != false && !empty($resultado))
                $resultado = new Endereco($resultado['idEndereco'],$resultado['logradouroEndereco'], $resultado['numeroEndereco'],
                    $resultado['bairroEndereco'], $resultado['idCidade'], $resultado['cepEndereco']);
            else
                $resultado = null;

            return $resultado;
        }

        function obterId($nomeEndereco)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $sql = "SELECT  id_endereco  as idEndereco 
                        FROM TB_ENDERECO
                        WHERE logradouro_endereco = :endereco;";

            $stmt = $Conexao->prepare($sql);
            $stmt->bindParam(':endereco', $_POST['endereco']);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resultado != false && !empty($resultado))
                $resultado = $resultado['idEndereco'];
            else
                $resultado = null;

            return $resultado;
        }

    }
?>