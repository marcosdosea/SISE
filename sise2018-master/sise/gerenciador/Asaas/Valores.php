<?php
    /**
     * Autor: Daniel
     * Date: 25/02/2017
     * Time: 00:16
     */
    //Classe que contém os valores do nosso TOKEN e do nosso AMBIENTE
    //Token é uma chave de permissão para consumir dados no Web Service do Asaas
    //Ambiente é um vaor que indica se as ações serão feitas em modo de produção ou modo de teste
    class Valores {

        //TOKEN PRODUÇÃO
        //static $token = "b1c78cd5d1ec5b61f29e52038041535817fc1ef6fd53673035e63c9b09d81ab6";

        //TOKEN SANDBOX
        static $token = "30bb34bd39a2bea5372ec3b523385a4d13e4dfbdb45c3aa2c52f71c81fdcb861";

        //AMBIENTE PRODUÇÃO
        //static $ambiente = 'https://www.asaas.com/api/v3';

        //AMBIENTE SANDBOX
        static $ambiente = 'https://sandbox.asaas.com/api/v3';

    }
?>