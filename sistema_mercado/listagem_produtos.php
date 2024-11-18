<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-novo, .btn-voltar {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn-novo:hover, .btn-voltar:hover {
            background-color: #45a049;
        }

        .acoes a {
            margin-right: 10px;
            text-decoration: none;
        }

        .editar {
            color: #4CAF50;
        }

        .excluir {
            color: #ff4444;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
        if(isset($_GET['erro'])) {
            $mensagem = "";
            switch($_GET['erro']) {
                case 1:
                    $mensagem = "Erro ao excluir o produto. Tente novamente.";
                    break;
                case 2:
                    $mensagem = "Produto não encontrado.";
                    break;
                case 3:
                    $mensagem = "ID do produto não fornecido.";
                    break;
                case 4:
                    $mensagem = "Não é possível excluir este produto pois existem vendas associadas a ele.";
                    break;
            }
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 4px; text-align: center;">
                    '.$mensagem.'
                  </div>';
        }
        ?>    
    
    <h1>Produtos Cadastrados</h1>
        <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
        <a href="cadastro_produto.php" class="btn-novo">Novo Produto</a>


        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Validade</th>
                    <th>Unid. Medida</th>
                    <th>Desconto</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM produtos ORDER BY nome");
                while($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>".$row['codigo']."</td>";
                    echo "<td>".$row['nome']."</td>";
                    echo "<td>R$ ".number_format($row['preco'], 2, ',', '.')."</td>";
                    echo "<td>".date('d/m/Y', strtotime($row['validade']))."</td>";
                    echo "<td>".$row['unid_medida']."</td>";
                    echo "<td>".$row['desconto']."%</td>";
                    echo "<td>".$row['quantidade']."</td>";
                    echo "<td class='acoes'>
                            <a href='editar_produto.php?id=".$row['codigo']."' class='editar'>Editar</a>
                            <a href='excluir_produto.php?id=".$row['codigo']."' class='excluir' 
                               onclick='return confirm(\"Deseja realmente excluir este produto?\")'>Excluir</a>
                          </td>";
                    echo "</tr>";
                }

                // Se não houver registros
                if($stmt->rowCount() == 0) {
                    echo "<tr><td colspan='8' style='text-align: center;'>Nenhum produto cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>