<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Salários dos Funcionários</title>
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
    </style>
</head>
<body>
    <h2>Salários dos Funcionários</h2>
    <a href="menu.php" class="btn-voltar">Voltar ao Menu</a>
    <table>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Salário 220h</th>
            <th>Horas Trabalhadas</th>
            <th>Salário Final</th>
        </tr>
        <?php
        include 'config.php';
        $stmt = $pdo->query("SELECT * FROM funcionarios ORDER BY nome");
        while($row = $stmt->fetch()) {
            $salario_final = ($row['salario_220h'] / 220) * $row['horas_trabalhadas'];
            echo "<tr>";
            echo "<td>".$row['nome']."</td>";
            echo "<td>".$row['cpf']."</td>";
            echo "<td>R$ ".number_format($row['salario_220h'], 2, ',', '.')."</td>";
            echo "<td>".$row['horas_trabalhadas']."</td>";
            echo "<td>R$ ".number_format($salario_final, 2, ',', '.')."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>