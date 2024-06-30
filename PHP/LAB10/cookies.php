<?php
$pageAccess = $_COOKIE['accesses'];
setcookie('accesses', ++$pageAccess);

echo $pageAccess;




