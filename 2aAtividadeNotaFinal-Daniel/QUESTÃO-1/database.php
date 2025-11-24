<?php
$host = "localhost";
$user = "root";
$pass="";
$dbname = "livraria";

$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Erro de conexão:" . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Banco de Dados criado com sucesso ou já existe.<br>";
} else {
    die("Erro ao criar o banco de dados: " . $conn->error);
}
$conn->select_db($dbname);


$table = "CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    ano YEAR NOT NULL   
)";

if ($conn->query($table) === TRUE) {
    echo "Tabela 'livros' criada com sucesso ou já existe.<br>";
} else {
    die("Erro ao criar a tabela: " . $conn->error);
}
echo "Banco de dados feito com êxito.";
?>