<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = 'koushiksiripuram';
$db = 'blog';
$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    echo $conn->connect_error;
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password === $confirm_password) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $res = $conn->query($query);

            if ($res->num_rows > 0) {
                echo "Username already exists";
            } else {
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                $conn->query($query);
                echo "Registration successful";
                header("Location: login.php");
            }
        } else {
            echo "Passwords do not match";
        }
    }
}
?>

<form method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" required><br><br>
    <input type="submit" name="submit" value="Register">
</form>