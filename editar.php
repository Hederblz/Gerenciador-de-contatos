<?php
include 'conexao.php';

$id = $_GET['id'];

// Buscar o contato no banco de dados
$stmt = $conexao->prepare("SELECT * FROM contatos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$contato = $resultado->fetch_assoc();

if (!$contato) {
    die("Contato não encontrado!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Contato</h1>
        <form action="atualizar_contato.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $contato['id']; ?>">
            <input type="text" name="nome" value="<?php echo htmlspecialchars($contato['nome']); ?>" required>
            <input type="text" name="sobrenome" value="<?php echo htmlspecialchars($contato['sobrenome']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($contato['email']); ?>" required>
            <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($contato['telefone']); ?>" required>
            <button type="submit">Atualizar Contato</button>
            <a href="index.php" class="btn-voltar">Voltar</a>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
<?php
$stmt->close();
$conexao->close();
?>