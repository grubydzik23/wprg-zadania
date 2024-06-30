<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Licznik odwiedzin</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        .counter { font-size: 24px; margin: 20px 0; }
        button { padding: 10px 20px; font-size: 16px; }
        .reset { margin-top: 20px; }
    </style>
</head>
<body>
<h1>Licznik odwiedzin</h1>

<?php
$file = 'licznik.txt';

// Inicjalizacja licznika jeśli plik nie istnieje
if (!file_exists($file)) {
    file_put_contents($file, 0);
}

// Zwiększenie licznika lub resetowanie w zależności od przycisku
if (isset($_POST['reset'])) {
    file_put_contents($file, 0);
} else {
    $count = (int)file_get_contents($file);
    $count++;
    file_put_contents($file, $count);
}

// Pobieranie aktualnej wartości licznika
$count = file_get_contents($file);

echo "<div class='counter'>Liczba odwiedzin: $count</div>";
?>

<form method="post">
    <button type="submit" name="reset" class="reset">Resetuj licznik</button>
</form>
</body>
</html>
