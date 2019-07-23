<?php
    /**
     * Autor: Kaic
     * Date: 24/02/2017
     * Time: 12:00
     * UPDATE
     * Autor: John Hed
     * Date: 27/07/2017
     * Description:
     * adição do atributo imagem_usuario na função de buscarLogin
     * UPDATE
     * Autor: Gabriel Santana
     * Date: 07/08/2017
     * Revisao do obterById
     */
    require_once 'DbConnection.php';
    require_once 'DaoGenerico.php';
    require_once '../model/Usuario.php';

    class PersistenciaUsuario implements DaoGenerico
    {
        function inserir($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'INSERT INTO tb_usuario (nome_usuario,cpf_usuario,email_usuario,senha_usuario,id_asaas_usuario,tipo_usuario) 
                                                  VALUES (:nome_usuario,:cpf_usuario,:email_usuario,
                                                  :senha_usuario,:id_asaas_usuario,:tipo_usuario);';

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_usuario', $Objeto->getNomeUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':cpf_usuario', $Objeto->getCpfUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':email_usuario', $Objeto->getEmailUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':senha_usuario', $Objeto->getSenhaUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':id_asaas_usuario', $Objeto->getIdAsaasUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':tipo_usuario','ouvinte', PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function atualizar($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "UPDATE tb_usuario SET
                            nome_usuario = :nome_usuario,
                            cpf_usuario = :cpf_usuario,
                            email_usuario = :email_usuario,
                            senha_usuario = :senha_usuario,
                            tipo_usuario = :tipo_usuario
                        WHERE id_usuario = :id_usuario";

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':nome_usuario', $Objeto->getNomeUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':cpf_usuario', $Objeto->getCpfUSuario(), PDO::PARAM_STR);
            $statement->bindValue(':email_usuario', $Objeto->getEmailUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':senha_usuario', $Objeto->getSenhaUsuario(), PDO::PARAM_STR);
            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);
            $statement->bindValue(':tipo_usuario', $Objeto->getTipoUsuario(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function atualizarIdAsaas($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "UPDATE tb_usuario SET
                            id_asaas_usuario = :id_asaas_usuario
                        WHERE id_usuario = :id_usuario";

            $statement = $Conexao->prepare($SQL);

            $statement->bindValue(':id_asaas_usuario', $Objeto->getIdAsaasUsuario(), PDO::PARAM_STR);

            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_STR);

            // Executa a query
            $statement->execute();
        }

        function remover($Objeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'DELETE FROM tb_usuario WHERE id_usuario = :id_usuario;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':id_usuario', $Objeto->getIdUsuario(), PDO::PARAM_INT);

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
                            nome_usuario as nomeUsuario,
                            cpf_usuario as cpfUsuario,
                            email_usuario as emailfederada,
                            senha_usuario as senhaUsuario,
                            id_asaas_usuario as idAsaasUsuario,
                            tipo_usuario as tipoUsuario
                        FROM TB_USUARIO;';

            // Executa a query e cria o array de objetos TipoUnidade
            $statement = $Conexao->query($SQL);
            $statement = $statement->fetchAll(PDO::FETCH_ASSOC);
            $resultado = null;
            if ($statement != false && !empty($statement))
                foreach ($statement as $linha)
                    $resultado[] = new Usuario(
                        $linha['idUsuario'],
                        $linha['nomeUsuario'],
                        $linha['cpfUsuario'],
                        $linha['emailUsuario'],
                        $linha['senhaUsuario'],
                        $linha['idAsaasUsuario'],
                        $linha['tipoUsuario']);

            return $resultado;
        }

        function obterById($IdObjeto)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_usuario as idUsuario,
                            nome_usuario as nomeUsuario,
                            cpf_usuario as cpfUsuario,
                            email_usuario as emailUsuario,
                            senha_usuario as senhaUsuario,
                            id_asaas_usuario as idAsaasUsuario,
                            tipo_usuario as tipoUsuario,
                        FROM tb_usuario
                        WHERE id_usuario = :idUsuario;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idUsuario', $IdObjeto, PDO::PARAM_INT);
            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Usuario($resultado['idUsuario'], $resultado['nomeUsuario'], $resultado['cpfUsuario'],
                    $resultado['emailUsuario'], $resultado['senhaUsuario'],
                    $resultado['idAsaasUsuario'], $resultado['tipoUsuario']);
            else
                $resultado = null;

            return $resultado;
        }
		
		function buscarLogin($cpfUsuario, $senhaUsuario){
			 // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_usuario as idUsuario,
                            nome_usuario as nomeUsuario,
                            cpf_usuario as cpfUsuario,
                            email_usuario as emailUsuario,
                            senha_usuario as senhaUsuario,
                            id_asaas_usuario as idAsaasUsuario,
                            tipo_usuario as tipoUsuario
                        FROM tb_usuario
                        WHERE cpf_usuario = :login and senha_usuario = :senha';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':login', $cpfUsuario, PDO::PARAM_STR);
			$statement->bindValue(':senha', $senhaUsuario, PDO::PARAM_STR);

            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Usuario(
                    $resultado['idUsuario'],
                    $resultado['nomeUsuario'],
                    $resultado['cpfUsuario'],
                    $resultado['emailUsuario'],
                    $resultado['senhaUsuario'],
                    $resultado['idAsaasUsuario'],
                    $resultado['tipoUsuario']);
            else
                $resultado = null;

            return $resultado;
			
		}
	
		function idAsaas($idUsuario){
			 // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_asaas_usuario as idAsaasUsuario
                        FROM tb_usuario
                        WHERE id_usuario = :idUsuario;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
			
			  $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Usuario($resultado['idAsaasUsuario']);
            else
                $resultado = null;

            return $resultado;
			
			
		}

		function obterByCPF($cpf){
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = "SELECT * FROM tb_usuario WHERE cpf_usuario = {$cpf};";

            $statement = $Conexao->prepare($SQL);
         //   $statement->bindValue(':cpf', $cpf, PDO::PARAM_INT);

            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);

            if ($resultado != false && !empty($resultado))
                $resultado = new Usuario(
                    $resultado['id_usuario'],
                    $resultado['nome_usuario'],
                    $resultado['cpf_usuario'],
                    $resultado['email_usuario'],
                    $resultado['senha_usuario'],
                    $resultado['id_asaas_usuario'],
                    $resultado['tipo_usuario']);
            else
                $resultado = null;

            return $resultado;
        }

        function obterByEmail($email)
        {
            // Obtém a conexão
            $Conexao = DbConnection::retornaConexao();

            // Prepara a query
            $SQL = 'SELECT
                            id_usuario as idUsuario,
                            nome_usuario as nomeUsuario,
                            cpf_usuario as cpfUsuario,
                            email_usuario as emailUsuario,
                            senha_usuario as senhaUsuario,
                            id_asaas_usuario as idAsaasUsuario,
                            tipo_usuario as tipoUsuario
                        FROM tb_usuario
                        WHERE email_usuario = :emailUsuario;';

            $statement = $Conexao->prepare($SQL);
            $statement->bindValue(':emailUsuario', $email, PDO::PARAM_STR);
            // Executa a query e obtém os dados do Tipo Unidade
            $statement->execute();
            $resultado = $statement->fetch(PDO::FETCH_ASSOC);
            if ($resultado != false && !empty($resultado))
                $resultado = new Usuario($resultado['idUsuario'], $resultado['nomeUsuario'], $resultado['cpfUsuario'],
                    $resultado['emailUsuario'], $resultado['senhaUsuario'], $resultado['idAsaasUsuario'], $resultado['tipoUsuario']);
            else
                $resultado = null;

            return $resultado;
        }
    }
?>