<?php
session_start();
if (!isset($_SESSION['EmployeeID'])) {
    header("Location: login.php");
    exit();
}

include "includes/header.php";/*
include "includes/db.php";
*/
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn-shadow {
            background-color: #f8f9fa;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        a,
        a:hover {
            text-decoration: none;
            color: white;
        }

        #addButton {
            margin-top: 75px;
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
            <div class="col" style="padding-right: 5px; padding-top: 25px;">
                <div class="w-110" style="max-width: 1200px; margin-left: auto; margin-right: auto;">
                <div id="message">

                </div>
                    <!-- Header Section -->
                    <div class="header-section mb-4">
                        <h1 class="display-4 text-primary">إدارة الموظفين</h1>
                        <!-- <p class="lead">إدارة الموظفين بسهولة. أضف موظفين جدد أو اعرض جميع الموظفين الحاليين.</p> -->
                    </div>

                    <!-- Employee Tabs -->
                    <div class="bg-white p-3 text-end">
                        <ul class="nav nav-pills mb-4" id="employeeTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-shadow" id="view-employees-tab" data-bs-toggle="tab" data-bs-target="#view-employees" type="button" role="tab" aria-controls="view-employees" aria-selected="true">عرض جميع الموظفين</button>
                            </li>

                        </ul>
                    </div>

                    <div class="tab-content" id="employeeTabContent">


                        <!-- View Employees Table -->
                        <div class="tab-pane fade" id="view-employees" role="tabpanel" aria-labelledby="view-employees-tab">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">قائمة الموظفين</h5>
                                    <table class="table table-bordered table-hover table-responsive-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">رقم الموظف</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الإلكتروني</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col">الصلاحيات</th>
                                                <th scope="col">تاريخ التوظيف</th>
                                                <th scope="col">إجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody id="employeeTable">



                                        </tbody>
                                    </table>

                                    <div class="text-end" id="addButton">
                                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#add_employeeForm"><a href="add_employee.php">إضافة موظف</a> </button>
                                    </div>
                                </div>
                            </div>
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
                        <a href="employee_details.php?employeeID=' + value['EmployeeID'] + '" class="btn btn-info btn-sm">عرض البيانات</a>\
                        </td>\
                        </tr>');
                    })
                }
            });
        }
    </script>

</body>

</html>