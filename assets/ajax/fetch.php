<?php

$conn = mysqli_connect("localhost:5222", "root", "", "management_system");

$query = "SELECT * FROM Employees";
$query_run = mysqli_query($conn, $query);
$result_array = [];

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $row) {
        array_push($result_array, $row);
    }
    header('Content-type: application/json');
    echo json_encode($result_array);
} else {
    echo $return = "<h4>no record found</h4>";
}
