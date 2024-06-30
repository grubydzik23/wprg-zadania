<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przeliczanie temperatury</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 2px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1 style="text-align:center;">Przeliczanie temperatury</h1>
<table>
    <thead>
    <tr>
        <th>Celsjusze</th>
        <th>Fahrenheity</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($c = -20; $c <= 40; $c += 5) {
        $f = $c * 9/5 + 32;
        echo "<tr><td>{$c}°C</td><td>{$f}°F</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
