<?php
$host = "localhost";
$user = "root";
$pass="";
$dbname = "tarefas";
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro ao Conectar:" . $conn->connect_error);
}

if (isset($_POST['vencimento']) && isset($_POST['descricao'])){
    $vencimento = $_POST['vencimento'];
    $descricao = $_POST['descricao'];
    $concluida = 0;   
    $sql = $conn->prepare("INSERT INTO tarefas (vencimento, descricao, concluida) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $vencimento, $descricao, $concluida);

    if ($sql->execute()){
        echo "Tarefa adicionada com sucesso";
    } else {
        echo "Erro ao adicionar tarefa";
    }

    $sql->close();

} else {
    echo "Vazio";
}

$conn->close();
?>