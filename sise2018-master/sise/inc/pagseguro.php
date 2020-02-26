<?php
require_once '../gerenciador/GerenciadorUsuario.php';
require_once '../model/Usuario.php';
$gerenciadoraUsuario = new GerenciadorUsuario();

$usuario = $gerenciadoraUsuario->obterPeloCPF($_SESSION['cpf']);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$data['email'] = 'igorb22@live.com';
$data['token'] = '97AFAC6B6A92484BBBD2E3DD1FC541E7';

$data['currency'] = 'BRL';
$data['itemId1'] = '001';
$data['itemDescription1'] = 'Nome do Evento';
$data['itemAmount1'] = '20.00';
$data['itemQuantity1'] = '1';
//$data['itemWeight1'] = '1000';
//$data['reference'] = '01';

$data['senderName'] = $usuario->getNomeUsuario();
$data['senderAreaCode'] = '11';
$data['senderPhone'] = '56273440';
$data['senderEmail'] = $usuario->getEmailUsuario();

/*$data['shippingType'] = '1';
$data['shippingAddressStreet'] = 'Av. Brig. Faria Lima';
$data['shippingAddressNumber'] = '1384';
$data['shippingAddressComplement'] = '5o andar';
$data['shippingAddressDistrict'] = 'Jardim Paulistano';
$data['shippingAddressPostalCode'] = '01452002';
$data['shippingAddressCity'] = 'Sao Paulo';
$data['shippingAddressState'] = 'SP';
$data['shippingAddressCountry'] = 'BRA';*/

$data['redirectURL'] = 'http://localhost/sise';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$xml= curl_exec($curl);
/*
if($xml == 'Unauthorized'){
    //Insira seu código de prevenção a erros
    header('Location: erro.php?tipo=autenticacao');
    exit;//Mantenha essa linha
}*/
curl_close($curl);

$xml= simplexml_load_string($xml);
/*if(count($xml -> error) > 0){
    //Insira seu código de tratamento de erro, talvez seja útil enviar os códigos de erros.
    header('Location: erro.php?tipo=dadosInvalidos');
    exit;
}*/
