<?php

class Employee
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Employees";
        return $this->conn->query($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Employees WHERE EmployeeID = '$id'";
        return $this->conn->query($sql)->fetch_assoc();
    }

    public function create($name, $email, $phone, $password, $role)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Employees (Name, Email, PhoneNumber, Password, Role) VALUES ('$name', '$email', '$phone', '$password', '$role')";
        return $this->conn->query($sql);
    }

    public function update($id, $name, $email, $phone, $role)
    {
        $sql = "UPDATE Employees SET Name='$name', Email='$email', PhoneNumber='$phone', Role='$role' WHERE EmployeeID='$id'";
        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Employees WHERE EmployeeID='$id'";
        return $this->conn->query($sql);
    }
}
?>