<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Santana
 * Date: 14/07/2017
 * Time: 12:16
 * UPDATE
 * Autor: JOHN HED
 * Descrição:
 * 1- Criação do Método obterByIdEvento()
 */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Certificado.php';
    require_once '../model/Evento.php';

    class PersistenciaCertificado implements DaoGenerico
    {
        function inserir($Objeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'INSERT INTO tb_certificado (
                                ch_certificado, 
                                status_certificado, 
                                url_imagem_certificado, 
                                tipo_certificado, 
                                id_evento)
                                          VALUES (
                                          :ch_certificado, 
                                          :status_certificado, 
                                          :url_imagem_certificado, 
                                          :tipo_certificado, 
                                          :id_evento);';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':ch_certificado', $Objeto->getChCertificado(), PDO::PARAM_INT);
            $statement->bindValue(':status_certificado', $Objeto->getStatusCertificado(), PDO::PARAM_INT);
            $statement->bindValue(':url_imagem_certificado', $Objeto->getUrlImagemCertificado(), PDO::PARAM_STR);
            $statement->bindValue(':tipo_certificado', 'OUVINTE', PDO::PARAM_STR);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_INT);

            // Executa a Query
            $statement->execute();
        }

        function atualizar($Objeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'UPDATE tb_certificado SET
                                ch_certificado = :ch_certificado,
                                status_certificado = :status_certificado,
                                url_imagem_certificado = :url_imagem_certificado,
                                tipo_certificado = :tipo_certificado
                              WHERE id_certificado = :id_certificado;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':ch_certificado', $Objeto->getChCertificado(), PDO::PARAM_INT);
            $statement->bindValue(':status_certificado', $Objeto->getStatusCertificado(), PDO::PARAM_INT);
            $statement->bindValue(':url_imagem_certificado', $Objeto->getUrlImagemCertificado(), PDO::PARAM_STR);
            $statement->bindValue(':tipo_certificado', $Objeto->getTipoCertificado(), PDO::PARAM_STR);
            $statement->bindValue(':id_certificado', $Objeto->getIdCertificado(), PDO::PARAM_INT);

            // Executa a Query
            $statement->execute();
        }

        function remover($Objeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'DELETE FROM tb_certificado WHERE id_certificado = :id_certificado;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_certificado', $Objeto->getIdCertificado(), PDO::PARAM_INT);

            // Executa a Query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'SELECT 
                              id_certificado as id_certificado,
                              ch_certificado as ch_certificado,
                              status_certificado as status_certificado,
                              url_imagem_certificado as url_imagem_certificado,
                              tipo_certificado as tipo_certificado,
                              id_evento as id_evento
                              FROM tb_certificado;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;

            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new Certificado($linha['id_certificado'], $linha['ch_certificado'], $linha['status_certificado'],
                        $linha['url_imagem_certificado'], $linha['tipo_certificado'],$linha['id_evento']);

            return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'SELECT
                          id_certificado as id_certificado,
                          ch_certificado as ch_certificado,
                          status_certificado as status_certificado,
                          url_imagem_certificado as url_imagem_certificado,
                          tipo_certificado as tipo_certificado,
                          id_evento as id_evento
                      FROM tb_certificado
                      WHERE id_certificado = :id_certificado;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_certificado', $IdObjeto, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            if ($resultado != false && !empty($resultado))
                $resultado = new Certificado(
                    $resultado['id_certificado'],
                    $resultado['ch_certificado'],
                    $resultado['status_certificado'],
                    $resultado['url_imagem_certificado'],
                    $resultado['tipo_certificado'],
                    $resultado['id_evento']
                    );
            else
                $resultado = null;

            return $resultado;

        }

        function obterByIdEvento($IdObjeto)
        {
            // Obter a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = 'SELECT
                          id_certificado as id_certificado,
                          ch_certificado as ch_certificado,
                          status_certificado as status_certificado,
                          url_imagem_certificado as url_imagem_certificado,
                          tipo_certificado as tipo_certificado,
                          id_evento as id_evento
                      FROM tb_certificado
                      WHERE id_evento = :id_evento;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_evento', $IdObjeto, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            if ($resultado != false && !empty($resultado))
                $resultado = new Certificado(
                    $resultado['id_certificado'],
                    $resultado['ch_certificado'],
                    $resultado['status_certificado'],
                    $resultado['url_imagem_certificado'],
                    $resultado['tipo_certificado'],
                    $resultado['id_evento']
                );
            else
                $resultado = null;

            return $resultado;

        }
    }