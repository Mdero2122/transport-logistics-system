<?php

session_start();

session_unset();

session_destroy();

header("Location: /transport-logistics-system/auth/login.php");

exit();

?>