<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $filepath = "files/" . $file;

    if (file_exists($filepath)) {
        $mime = mime_content_type($filepath);
        
        // Allow previewing of text and code files as plain text
        $text_extensions = ["txt", "log", "md", "html", "css", "js", "php", "py", "java", "c", "cpp", "h", "cs", "swift", "kt", "dart", "json", "xml", "sql", "sh", "bat", "yaml", "yml", "toml", "ini", "pl", "rb", "go", "rs"];
        $ext = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

        if (in_array($ext, $text_extensions)) {
            header("Content-Type: text/plain");
        } else {
            header("Content-Type: $mime");
        }

        readfile($filepath);
    } else {
        echo "File not found!";
    }
}
?>
