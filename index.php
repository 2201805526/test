<?php
session_start();
if (!isset($_SESSION['EmployeeID'])) {
    header("Location: login.php");
    exit();
} else {
    header("Location: employees.php");
    exit();
}
?>