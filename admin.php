<?php
session_start();

// Set a simple access password (change this!)
$access_password = "admin123";
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === $access_password) {
            $_SESSION['logged_in'] = true;
        } else {
            echo "<script>alert('Wrong password!');</script>";
        }
    }
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo '<form method="POST"><input type="password" name="password" placeholder="Enter Password"><button type="submit">Login</button></form>';
        exit;
    }
}

$upload_dir = 'uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/webm', 'video/ogg'];
    if (in_array($file['type'], $allowed_types) && $file['size'] < 50000000) {
        $target_file = $upload_dir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo "<script>alert('Upload successful!');</script>";
        } else {
            echo "<script>alert('Upload failed!');</script>";
        }
    } else {
        echo "<script>alert('Invalid file type or size too large!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload</title>
</head>
<body>
    <h2>Upload Files</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
    <h3>Uploaded Files:</h3>
    <ul>
        <?php
        $files = array_diff(scandir($upload_dir), ['.', '..']);
        foreach ($files as $file) {
            echo "<li><a href='$upload_dir$file'>$file</a></li>";
        }
        ?>
    </ul>
</body>
</html>
