<?php
$servidor = "localhost";
$usuario = "root";
$senha = "root"; 
$banco_dados = "gerenciador_contatos"; 

// Criar a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco_dados);

// Checar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Definir o charset para utf8 para evitar problemas com acentuação
$conexao->set_charset("utf8");
?>