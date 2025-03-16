<?php
include '../includes/config.php';
include '../includes/header.php';

// Fetch data from APIs
$catImageData = json_decode(file_get_contents(CAT_API_URL), true);
$catFactData = json_decode(file_get_contents(CAT_FACT_URL), true);

$catImage = $catImageData[0]['url'] ?? 'https://via.placeholder.com/400';
$catFact = $catFactData['fact'] ?? 'No fact available at the moment.';
?>

<div class="container text-center">
    <h2>Random Cat</h2>
    <img src="<?php echo htmlspecialchars($catImage); ?>" alt="Random Cat" class="img-fluid rounded">
    <p class="mt-3"><?php echo htmlspecialchars($catFact); ?></p>
    <a href="get_cat.php" class="btn btn-primary">Get Another Cat</a>
</div>

<?php include '../includes/footer.php'; ?>
