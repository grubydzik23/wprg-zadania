<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kapibara i Marchewka</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        img { width: 300px; height: auto; margin: 20px; }
    </style>
</head>
<body>
<h1>Kapibara i Marchewka</h1>

<?php
function KapibaraJeMarchewke() {
    return mt_rand(1, 100) <= 60;
}

$kapibaraJe = KapibaraJeMarchewke();

if ($kapibaraJe) {
    echo '<img src="kapibara.jpg" alt="Kapibara">';
} else {
    echo '<img src="kapibara.jpg" alt="Kapibara">';
    echo '<img src="marchewka.jpg" alt="Marchewka">';
}
?>

</body>
</html>
