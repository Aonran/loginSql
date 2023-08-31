<?php
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'firstform', 3306);

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("SELECT * FROM register WHERE email=?");

    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['password'] === $password) {
            echo "<h2>You've logged in successfully</h2>";
        } else {
            echo "<h2>Invalid email or password</h2>";
        }
    } else {
        echo "<h2>Invalid email or password</h2>";
    }

    $stmt->close();
    $conn->close();
}
?>
