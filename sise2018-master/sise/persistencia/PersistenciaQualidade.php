<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 16:09
 */

    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Qualidade.php';

class PersistenciaQualidade implements DaoGenerico
{

    function inserir($Objeto)
    {

        // Obtem a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a Query
        $SQL = 'INSERT INTO tb_qualidade 
                                 (id_qualidade, nome_qualidade) 
                        VALUES (:id_qualidade, :nome_qualidade);';


        $statement = $Conexao->prepare($SQL);

        $statement->bindValue(':id_qualidade', $Objeto->getIdQualidade(), PDO::PARAM_INT);
        $statement->bindValue(':nome_qualidade', $Objeto->getNomeQualidade(), PDO::PARAM_STR);

        // Executa a query
        $statement->execute();
    }

    function atualizar($Objeto){
        //
    }

    function remover($Objeto)
    {
        // Obter a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a Query
        $SQL = 'DELETE FROM tb_qualidade WHERE id_qualidade = :id_qualidade;';

        $statement = $Conexao->prepare($SQL);
        $statement->bindValue(':id_qualidade', $Objeto->getIdQualidade(), PDO::PARAM_INT);

        // Executa a Query
        $statement->execute();
    }

    function obterTodos()
    {
        // Obter a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a Query
        $SQL = 'SELECT 
                              id_qualidade as idQualidade,
                              nome_qualidade as nomeQualidade
                              FROM tb_qualidade;';


        // Executa a query e cria o array de objetos
        $statement = $Conexao->query($SQL);
        $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
        $resultado = null;

        if ($statement != false && !empty($statement))
            foreach ($statement as $linha)
                $resultado[] = new Qualidade($linha['idQualidade'], $linha['nomeQualidade']);

        return $resultado;
    }

    function obterById($IdObjeto)
    {
        // Obter a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a Query
        $SQL = 'SELECT
                          id_qualidade as idQualidade,
                          nome_qualidade as nomeQualidade
                      FROM tb_qualidade
                      WHERE id_qualidade = :idQualidade;';

        $statement = $Conexao->prepare($SQL);
        $statement->bindValue(':idQualidade', $IdObjeto, PDO::PARAM_INT);

        // Executa a query e obtém os dados do Tipo Unidade
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);

        if ($resultado != false && !empty($resultado))
            $resultado = new Qualidade($resultado['idQualidade'],$resultado['nomeQualidade']);
        else
            $resultado = null;

        return $resultado;

    }

}