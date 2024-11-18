<?php
// menu.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu Principal - Sistema Mercado</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .menu { max-width: 600px; margin: 0 auto; }
        .menu-item { 
            display: block;
            padding: 15px;
            margin: 10px 0;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }
        .menu-item:hover { background: #45a049; }
        .header { 
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="menu">
        <div class="header">
            <h2>Bem-vindo(a), <?php echo $_SESSION['usuario']; ?></h2>
            <a href="logout.php" style="color: red;">Sair</a>
        </div>
        
        <?php if ($_SESSION['permissao'] == 'A'): ?>
            <a href="cadastro_funcionario.php" class="menu-item">Cadastro de Funcionários</a>
            <a href="listagem_salarios.php" class="menu-item">Listagem de Salários</a>
        <?php endif; ?>
        
        <a href="cadastro_produto.php" class="menu-item">Cadastro de Produtos</a>
        <a href="venda.php" class="menu-item">Registrar Venda</a>
        <a href="listagem_vendas.php" class="menu-item">Listagem de Vendas</a>
        <a href="listagem_produtos.php" class="menu-item">Lista de Produtos</a>

    </div>
</body>
</html>