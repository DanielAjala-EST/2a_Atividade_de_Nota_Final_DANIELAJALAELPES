<?php
require "database.php";

// ======== CONCLUIR TAREFA ========
if (isset($_POST['id']) && isset($_POST['concluir'])) {

    $id = intval($_POST['id']);

    $sql = $conn->prepare("UPDATE tarefas SET concluida = 1 WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "Tarefa concluída!";
    } else {
        echo "Erro ao concluir.";
    } 
    $sql->close();
    exit;
}


if (isset($_POST['id']) && isset($_POST['descricao']) && isset($_POST['vencimento'])) {

    $id = intval($_POST['id']);
    $descricao = $_POST['descricao'];
    $vencimento = $_POST['vencimento'];

    $sql = $conn->prepare("UPDATE tarefas SET descricao = ?, vencimento = ? WHERE id = ?");
    $sql->bind_param("ssi", $descricao, $vencimento, $id);

    if ($sql->execute()) {
        echo "Alterações salvas com sucesso!";  
    } else {
        echo "Erro ao salvar alterações.";
    }

    $sql->close();
    exit;
}

echo "Nada a atualizar.";
?>
