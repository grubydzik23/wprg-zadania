<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $background_color = $_POST['background_color'];
    $text_color = $_POST['text_color'];

    setcookie('background_color', $background_color, time() + 3600); // Ciastko na 1 godzinę
    setcookie('text_color', $text_color, time() + 3600); // Ciastko na 1 godzinę

    header('Location: confirmation.html');
    exit();
}
?>
