<?php

// Define the directory where uploaded upl files will be stored
$uploadDir = 'uploads/';

// Check if the file was uploaded without errors
if ($_FILES['upl']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['upl']['tmp_name'];
    $originalFileName = $_FILES['upl']['name'];

    // Get the file extension
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);

    // Define the allowed file extensions
    $allowedExtensions = array('pdf', 'docx');

    // Check if the file extension is allowed
    if (in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique file name for the uploaded upl file
        $uniqueFilename = uniqid('upl_') . '.' . $fileExtension;
        $targetFile = $uploadDir . $uniqueFilename;

        // Move the temporary file to the target directory
        if (move_uploaded_file($tempFile, $targetFile)) {
            echo 'File uploaded successfully.';
        } else {
            echo 'Error uploading file.';
        }
    } else {
        echo 'Invalid file type. Only PDF and DOCX files are allowed.';
    }
} else {
    echo 'File upload error: ' . $_FILES['upl']['error'];
}

?>