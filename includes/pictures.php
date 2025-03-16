<?php
include '../includes/config.php';

// Fetch 24 cat images dynamically from the API
$catImagesData = json_decode(file_get_contents(CAT_API_URL . "?limit=10"), true);

// Default placeholder if API fails
if (!$catImagesData) {
    $catImagesData = array_fill(0, 10, ['url' => 'https://via.placeholder.com/400']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../includes/header.php'; ?>
    <title>Cat Pictures</title>
    <style>
        .gallery-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }
        .gallery-img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center mb-4">Cat Gallery</h2>
        <p class="text-center mb-4">Refresh for new cat pics!</p>
        <div class="row mt-5">
            <?php foreach ($catImagesData as $index => $cat): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <img src="<?= htmlspecialchars($cat['url']) ?>" alt="Cat Image" class="gallery-img w-100">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
