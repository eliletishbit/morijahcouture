<?php
// Paramètres de connexion Railway
$host = 'mysql.railway.internal';
$user = 'root';
$pass = 'hwXwcuBdBBRXlEbUwPPrVepwLKASfUHs';
$db   = 'railway';

// Connexion
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Lecture du fichier SQL
$sql_file = 'morijahcouture.sql';
if (!file_exists($sql_file)) {
    die("Fichier $sql_file introuvable !");
}

$sql_content = file_get_contents($sql_file);

// Exécution
if (mysqli_multi_query($conn, $sql_content)) {
    echo "Succès : Base de données importée avec brio !";
} else {
    echo "Erreur lors de l'import : " . mysqli_error($conn);
}
?>