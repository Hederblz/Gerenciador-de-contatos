<?php
include 'conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if (empty($id) || empty($nome) || empty($email) || empty($telefone)) {
    die("Erro: Dados incompletos.");
}

$stmt = $conexao->prepare("UPDATE contatos SET nome = ?, sobrenome = ?, email = ?, telefone = ? WHERE id = ?");

$stmt->bind_param("ssssi", $nome, $sobrenome, $email, $telefone, $id);

if ($stmt->execute()) {
    header("Location: index.php?status=atualizado");
} else {
    echo "Erro ao atualizar contato: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>