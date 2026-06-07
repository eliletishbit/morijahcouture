<?php
// Configuration extraite de ton URL Railway
$host = 'acela.proxy.rlwy.net';
$port = '36749';
$db   = 'railway';
$user = 'root';
$pass = 'hwXwcuBdBBRXlEbUwPPrVepwLKASfUHs';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lecture du fichier
    $sql_file = 'morijahcouture.sql';
    if (!file_exists($sql_file)) {
        die("Erreur : Le fichier $sql_file est introuvable à la racine.");
    }
    
    $sql_content = file_get_contents($sql_file);
    
    // Exécution
    $pdo->exec($sql_content);
    
    echo "SUCCÈS : Importation de morijahcouture.sql terminée avec succès !";
    
} catch (PDOException $e) {
    echo "ERREUR DE CONNEXION/IMPORT : " . $e->getMessage();
}
?>