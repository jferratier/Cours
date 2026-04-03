<?php
/*
1- Wamp Drivers Installation
https://learn.microsoft.com/fr-fr/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver17
add php_sqlsrv_83_ts_x64.dll >> C:\WAMP\bin\php\php8.3.14\ext
add php_pdo_sqlsrv_83_ts_x64.dll >> C:\WAMP\bin\php\php8.3.14\ext

2- Add PHP INI
; Extensions SQL Server
extension=php_sqlsrv_83_ts_x64
extension=php_pdo_sqlsrv_83_ts_x64

3- SQL Configuration Manager
Configuration du reseau SQL Serveur > Protocoles ppour SQLEXPRESS > TCP/IP
IPALL > Port TCP >1433

4- Start Services
net start SQLBrowser
net start MSSQL$SQLEXPRESS

*/

// Configuration de la connexion
$serverName = "127.0.0.1,1433"; // IP + port explicite
$database = "AutomateIA";
$username = "sa2";
$password = "P@ssw0rd";

try {
    // Option 1: DSN avec IP et port
    $dsn = "sqlsrv:Server=$serverName;Database=$database;TrustServerCertificate=yes;Encrypt=yes";
    
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
    
    echo "✅ Connexion réussie !\n\n";
    
    // Tester la connexion
    $stmt = $pdo->query("SELECT @@VERSION AS version");
    $result = $stmt->fetch();
    echo "Version SQL Server: " . $result['version'] . "\n\n";
    
    // Lister les tables
    $query = "SELECT TABLE_NAME 
              FROM INFORMATION_SCHEMA.TABLES 
              WHERE TABLE_TYPE = 'BASE TABLE' 
              ORDER BY TABLE_NAME";
    
    $stmt = $pdo->query($query);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📋 Tables dans AutomateIA :\n";
    echo str_repeat("=", 60) . "\n";
    
    foreach ($tables as $index => $table) {
        echo ($index + 1) . ". " . $table . "\n";
    }
    
    echo str_repeat("=", 60) . "\n";
    echo "Total : " . count($tables) . " table(s)\n";
    
} catch (PDOException $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
    echo "\n📝 Informations de débogage :\n";
    echo "- Code erreur : " . $e->getCode() . "\n";
    echo "- Fichier : " . $e->getFile() . "\n";
    echo "- Ligne : " . $e->getLine() . "\n";
}
?>