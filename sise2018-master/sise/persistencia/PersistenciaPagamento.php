<?php
    /**
     * Autor: Paulo David
     * Date: 22/02/2017
     * Time: 21:22
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Pagamento.php';

    class PersistenciaPagamento implements DaoGenerico {

        function inserir($Pagamento)
        {
            //Prepara a conexão
            $Conexao = DbConnection::retornaConexao();

            //Prepara a query
            $SQL = 'INSERT INTO tb_pagamento (valor_pagamento,quantidade_parcelas_pagamento,status_pagamento,id_usuario, id_evento, tipo_pagamento)                                
            VALUES 
            (:valor_pagamento,:quantidade_parcelas_pagamento,:status_pagamento,:id_usuario, :id_evento,:tipo_pagamento)';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':valor_pagamento', $Pagamento->getValorPagamento(), PDO::PARAM_STR);
            $statement->bindValue(':quantidade_parcelas_pagamento', $Pagamento->getQuantidadeParcelasPagamento(), PDO::PARAM_INT);
            $statement->bindValue(':status_pagamento', $Pagamento->getStatusPagamento(), PDO::PARAM_STR);
            $statement->bindValue(':id_usuario', $Pagamento->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento', $Pagamento->getIdEvento(), PDO::PARAM_INT);
            $statement->bindValue(':tipo_pagamento', $Pagamento->getTipoPagamento(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();

            return $Conexao->lastInsertId();
        }

        function atualizar($Pagamento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_pagamento SET
                            valor_pagamento = :valor_pagamento,
                            quantidade_parcelas_pagamento = :quantidade_parcelas_pagamento,
                            status_pagamento = :status_pagamento,
                            id_usuario = : id_usuario,
                            id_evento = :id_evento,
                            tipo_pagamento = :tipo_pagamento,
                        WHERE id_pagamento = :id_pagamento';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':valor_pagamento', $Pagamento->getValorPagamento(), PDO::PARAM_DOUBLE);
            $statement->bindValue(':quantidade_parcelas_pagamento', $Pagamento->getQuantidadeParcelasPagamento(), PDO::PARAM_INT);
            $statement->bindValue(':status_pagamento', $Pagamento->getStatusPagamento(), PDO::PARAM_STR);
            $statement->bindValue(':id_usuario', $Pagamento->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento', $Pagamento->getIdEvento(), PDO::PARAM_INT);
            $statement->bindValue(':tipo_pagamento', $Pagamento->getTipoPagamento(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function remover($Pagamento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_pagamento WHERE id_pagamento = :id_pagamento;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_pagamento', $Pagamento->getIdPagamento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_pagamento as idPagamento,
                            valor_pagamento as valorPagamento,
                            quantidade_parcelas_pagamento as quantidadeParcelasPagamento,
                            status_pagamento as statusPagamento,
                            id_usuario as idUsuario,
                            id_evento as idEvento,
                            tipo_pagamento as tipoPagamento,
                        FROM tb_pagamento;';

            // Executa a query e cria o array de objetos Pagamento
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != false && !empty($statement))
                foreach($statement as $linha)
                    $resultado[] = new Pagamento($linha['idPagamento'], $linha['valorPagamento'], $linha['quantidadeParcelasPagamento'], $linha['statusPagamento'],
                                   $linha['idUsuario'], $linha['idEvento'], $linha['tipoPagamento']);

            return $resultado;
        }

        function obterById($IdPagamento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_pagamento as idPagamento,
                            valor_pagamento as valorPagamento,
                            quantidade_parcelas_pagamento as quantidadeParcelasPagamento,
                            status_pagamento as statusPagamento,
                            id_usuario as idUsuario,
                            id_evento as idEvento,
                            tipo_pagamento as tipoPagamento,
                        FROM tb_pagamento
                        WHERE id_pagamento = :idPagamento;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_pagamento', $IdPagamento, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Pagamento
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if($resultado != false && !empty($resultado))
                $resultado = new Pagamento($resultado['idPagamento'], $resultado['valorPagamento'], $resultado['quantidadeParcelasPagamento'], $resultado['statusPagamento'],
                    $resultado['idUsuario'], $resultado['idEvento'], $resultado['tipoPagamento']);
            else
                $resultado = null;

            return $resultado;
        }

        function obterPeloUsuarioEvento($idUsuario,$idEvento){
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_pagamento as idPagamento,
                            valor_pagamento as valorPagamento,
                            quantidade_parcelas_pagamento as quantidadeParcelasPagamento,
                            status_pagamento as statusPagamento,
                            id_usuario as idUsuario,
                            id_evento as idEvento,
                            tipo_pagamento as tipoPagamento
                        FROM tb_pagamento
                        WHERE id_usuario = :idUsuario and id_evento = :idEvento';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
			$statement->bindValue(':idEvento', $idEvento, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Pagamento
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if($resultado != false && !empty($resultado))
                $resultado = new Pagamento($resultado['idPagamento'], $resultado['valorPagamento'], $resultado['quantidadeParcelasPagamento'], $resultado['statusPagamento'],
                    $resultado['idUsuario'], $resultado['idEvento'], $resultado['tipoPagamento']);
            else
                $resultado = null;

            return $resultado;
        }

    }
?>