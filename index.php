<?php
$upload_dir = 'uploads/';
$files = array_diff(scandir($upload_dir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Gallery</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .gallery { display: flex; flex-wrap: wrap; justify-content: center; }
        .gallery div { margin: 10px; }
        img, video { max-width: 200px; max-height: 200px; display: block; }
    </style>
</head>
<body>
    <h2>Gallery</h2>
    <div class="gallery">
        <?php foreach ($files as $file): ?>
            <div>
                <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)): ?>
                    <img src="<?= $upload_dir . $file ?>" alt="Image">
                <?php elseif (preg_match('/\.(mp4|webm|ogg)$/i', $file)): ?>
                    <video controls>
                        <source src="<?= $upload_dir . $file ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php endif; ?>
                <p><a href="<?= $upload_dir . $file ?>" download><?= $file ?></a></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
