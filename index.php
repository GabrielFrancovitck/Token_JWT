

<?php

//Tipo de token JWT e o algoritmo usado é HS256.
$passW = [
    'alg' => 'HS256',
    'typ' => 'JWT'
];

//Converte o Array em objeto.
$passW = json_encode($passW);

//Codifica em base64.
$passW = base64_encode($passW);

//Imprimir a Passw
echo "Pass: $passW <br>";

//Aqui vai fazer o ciclo de duração e imprimir o token e quando irá ser vencido.
//$durationpassW = time() + (1*24*60*60);
$durationpassW = time() + (10 * 60);
//echo "Data atual: " . date("d-m-Y H:i:s") . "<br>Vencimento do Token: " . date("d-m-Y H:i:s", $durationpassW);

//Criação do Payload

$payload = [
    /*'iss' => 'localhost',
    'aud' => 'localhost',*/
    'exp' => $durationpassW,
    'id' => '1',
    /*nome' => 'Gabriel',
    'email' => 'gabriel.franco@hotmail.com'*/
];

//Converte o Array em objeto.
$payload = json_encode($payload);

//Codifica em base64.
$payload = base64_encode($payload);

//Imprimir o Payload
echo "<br><br>Payload: $payload <br><br>";

// Aqui vai fazer o ciclo de duração e imprimir o token e quando irá ser vencido.
  $durationpayload = time() + (1*24*60*60);
// echo "Data atual: " . date("d-m-Y H:i:s") . "<br>Vencimento do Payload: " . date("d-m-Y H:i:s", $durationpayload);

//Criar uma assinatura.

$key = "GT5LSD6Q3W5KY81SBSIWS29I2";
//Gera um valor de hash com a chave usando o HMAC. 
$signature = hash_hmac('sha256', "$passW.$payload", $key, true);

//Codifica em base64.
$signature = base64_encode($signature);
echo "<br>Assinatura: $signature <br><br>";

//Token final
echo "<br>Token: $passW.$payload.$signature <br><br>";
echo "Data atual: " . date("d-m-Y H:i:s") . "<br>Vencimento do Token: " . date("d-m-Y H:i:s", $durationpassW);

//Para validar o Token final é necessário entrar no site https://jwt.io/. Após isso, inserir a chave de token gerada e inserir a >KEY< para valida-lá ou você pode validar dentro do site :). 
