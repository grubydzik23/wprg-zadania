<?php
$background_color = isset($_COOKIE['background_color']) ? $_COOKIE['background_color'] : 'white';
$text_color = isset($_COOKIE['text_color']) ? $_COOKIE['text_color'] : 'black';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Treść</title>
    <style>
        body {
            background-color: <?php echo htmlspecialchars($background_color); ?>;
            color: <?php echo htmlspecialchars($text_color); ?>;
        }
    </style>
</head>
<body>
<p>Lorem Ipsum...</p>
<a href="preferences.html">Zmień ustawienia</a>
</body>
</html>
