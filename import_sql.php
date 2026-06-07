<?php
$dsn = "mysql:host=acela.proxy.rlwy.net;port=36749;dbname=railway;charset=utf8mb4";
$user = 'root';
$pass = 'hwXwcuBdBBRXlEbUwPPrVepwLKASfUHs';

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Nettoyage de la base
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $pdo->exec("DROP TABLE `$table`");
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");
    echo "Base nettoyée. ";

    // 2. Importation du fichier
    $sql_file = 'morijahcouture.sql';
    if (!file_exists($sql_file)) {
        die("Erreur : Le fichier $sql_file est introuvable.");
    }
    
    $sql_content = file_get_contents($sql_file);
    $pdo->exec($sql_content);
    
    echo "Importation réussie avec succès !";

} catch (PDOException $e) {
    echo "ERREUR : " . $e->getMessage();
}
?>