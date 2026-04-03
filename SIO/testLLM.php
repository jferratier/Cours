<?php

// Configuration de l'API LM Studio
$apiUrl = 'http://localhost:1234/v1/chat/completions'; // URL par défaut de LM Studio
$apiKey = 'sk-lm-TChpfcNK:KK3rYYMLJI9Qb3GINrUp'; // Clé API par défaut (LM Studio n'en nécessite pas vraiment)

// Message à envoyer
$message = "bonjour peux tu me faire l'operation 654654654564 + 65465465456 ?";

// Préparation des données pour l'API
$data = [
    'model' => 'qwen2.5-coder-7b-instruct', // Le nom du modèle chargé dans LM Studio
    'messages' => [
        [
            'role' => 'user',
            'content' => $message
        ]
    ],
    'temperature' => 0.7,
    'max_tokens' => 150,
    'stream' => false
];

// Initialisation de cURL
$ch = curl_init($apiUrl);

// Configuration des options cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

// Exécution de la requête
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Gestion des erreurs
if (curl_errno($ch)) {
    echo "Erreur cURL : " . curl_error($ch) . "\n";
    curl_close($ch);
    exit;
}

curl_close($ch);

// Traitement de la réponse
if ($httpCode === 200) {
    $result = json_decode($response, true);
    
    // Affichage du message envoyé
    echo "Message envoyé : " . $message . "\n\n";
    
    // Affichage de la réponse du LLM
    if (isset($result['choices'][0]['message']['content'])) {
        echo "Réponse du LLM : " . $result['choices'][0]['message']['content'] . "\n";
    } else {
        echo "Aucune réponse trouvée dans le retour.\n";
    }
    
    // Affichage des informations supplémentaires (optionnel)
    if (isset($result['usage'])) {
        echo "\n--- Informations d'utilisation ---\n";
        echo "Tokens utilisés : " . $result['usage']['total_tokens'] . "\n";
        echo "Tokens prompt : " . $result['usage']['prompt_tokens'] . "\n";
        echo "Tokens completion : " . $result['usage']['completion_tokens'] . "\n";
    }
} else {
    echo "Erreur HTTP " . $httpCode . "\n";
    echo "Réponse : " . $response . "\n";
}

?>