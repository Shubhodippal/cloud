<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
    <link rel="stylesheet" href="style.css">

    <!-- Prism.js for Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <style>
        .file-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 files per row */
            gap: 20px;
            padding: 20px;
            justify-content: center;
            align-items: center;
        }

        /* Individual file item */
        .fileList {
            background-color: rgba(255, 255, 255, 0.15); /* Transparent for theme consistency */
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(5px); /* Soft blur effect */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* File Name */
        /* Buttons for viewing & downloading */
        .fileList .button {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .fileList button {
            flex: 1;
            margin: 0 5px;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION["user"]; ?>!</h1>

    <div class="container">
        <h2>Upload and Download Files</h2>
        <input type="file" id="fileInput">
        <button onclick="uploadFile()">Upload</button>

        <h3>Uploaded Files</h3>
        <ul id="fileList" class="file-grid"></ul>

        <!-- File Preview Section -->
        <div id="previewArea" class="preview"></div>
    </div>

    <a href="logout.php">Logout</a>

    <script src="script.js"></script>

    <!-- Prism.js for Syntax Highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-java.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-c.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-cpp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
</body>
</html>
