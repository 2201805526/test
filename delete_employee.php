<?php

session_start();
if (!isset($_SESSION['EmployeeID'])) {
    header("Location: login.php");
    exit();
}

include "includes/header.php";
include "includes/db.php";



if (isset($_GET['employeeID'])) {
    $employeeID = $_GET['employeeID'];
    $sql = "SELECT * FROM Employees WHERE EmployeeID = '$employeeID'";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "<div class='text-center alert alert-danger'>لم يتم العثور على الموظف</div>";
        exit();
    }
    
} else {
    echo "<div class='text-center alert alert-danger'>رقم الموظف #$employeeID غير موجود</div>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employeeID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $sql = "DELETE FROM Employees WHERE EmployeeID='$employeeID'";

    try {
        if ($conn->query($sql) === TRUE) {
            echo "<div class='text-center alert alert-success'>تم حذف الموظف #$employeeID بنجاح</div>";
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        echo "<div class='text-center alert alert-danger'>خطأ: " . $e->getMessage() . "</div>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container-fluid" dir="rtl">
        <div class="row">
            <div class="col-auto">
                <?php include "includes/sidebar.php"; ?>
            </div>
            <div class="col" style="padding-right: 10px; padding-top: 25px;">
                <div class="w-110" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
                    
                </div>
            </div>
        </div>
    </div>

</body>

</html>



<?php
include "includes/footer.php"; ?>