<?php 
include 'includes/config.php';
include 'includes/header.php';

$catImagesData = json_decode(file_get_contents(CAT_API_URL . "?limit=3"), true);
$catFactsData = [];

// Fetch multiple cat facts
for ($i = 0; $i < 3; $i++) {
    $catFactsData[] = json_decode(file_get_contents(CAT_FACT_URL), true)['fact'] ?? 'No fact available.';
}

// Ensure only 6 images are used, fallback to a placeholder if empty
$catImages = !empty($catImagesData) ? array_slice($catImagesData, 0, 3) : [['url' => 'https://via.placeholder.com/400']];

?>
    <div id="content" class="text-center mt-5">
        <img src="../src/logo.png" height="384">
        <h1>Welcome to the Cat Blog!</h1>
        <p>hooman's favorite place for all the cat facts and pictures.</p>
        <div class="row mt-5">
            <div class="align-items-center">
                <div class="row">
                <?php foreach ($catImages as $index => $image) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($image['url']); ?>" class="card-img-top" alt="Random Cat">
                            <div class="card-body">
                                <p class="card-text"><?php echo htmlspecialchars($catFactsData[$index] ?? 'No fact available.'); ?></p>
                                <!-- <a href="read.php?id=<?php // echo $index; ?>" class="btn btn-primary">Read More</a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>