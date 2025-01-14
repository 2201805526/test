<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Employees WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['EmployeeID'] = $row['EmployeeID'];
            $_SESSION['Name'] = $row['Name'];
            $_SESSION['Role'] = $row['Role'];
            header("Location: employees.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
