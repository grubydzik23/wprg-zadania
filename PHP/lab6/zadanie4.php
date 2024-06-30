<html><body>
<form>
    Podaj promien: <input type='text' name='promien'>
    <input type='submit' value='wyslij'>
    Podaj wysokosc: <input type='text' name='wysokosc'>
    <input type='submit' value='wyslij'>
</form>
<br>
<?php
$promien = $_GET['promien'];
$wysokosc = $_GET['wysokosc'];
$objetosc = pow($promien, 2) * $wysokosc;
echo("Objętość cylindra wynosi: $objetosc");
?>
</body></html>