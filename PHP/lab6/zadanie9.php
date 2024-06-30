<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Losowe Kapibary</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        img { width: 200px; height: auto; margin: 10px; }
    </style>
</head>
<body>
<h1>Losowe Kapibary</h1>

<?php
$images = [
    "kapibara1.jpg",
    "kapibara2.jpg",
    "kapibara3.jpg",
    "kapibara4.jpg",
    "kapibara5.jpg",
    "kapibara6.jpg",
    "kapibara7.jpg",
    "kapibara8.jpg",
    "kapibara9.jpg"
];

$randomImages = array_rand($images, 3);

foreach ($randomImages as $index) {
    echo '<img src="' . $images[$index] . '" alt="Kapibara">';
}
?>

</body>
</html>
