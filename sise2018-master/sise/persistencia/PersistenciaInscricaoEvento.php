<?php
    /**
     * Autor: Kaic
     * Date: 25/02/2017
     * Time: 10:08
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/InscricaoEvento.php';
    require_once '../model/Usuario.php';

    class PersistenciaInscricaoEvento implements DaoGenerico {

        function inserir($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'INSERT INTO tb_inscricao_evento(tb_usuario_id_usuario,tb_evento_id_evento,data_hora_inscricao_evento) VALUES (:id_usuario,:id_evento,NOW());';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function atualizar($Objeto)
        {
            //
        }

        function remover($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_inscricao_evento WHERE tb_usuario_id_usuario = :id_usuario AND tb_evento_id_evento = :id_evento;';

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
                            tb_usuario_id_usuario as CodigoUsuario,
                            tb_evento_id_evento as CodigoEvento,
                            data_hora_inscricao_evento as dataHoraInscricaoEvento
                        FROM tb_inscricao_evento;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new InscricaoEvento($linha['CodigoUsuario'], $linha['CodigoEvento'], $linha['dataHoraInscricaoEvento']);

            return $resultado;
        }

        function obterById($IdObjeto){
            //
        }

        function obterTodosByIdUsuario($IdObjeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            tb_usuario_id_usuario as CodigoUsuario,
                            tb_evento_id_evento as CodigoEvento,
                            data_hora_inscricao_evento as dataHoraInscricaoEvento
                        FROM tb_inscricao_evento WHERE tb_usuario_id_usuario = :idUsuario
                        AND tb_evento_id_evento IN (SELECT id_evento FROM tb_evento WHERE id_evento_pai IS NULL);
                        ';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':idUsuario', $IdObjeto, PDO::PARAM_INT);

            $statement->execute();
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

            $resultado = null;
            if ($statement != false && !empty($statement))

                foreach ($statement as $linha)
                    $resultado[] = new InscricaoEvento($linha['CodigoUsuario'], $linha['CodigoEvento'], $linha['dataHoraInscricaoEvento']);

            return $resultado;
        }

        function obterInscricao($idUsuario, $idEvento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                                tb_usuario_id_usuario as IdUsuario,
                                tb_evento_id_evento as IdEvento,
                                data_hora_inscricao_evento as dataHoraInscricaoEvento
                            FROM tb_inscricao_evento 
                            WHERE tb_usuario_id_usuario = :idUsuario AND tb_evento_id_evento = :idEvento';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $statement->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            $statement->execute();

            $resultado = null;
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($statement != false && !empty($statement))
                $resultado = new InscricaoEvento($resultado['IdUsuario'], $resultado['IdEvento'], $resultado['dataHoraInscricaoEvento']);

            return $resultado;
        }

        //retorna os minicursos que o usuario está inscrito do evento específico
        function obterTodosMiniCursosInscritos($idUsuario, $idEvento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            tb_usuario_id_usuario as CodigoUsuario,
                            tb_evento_id_evento as CodigoEvento,
                            data_hora_inscricao_evento as dataHoraInscricaoEvento
                        FROM tb_inscricao_evento WHERE tb_usuario_id_usuario = :idUsuario
                        AND tb_evento_id_evento IN (SELECT id_evento FROM tb_evento WHERE id_evento_pai = :idEvento)
                        ';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $statement->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            $statement->execute();
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

            $resultado = null;
            if ($statement != false && !empty($statement))

                foreach ($statement as $linha)
                    $resultado[] = new InscricaoEvento($linha['CodigoUsuario'], $linha['CodigoEvento'], $linha['dataHoraInscricaoEvento']);

            return $resultado;
        }

        function obterInscritosNoEvento($idEvento){
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT u.id_usuario,u.nome_usuario, u.cpf_usuario,
                      u.rg_usuario,u.empresa_usuario,u.federada_usuario,
                      u.email_usuario,u.tel1_usuario,u.tel2_usuario,u.id_federacao,
                      u.sexo_usuario,u.senha_usuario,u.id_asaas_usuario 
                        from tb_inscricao_evento i inner join tb_usuario u on (i.tb_usuario_id_usuario = u.id_usuario) where i.tb_evento_id_evento = :idEvento 
                        ';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);
            $statement->execute();
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

            $resultado = null;
            if ($statement != false && !empty($statement))

                foreach ($statement as $linha)
                    $resultado[] = new Usuario($linha['id_usuario'], $linha['nome_usuario'], $linha['cpf_usuario'], $linha['rg_usuario'], $linha['empresa'], $linha['federada_usuario'], $linha['cpf_usuario'], $linha['email_usuario'], $linha['tel1_usuario'], $linha['tel2_usuario'], $linha['id_federacao'], $linha['sexo_usuario'],$linha['senha_usuario'], $linha['id_asaas_usuario']);

            return $resultado;
        }
    }
?>