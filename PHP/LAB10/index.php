<?php
$passwords = ['kapibara' => 'wscieklykapibar1'];


$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

if ((!isset($username) || !isset($password)) || $password !== $passwords[$username]) {
    header('WWW-Authenticate: Basic realm="Kapibara');
} else {
    echo 'Jestes zalogowany jako: ' . $username;
}

?>
<html>
<body>
<br/>
</body>
</html>