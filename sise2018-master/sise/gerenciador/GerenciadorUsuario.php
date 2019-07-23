<?php
    /**
     * Autor: Kaic
     * Date: 10/03/2017
     * Time: 12:02
     */
    require_once '../model/Usuario.php';
    require_once '../persistencia/PersistenciaUsuario.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorUsuario {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaUsuario();
        }

        function adicionar(Usuario $usuario){
            return $this->persistencia->inserir($usuario);
        }

        function atualizar(Usuario $usuario){
            return $this->persistencia->atualizar($usuario);
        }

        function atualizarIdAsaas(Usuario $usuario){
            return $this->persistencia->atualizarIdAsaas($usuario);
        }

        function remover(Usuario $usuario){
            return $this->persistencia->remover($usuario);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obter($idUsuario){
            return $this->persistencia->obterById($idUsuario);
        }

        function buscarLogin($cpfUsuario, $senhaUsuario){
            return $this->persistencia->buscarLogin($cpfUsuario, $senhaUsuario);
        }

        function idAsaas($idUsuario){
            return $this->persistencia->idAsaas($idUsuario);
        }

        function obterPeloCPF($cpf){
            return $this->persistencia->obterByCPF($cpf);
        }

        function obterByEmail($email){
            return $this->persistencia->obterByEmail($email);
        }
    }
?>