document.addEventListener("DOMContentLoaded", fetchFiles);

function fetchFiles() {
    fetch("upload.php?list=1")
        .then(response => response.json())
        .then(files => {
            const fileList = document.getElementById("fileList");
            fileList.innerHTML = "";

            files.forEach(file => {
                const li = document.createElement("li");

                // File Name
                const fileName = document.createElement("span");
                fileName.textContent = file;

                // View Button
                const viewBtn = document.createElement("button");
                viewBtn.textContent = "View";
                viewBtn.classList.add("view-btn");
                viewBtn.onclick = () => viewFile(file);

                // Download Button
                const downloadBtn = document.createElement("button");
                downloadBtn.textContent = "Download";
                downloadBtn.classList.add("download-btn");
                downloadBtn.onclick = () => downloadFile(file);

                const delbtn = document.createElement("button");
                delbtn.textContent = "Delete";
                delbtn.classList.add("delbtn");
                delbtn.onclick = () => deleteFile(file);

                // Append elements
                li.appendChild(fileName);
                li.appendChild(viewBtn);
                li.appendChild(downloadBtn);
                li.appendChild(delbtn);
                fileList.appendChild(li);
            });
        })
        .catch(error => console.error("Error fetching files:", error));
}

// Function to View File Inside the Page
function viewFile(file) {
    const previewArea = document.getElementById("previewArea");
    const ext = file.split('.').pop().toLowerCase();
    const fileUrl = `view.php?file=${encodeURIComponent(file)}`;

    if (["jpg", "jpeg", "png", "gif", "bmp", "svg", "webp"].includes(ext)) {
        previewArea.innerHTML = `<img src="${fileUrl}" alt="Image Preview" style="max-width:100%;">`;
    } else if (["pdf"].includes(ext)) {
        previewArea.innerHTML = `<iframe src="${fileUrl}" width="100%" height="500px"></iframe>`;
    } else if (["mp4", "webm", "avi", "mov", "mkv"].includes(ext)) {
        previewArea.innerHTML = `<video width="100%" controls><source src="${fileUrl}" type="video/${ext}"></video>`;
    } else if (["mp3", "wav", "ogg"].includes(ext)) {
        previewArea.innerHTML = `<audio controls><source src="${fileUrl}" type="audio/${ext}"></audio>`;
    } else if (isCodeFile(ext)) {
        fetch(fileUrl)
            .then(response => response.text())
            .then(code => {
                previewArea.innerHTML = `<pre><code class="language-${ext}">${escapeHtml(code)}</code></pre>`;
                Prism.highlightAll(); // Apply syntax highlighting
            });
    } else {
        previewArea.innerHTML = `<p>Cannot preview this file type.</p>`;
    }
}

// Function to Check if the File is a Code File
function isCodeFile(ext) {
    const codeExtensions = ["html", "css", "js", "php", "py", "java", "c", "cpp", "h", "cs", "swift", "kt", "dart", "json", "xml", "sql", "sh", "bat", "yaml", "yml", "toml", "ini", "pl", "rb", "go", "rs"];
    return codeExtensions.includes(ext);
}

// Function to Escape HTML Characters in Code Files
function escapeHtml(text) {
    return text.replace(/&/g, "&amp;")
               .replace(/</g, "&lt;")
               .replace(/>/g, "&gt;")
               .replace(/"/g, "&quot;")
               .replace(/'/g, "&#039;");
}

function uploadFile() {
    const fileInput = document.getElementById("fileInput");
    if (fileInput.files.length === 0) {
        alert("Please select a file to upload.");
        return;
    }

    const file = fileInput.files[0];
    const formData = new FormData();
    formData.append("file", file);

    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Show upload success/failure message
        fetchFiles(); // Refresh file list after upload
    })
    .catch(error => console.error("Error uploading file:", error));
}

function deleteFile(fileName) {
    if (confirm(`Are you sure you want to delete "${fileName}"?`)) {
        fetch(`delete.php?file=${encodeURIComponent(fileName)}`, {
            method: "GET"
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show deletion success/failure message
            fetchFiles(); // Refresh file list after deletion
        })
        .catch(error => console.error("Error deleting file:", error));
    }
}

// Function to Download File
function downloadFile(file) {
    window.location.href = `download.php?file=${encodeURIComponent(file)}`;
}