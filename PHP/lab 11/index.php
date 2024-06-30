<?php
session_start();

if (!isset($_SESSION['cars'])) {
    $_SESSION['cars'] = [];
}

require_once 'Car.php';
require_once 'NewCar.php';
require_once 'InsuranceCar.php';

$carCount = count($_SESSION['cars']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carType = $_POST['carType'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $exchangeRate = $_POST['exchangeRate'];

    if ($carType == 'Car') {
        $car = new Car($model, $price, $exchangeRate);
    } elseif ($carType == 'NewCar') {
        $alarm = isset($_POST['alarm']);
        $radio = isset($_POST['radio']);
        $climatronic = isset($_POST['climatronic']);
        $car = new NewCar($model, $price, $exchangeRate, $alarm, $radio, $climatronic);
    } elseif ($carType == 'InsuranceCar') {
        $alarm = isset($_POST['alarm']);
        $radio = isset($_POST['radio']);
        $climatronic = isset($_POST['climatronic']);
        $firstOwner = isset($_POST['firstOwner']);
        $years = $_POST['years'];
        $car = new InsuranceCar($model, $price, $exchangeRate, $alarm, $radio, $climatronic, $firstOwner, $years);
    }

    $_SESSION['cars'][] = $car;
    $carCount++;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Samochody</title>
</head>
<body>
<h1>Ilość samochodów: <?php echo $carCount; ?></h1>
<form method="POST">
    <label for="carType">Wybierz typ samochodu:</label>
    <select id="carType" name="carType" onchange="showForm(this.value)">
        <option value="Car">Car</option>
        <option value="NewCar">NewCar</option>
        <option value="InsuranceCar">InsuranceCar</option>
    </select>
    <div id="commonFields">
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
        <label for="exchangeRate">Exchange Rate:</label>
        <input type="number" step="0.01" id="exchangeRate" name="exchangeRate" required>
    </div>
    <div id="newCarFields" style="display:none;">
        <label for="alarm">Alarm:</label>
        <input type="checkbox" id="alarm" name="alarm">
        <label for="radio">Radio:</label>
        <input type="checkbox" id="radio" name="radio">
        <label for="climatronic">Climatronic:</label>
        <input type="checkbox" id="climatronic" name="climatronic">
    </div>
    <div id="insuranceCarFields" style="display:none;">
        <label for="firstOwner">First Owner:</label>
        <input type="checkbox" id="firstOwner" name="firstOwner">
        <label for="years">Years:</label>
        <input type="number" id="years" name="years" required>
    </div>
    <button type="submit">Dodaj samochód</button>
</form>
<h2>Lista samochodów:</h2>
<ul>
    <?php foreach ($_SESSION['cars'] as $index => $car): ?>
        <li>
            <?php echo $car; ?>
            <form method="POST" action="delete_car.php" style="display:inline;">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit">Usuń</button>
            </form>
            <a href="car_details.php?index=<?php echo $index; ?>">Szczegóły</a>
            <form method="POST" action="calculate_value.php" style="display:inline;">
                <input type="hidden" name="index" value="<?php echo $index; ?>">
                <button type="submit">Oblicz cenę</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
<script>
    function showForm(carType) {
        document.getElementById('newCarFields').style.display = carType === 'NewCar' || carType === 'InsuranceCar' ? 'block' : 'none';
        document.getElementById('insuranceCarFields').style.display = carType === 'InsuranceCar' ? 'block' : 'none';
    }
</script>
</body>
</html>
