<?php
$host = "localhost";
$user = "root";
$pass="";
$dbname = "livraria";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$sql = "Select * from $dbname.livros ORDER BY id DESC ";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Livraria</title>
</head>
<body>
<h1>Adicionar Livros</h1>
<h2>Adicionar novo livro</h2>
<form action= "add_book.php" method="post">

<label>Título:</label>
<input type="text" name="titulo" required> <br><br>

<label>Autor:</label>
<input type="text" name="autor" required> <br><br>

<label>Ano</label>
<input type="number" name="ano" required> <br><br>


<button type="submit">Adicionar</button>
</form>

<hr>

<h2>Lista de Livros</h2>

<?php
if($result->num_rows > 0 ){
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano</th><th>Ação</th></tr>";


    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['titulo'] . "</td>";
        echo "<td>" . $row['autor'] . "</td>";
        echo "<td>" . $row['ano'] . "</td>";
        
        echo "<td>
         <button type ='button' onclick='deletarLivro(" . $row['id'] . ")'>Deletar</button>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum livro encontrado.";
}
$conn->close();
?>
<script>
      document.querySelector("form").addEventListener("submit", function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        fetch("add_book.php", {
          method: "POST",
          body: formData
        })
        .then(res => res.text())
        .then(resposta=>{
            if (resposta === "OK") {
                alert ("Livro adicionado com sucesso!");
                location.reload();
            } else {
                alert("Erro ao adicionar o livro.");
            }
        });
      });
</script>

<script>
function deletarLivro(id) {
    if (confirm("Tem certeza que deseja deletar?")) {
        let formData = new FormData();
        formData.append("id", id);

        fetch("delete_book.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(resposta => {
            if (resposta === "OK") {
                alert("Livro deletado com sucesso!");
                location.reload();
            } else {
                alert("Erro ao deletar o livro.");
            }
        });
    }
}
</script>

</body>
</html>
