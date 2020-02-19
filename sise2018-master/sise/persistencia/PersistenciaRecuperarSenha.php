<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 04/09/2017
 * Time: 23:38
 */

require_once 'DbConnection.php';
require_once 'DaoGenerico.php';
require_once '../model/RecuperarSenha.php';

class PersistenciaRecuperarSenha implements DaoGenerico
{
    function inserir($Objeto)
    {
        // Obtém a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a query
        $SQL = 'INSERT INTO tb_recuperar_senha (token,data_requisicao,data_validade,utilizado,id_usuario)
                            VALUES (:token,now(),ADDDATE(now(), INTERVAL 1 DAY),:utilizado, :id_usuario);';

        $statement = $Conexao->prepare($SQL);

        $statement->bindValue(':token', $Objeto->getToken(), PDO::PARAM_STR);
        $statement->bindValue(':utilizado', $Objeto->getUtilizado(), PDO::PARAM_STR);
        $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);

        // Executa a query
        $statement->execute();
    }

    function atualizar($Objeto)
    {
        // Obtém a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a query
        $SQL = 'UPDATE tb_recuperar_senha 
                                SET
                                  token = :token,
                                  utilizado = :utilizado
                                WHERE id_usuario = :id_usuario';

        $statement = $Conexao->prepare($SQL);

        $statement->bindValue(':token', $Objeto->getToken(), PDO::PARAM_STR);
        $statement->bindValue(':utilizado', $Objeto->getUtilizado(), PDO::PARAM_STR);
        $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);

        // Executa a query
        $statement->execute();
    }

    function remover($Objeto)
    {
        // TODO: Implement remover() method.
    }

    function obterTodos()
    {
        // TODO: Implement obterTodos() method.
    }

    function obterById($IdObjeto)
    {
        // TODO: Implement obterById() method.
    }

    function obterValidoByIdUser($IdUsuario)
    {
        // Obtém a conexão
        $Conexao = DbConnection::retornaConexao();

        // Prepara a query
        $SQL = "SELECT 
                       id_recuperar_senha as idRecuperarSenha,
                       token as token,
                       data_requisicao as dataRequisicao,
                       data_validade as dataValidade,
                       utilizado as utilizado,
                       id_usuario as idUsuario
                    FROM tb_recuperar_senha
                    WHERE NOW() > data_requisicao AND NOW() < data_validade AND id_usuario = :idUsuario AND utilizado = 'N'";

        $statement = $Conexao->prepare($SQL);
        $statement->bindValue(':idUsuario', $IdUsuario, PDO::PARAM_INT);
        // Executa a query e obtém os dados do Tipo Unidade
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        if($resultado != false && !empty($resultado)) {
            $resultado = new RecuperarSenha ($resultado['idRecuperarSenha'], $resultado['token'],
                $resultado['dataRequisicao'], $resultado['dataValidade'],
                $resultado['utilizado'], $resultado['idUsuario']);

        } else
            $resultado = null;

        return $resultado;
    }

}