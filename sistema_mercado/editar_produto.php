<?php
include 'config.php';
if(isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE codigo = ?");
    $stmt->execute([$_GET['id']]);
    $produto = $stmt->fetch();
    
    if(!$produto) {
        header("Location: listagem_produtos.php");
        exit;
    }
} else {
    header("Location: listagem_produtos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        
        .btn-salvar {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-cancelar {
            background-color: #777;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
            display: inline-block;
        }

        .btn-voltar {
            background-color: #777;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
            display: inline-block;
        }
        
        .btn-salvar:hover {
            background-color: #45a049;
        }
        
        .btn-cancelar:hover {
            background-color: #666;
        }

        .btn-voltar:hover {
            background-color: #666;
        }
        
        .mensagem {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        
        .sucesso {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        
        .erro {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="mensagem sucesso">
                Produto atualizado com sucesso!
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['erro'])): ?>
            <div class="mensagem erro">
                Erro ao atualizar o produto. Tente novamente.
            </div>
        <?php endif; ?>

        <form action="atualizar_produto.php" method="POST">
            <input type="hidden" name="codigo" value="<?php echo $produto['codigo']; ?>">
            
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço (R$):</label>
                <input type="number" id="preco" name="preco" step="0.01" value="<?php echo $produto['preco']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="validade">Data de Validade:</label>
                <input type="date" id="validade" name="validade" value="<?php echo $produto['validade']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="unid_medida">Unidade de Medida:</label>
                <input type="text" id="unid_medida" name="unid_medida" value="<?php echo htmlspecialchars($produto['unid_medida']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="desconto">Desconto (%):</label>
                <input type="number" id="desconto" name="desconto" min="0" max="100" value="<?php echo $produto['desconto']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="quantidade">Quantidade em Estoque:</label>
                <input type="number" id="quantidade" name="quantidade" min="0" value="<?php echo $produto['quantidade']; ?>" required>
            </div>
            
            <div class="buttons">
                <button type="submit" class="btn-salvar">Salvar Alterações</button>
                <a href="listagem_produtos.php" class="btn-cancelar">Cancelar</a>
                <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
            </div>
        </form>
    </div>
</body>
</html>