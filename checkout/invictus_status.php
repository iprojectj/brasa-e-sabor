<?php
header("Content-Type: application/json");

$api_token = "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr";

// Recebe hash da transação
$transaction_hash = isset($_GET['transaction_hash']) ? $_GET['transaction_hash'] : null;
if (!$transaction_hash) {
    echo json_encode(["error" => "Hash da transação não informado"]);
    exit;
}

$url = "https://api.invictuspay.app.br/api/public/v1/transactions/$transaction_hash?api_token=$api_token";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}
curl_close($ch);

echo $response;
?>