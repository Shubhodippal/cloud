<?php
if (isset($_GET["file"])) {
    $fileName = $_GET["file"];
    $filePath = "files/" . $fileName;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "File deleted successfully!";
        } else {
            echo "Error deleting file!";
        }
    } else {
        echo "File not found!";
    }
} else {
    echo "No file specified!";
}
?>















