<html><body>
<form>
    Podaj stop(dlugosc): <input type='text' name='stopa'>
    <input type='submit' value='wyslij'>
</form>
<br>
<?php
@$stopa = $_GET['stopa'] * 0.3048;
echo("Dlugosc w metrach: $stopa");
?>
</body></html>