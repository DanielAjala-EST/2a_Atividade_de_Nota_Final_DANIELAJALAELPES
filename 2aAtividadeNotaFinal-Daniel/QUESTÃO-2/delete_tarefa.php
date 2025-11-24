<?php
$host = "localhost";
$user = "root";
$pass="";
$dbname = "tarefas";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro ao conectar:" . $conn->connect_error);
}
if (isset($_POST['id'])){
    $id = intval($_POST['id']);

    $sql =$conn->prepare("DELETE FROM tarefas WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "OK";
    } else {
        echo "Erro";
        
    }

    $sql->close();
} else {
    echo "Erro";
}
$conn->close();

?>