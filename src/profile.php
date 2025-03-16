<?php
include '../includes/config.php';
include '../includes/header.php';

// Fetch user data (change '1' to a dynamic ID if needed)
$userData = json_decode(file_get_contents('https://dummyjson.com/users/1'), true);

// Fetch random profile image
$randomProfile = json_decode(file_get_contents('https://randomuser.me/api/'), true);
$profilePic = $randomProfile['results'][0]['picture']['large'] ?? 'https://via.placeholder.com/150';

if (!$userData) {
    die("Error fetching user data.");
}
?>

<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-9 col-xl-8">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                        <img src="<?= $profilePic ?>" alt="Profile picture" class="img-fluid img-thumbnail mt-4 mb-2"
                            style="width: 150px; z-index: 1">
                        <button type="button" class="btn btn-outline-dark text-body" style="z-index: 1;">
                            Edit profile
                        </button>
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                        <h5><?= htmlspecialchars($userData['firstName'] . ' ' . $userData['lastName']) ?></h5>
                        <p><?= htmlspecialchars($userData['email']) ?></p>
                        </div>
                    </div>
                    <div class="p-4 text-black bg-body-tertiary">
                        <div class="d-flex justify-content-end text-center py-1 text-body">
                        <div>
                            <p class="mb-1 h5">253</p>
                            <p class="small text-muted mb-0">Photos</p>
                        </div>
                        <div class="px-3">
                            <p class="mb-1 h5">1026</p>
                            <p class="small text-muted mb-0">Subscribers</p>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="mb-5 text-body">
                        <p class="lead fw-normal mb-1">About</p>
                        <div class="p-4 bg-body-tertiary">
                            <p class="font-italic mb-1">Username: <?= htmlspecialchars($userData['username']) ?></p>
                            <p class="font-italic mb-1">Birth Date: <?= htmlspecialchars($userData['birthDate']) ?></p>
                            <p class="font-italic mb-1">First Name: <?= htmlspecialchars($userData['firstName']) ?></p>
                            <p class="font-italic mb-1">Last Name: <?= htmlspecialchars($userData['lastName']) ?></p>
                            <p class="font-italic mb-1">Email: <?= htmlspecialchars($userData['email']) ?></p>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
