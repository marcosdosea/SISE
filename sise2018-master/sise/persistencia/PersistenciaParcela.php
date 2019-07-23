<?php
    /**
     * Autor: Paulo David
     * Date: 24/02/2017
     * Time: 14:34
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Parcela.php';

    class PersistenciaParcela implements DaoGenerico {

        function inserir($Parcela)
        {
            //Prepara a conexão
            $Conexao = DbConnection::retornaConexao();

            //Prepara a query
            $SQL = 'INSERT INTO tb_parcela (valor_parcela,vencimento_parcela,status_parcela,referencia_parcela, id_pagamento, id_parcela_asaas)                                
            VALUES 
            (:valor_parcela,:vencimento_parcela,:status_parcela,:referencia_parcela, :id_pagamento, :id_parcela_asaas)';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':valor_parcela', $Parcela->getValorParcela(), PDO::PARAM_STR); //Valor da parcela não deveria ser Double? deixei passar isso na revisão
            $statement->bindValue(':vencimento_parcela', $Parcela->getVencimentoParcela(), PDO::PARAM_STR);
            $statement->bindValue(':status_parcela', $Parcela->getStatusParcela(), PDO::PARAM_STR);
            $statement->bindValue(':referencia_parcela', $Parcela->getReferenciaParcela(), PDO::PARAM_STR);
            $statement->bindValue(':id_pagamento', $Parcela->getIdPagamento(), PDO::PARAM_INT);
            $statement->bindValue(':id_parcela_asaas', $Parcela->getIdParcelaAsaas(), PDO::PARAM_STR);

            $statement->execute();
        }

        function atualizar($Parcela)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_parcela SET
                            valor_parcela = :valor_parcela,
                            vencimento_parcela = :vencimento_parcela,
                            status_parcela = :status_parcela,
                            referencia_parcela = : referencia_parcela,
                            id_pagamento = :id_pagamento,
                        WHERE id_parcela = :id_parcela';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':valor_parcela', $Parcela->getValorParcela(), PDO::PARAM_STR); //Valor da parcela não deveria ser Double? deixei passar isso na revisão
            $statement->bindValue(':vencimento_parcela', $Parcela->getVencimentoParcela(), PDO::PARAM_STR);
            $statement->bindValue(':status_parcela', $Parcela->getStatusParcela(), PDO::PARAM_STR);
            $statement->bindValue(':referencia_parcela', $Parcela->getParcela(), PDO::PARAM_STR);
            $statement->bindValue(':id_pagamento', $Parcela->getIdPagamento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function remover($parcela)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_parcela WHERE id_parcela = :id_parcela;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_parcela', $parcela->getIdParcela(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function obterTodos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_parcela as idParcela,
                            valor_parcela as valorParcela,
                            vencimento_parcela as vencimentoParcela,
                            status_parcela as statusParcela,
                            referencia_parcela as referenciaParcela,
                            id_pagamento as idPagamento,
                        FROM tb_parcela;';

            // Executa a query e cria o array de objetos Parcela
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != false && !empty($statement))
                foreach($statement as $linha)
                    $resultado[] = new Parcela($linha['idParcela'], $linha['valorParcela'], $linha['vencimentoParcela'], $linha['statusParcela'],
                                   $linha['referenciaParcela'], $linha['idPagamento']);

            return $resultado;
        }

        function obterById($IdParcela)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_parcela as idParcela,
                            valor_parcela as valorParcela,
                            vencimento_parcela as vencimentoParcela,
                            status_parcela as statusParcela,
                            referencia_parcela as referenciaParcela,
                            id_pagamento as idPagamento,
                        FROM tb_parcela
                        WHERE id_parcela = :id_parcela;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_parcela', $IdParcela, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Parcela by ID
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if($resultado != false && !empty($resultado))
                $resultado = new Parcela($resultado['idParcela'], $resultado['valorParcela'], $resultado['vencimentoParcela'], $resultado['statusParcela'],
                    $resultado['referenciaParcela'], $resultado['idPagamento']);
            else
                $resultado = null;

            return $resultado;
        }
		
		function obterTodosPorPagamento($idPagamento)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_parcela as idParcela,
                            valor_parcela as valorParcela,
                            vencimento_parcela as vencimentoParcela,
                            status_parcela as statusParcela,
                            referencia_parcela as referenciaParcela,
                            id_pagamento as idPagamento,
                            id_parcela_asaas as idAsaas
                        FROM tb_parcela
						WHERE id_pagamento = :idPagamento;';
						
						
			$statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idPagamento', $idPagamento, PDO::PARAM_INT);
         			
			// Executa a query e cria o array de objetos Parcela
            $statement->execute();
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if($statement != false && !empty($statement))
                foreach($statement as $linha)
                    $resultado[] = new Parcela($linha['idParcela'], $linha['valorParcela'], $linha['vencimentoParcela'], $linha['statusParcela'],
                                   $linha['referenciaParcela'], $linha['idPagamento'], $linha['idAsaas']);

            return $resultado;
        }
    }
?>