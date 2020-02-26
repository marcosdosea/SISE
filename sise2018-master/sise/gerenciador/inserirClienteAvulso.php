<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://sandbox.asaas.com/api/v3/customers");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"name\": \"Marcelo Almeida\",
  \"email\": \"marcelo.almeida@gmail.com\",
  \"phone\": \"4738010919\",
  \"mobilePhone\": \"4799376637\",
  \"cpfCnpj\": \"24971563792\",
  \"postalCode\": \"01310-000\",
  \"address\": \"Av. Paulista\",
  \"addressNumber\": \"150\",
  \"complement\": \"Sala 201\",
  \"province\": \"Centro\",
  \"externalReference\": \"12987382\",
  \"notificationDisabled\": false,
  \"additionalEmails\": \"marcelo.almeida2@gmail.com,marcelo.almeida3@gmail.com\"
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "access_token: 30bb34bd39a2bea5372ec3b523385a4d13e4dfbdb45c3aa2c52f71c81fdcb861"
));

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);