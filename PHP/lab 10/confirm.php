<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['bg_color'] = $_POST['bg_color'];
    $_SESSION['text_color'] = $_POST['text_color'];
    header('Location: content.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Potwierdzenie ustawień</title>
</head>
<body>
<h1>Ustawienia zostały zapisane!</h1>
<p><a href="content.php">Przejdź do treści</a></p>
</body>
</html>
