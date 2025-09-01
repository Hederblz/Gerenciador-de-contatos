<?php
include __DIR__ . '/../config/conexao.php';

$id = $_GET['id'];

if (empty($id)) {
    die("Erro: ID do contato não fornecido.");
}

$stmt = $conexao->prepare("DELETE FROM contatos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../index.php?status=excluido");
} else {
    echo "Erro ao excluir contato: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>