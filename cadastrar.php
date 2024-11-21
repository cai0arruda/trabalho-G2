<div class="formulario">
    <div class="form-container">
        <h2>Formulário de Inserção</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <!-- Nome -->
            <label for="nome">Nome (Obrigatório)</label>
            <input type="text" id="nome" name="nome" 
                   pattern="[A-Za-zÀ-ÖØ-öø-ÿ ]+" 
                   title="Digite apenas letras e espaços." 
                   required>

            <!-- Telefone -->
            <label for="telefone">Telefone</label>
            <input type="tel" id="telefone" name="telefone" 
                   pattern="[0-9]{11}" 
                   placeholder="Ex: 11987654321" 
                   title="Digite exatamente 11 números, sem espaços ou caracteres especiais.">

            <!-- E-mail -->
            <label for="email">Endereço de E-mail (Obrigatório)</label>
            <input type="email" id="email" name="email" 
                   pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                   title="Digite um endereço de e-mail válido." 
                   required>

            <!-- Endereço WEB -->
            <label for="endereco_web">Endereço WEB</label>
            <input type="url" id="endereco_web" name="endereco_web" 
                   pattern="https?://.+" 
                   placeholder="Ex: https://www.seusite.com" 
                   title="Digite uma URL válida. Deve começar com http:// ou https://.">

            <!-- Experiência Profissional -->
            <label for="experiencia_profissional">Experiência Profissional (Obrigatório)</label>
            <textarea id="experiencia_profissional" name="experiencia_profissional" 
                      pattern="[A-Za-zÀ-ÖØ-öø-ÿ0-9 .,]+" 
                      title="Digite apenas letras, números e espaços." 
                      required></textarea>

            <!-- Botão -->
            <button type="submit">Enviar</button>
            <?php include "inserir.php"; ?>
        </form>
    </div>
</div>
<a href='index.php' class='btn-voltar'>Voltar</a>
