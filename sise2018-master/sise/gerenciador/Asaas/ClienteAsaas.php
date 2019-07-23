<?php
    /**
     * Autor: Daniel
     * Date: 24/02/2017
     * Time: 15:12
     */

    require_once 'Valores.php';

    function inserirCliente($dadosCliente) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente . "/customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "{
          \"name\": \"". $dadosCliente['name'] ."\",
          \"email\": \"". $dadosCliente['email'] ."\",
		  \"phone\": \"". $dadosCliente['phone'] ."\",
		  \"mobilePhone\": \"". $dadosCliente['mobilePhone'] ."\",
          \"cpfCnpj\": \"". $dadosCliente['cpfCnpj'] ."\"    
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
    $dadosCliente['name'] = "Daniel Lima Oliveira";
    $dadosCliente['email'] = "daniel102510@gmail.com";
    $dadosCliente['cpfCnpj'] = "05892452522";

    var_dump(inserirCliente($dadosCliente));
    */

    function getCliente($idCliente){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, Valores::$ambiente . "/customers?id=" . $idCliente);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "access_token: " . Valores::$token
		));
		
		$response = curl_exec($ch);
		curl_close($ch);


        return $response;
    }

    //var_dump(getCliente('cus_000000041287'));

    function removerCliente($idCliente){
       $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, Valores::$ambiente . "/customers?id=" . $idCliente);
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

    //var_dump(removerCliente('cus_000000041287'));
?>