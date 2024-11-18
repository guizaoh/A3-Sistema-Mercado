<?php
include 'config.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    try {
        // Primeiro verifica se existem vendas para este produto
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM vendas WHERE codigo = ?");
        $stmt->execute([$_GET['id']]);
        $temVendas = $stmt->fetchColumn() > 0;
        
        if($temVendas) {
            // Produto tem vendas associadas
            header("Location: listagem_produtos.php?erro=4");
            exit();
        }
        
        // Se não tem vendas, pode excluir
        $stmt = $pdo->prepare("DELETE FROM produtos WHERE codigo = ?");
        $stmt->execute([$_GET['id']]);
        
        if($stmt->rowCount() > 0) {
            header("Location: listagem_produtos.php?success=1");
        } else {
            header("Location: listagem_produtos.php?erro=2");
        }
        
    } catch(PDOException $e) {
        header("Location: listagem_produtos.php?erro=1");
    }
    exit();
} else {
    header("Location: listagem_produtos.php?erro=3");
    exit();
}
?>