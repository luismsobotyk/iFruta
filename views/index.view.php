<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Ifruta</title>
  <!-- Icone da página -->
  <link rel="shortcut icon" href="/imagens/logo ifruta verde.png" type="image/x-icon">
  <link rel="stylesheet" href="/css/login.css"> <!-- Link para o arquivo CSS -->
  <script src="/javascript/login.js" defer></script> <!-- Link para o arquivo JavaScript -->
</head>
<body>

  <div class="login-container">
    <!-- Logo iFruta e ícone lado a lado -->
    <div class="logo-ifruta">
      <img src="imagens/logo ifruta verde.png" alt="logo-ifruta" class="logo">
      <h2 class="title-ifruta">iFruta</h2>
    </div>

    <!-- Título Login -->
    <h2>Login</h2>
     <!-- Parágrafo informativo -->
     <p>Insira os dados de login iguais aos usados para acessar a rede no campus e <span>pressione em Confirmar</span></p>

    <!-- Formulário de login -->
    <form id="loginForm" action="/auth" method="POST">
      <input hidden value="<?= $matricula;?>" name="user" id="user">

      <!-- Campo de email -->
      <label for="user">Login</label>
      <input type="text" class="input-field" id="user" placeholder="Digite o seu Login" name="user" required>

      <!-- Campo de senha -->
      <label for="senha">Senha</label>
      <input type="password" class="input-field" id="senha" placeholder="Digite sua senha" name="senha" required>

      <!-- Botão de login -->
      <button type="submit" class="btn-login" id="login" value="login">Confirmar</button>

      <!-- Links para recuperar senha ou cadastrar-se -->
      <div class="links">
        <a href="/esqueci-senha">Esqueceu a senha?</a>
        <a href="/cadastro">Cadastrar-se</a>
      </div>

      <!-- Mensagem de erro ou sucesso -->
      <div id="message" class="message"></div>
    </form>

    <!-- Logo do IFRS (na parte de baixo do login) -->
    <div class="logo-ifrs">
      <img src="imagens/Logo-IFRS-cores-sem-fundo-Horizontal.png" alt="logo-ifrs">
    </div>
  </div>

</body>
</html>