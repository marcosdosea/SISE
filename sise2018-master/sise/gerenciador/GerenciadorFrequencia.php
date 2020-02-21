<?php
/**
 * Created by PhpStorm.
 * User: Rafael Silveira
 * Date: 20/07/2017
 * Time: 09:16
 */
    require_once '../persistencia/PersistenciaFrequencia.php';
    require_once '../model/Frequencia.php';

    class GerenciadorFrequencia{
        private $persistencia;

        function __construct()
        {
            $this->persistencia = new PersistenciaFrequencia();
        }

        function inserir($idEventoFrequencia){
            return $this->persistencia->inserir($idEventoFrequencia);
        }

        function obterTodos(){
            return $this->persistencia->obterTodos();
        }

        function obterById($idUsuarioEvento){
            return $this->persistencia->obterById($idUsuarioEvento);
        }

        function obterQntFreqByDia($dia, $evento, $idUsuario){
            return $this->persistencia->obterQntFreqByDia($dia, $evento, $idUsuario);
        }

    }
?>