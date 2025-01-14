<?php

    $response = array(
        "message" => "",
        "employeeID" => "",
        "error" => ""
    );

include 'includes/db.php';

    $id = $_POST['employeeID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    try {
        $query = "UPDATE employees SET Name = $name, PhoneNumber = $phone, Role = $role, Email = $email WHERE EmployeeID = $id;";

        $stmt = $conn->prepare($query); /*
        $stmt->bind_param(':employeeID', $_POST['id']);
        $stmt->bind_param(':name', $_POST['name']);
        $stmt->bind_param(':email', $_POST['email']);
        $stmt->bind_param(':phone', $_POST['phoneNumber']);
        $stmt->bind_param(':role', $_POST['role']); */

        $stmt->execute();

        if ($stmt->num_rows() > 0) {
            $response['message'] = 'success';
            $response['employeeID'] = $_POST['id'];
        } else {
            $response["message"] = "no records have been updated";
        }
    } catch (Exception $ex) {
        $response['error'] = $ex->getMessage();
    }

echo json_encode($response);
