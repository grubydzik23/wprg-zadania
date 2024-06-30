<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $index = $_POST['index'];
    if (isset($_SESSION['cars'][$index])) {
        unset($_SESSION['cars'][$index]);
        $_SESSION['cars'] = array_values($_SESSION['cars']);
    }
}

header('Location: index.php');
exit();
?>
