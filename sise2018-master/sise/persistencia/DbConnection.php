<?php
    /**
     * Autor: Daniel Lima Oliveira
     * Date: 16/02/2017
     * Time: 20:08
     */
	class DbConnection{
		private static $ParametrosConexao;
		private static $Conexao;
		private static $StringConexao;

		static function retornaConexao(){
			self::$ParametrosConexao = parse_ini_file('config_bd.ini');
			self::$StringConexao = 'mysql:dbname=' . self::$ParametrosConexao['Banco'] . ';host=' . self::$ParametrosConexao['Host'];
			if(!isset(self::$Conexao)){
				try{
					self::$Conexao = new PDO(self::$StringConexao, self::$ParametrosConexao['Usuario'], self::$ParametrosConexao['Senha']);
                    //self::$Conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				}catch(PDOException $e){
					echo 'Conexão Falhou: ' . $e->getMessage();
				}
			}
			return self::$Conexao;
		}

		static function encerraConexao(){
			self::$Conexao = null;
		}
	}
?>