<?php

session_start();

if (isset($_SESSION["Username"])) {
    if (isset($_SESSION["Role"])) {
        header("Location: " . $_SESSION["Role"] . ".php");
    }
} else {
    header("Location: login.php");
}
