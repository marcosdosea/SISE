<?php
    /**
     * Autor: John Hed
     * Date: 14/08/2017
      */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/AdminEvento.php';

    class PersistenciaAdminEvento implements DaoGenerico
    {

        function inserir($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'INSERT INTO tb_admin_evento(id_usuario,id_evento) 
                                      VALUES (:id_usuario, :id_evento);';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function atualizar($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_admin_evento SET
                            id_usuario = :id_usuario,
                            id_evento = :id_evento
                        WHERE id_usuario = :id_usuario AND id_evento = :id_evento;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function remover($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_admin_evento WHERE id_usuario = :id_usuario AND id_evento = :id_evento;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_usuario as idUsuario,
                            id_evento as idEvento
                        FROM tb_admin_evento;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new AdminEvento($linha['idUsuario'],$linha['idEvento']);

            return $resultado;
        }

        function obterById($IdObjeto){}

        function obterByIdUser($IdUsuario)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT COUNT(e.id_evento) 
                        FROM tb_evento e 
                        INNER JOIN tb_adm_evento a 
                        ON (e.id_evento = a.id_evento) 
                        WHERE a.id_usuario = {$IdUsuario};";

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->prepare($SQL);
            $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($resultado != false && !empty($resultado))
                    $resultado = new Evento(
                        $resultado['id_evento'],
                        $resultado['nome_evento'],
                        $resultado['siga_evento'],
                        $resultado['descricao_evento'],
                        $resultado['inicio_inscricoes_evento']);

            return $resultado;
        }

        function obterTodosEventosByIdAdmin($IdUsuario)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT
                            id_usuario as idUsuario,
                            id_evento as idEvento
                        FROM tb_admin_evento
                        GROUP BY id_usuario = {$IdUsuario};";

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new AdminEvento($linha['idUsuario'],$linha['idEvento']);

            return $resultado;
        }
    }
?>