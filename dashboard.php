// File listing and download (dashboard.php)
<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$files = $conn->query("SELECT * FROM files WHERE user_id = '{$_SESSION['user_id']}'");
?>
<!DOCTYPE html>
<html>
<body>
<h1>Welcome, <?= $_SESSION['username'] ?></h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit">Upload</button>
</form>
<h2>Your Files:</h2>
<ul>
    <?php while ($file = $files->fetch_assoc()): ?>
        <li><a href="<?= $file['file_path'] ?>" download><?= basename($file['file_path']) ?></a></li>
    <?php endwhile; ?>
</ul>
<a href="logout.php">Logout</a>
</body>
</html>
