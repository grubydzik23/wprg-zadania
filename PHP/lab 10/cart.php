<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$products = [
    1 => 'Produkt 1',
    2 => 'Produkt 2',
    3 => 'Produkt 3'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'clear_cart') {
        $_SESSION['cart'] = [];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Koszyk</title>
</head>
<body>
<h1>Twój koszyk, <?php echo htmlspecialchars($username); ?>!</h1>
<ul>
    <?php if (empty($_SESSION['cart'])): ?>
        <li>Twój koszyk jest pusty.</li>
    <?php else: ?>
        <?php foreach ($_SESSION['cart'] as $product_id => $quantity): ?>
            <li>
                <?php echo htmlspecialchars($products[$product_id]) . ' - Ilość: ' . $quantity; ?>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
<form method="POST" action="cart.php">
    <button type="submit" name="action" value="clear_cart">Kup i wyczyść koszyk</button>
</form>
<a href="shop.php">Wróć do sklepu</a>
</body>
</html>
