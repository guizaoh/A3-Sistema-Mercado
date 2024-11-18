<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Produtos Vendidos</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #4CAF50; color: white; }
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
        tfoot td { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Produtos Vendidos</h2>
    <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
    <table>
        <tr>
            <th>Código da Venda</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Valor</th>
        </tr>
        <?php
        include 'config.php';

        // Inicializar variáveis para totalização
        $totalQuantidade = 0;
        $totalValor = 0;

        // Obter dados das vendas
        $stmt = $pdo->query("
            SELECT v.*, p.nome as produto_nome 
            FROM vendas v 
            JOIN produtos p ON v.codigo = p.codigo
            ORDER BY v.data_venda DESC
        ");

        while ($row = $stmt->fetch()) {
            // Atualizar os totais
            $totalQuantidade += $row['qtde_venda'];
            $totalValor += $row['valor'];

            // Exibir os dados da venda
            echo "<tr>";
            echo "<td>".$row['cod_venda']."</td>";
            echo "<td>".$row['produto_nome']."</td>";
            echo "<td>".$row['qtde_venda']."</td>";
            echo "<td>".date('d/m/Y', strtotime($row['data_venda']))."</td>";
            echo "<td>R$ ".number_format($row['valor'], 2, ',', '.')."</td>";
            echo "</tr>";
        }
        ?>
        <tfoot>
            <tr>
                <td colspan="2">Totais</td>
                <td><?php echo $totalQuantidade; ?></td>
                <td></td>
                <td>R$ <?php echo number_format($totalValor, 2, ',', '.'); ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>