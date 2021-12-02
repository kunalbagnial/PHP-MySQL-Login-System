<?php
#start session
session_start();

# usnet session varibales
$_SERVER = array();

# destroy session
session_destroy();

# redirect to login page
echo "<script>window.location.href='http://localhost/PHP-MySQL-Login/login.php'</script>";
exit();
