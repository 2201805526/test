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
    echo "<div class='text-center alert alert-danger'>رقم الموظف غير موجود</div>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>

    <div class="container-fluid" dir="rtl">
        <div class="row">
            <div class="col-auto">
                <?php include "includes/sidebar.php"; ?>
            </div>
            <div class="col" style="padding-right: 5px; padding-top: 25px;">
                <div class="w-110" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="employees.php" class="btn btn-secondary btn-sm mb-5">← العودة</a>
                            <h5 class="card-title">تفاصيل الموظف</h5>
                            <div id="viewData">
                                <p><strong>الاسم:</strong> <?php echo $employee['Name']; ?></p>
                                <p><strong>البريد الإلكتروني:</strong> <?php echo $employee['Email']; ?></p>
                                <p><strong>الهاتف:</strong> <?php echo $employee['PhoneNumber']; ?></p>
                                <p><strong>الدور:</strong> <?php echo $employee['Role']; ?></p>
                                <p><strong>تاريخ التوظيف:</strong> <?php echo $employee['HireDate']; ?></p>
                            </div>
                            <div style="margin-top: 150px;">
                                <a href="update_employee.php?employeeID=<?php echo $employee['EmployeeID']; ?>" class="btn btn-warning btn-sm">تعديل</a>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $employee['EmployeeID']; ?>)">حذف</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(employeeID) {
            if (confirm('هل أنت متأكد أنك تريد حذف هذا الموظف؟')) {
                window.location.href = 'delete_employee.php?employeeID=' + employeeID;
            }
        }

        $(document).ready(function() {
            getData();

        });

        function getData() {
            $.ajax({
                type: "GET",
                url: "assets/ajax/fetch_details.php",

                success: function(response) {

                }
            });
        }
    </script>

    <?php include "includes/footer.php"; ?>
</body>

</html>