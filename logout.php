
// Logout (logout.php)
<?php
session_start();
session_destroy();
header('Location: login.php');
?>

/* SQL Database Structure
CREATE DATABASE file_manager;
USE file_manager;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);
CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_path VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
*/
