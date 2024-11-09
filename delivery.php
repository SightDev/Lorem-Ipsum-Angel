<?php
// Check if the form is submitted and if the file is uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    // Get the file details
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Set the upload directory (make sure this directory is writable)
    $upload_dir = 'uploads/';  // Path inside the htdocs folder

    // Check if the upload directory exists, and create it if it doesn't
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);  // Create the uploads folder with proper permissions
    }

    // Generate a unique file name to avoid name conflicts
    $file_path = $upload_dir . basename($file_name);

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file_tmp, $file_path)) {
        echo "File uploaded successfully!";
    } else {
        echo "Failed to upload file.";
    }
} else {
    echo "No file uploaded.";
}
?>
