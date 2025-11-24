<?php
require_once "database.php";


$nao = $conn->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY vencimento ASC");
$concluidas = $conn->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY vencimento ASC");


if (!$nao) die("Erro SELECT NÃO CONCLUIDAS: " . $conn->error);
if (!$concluidas) die("Erro SELECT CONCLUIDAS: " . $conn->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Tarefas</title>
</head>
<body>

<h2>Adicionar Tarefa</h2>
<form id="formAdd">
    <label>Descrição:</label>
    <input type="text" name="descricao" required>

    <label>Vencimento:</label>
    <input type="date" name="vencimento" required>

    <button type="submit">Adicionar</button>
</form>

<hr>

<h2>Tarefas Não Concluídas</h2>
<ul>
<?php while ($t = $nao->fetch_assoc()): ?>
    <li>
     <strong><?= $t['descricao'] ?></strong> — vence em <?= $t['vencimento'] ?>
     <button onclick="concluir(<?= $t['id'] ?>)">Concluir</button>
     <button onclick="editar(<?= $t['id'] ?>, '<?= $t['descricao'] ?>', '<?= $t['vencimento'] ?>')">Editar</button>
    </li>
<?php endwhile; ?>
</ul>

<h2>Tarefas Concluídas</h2>
<ul>
<?php while ($c = $concluidas->fetch_assoc()): ?>
    <li>
    <s><strong><?= $c['descricao'] ?>
    </strong></s> — <?= $c['vencimento'] ?>
    </li>
<?php endwhile; ?>
</ul>

<hr>

<h2>Excluir Tarefa</h2>
<form id="formDelete">
    <label>ID da tarefa:</label>
    <input type="number" name="id" required>
    <button type="submit">Excluir</button>
</form>

<hr>

<h2>Editar Tarefa</h2>
<form id="formEdit" style="display:none;">
    <input type="hidden" name="id" id="edit_id">

    <label>Descrição:</label>
    <input type="text" name="descricao" id="edit_desc" required>

    <label>Vencimento:</label>
    <input type="date" name="vencimento" id="edit_venc" required>

    <button type="submit">Salvar Alterações</button>
</form>

<script>

function editar(id, desc, venc) {
    document.getElementById('formEdit').style.display = "block";
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_desc').value = desc;
    document.getElementById('edit_venc').value = venc;
}

document.getElementById('formAdd').onsubmit = async (e) => {
    e.preventDefault();
    const dados = new FormData(e.target);
    const req = await fetch("add_tarefa.php", { method: "POST", body: dados });
    alert(await req.text());
    location.reload();
};

document.getElementById('formDelete').onsubmit = async (e) => {
    e.preventDefault();
    const dados = new FormData(e.target);
    const req = await fetch("delete_tarefa.php", {
    method: "POST", body: dados });
    alert(await req.text());
    location.reload();
};

document.getElementById('formEdit').onsubmit = async (e) => {
    e.preventDefault();
    const dados = new FormData(e.target);
    const req = await fetch("update_tarefa.php", { 
    method: "POST", body: dados });
    alert(await req.text());
    location.reload();
};

async function concluir(id) {
    const dados = new FormData();
    dados.append("id", id);
    dados.append("concluir", 1); 

    const req = await fetch("update_tarefa.php", { 
        method: "POST",
        body: dados 
    });

    alert(await req.text());
    location.reload();
}


</script>

</body>
</html>
