<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 17/07/2017
 * Time: 16:29
 */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Usuario.php';
    require_once '../model/Evento.php';

    class PersistenciaFrequencia implements DaoGenerico
    {

        function inserir($Objeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = ' INSERT INTO tb_frequencia (data_hora_frequencia, id_evento_frequencia, id_usuario_frequencia)
                                         VALUES (:data_hora_frequencia, :id_evento_frequencia, :id_usuario_frequencia);';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue('data_hora_frequencia', $Objeto->getDataHoraFrequencia(), PDO::PARAM_STR);
            $statement->bindValue('id_evento_frequencia', $Objeto->getIdEventoFrequencia(), PDO::PARAM_INT);
            $statement->bindValue('id_usuario_frequencia', $Objeto->getIdUsuarioFrequencia(), PDO::PARAM_INT);

            // Executa a Query
            $statement->execute();
        }
        function atualizar($Objeto)
        {
            // TODO: Implement atualizar() method.
        }

        function remover($Objeto)
        {
            // TODO: Implement remover() method.
        }
        function obterTodos()
        {
            // Obter a Conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'SELECT 
                            data_hora_frequencia as :DataHoraFrequencia,
                            id_evento_frequencia as :IdEventoFrequencia,
                            id_usuario_frequencia as :IdUsuarioFrequencia
                            FROM tb_frequencia;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != null && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new Evento($linha['DataHoraFrequencia'], $linha['IdEventoFrequencia'], $linha['IdUsuarioFrequencia']);

                return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obter a Conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'SELECT 
                            data_hora_frequencia as DataHoraFrequencia,
                            id_evento_frequencia as IdEventoFrequencia,
                            id_usuario_frequencia as IdUsuarioFrequencia
                        FROM tb_frequencia
                        WHERE id_evento_frequencia = :id_evento_frequencia 
                        AND id_usuario_frequencia = :id_usuario_frequencia';
            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_evento_frequencia', $IdObjeto, PDO::PARAM_STR);
            $statement->bindValue(':id_usuario_frequencia', $IdObjeto, PDO::PARAM_STR);

            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
            $resultado = new Frequencia($resultado['id_evento_frequencia'], $resultado['id_usuario_frequencia']);
        else
            $resultado = null;

            return $resultado;
        }

        function obterQntFreqByDia($dia, $evento, $idUsuario)
        {
            $Conexao = DbConnection::retornaConexao();

            $SQL =" SELECT COUNT(id_usuario_frequencia) AS Quant
                FROM tb_frequencia
                WHERE CAST(data_hora_frequencia AS DATE) = CAST(:diaFrequencia AS DATE)
                AND id_evento_frequencia = :idEvento 
                AND id_usuario_frequencia = :idUsuario";

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':diaFrequencia', $dia);
            $statement->bindValue(':idEvento', $evento);
            $statement->bindValue(':idUsuario', $idUsuario);

            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            return $resultado['Quant'];
        }

    }