<?php
// On utilise PDO qui est présent par défaut dans tout PHP
$dsn = 'mysql:host=mysql.railway.internal;dbname=railway;charset=utf8mb4';
$user = 'root';
$pass = 'hwXwcuBdBBRXlEbUwPPrVepwLKASfUHs';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lecture du fichier
    $sql = file_get_contents('morijahcouture.sql');
    
    // Importation
    $pdo->exec($sql);
    
    echo "Succès total : Base de données importée !";
} catch (PDOException $e) {
    echo "ERREUR FATALE PDO : " . $e->getMessage();
}
?>