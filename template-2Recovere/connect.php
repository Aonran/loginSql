<?php
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];

//database connection
$conn = new mysqli('localhost','root','','firstform','3306','21544');
if($conn->connect_error){
    die('connection Failed: '.$conn->connect_error);
}else{
    $stmt= $conn->prepare("INSERT INTO register(name,email,password) values (?,?,?)");

    // Check if the prepared statement was created successfully
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
        echo "You registered successfully";
    } else {
        echo "Registration failed: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();

    }
?>