<?php
$host = "localhost";
$user = "root";
$pass="";
$dbname = "livraria";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro_Conexão");
}

if (isset($_POST['titulo']) && isset($_POST['autor']) && isset($_POST['ano'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = intval($_POST['ano']);   

    $sql = $conn->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (?, ?, ?)");
    $sql->bind_param("ssi", $titulo, $autor, $ano);

    if ($sql->execute()){
        echo "OK";
    } else {
        echo "Erro";
    }

    $sql->close();

} else {
    echo "Vazio";
}

$conn->close();
?>