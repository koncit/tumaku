<?php
session_start();
session_unset('login');
header("location: index.php");
?>
