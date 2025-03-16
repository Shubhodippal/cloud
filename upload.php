<?php
$uploadDir = "files/";

// Ensure the upload directory exists
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle File Upload
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $fileName = basename($_FILES["file"]["name"]);
    
    // Sanitize the file name to prevent security risks
    $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);
    
    // Prevent overwriting by appending a timestamp if the file exists
    $targetFile = $uploadDir . $fileName;
    if (file_exists($targetFile)) {
        $fileName = time() . "_" . $fileName;
        $targetFile = $uploadDir . $fileName;
    }

    // Optional: Limit file size (e.g., max 50MB)
    if ($_FILES["file"]["size"] > 50 * 1024 * 1024) {
        echo "File size exceeds the 50MB limit.";
        exit;
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "File uploaded successfully!";
    } else {
        echo "Failed to upload file.";
    }
    exit;
}

// Serve files for viewing
if (isset($_GET["view"])) {
    $file = $uploadDir . basename($_GET["view"]);

    if (file_exists($file)) {
        $mimeType = mime_content_type($file);
        header("Content-Type: $mimeType");
        readfile($file);
        exit;
    } else {
        echo "File not found.";
        exit;
    }
}

// Handle File Listing
if (isset($_GET["list"])) {
    $files = array_diff(scandir($uploadDir), array('.', '..'));
    echo json_encode(array_values($files));
    exit;
}
?>
