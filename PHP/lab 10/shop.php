<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Inicjalizuj koszyk użytkownika, jeśli nie istnieje
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => 'Produkt 1',
    2 => 'Produkt 2',
    3 => 'Produkt 3'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Dodaj produkt do koszyka
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 0;
    }
    $_SESSION['cart'][$product_id]++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sklep internetowy</title>
</head>
<body>
<h1>Witaj w sklepie, <?php echo htmlspecialchars($username); ?>!</h1>
<ul>
    <?php foreach ($products as $id => $name): ?>
        <li>
            <?php echo htmlspecialchars($name); ?>
            <form method="POST" action="shop.php" style="display:inline;">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <button type="submit">Dodaj do koszyka</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<a href="cart.php">Przejdź do koszyka</a>
<br>
<a href="logout.php">Wyloguj</a>
</body>
</html>
