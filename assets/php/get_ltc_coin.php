<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$ch = curl_init("https://min-api.cryptocompare.com/data/histominute?fsym=LTC&tsym=USD&limit=60&aggregate=15&e=CCCAGG");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Api-Version: alpha')                                                                       
);
$response = curl_exec($ch);
return $response;

?>