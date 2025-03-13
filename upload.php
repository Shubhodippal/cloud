
// File upload (upload.php)
<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$target_dir = "uploads/" . $_SESSION['username'] . "/";
$target_file = $target_dir . basename($_FILES['file']['name']);
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
    $conn->query("INSERT INTO files (user_id, file_path) VALUES ('{$_SESSION['user_id']}', '$target_file')");
}
header('Location: index.php');
?>

