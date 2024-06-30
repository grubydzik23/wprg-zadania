<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['cars'][$index])) {
        $car = $_SESSION['cars'][$index];
        $value = $car->value();
        echo "Wartość samochodu: " . $value . " PLN";
        echo "<br><a href='index.php'>Powrót do listy samochodów</a>";
    } else {
        header('Location: index.php');
        exit();
    }
}
?>
