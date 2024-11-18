<?php
// salvar_venda.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Primeiro, vamos buscar o preço e desconto do produto
        $stmt = $pdo->prepare("SELECT preco, desconto, quantidade FROM produtos WHERE codigo = ?");
        $stmt->execute([$_POST['codigo']]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$produto) {
            throw new PDOException("Produto não encontrado");
        }
        
        // Verificar se há quantidade suficiente em estoque
        if ($produto['quantidade'] < $_POST['qtde_venda']) {
            header("Location: venda.php?erro=2"); // Erro de estoque insuficiente
            exit;
        }
        
        // Calcular o valor total da venda considerando o desconto
        $preco_unitario = $produto['preco'];
        $desconto = $produto['desconto'] / 100; // Convertendo porcentagem para decimal
        $quantidade = $_POST['qtde_venda'];
        
        $valor_sem_desconto = $preco_unitario * $quantidade;
        $valor_do_desconto = $valor_sem_desconto * $desconto;
        $valor_total = $valor_sem_desconto - $valor_do_desconto;
        
        // Inserir a venda com o valor calculado
        $stmt = $pdo->prepare("INSERT INTO vendas (codigo, qtde_venda, data_venda, valor) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['codigo'],
            $quantidade,
            $_POST['data_venda'],
            $valor_total
        ]);
        
        // Atualiza o estoque do produto
        $stmt = $pdo->prepare("UPDATE produtos SET quantidade = quantidade - ? WHERE codigo = ?");
        $stmt->execute([$quantidade, $_POST['codigo']]);
        
        header("Location: venda.php?success=1");
    } catch(PDOException $e) {
        // Você pode adicionar um log do erro aqui se necessário
        header("Location: venda.php?erro=1");
    }
}
?>