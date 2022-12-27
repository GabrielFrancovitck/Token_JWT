<h1>Validar token JWT</h1>
<!-- Formulário para receber o Token -->
<form method="POST" action="">
    <label>Token: </label>
    <input type="text" name="token" placeholder="Token"><br><br>

    <input type="submit" name="validar" value="Validar"><br><br>
</form>

<?php
// Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Acessa o IF quando clicar no botão validar
if (!empty($dados['validar'])) {
    //var_dump($dados);

    // Converter o token em array
    $token_array = explode('.', $dados['token']);
    //var_dump($token_array);
    $passW = $token_array[0];
    $payload = $token_array[1];
    $signature = $token_array[2];

    // Chave usada para gerar o token a mesma deve ser usada para validar o token
    $key = "GT5LSD6Q3W5KY81SBSIWS29I2";

    // Usar o header e o payload e codificar com o algoritmo sha256
    $valida_signature = hash_hmac('sha256', "$passW.$payload", $key, true);

    // Codificar dados em base64
    $valida_signature = base64_encode($valida_signature);

    // Comparar a assinatura do token recebido com a assinatura gerada.
    // Acessa o IF quando o token é válido
    if ($signature == $valida_signature) {
        // decodificar dados de base64
        $dados_token = base64_decode($payload);

        // Converter objeto em array
        $dados_token = json_decode($dados_token);
        var_dump($dados_token);

        // Comparar a data de vencimento do token com a data atual
        // Acessa o IF quando a data do token é maior do que a data atual
        if ($dados_token->exp > time()) {
            echo "Token válido";
        } else { // Acessa o ELSE quando a data do token é menor ou igual a data atual
            echo "Token inválido, token vencido!";
        }
    } else { // Acessa o ELSE quando o token é inválido
        echo "Token inválido";
    }
}
