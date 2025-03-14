GNU nano 5.4                                                                                       download.php                                                                                                <?php
$uploadDir = "/var/www/html/files/";

if (!isset($_GET["file"])) {
    die("No file specified.");
}

$fileName = basename($_GET["file"]); // Prevent directory traversal
$filePath = $uploadDir . $fileName;

if (!file_exists($filePath)) {
    die("File not found.");
}

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Length: " . filesize($filePath));
readfile($filePath);
exit;
?>
