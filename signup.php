<?php
include 'auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (registerUser($email, $password, $conn)) {
        echo "<p style='color:green;'>Account created successfully! <a href='index.php'>Login here</a></p>";
    } else {
        echo "<p style='color:red;'>Error: Email might already be in use!</p>";
    }
}
?>

<h2>Sign Up</h2>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Sign Up</button>
</form>

<p>Already have an account? <a href="index.php"><button>Login</button></a></p>
