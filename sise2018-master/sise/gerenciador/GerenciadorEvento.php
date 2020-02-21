<?php
    /**
     * Autor: Paulo David Almeida da Silva (pdavidalmeida@hotmail.com)
     * Date: 10/03/2017
     * Time: 10:08
     */
    require_once '../model/Evento.php';
    require_once '../persistencia/PersistenciaEvento.php';
    //Caso a classe utilize o Asaas: dar include em seu respectivo arquivo e seguir o exemplo para respectiva ação
    //Classes que utilizarão o Asaas: Usuario,Pagamento,Parcela
    class GerenciadorEvento {

        private $persistencia;

        function __construct(){
            $this->persistencia = new PersistenciaEvento();
        }

        function adicionar(Evento $Evento, $idUsuario){
            require_once '../gerenciador/GerenciadorAdminEvento.php';
            $gerenciadoraAdminEvento = new GerenciadorAdminEvento();

            $idEvento = $this->persistencia->inserir($Evento);
            // Montando o Objeto AdminEvento com o idUsuario cadastrante e o Id do evento Recem cadastrado
            $novoAdmin = new AdminEvento($idUsuario,$idEvento);

            // Adicionando as informações Administrativas
            $gerenciadoraAdminEvento->adicionar($novoAdmin);
        }

        function atualizar(Evento $Evento){
            return $this->persistencia->atualizar($Evento);
        }

        function remover(Evento $Evento){
            return $this->persistencia->remover($Evento);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterTodosAbertos(){
            return $this->persistencia->obterTodosAbertos();
        }

        function obter($idEvento){
            return $this->persistencia->obterById($idEvento);
        }

        function obterEventosPai(){
            return $this->persistencia->obterTodosPai();
        }

        function obterMiniCursos($idEvento){
            return $this->persistencia->obterFilhos($idEvento);
        }

        function obterQuantDias($idEvento){
            return $this->persistencia->obterQuantDia($idEvento);
        }

        function obterDiasEvento($idEvento){
            return $this->persistencia->obterDiasEvento($idEvento);
        }

        function statusEvento($evento){

            $result = array(
                "label" => "",
                "status" => ""
            );

            if (date('Y-m-d h:i:s') > $evento->getDataFimEvento()) {
                $result["label"] = "label-success";
                $result["status"] = "Concluído";

                return $result;
            }
            if (date('Y-m-d h:i:s') > $evento->getFimInscricoesEvento() && date('Y-m-d h:i:s') < $evento->getDataFimEvento()) {
                $result["label"] = "label-warning";
                $result["status"] = "Em Andamento";

                return $result;
            }
            if (date('Y-m-d h:i:s') > $evento->getInicioInscricoesEvento() && date('Y-m-d h:i:s') < $evento->getFimInscricoesEvento()) {
                $result["label"] = "label-info";
                $result["status"] = "Inscriçoes Abertas";

                return $result;
            }
            if (date('Y-m-d h:i:s') < $evento->getInicioInscricoesEvento()) {
                $result["label"] = "label-danger";
                $result["status"] = "Sem Inscrições Abertas";

                return $result;
            }

            $result["label"] = "label-default";
            $result["status"] = "Sem Inscrições Abertas";
            return $result;

        }

        function listarEventosResponsavel($idUsuario){
            return $this->persistencia->listarEventosResponsavelPai($idUsuario);
        }
    }
?>