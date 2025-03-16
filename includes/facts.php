<?php
include '../includes/config.php';
include '../includes/header.php';

$catImagesData = json_decode(file_get_contents(CAT_API_URL . "?limit=4"), true);
$catFactsData = [];

// Fetch multiple cat facts
for ($i = 0; $i < 4; $i++) {
    $catFactsData[] = json_decode(file_get_contents(CAT_FACT_URL), true)['fact'] ?? 'No fact available.';
}

// Ensure only 12 images are used, fallback to a placeholder if empty
$catImages = !empty($catImagesData) ? array_slice($catImagesData, 0, 4) : array_fill(0, 4, ['url' => 'https://via.placeholder.com/400']);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Cat Facts</h2>
    <div class="row g-4">
        <?php foreach ($catImages as $index => $cat): ?>
            <div class="col-md-3">
                <div class="card post-card position-relative overflow-hidden">
                    <img src="<?= $cat['url'] ?>" class="card-img-top" alt="Cat Image">
                    <div class="card-body">
                        <p class="card-text">"<?= $catFactsData[$index] ?>"</p>
                    </div>
                    <div class="overlay d-flex flex-column align-items-center justify-content-center">
                        <button class="btn mb-2" data-bs-toggle="modal" data-bs-target="#editModal" 
                            data-img="<?= $cat['url'] ?>" data-fact="<?= htmlspecialchars($catFactsData[$index]) ?>">Edit</button>
                        <button class="btn" onclick="deletePost()">Delete</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" id="editImage">
                    </div>
                    <div class="mb-3">
                        <label for="editFact" class="form-label">Edit Fact</label>
                        <textarea class="form-control" id="editFact" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var image = button.getAttribute('data-img');
            var fact = button.getAttribute('data-fact');

            document.getElementById('editFact').value = fact;
        });

        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert("Changes saved successfully!");
            var modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            modal.hide();
        });
    });

    function deletePost() {
        if (confirm("Are you sure you want to delete this post?")) {
            alert("Post deleted successfully!");
            window.location.reload();
        }
    }
</script>

<style>
    .post-card {
        position: relative;
        transition: transform 0.3s ease-in-out;
    }
    .post-card:hover {
        transform: scale(1.05);
    }
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    .post-card:hover .overlay {
        opacity: 1;
    }
</style>

<?php include '../includes/footer.php'; ?>