<?php
include __DIR__ . '/../config/conexao.php';


// Pegar os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Validação simples no lado do servidor
if (empty($nome) || empty($email) || empty($telefone)) {
    die("Erro: Por favor, preencha todos os campos obrigatórios.");
}

// Preparar a query SQL para evitar SQL Injection
$stmt = $conexao->prepare("INSERT INTO contatos (nome, sobrenome, email, telefone) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssss", $nome, $sobrenome, $email, $telefone);

// Executar e verificar
if ($stmt->execute()) {
    // Redireciona de volta para a página principal com uma mensagem de sucesso
    header("Location: ../index.php?status=sucesso");
} else {
    // Exibe um erro
    echo "Erro ao salvar contato: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>