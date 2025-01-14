<?php


include "includes/db.php";
session_start();
if (!isset($_SESSION['EmployeeID'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['employeeID'])) {
    $EmployeeID = $_GET['employeeID'];
    $sql = "SELECT * FROM Employees WHERE EmployeeID = '$EmployeeID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $Employee = $result->fetch_assoc();
    } else {
        echo "<div class='text-center alert alert-danger'>لم يتم العثور على الموظف</div>";
        exit();
    }
} else {
    echo "<div class='text-center alert alert-danger'>رقم الموظف غير موجود</div>";
    exit();
}



include "includes/header.php";
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a,
        a:hover {
            text-decoration: none;
            color: white;
        }
    </style>
    <script src="assets/js/jquery-3.7.1.min.js"></script>


</head>

<body>
    <div class="container-fluid" dir="rtl">
        <div class="row">
            <div class="col-auto">
                <?php include "includes/sidebar.php"; ?>
            </div>
            <div id="message">

            </div>
            <div class="col" style="padding-right: 5px; padding-top: 25px;">
                <div class="w-110" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="employee_details.php?employeeID=<?php echo $EmployeeID; ?>" class="btn btn-secondary btn-sm mb-3">← العودة</a>
                            <h5 class="card-title">تعديل الموظف</h5>
                            <form id="updateEmployeeForm" action="">
                                <div class="mb-3">
                                    <label hidden for="name" class="form-label">رقم الموظف</label>
                                    <input hidden type="text" class="form-control" id="id" name="id" value="<?php echo $EmployeeID; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $Employee['Name'];  ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $Employee['Email']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $Employee['PhoneNumber']; ?>" required>
                                </div>
                                <div class="mb-10">
                                    <label for="role" class="form-label">الصلاحيات</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="Regular" <?php if ($Employee['Role'] == 'Regular') echo 'selected'; ?>>Regular</option>
                                        <option value="Supervisor" <?php if ($Employee['Role'] == 'Supervisor') echo 'selected'; ?>>Supervisor</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success btn-shadow mt-5" id="editButton" value="حفظ التعديلات">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>

<script>
    $(document).ready(function() {
        $("#updateEmployeeForm").submit(function(e) {
            e.preventDefault();
            let id = $("#id").val();
            let name = $("#name").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let role = $("#role").val();

           
                $.ajax({
                        method: "POST",
                        url: "update_employee_json_API.php",
                        dataType: "json",
                        data: {
                            'employeeID': id,
                            'name': name,
                            'email': email,
                            'phone': phone,
                            'role': role,
                        },
                    })
                    .done(function(data) {
                        if (data.message == 'success') {
                            $("#message").append('<div class="alert alert-success alert-dismissible fade show" role="alert">\
                                                تمت تعديل بيانات الموظف  بنجاح\
                                                <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"> </button>\
                                                </div>\
                                                ');
                        } else {
                            alert(data.message);
                        }

                    })
                    .fail(function(e) {
                        alert(" ERROR ");
                    });
        });
    });
</script>

</html>