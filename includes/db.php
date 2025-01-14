<?php
$servername = "localhost:5222";
$username = "root";
$password = "";
$dbname = "management_system";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Select the database
    $conn->select_db($dbname);

    // Create tables if they do not exist
    $createEmployeesTable = "CREATE TABLE IF NOT EXISTS Employees (
        EmployeeID INT AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(100) NOT NULL,
        Role ENUM('Regular', 'Supervisor') DEFAULT 'Regular',
        Email VARCHAR(100) UNIQUE,
        PhoneNumber VARCHAR(15),
        HireDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Password VARCHAR(255) NOT NULL
    )";

    $createStoresTable = "CREATE TABLE IF NOT EXISTS Stores (
        StoreID INT AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(100) NOT NULL,
        ContactNumber VARCHAR(15),
        OwnerName VARCHAR(100) NOT NULL,
        Address VARCHAR(255),
        CreatedBy INT NOT NULL,
        FOREIGN KEY (CreatedBy) REFERENCES Employees(EmployeeID)
    )";

    $createOrdersTable = "CREATE TABLE IF NOT EXISTS Orders (
        OrderID INT AUTO_INCREMENT PRIMARY KEY,
        StoreID INT,
        CustomerName VARCHAR(100) NOT NULL,
        CustomerPhone VARCHAR(15),
        Products TEXT,
        OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ProductsPrice DECIMAL(10, 2) CHECK (ProductsPrice >= 0),
        Status ENUM('Pending', 'Dispatched', 'Delivered', 'Cancelled') DEFAULT 'Pending',
        FOREIGN KEY (StoreID) REFERENCES Stores(StoreID)
    )";

    $createDriversTable = "CREATE TABLE IF NOT EXISTS Drivers (
        DriverID INT AUTO_INCREMENT PRIMARY KEY,
        Name VARCHAR(100) NOT NULL,
        LicenseNumber VARCHAR(50) UNIQUE,
        NationalID VARCHAR(50) UNIQUE,
        PhoneNumber VARCHAR(15),
        EmploymentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        LicenseExpiryDate DATE,
        DriverStatus ENUM('Active', 'No Active') DEFAULT 'Active'
    )";

    $createDeliveriesTable = "CREATE TABLE IF NOT EXISTS Deliveries (
        DeliveryID INT AUTO_INCREMENT PRIMARY KEY,
        OrderID INT NOT NULL,
        DriverID INT NOT NULL,
        DeliveryFee DECIMAL(10, 2) NOT NULL CHECK (DeliveryFee >= 0),
        DeliveryStatus ENUM('Assigned', 'In Transit', 'Delivered', 'Failed') DEFAULT 'Assigned',
        AssignedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        DeliveredAt TIMESTAMP NULL,
        FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
        FOREIGN KEY (DriverID) REFERENCES Drivers(DriverID)
    )";

    $createReportsTable = "CREATE TABLE IF NOT EXISTS Reports (
        ReportID INT AUTO_INCREMENT PRIMARY KEY,
        ReportDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ReportType ENUM('store report', 'mangament', 'Other') NOT NULL,
        ReportDetails TEXT,
        CreatedBy INT,
        ReportPeriod ENUM('Monthly', 'Yearly') NOT NULL,
        StoreID INT,
        FOREIGN KEY (StoreID) REFERENCES Stores(StoreID),
        FOREIGN KEY (CreatedBy) REFERENCES Employees(EmployeeID)
    )";

    // Execute table creation queries
    $conn->query($createEmployeesTable);
    $conn->query($createStoresTable);
    $conn->query($createOrdersTable);
    $conn->query($createDriversTable);
    $conn->query($createDeliveriesTable);
    $conn->query($createReportsTable);

} else {
    die("Error creating database: " . $conn->error);
}
