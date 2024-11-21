<?php
include "head.php";

// Inclua o arquivo de configuração do banco de dados
require_once 'pdoconfig.php';

// Verifica se foi fornecido um ID válido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Prepara a consulta para obter os dados da pessoa com base no ID fornecido
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
?>
        <main>
            <div class="container">
                <div class="container-menu">
                    <!-- Tabela com os detalhes do usuário -->
                    <div class="table-responsive">
                    <h2>Informações do Usuário</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Endereço WEB</th>
                                    <th>Experiência Profissional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['telefone'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['endereco_web'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['experiencia_profissional']); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <a href='curriculos-cadastrados.php' class='btn-voltar'>Voltar</a>
<?php
    } else {
        echo
        "<div class='container'>
            <div class='container-menu'>
                <p class='nao-ha-curriculos'>Usuário não encontrado.</p>
            </div>
        </div>";
    }
} else {
    echo
        "<div class='container'>
            <div class='container-menu'>
                <p class='nao-ha-curriculos'>ID de usuário inválido.</p>
            </div>
        </div>";
}
    echo "<a href='curriculos-cadastrados.php' class='btn-voltar'>Voltar</a>";
?>
