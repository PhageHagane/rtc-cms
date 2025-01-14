<?php
session_start();
unset($_SESSION["Username"]);
header('Location: /rtc-cms/login.php');
?>