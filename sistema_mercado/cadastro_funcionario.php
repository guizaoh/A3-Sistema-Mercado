<html>
<head>
    <title>Cadastro de Funcionários</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; }
        button { padding: 10px; background: #4CAF50; color: white; border: none; }
        .btn-voltar {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-voltar:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Cadastro de Funcionários</h2>
    <?php if (isset($_GET['success'])): ?>
        <p class="success">Funcionário cadastrado com sucesso!</p>
    <?php elseif (isset($_GET['erro'])): ?>
        <p class="error">Erro ao cadastrar o funcionário. Tente novamente.</p>
    <?php endif; ?>
    
    
    
    <form action="salvar_funcionario.php" method="POST">
        <div class="form-group">
            <label>CPF:</label>
            <input type="text" name="cpf" maxlength="11" required>
        </div>
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha" maxlength="5" required>
        </div>
        <div class="form-group">
            <label>Permissão:</label>
            <input type="text" name="permissao" maxlength="1" required>
        </div>
        <div class="form-group">
            <label>Salário 220h:</label>
            <input type="number" step="0.01" name="salario_220h" required>
        </div>
        <div class="form-group">
            <label>Horas Trabalhadas:</label>
            <input type="number" name="horas_trabalhadas" required>
        </div>
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        <button type="submit">Cadastrar Funcionário</button>
    </form>
</body>
</html>