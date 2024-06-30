<?php
session_start();

if (!isset($_GET['index']) || !isset($_SESSION['cars'][$_GET['index']])) {
    header('Location: index.php');
    exit();
}

$car = $_SESSION['cars'][$_GET['index']];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detal samochodu</title>
</head>
<body>
<h1>Detal samochodu</h1>
<p><?php echo $car; ?></p>
<a href="index.php">Powrót do listy samochodów</a>
</body>
</html>
