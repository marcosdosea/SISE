<?php
/**
 * Created by PhpStorm.
 * User: Ednilson MCS
 * Date: 17/08/2017
 * Time: 16:15
 */


require_once 'DbConnection.php';
require_once 'DaoGenerico.php';
require_once '../model/InfoFrequencia.php';

class PersistenciaInfoFrequencia implements DaoGenerico
{

    function inserir($Objeto)
    {
        // Obtém a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a query
        $SQL = 'INSERT INTO tb_info_frequencia (dia_info_frequencia, quant_info_frequencia, id_evento) 
                VALUES (:dia_info_frequencia, :quant_info_frequencia , :id_evento)';
        $statement = $Conexao->prepare($SQL);

        $statement->bindValue(':dia_info_frequencia', $Objeto->getDiaInfo(), PDO::PARAM_STR);
        $statement->bindValue('quant_info_frequencia', $Objeto->getQuantInfoFrequencia(), PDO::PARAM_STR);
        $statement->bindValue('id_evento', $Objeto->getIdEvento(), PDO::PARAM_STR);

        // Executa a query
        $statement->execute();
    }

    function atualizar($Objeto){}

    function remover($Objeto){}

    function obterTodos(){}

    function obterById($IdObjeto){}

    function obterQuantByDiaEvento($dia, $evento){
        $Conexao = DbConnection::retornaConexao();

        $SQL =" SELECT quant_info_frequencia as Quant
                FROM tb_info_frequencia 
                WHERE dia_info_frequencia = :diaFrequencia
                AND id_evento =  :idEvento";

        $statement = $Conexao->prepare($SQL);
        $statement->bindValue(':diaFrequencia', $dia);
        $statement->bindValue(':idEvento', $evento);

        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        return $resultado['Quant'];
    }
}
