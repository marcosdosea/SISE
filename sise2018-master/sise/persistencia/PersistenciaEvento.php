<?php
    /**
     * Autor: Kaic
     * Date: 24/02/2017
     * Time: 15:21
     * UPDATE
     * Autor: John Hed
     * Date: 17/07/2017
     * 1- atualização co campo url_imagem para url_imagem_evento que é o que consta no banco
     * 2- atualização do campo qntd_parcelas_permitida para qntd_parcelas_permitida_evento
     * 3- corrção da palavra :sigla_evento, antes estava :sigle_evento
     * 4- correcação na declaração da variavel :descricao_evento estava descicao_evento
     * 5- Criação do metodo obterByNome();
     * 6- Criação da fução obterEventosByNomeAndUsuario() para pega todos os eventos cadastrados por um determinado Nome por umcliente
     * 6- Criação da fução obterEventosByUsuario() para pega todos os eventos cadastrados por um determinado cliente
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Evento.php';

    class PersistenciaEvento implements DaoGenerico
    {

        function inserir($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'INSERT INTO tb_evento( 
                                            nome_evento,
                                            sigla_evento,
                                            descricao_evento,
                                            inicio_inscricoes_evento,
                                            fim_inscricoes_evento,
                                            data_inicio_evento,
                                            data_fim_evento,
                                            id_endereco,
                                            id_evento_pai,
                                            url_imagem_evento,
                                            valor_evento,
                                            qntd_parcelas_permitida_evento,
                                            part_min_evento,
                                            ativo_evento
                                          ) VALUES (
                                          :nome_evento,
                                          :sigla_evento,
                                          :descricao_evento,
                                          :inicio_inscricoes_evento,
                                          :fim_inscricoes_evento,
                                          :data_inicio_evento,
                                          :data_fim_evento,
                                          :id_endereco,
                                          :id_evento_pai,
                                          :url_imagem,
                                          :valor_evento,
                                          :qntd_parcelas_permitidas,
                                          :part_min_evento,
                                          :ativo_evento);';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_evento', $Objeto->getNomeEvento(), PDO::PARAM_STR);
            $statement->bindValue(':sigla_evento', $Objeto->getSiglaEvento(), PDO::PARAM_STR);
            $statement->bindValue(':descricao_evento', $Objeto->getDescricaoEvento(), PDO::PARAM_STR);
            $statement->bindValue(':inicio_inscricoes_evento', $Objeto->getInicioInscricoesEvento(), PDO::PARAM_STR);
            $statement->bindValue(':fim_inscricoes_evento', $Objeto->getFimInscricoesEvento(), PDO::PARAM_STR);
            $statement->bindValue(':data_inicio_evento', $Objeto->getDataInicioEvento(), PDO::PARAM_STR);
            $statement->bindValue(':data_fim_evento', $Objeto->getDataFimEvento(), PDO::PARAM_STR);
            $statement->bindValue(':id_endereco', $Objeto->getIdEndereco(), PDO::PARAM_INT);
            $statement->bindValue(':id_evento_pai', $Objeto->getIdEventoPai(), PDO::PARAM_INT);
            $statement->bindValue(':url_imagem', $Objeto->getUrlImagem(), PDO::PARAM_STR);
            $statement->bindValue(':valor_evento', $Objeto->getValorEvento(), PDO::PARAM_STR);
            $statement->bindValue(':qntd_parcelas_permitidas', $Objeto->getQntdParcelasPermitidas(), PDO::PARAM_INT);
            $statement->bindValue(':part_min_evento', $Objeto->getPartMinEvento(), PDO::PARAM_INT);
            $statement->bindValue(':ativo_evento', 's', PDO::PARAM_STR);

            // Executa a query
            $statement->execute();

            return $ultimoID = $Conexao->lastInsertId();
        }

        function atualizar($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'UPDATE tb_evento SET
                            nome_evento = :nome_evento,
                            sigla_evento = :sigla_evento,
                            descricao_evento = :descricao_evento,
                            inicio_inscricoes_evento = :inicio_inscricoes_evento,
                            fim_inscricoes_evento = :fim_inscricoes_evento,
                            data_inicio_evento = :data_inicio_evento,
                            data_fim_evento = :data_fim_evento,
                            id_endereco = :id_endereco,
                            id_evento_pai = :id_evento_pai,
                            url_imagem_evento = :url_imagem,
                            valor_evento = :valor_evento,
                            qntd_parcelas_permitida_evento = :qntd_parcelas_permitida,
                            part_min_evento = :part_min_evento,
                            ativo_evento = :ativo_evento
                        WHERE id_evento = :id_evento;';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_evento', $Objeto->getNomeEvento(), PDO::PARAM_STR);
            $statement->bindValue(':sigla_evento', $Objeto->getSiglaEvento(), PDO::PARAM_STR);
            $statement->bindValue(':descricao_evento', $Objeto->getDescricaoHotel(), PDO::PARAM_STR);
            $statement->bindValue(':inicio_inscricoes_evento', $Objeto->getInicioInscricoesEvento(), PDO::PARAM_STR);
            $statement->bindValue(':fim_inscricoes_evento', $Objeto->getFimInscricoesEvento(), PDO::PARAM_STR);
            $statement->bindValue(':data_inicio_evento', $Objeto->getDataInicioEvento(), PDO::PARAM_STR);
            $statement->bindValue(':data_fim_evento', $Objeto->getDataFimEvento(), PDO::PARAM_STR);
            $statement->bindValue(':id_endereco', $Objeto->getIdEndereco(), PDO::PARAM_INT);
            $statement->bindValue(':id_eveto_pai', $Objeto->getIdEventoPai(), PDO::PARAM_INT);
            $statement->bindValue(':url_imagem', $Objeto->getUrlImagem(), PDO::PARAM_STR);
            $statement->bindValue(':valor_evento', $Objeto->getValorEvento(), PDO::PARAM_STR);
            $statement->bindValue(':qntd_parcelas_permitidas', $Objeto->getQntdParcelasPermitidas(), PDO::PARAM_INT);
            $statement->bindValue(':part_min_evento', $Objeto->getPartMinEvento(), PDO::PARAM_INT);
            $statement->bindValue(':ativo_evento', $Objeto->getAtivoEvento(), PDO::PARAM_STR);
            $statement->bindValue(':id_evento', $Objeto->getIdEvento(), PDO::PARAM_INT);

            // Executa a query
            $statement->execute();
        }

        function remover($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_evento WHERE id_evento = :id_evento;';

            $statement = $Conexao->prepare($SQL);
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
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new Evento($linha['idEvento'], utf8_encode($linha['nomeEvento']), $linha['siglaEvento'], utf8_encode($linha['descricaoEvento']),
                        $linha['inicioInscricoesEvento'], $linha['fimInscricoesEvento'], $linha['dataInicioEvento'],
                        $linha['dataFimEvento'], $linha['idEndereco'], $linha['idEventoPai'], $linha['urlImagem'], $linha['valorEvento'],
                        $linha['qntdParcelasPermitidas'], $linha['partMinEvento'], $linha['ativoEvento']);

            return $resultado;
        }

        function obterTodosAbertos()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento
                        
                        WHERE fim_inscricoes_evento > NOW() AND id_evento_pai IS NULL;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha) {

                    $resultado[] = new Evento($linha['idEvento'], utf8_encode($linha['nomeEvento']), $linha['siglaEvento'], utf8_encode($linha['descricaoEvento']),
                        $linha['inicioInscricoesEvento'], $linha['fimInscricoesEvento'], $linha['dataInicioEvento'],
                        $linha['dataFimEvento'], $linha['idEndereco'], $linha['idEventoPai'], $linha['urlImagem'], $linha['valorEvento'], $linha['qntdParcelasPermitidas'],
                        $linha['partMinEvento'], $linha['ativoEvento']);
                }
            return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento
                        WHERE id_evento = :idEvento;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idEvento', $IdObjeto, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Evento($resultado['idEvento'], utf8_encode($resultado['nomeEvento']), $resultado['siglaEvento'], utf8_encode($resultado['descricaoEvento']),
                    $resultado['inicioInscricoesEvento'], $resultado['fimInscricoesEvento'], $resultado['dataInicioEvento'],
                    $resultado['dataFimEvento'], $resultado['idEndereco'], $resultado['idEventoPai'], $resultado['urlImagem'], $resultado['valorEvento'], $resultado['qntdParcelasPermitidas'],
                    $resultado['partMinEvento'], $resultado['ativoEvento']);
            else
                $resultado = null;

            return $resultado;
        }

        function obterByNome($nomeObjeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento
                        WHERE UPPER(nome_evento) LIKE UPPER('%{$nomeObjeto}%') ;";

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':nomeEvento', $nomeObjeto, PDO::PARAM_STR);
            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Evento($resultado['idEvento'], utf8_encode($resultado['nomeEvento']), $resultado['siglaEvento'], utf8_encode($resultado['descricaoEvento']),
                    $resultado['inicioInscricoesEvento'], $resultado['fimInscricoesEvento'], $resultado['dataInicioEvento'],
                    $resultado['dataFimEvento'], $resultado['idEndereco'], $resultado['idEventoPai'], $resultado['urlImagem'], $resultado['valorEvento'],
                    $resultado['qntdParcelasPermitidas'], $resultado['partMinEvento'], $resultado['ativoEvento']);
            else
                $resultado = null;

            return $resultado;
        }

        //RETORNA TODOS OS EVENTOS PAI
        function obterTodosPai()
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento
                        
                        WHERE id_evento_pai IS NULL;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha) {
                    $resultado[] = new Evento($linha['idEvento'], utf8_encode($linha['nomeEvento']), $linha['siglaEvento'], utf8_encode($linha['descricaoEvento']),
                        $linha['inicioInscricoesEvento'], $linha['fimInscricoesEvento'], $linha['dataInicioEvento'],
                        $linha['dataFimEvento'], $linha['idEndereco'], $linha['idEventoPai'], $linha['urlImagem'], $linha['valorEvento'], $linha['qntdParcelasPermitidas'],
                        $linha['partMinEvento'], $linha['ativoEvento']);
                }
            return $resultado;
        }


        function obterFilhos($idPai)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT
                            id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento
                        FROM tb_evento
                        WHERE id_evento_pai = $idPai;";
            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement->bindValue(':idEventoPai', $idPai, PDO::PARAM_STR);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha) {
                    $resultado[] = new Evento($linha['idEvento'], utf8_encode($linha['nomeEvento']), $linha['siglaEvento'], utf8_encode($linha['descricaoEvento']),
                        $linha['inicioInscricoesEvento'], $linha['fimInscricoesEvento'], $linha['dataInicioEvento'],
                        $linha['dataFimEvento'], $linha['idEndereco'], $linha['idEventoPai'], $linha['urlImagem'], $linha['valorEvento'], $linha['qntdParcelasPermitidas'],
                        $linha['partMinEvento'], $linha['ativoEvento']);
                }
            return $resultado;
        }
        function obterByIdUsuario(){

        }

//        Retorna a quantidade de dias de um evento ou false caso seja passado o id de um evento não existente.
        function obterQuantDia($idEvento){
            $Conexao = DbConnection::retornaConexao();

            $SQL = "SELECT DATEDIFF(data_fim_evento, data_inicio_evento) as dif FROM tb_evento WHERE id_evento = $idEvento";
            $statement = $Conexao->query($SQL);
            if($statement->rowCount() == 1){
                while($l = $statement->fetch(PDO::FETCH_OBJ)){
                    return $l->dif+1;
                    // Somado um por que a diferença do MySQL é a quantidade de dias - 1
                }
            }else{
                return false;
            };
        }

        function obterDiasEvento($idEvento){
            $Conexao = DbConnection::retornaConexao();
            $quant =  $this->obterQuantDia($idEvento);
              if($quant != 0){
                $dias = null;
                for($x = 0; $x < $quant; $x++){
                    $SQL = "SELECT CAST(ADDDATE( data_inicio_evento, INTERVAL ($x) DAY) AS DATE) as dia FROM tb_evento WHERE id_evento = $idEvento";
                    $statement = $Conexao->query($SQL);
                    while($w =  $statement->fetch(PDO::FETCH_ASSOC)){
                        $dias[$x] = $w['dia'];
                    }
                };
                return $dias;
            };
        }

        function qntdResponsavelEventos($idUsuario){

            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT COUNT(e.id_evento) AS qntdEventos 
                        FROM tb_evento e
                        INNER JOIN tb_admin_evento a 
                          ON (e.id_evento = a.id_evento) 
                        WHERE a.id_usuario = {$idUsuario};";

            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    return $linha['qntdEventos'];
        }

        function listarEventosResponsavelPai($idUsuario){

            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a Query
            $SQL = "Select e.id_evento as idEvento,
                            nome_evento as nomeEvento,
                            sigla_evento as siglaEvento,
                            descricao_evento as descricaoEvento,
                            inicio_inscricoes_evento as inicioInscricoesEvento,
                            fim_inscricoes_evento as fimInscricoesEvento,
                            data_inicio_evento as dataInicioEvento,
                            data_fim_evento as dataFimEvento,
                            id_endereco as idEndereco,
                            id_evento_pai as idEventoPai,
                            url_imagem_evento as urlImagem,
                            valor_evento as valorEvento,
                            qntd_parcelas_permitida_evento as qntdParcelasPermitidas,
                            part_min_evento as partMinEvento,
                            ativo_evento as ativoEvento 
                        from tb_evento e 
                        INNER Join tb_admin_evento a 
                          on (e.id_evento = a.id_evento) 
                        where a.id_usuario = {$idUsuario};";

            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($statement != false && !empty($statement))
                foreach ($statement as $linha) {
                    $resultado[] = new Evento($linha['idEvento'], utf8_encode($linha['nomeEvento']), $linha['siglaEvento'], utf8_encode($linha['descricaoEvento']),
                        $linha['inicioInscricoesEvento'], $linha['fimInscricoesEvento'], $linha['dataInicioEvento'],
                        $linha['dataFimEvento'], $linha['idEndereco'], $linha['idEventoPai'], $linha['urlImagem'], $linha['valorEvento'], $linha['qntdParcelasPermitidas'],
                        $linha['partMinEvento'], $linha['ativoEvento']);
                }

                return $resultado;

        }
    }
?>