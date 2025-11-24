<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tarefas";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Erro ao conectar: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Erro ao criar banco: " . $conn->error);
}

$conn->select_db($dbname);

$tabela = "CREATE TABLE IF NOT EXISTS tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vencimento DATE NOT NULL,
    descricao TEXT NOT NULL,
    concluida TINYINT(1) NOT NULL DEFAULT 0
)";

if ($conn->query($tabela) !== TRUE) {
    die("Erro ao criar tabela: " . $conn->error);
}
?>

