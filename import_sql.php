<?php
// Liste des hôtes potentiels
$hosts = ['mysql', 'mysql.railway.internal', '127.0.0.1', getenv('MYSQLHOST')];

foreach ($hosts as $host) {
    if (empty($host)) continue;
    echo "Tentative de connexion sur : $host... ";
    
    $dsn = "mysql:host=$host;dbname=railway;charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, 'root', 'hwXwcuBdBBRXlEbUwPPrVepwLKASfUHs');
        echo "SUCCÈS !\n";
        
        // Importation
        $sql = file_get_contents('morijahcouture.sql');
        $pdo->exec($sql);
        echo "Importation terminée avec succès.\n";
        exit;
    } catch (PDOException $e) {
        echo "Échec (" . $e->getMessage() . ")\n";
    }
}
?>