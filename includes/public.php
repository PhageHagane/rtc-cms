<?php
require_once "conn.php";

session_start();

if (isset($_SESSION["Username"]) && !empty($_SESSION["Username"])) {
    header("Location: " . $_SESSION["Role"] . ".php");
}
