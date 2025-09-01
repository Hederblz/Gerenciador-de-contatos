<?php
include 'config/conexao.php'; // Inclui o arquivo de conexão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Contatos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciador de Contatos</h1>

        <h2>Adicionar Novo Contato</h2>
        <form action="controllers/salvar_contato.php" method="POST" id="form-contato">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="text" name="telefone" id="telefone" placeholder="Telefone" required>
            <button type="submit">Salvar Contato</button>
        </form>

        <div class="busca-container">
            <input type="text" id="busca" placeholder="Buscar contato por nome...">
        </div>

        <h2>Lista de Contatos</h2>
        <table id="tabela-contatos">
            <thead>
                <tr>
                    <th>Nome Completo</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, nome, sobrenome, email, telefone FROM contatos ORDER BY nome";
                $resultado = $conexao->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($contato = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($contato['nome']) . " " . htmlspecialchars($contato['sobrenome']) . "</td>";
                        echo "<td>" . htmlspecialchars($contato['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($contato['telefone']) . "</td>";
                        echo "<td class='acoes'>";
                        echo "<a href='controllers/editar.php?id=" . $contato['id'] . "' class='btn-editar'>Editar</a> ";
                        echo "<a href='controllers/excluir_contato.php?id=" . $contato['id'] . "' class='btn-excluir' onclick='return confirm(\"Tem certeza que deseja excluir este contato?\")'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum contato encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="assets/js/scripts.js"></script> 
</body>
</html>
<?php
$conexao->close();
?>