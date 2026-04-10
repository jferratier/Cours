<?php
$apiKey = "YOUR API KEY";
$url = "https://api.openai.com/v1/responses";
$data = [
    "model" => "gpt-4.1-mini",
    "input" => "Explique l'intelligence artificielle simplement."
];
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_SSL_VERIFYPEER => false, // test seulement
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer " . $apiKey
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);
$response = curl_exec($ch);
curl_close($ch);
print_r(json_decode($response, true));
