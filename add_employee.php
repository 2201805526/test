<?php
session_start();
if (!isset($_SESSION['EmployeeID'])) {
    header("Location: login.php");
    exit();
}

include "includes/db.php";
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
            <div class="show-message">

            </div>


            <div class="col" style="padding-right: 5px; padding-top: 25px;">
                <div class="w-110" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                    <div id="message">

                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">

                            <!-- Employee Tabs -->
                            <div class="bg-white p-3 text-end">
                                <ul class="nav nav-pills mb-1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn-secondary active" aria-selected="true">إضافة موظف</button>
                                    </li>

                                </ul>
                            </div>

                            <!-- Header Section -->
                            <div class="mb-5">
                                <p class="lead">ادخل بيانات الموظف في الحقول التالية</p>
                            </div>
                            <form action="employees.php" method="post" id="add_employeeForm" class="form-floating">
                                <div class="mb-1 mt-2">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" class="form-control" id="name" name="name">

                                </div>
                                <div class="mb-1">
                                    <label for="phone" class="form-label">الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-1">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-1">
                                    <label for="password" class="form-label">كلمة المرور</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="text-end" style="margin-top: 100px;">
                                    <button type="submit" class="btn btn-success ">تأكيد</button>
                                    <div class="btn btn-danger" id="cancel-btn"><a href="employees.php">إلغاء</a></div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>

    <script>
        $(document).ready(function() {
            getData();

            $('#add_employeeForm').submit(function(e) {
                e.preventDefault();

                let name = $('#name').val();
                let phone = $('#phone').val();
                let email = $('#email').val();
                let password = $('#password').val();

                if (name != "" & phone != "" & email != "" & password != "") {
                    $.ajax({
                        type: "POST",
                        url: "assets/ajax/add.php",
                        data: {
                            'checking_add': true,
                            'Name': name,
                            'PhoneNumber': phone,
                            'Email': email,
                            'Password': password,
                        },
                        success: function(response) {
                            // console.log(response)
                            $('#message').append('<div class="alert alert-success alert-dismissible fade show" role="alert">\
                                                تمت إضافة الموظف  بنجاح\
                                                <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"> </button>\
                                                </div>\
                                                ');
                            $("input").val('');                   
                        }
                    });
                } else {

                    console.log("Please Enter all fields");
                    $('#message').append('<div\
                                    class="alert alert-danger alert-dismissible fade show" role="alert">\
                                    تأكد من أن الحقول ليست فارغة \
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"> </button>\
                                    </div>\
                                    ');
                }

            })
        });

        function getData() {
            $.ajax({
                type: "GET",
                url: "assets/ajax/fetch.php",

                success: function(response) {

                    $.each(response, function(key, value) {

                        $('#employeeTable').append('<tr>' +
                            '<td>' + value['EmployeeID'] + '</td>\
                        <td> ' + value['Name'] + ' </td>\
                        <td> ' + value['Email'] + ' </td>\
                        <td> ' + value['PhoneNumber'] + ' </td>\
                        <td> ' + value['Role'] + ' </td>\
                        <td> ' + value['HireDate'] + ' </td>\
                        <td>\
                        <a href="employee_details.php?employeeID= ' + value['EmployeeID'] + '" class="btn btn-info btn-sm">عرض التفاصيل</a>\
                        </td>\
                        </tr>');
                    })
                }
            });
        }
    </script>
</body>

</html>