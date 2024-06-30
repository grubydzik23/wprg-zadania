<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['background_color'] = $_POST['background_color'];
    $_SESSION['text_color'] = $_POST['text_color'];

    header('Location: confirmation.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ustawienia preferencji</title>
</head>
<body>
<form method="POST" action="preferences.php">
    <label for="background_color">Kolor tła:</label>
    <select id="background_color" name="background_color">
        <option value="white">Biały</option>
        <option value="lightblue">Jasnoniebieski</option>
        <option value="lightgreen">Jasnozielony</option>
    </select>

    <label for="text_color">Kolor tekstu:</label>
    <select id="text_color" name="text_color">
        <option value="black">Czarny</option>
        <option value="blue">Niebieski</option>
        <option value="green">Zielony</option>
    </select>

    <button type="submit">Zapisz</button>
</form>
</body>
</html>
