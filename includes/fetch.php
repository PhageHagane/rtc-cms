<?php
require_once "conn.php";

session_start();

$data = array();

if (isset($_POST['EditAccused'])) {
    $id = $conn->real_escape_string($_POST['EditAccused']);

    $query = "SELECT * FROM `accused` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}
if (isset($_POST['EditUser'])) {
    $id = $conn->real_escape_string($_POST['EditUser']);

    $query = "SELECT * FROM `users` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}
if (isset($_POST['EditViolation'])) {
    $id = $conn->real_escape_string($_POST['EditViolation']);

    $query = "SELECT * FROM `violations` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}
if (isset($_POST['EditCase'])) {
    $id = $conn->real_escape_string($_POST['EditCase']);

    $query = "SELECT * FROM `cases` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}
if (isset($_POST['EditDocument'])) {
    $id = $conn->real_escape_string($_POST['EditDocument']);

    $query = "SELECT * FROM `documents` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}
if (isset($_POST['ViewHearing'])) {
    $id = $conn->real_escape_string($_POST['ViewHearing']);

    $query = "SELECT * FROM `hearings` where id=?";
    $result = $conn->execute_query($query, [$id]);

    while ($row = $result->fetch_assoc()) {
        $data = $row;
    }
}

echo json_encode($data);

$conn->close();
