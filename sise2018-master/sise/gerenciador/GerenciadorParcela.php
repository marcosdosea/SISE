<?php
    /**
     * Autor: Kaic
     * Date: 09/03/2017
     * Time: 11:30
     */
    require_once '../model/Usuario.php';
    require_once '../model/Parcela.php';
    require_once '../model/Pagamento.php';
    require_once '../persistencia/PersistenciaParcela.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorParcela {
        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaParcela();
        }

        function adicionar(Parcela $parcela){
            return $this->persistencia->inserir($parcela);
        }

        function atualizar(Parcela $parcela){
            return $this->persistencia->atualizar($parcela);
        }

        function remover(Parcela $parcela){
            return $this->persistencia->remover($parcela);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterTodosPorPagamento($idPagamento){
            return $this->persistencia->obterTodosPorPagamento($idPagamento);
        }

        function obter($idParcela){
            return $this->persistencia->obterById($idParcela);
        }

        function adicionarAsaas(Parcela $parcela, Usuario $usuario, Pagamento $pagamento){
            $dadosCobranca['customer'] = $usuario->getIdAsaasUsuario();
            if (strtoupper($pagamento->getTipoPagamento()) == 'B') {
                $dadosCobranca['billingType'] = "BOLETO";
            }
            $dadosCobranca['value'] = $parcela->getValorParcela();
            $dadosCobranca['dueDate'] = date($parcela->getVencimentoParcela());
            $cobranca = inserirCobranca($dadosCobranca);
            return $cobranca;
        }

    }
?>