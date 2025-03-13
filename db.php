// Database connection (db.php)
<?php
session_start();
$conn = new mysqli('localhost', 'username', 'password', 'file_manager');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
