<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_COOKIE['capybaras'])) {
    setcookie('capybaras', 0, time() + (86400 * 30), "/"); // 30 days
}

if (isset($_POST['add_capibara'])) {
    $capybaras = isset($_COOKIE['capybaras']) ? $_COOKIE['capybaras'] : 0;
    $capybaras++;
    setcookie('capybaras', $capybaras, time() + (86400 * 30), "/");
}

$capybaras = isset($_COOKIE['capybaras']) ? $_COOKIE['capybaras'] : 0;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kapibary</title>
</head>
<body>
<h1>Witaj, <?php echo $_SESSION['username']; ?></h1>
<p>Masz <?php echo $capybaras; ?> kapibar.</p>
<form method="post">
    <button type="submit" name="add_capibara">Dodaj kapibarę</button>
</form>
<a href="logout.php">Wyloguj się</a>
</body>
</html>
