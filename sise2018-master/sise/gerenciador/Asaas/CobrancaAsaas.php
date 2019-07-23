<?php
    /**
     * Autor: Daniel
     * Date: 24/02/2017
     * Time: 15:12
     */

    require_once 'Valores.php';

    //inserir cobranca para um id de cliente
    function inserirCobranca($dadosCobranca){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente . "/payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
          \"customer\": \"". $dadosCobranca['customer'] ."\",
          \"billingType\": \"". $dadosCobranca['billingType'] ."\",
          \"dueDate\": \"". $dadosCobranca['dueDate'] ."\",
          \"value\": " . $dadosCobranca['value'] . "
        }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . Valores::$token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /*
    $dadosCobranca['customer'] = "cus_000000041274";
    $dadosCobranca['billingType'] = "BOLETO";
    $dadosCobranca['dueDate'] = "2017-06-10";
    $dadosCobranca['value'] = "150";

    var_dump(inserirCobranca($dadosCobranca));
    */

    //criar cobrança parcelada
    function inserirCobrancaParcelada($dadosCobranca){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente . "/payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
             \"customer\": \"". $dadosCobranca['customer'] ."\",
             \"billingType\": \"". $dadosCobranca['billingType'] ."\",
             \"installmentCount\": \"". $dadosCobranca['installmentCount'] ."\",
             \"installmentValue\": \"". $dadosCobranca['installmentValue'] ."\",
             \"dueDate\": \"". $dadosCobranca['dueDate'] ."\"
             }");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . Valores::$token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /*
    $dadosCobranca['customer'] = "cus_000000041274";
    $dadosCobranca['billingType'] = "BOLETO";
    $dadosCobranca['dueDate'] = "2017-06-10";
    $dadosCobranca['value'] = "150";
    $dadosCobranca['installmentCount'] = 3;
    $dadosCobranca['installmentValue'] = 150;

    var_dump(inserirCobrancaParcelada($dadosCobranca));
    */

    //Buscar cobrança parcelada
    function getTodasParcelas($idInstallment) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente. "/payments?installment=" . $idInstallment);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . Valores::$token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    //var_dump(getTodasParcelas('ins_000000000311'));

    //buscar cobranca pelo id da cobranca
    function getCobranca($idCobranca){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente. "/payments/" . $idCobranca);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . Valores::$token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    //var_dump(getCobranca('pay_618242592321'));

    function removerCobranca($idCobranca){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente. "/payments/" . $idCobranca);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . Valores::$token
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    //removerCobranca('pay_124830529530');
?>