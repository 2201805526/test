<?php

class EmployeeController
{
    private $employeeModel;

    public function __construct($db)
    {
        include_once '../app/models/Employee.php';
        $this->employeeModel = new Employee($db);
    }

    public function index()
    {
        $employees = $this->employeeModel->getAll();
        include '../app/views/employees/index.php';
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $role = 'Regular';

            if ($this->employeeModel->create($name, $email, $phone, $password, $role)) {
                header("Location: /employees");
            } else {
                echo "Error: Could not create employee.";
            }
        } else {
            include '../app/views/employees/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];

            if ($this->employeeModel->update($id, $name, $email, $phone, $role)) {
                header("Location: /employees");
            } else {
                echo "Error: Could not update employee.";
            }
        } else {
            $employee = $this->employeeModel->getById($id);
            include '../app/views/employees/edit.php';
        }
    }

    public function details($id)
    {
        $employee = $this->employeeModel->getById($id);
        include '../app/views/employees/details.php';
    }

    public function delete($id)
    {
        if ($this->employeeModel->delete($id)) {
            header("Location: /employees");
        } else {
            echo "Error: Could not delete employee.";
        }
    }
}
?>