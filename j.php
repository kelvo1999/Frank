<?php
$upload_dir = 'uploads/';
$files = array_diff(scandir($upload_dir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Upload</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .gallery { display: flex; flex-wrap: wrap; justify-content: center; }
        .gallery div { margin: 10px; }
        img, video { max-width: 200px; max-height: 200px; display: block; }
    </style>
</head>
<body>
    <h2>Upload Files</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
    
    <div class="container-fluid pt-5" id="service">
        <div class="container">
            <div class="service-h4 position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Service</h1>
                <h1 class="position-absolute text-uppercase text-primary">My Services</h1>
            </div>
            <div class="row pb-3">
                <?php foreach ($files as $file): ?>
                    <div class="service-box col-lg-4 col-md-6 text-center mb-5">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)): ?>
                                <img src="<?= $upload_dir . $file ?>" alt="Uploaded Image">
                            <?php elseif (preg_match('/\.(mp4|webm|ogg)$/i', $file)): ?>
                                <video controls>
                                    <source src="<?= $upload_dir . $file ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                        <p><a href="<?= $upload_dir . $file ?>" download><?= $file ?></a></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>