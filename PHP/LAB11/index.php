<?php

require_once "Animal.php";
require_once "Capybara.php";


$kapibara = new Capybara("white", 10);

echo $kapibara;

echo $kapibara->makeSound();

echo Animal::info();

?>

<html>

</html>
