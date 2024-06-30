<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kształt zmieniający kolor</title>
    <style>
        .shape {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 50px auto;
            text-align: center;
            line-height: 200px;
            font-size: 20px;
            color: white;
        }
        .color1 { background-color: red; }
        .color2 { background-color: green; }
        .color3 { background-color: blue; }
    </style>
</head>
<body>
<h1 style="text-align:center;">Kształt zmieniający kolor</h1>
<?php
$minute = (int)date('i');
$colorClass = '';
if ($minute < 20) {
    $colorClass = 'color1';
} elseif ($minute < 40) {
    $colorClass = 'color2';
} else {
    $colorClass = 'color3';
}
echo "<div class='shape $colorClass'>Kolor kształtu</div>";
?>
</body>
</html>
