<html>
<head>
    <title>Cadastro de Produtos</title>
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
    <h2>Cadastro de Produtos</h2>
    <?php if (isset($_GET['success'])): ?>
        <p class="success">Produto cadastrado com sucesso!</p>
    <?php elseif (isset($_GET['erro'])): ?>
        <p class="error">Erro ao cadastrar o produto. Tente novamente.</p>
    <?php endif; ?>
    <form action="salvar_produto.php" method="POST">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required>
        </div>
        <div class="form-group">
            <label>Preço:</label>
            <input type="number" step="0.01" name="preco" required>
        </div>
        <div class="form-group">
            <label>Validade:</label>
            <input type="date" name="validade" required>
        </div>
        <div class="form-group">
            <label>Unidade de Medida:</label>
            <input type="text" name="unid_medida" required>
        </div>
        <div class="form-group">
            <label>Desconto:</label>
            <input type="number" name="desconto">
        </div>
        <div class="form-group">
            <label>Quantidade:</label>
            <input type="number" name="quantidade" required>
        </div>
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        <button type="submit">Cadastrar Produto</button>
    </form>
</body>
</html>