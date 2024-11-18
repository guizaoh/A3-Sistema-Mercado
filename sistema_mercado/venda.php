<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Vendas</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; }
        button { padding: 10px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background: #45a049; }
        .valor-display {
            font-size: 1.2em;
            font-weight: bold;
            padding: 10px;
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
        .success-message {
            color: green;
            margin-bottom: 10px;
        }

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
    <h2>Registro de Vendas</h2>
    <?php if(isset($_GET['erro'])): ?>
        <div class="error-message">
            <?php 
                switch($_GET['erro']) {
                    case '1':
                        echo "Erro ao registrar a venda.";
                        break;
                    case '2':
                        echo "Estoque insuficiente.";
                        break;
                    default:
                        echo "Ocorreu um erro.";
                }
            ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['success'])): ?>
        <div class="success-message">Venda registrada com sucesso!</div>
    <?php endif; ?>

    <form action="salvar_venda.php" method="POST">
        <div class="form-group">
            <label>Produto:</label>
            <select name="codigo" id="codigo" required>
                <option value="">Selecione um produto</option>
                <?php
                $stmt = $pdo->query("SELECT codigo, nome, preco, quantidade, desconto FROM produtos");
                while($row = $stmt->fetch()) {
                    echo "<option value='".$row['codigo']."' 
                        data-preco='".$row['preco']."' 
                        data-estoque='".$row['quantidade']."'
                        data-desconto='".$row['desconto']."'>"
                        .$row['nome']." (Estoque: ".$row['quantidade'].")</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Quantidade:</label>
            <input type="number" name="qtde_venda" id="qtde_venda" min="1" required>
            <span id="estoque-message" style="color: red; display: none;">Quantidade maior que o estoque disponível!</span>
        </div>
        <div class="form-group">
            <label>Data da Venda:</label>
            <input type="date" name="data_venda" required value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label>Valor Total:</label>
            <div class="valor-display" id="valor-display">R$ 0,00</div>
            <input type="hidden" name="valor" id="valor" required>
        </div>
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        <button type="submit" id="submit-button">Registrar Venda</button>

    </form>

    <script>
        function calcularValor() {
            const select = document.getElementById('codigo');
            const quantidade = document.getElementById('qtde_venda').value;
            const submitButton = document.getElementById('submit-button');
            
            if (select.value && quantidade) {
                const option = select.options[select.selectedIndex];
                const preco = parseFloat(option.dataset.preco);
                const estoque = parseInt(option.dataset.estoque);
                const desconto = parseFloat(option.dataset.desconto);
                
                // Verificar estoque
                if (quantidade > estoque) {
                    document.getElementById('estoque-message').style.display = 'block';
                    submitButton.disabled = true;
                    return;
                } else {
                    document.getElementById('estoque-message').style.display = 'none';
                    submitButton.disabled = false;
                }
                
                // Calcular valor total com desconto
                const valorSemDesconto = preco * quantidade;
                const valorDesconto = valorSemDesconto * (desconto / 100);
                const valorTotal = valorSemDesconto - valorDesconto;
                
                document.getElementById('valor-display').textContent = 
                    `R$ ${valorTotal.toFixed(2)} (Desconto: ${desconto}%)`;
                document.getElementById('valor').value = valorTotal.toFixed(2);
            } else {
                document.getElementById('valor-display').textContent = 'R$ 0,00';
                document.getElementById('valor').value = '';
            }
        }

        // Adicionar eventos para recalcular o valor
        document.getElementById('codigo').addEventListener('change', calcularValor);
        document.getElementById('qtde_venda').addEventListener('input', calcularValor);
    </script>
</body>
</html>