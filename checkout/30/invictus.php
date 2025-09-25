<?php
header("Content-Type: application/json");

// Token fixo da sua conta
$api_token = "4E2OLjHJifbLGELU5Z7GzdBPf90TVgJUDYyaEi8ermNgC9QtihlyPJO8Tavr";

// Valor da doação recebido do front (em centavos)
$amount = isset($_GET['amount']) ? intval($_GET['amount']) : 0;
if ($amount <= 0) {
    echo json_encode(["error" => "Valor inválido"]);
    exit;
}

// Dados mínimos obrigatórios
$data = [
    "amount" => $amount, // em centavos
    "offer_hash" => "7becb", // substitua pelo correto no painel InvictusPay
    "payment_method" => "pix",
    "customer" => [
        "name" => "Cliente Teste",
        "email" => "teste@teste.com",
        "phone_number" => "21999999999",
        "document" => "09115751031"
    ],
    "cart" => [
        [
            "product_hash" => "7tjdfkshdv", // substitua pelo correto no painel InvictusPay
            "title" => "Doação",
            "price" => $amount,
            "quantity" => 1,
            "operation_type" => 1,
            "tangible" => false
        ]
    ]
];

// Chamada para InvictusPay
$url = "https://api.invictuspay.app.br/api/public/v1/transactions?api_token=$api_token";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}
curl_close($ch);

// Retorna para o front
echo $response;
?>