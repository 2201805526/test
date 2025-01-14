<?php

$conn = mysqli_connect("localhost:5222", "root", "", "management_system");

if (isset($_POST['checking_add'])) {
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $query = "INSERT INTO employees (Name, PhoneNumber, Email, Password) VALUES ('$name', '$phone', '$email', '$password'); ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo $return = "Successfully stored";
    }else{
        echo $return = "Something went wrong";
    }
}