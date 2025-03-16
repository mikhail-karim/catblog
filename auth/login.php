<?php
include '../includes/config.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? ''; // Fix: Prevent undefined key
    $password = $_POST['password'] ?? ''; // Fix: Prevent undefined key

    if (!empty($username) && !empty($password)) {
        $url = DUMMY_AUTH_URL . '/filter?key=username&value=' . urlencode($username);
        $response = file_get_contents($url);

        if ($response === false) {
            die("Error fetching user data.");
        }

        $users = json_decode($response, true)['users'] ?? [];

        if (!empty($users)) {
            $user = $users[0]; // Assume only one user matches
            if ($password === $user['password']) { // DummyJSON does not hash passwords
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'image' => $user['image'],
                    'role' => $user['role']
                ];
                header('Location: ../index.php');
                exit();
            }
        }

        $error = 'Invalid username or password.';
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>

<form method="POST" class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 p-4 shadow-lg rounded bg-light">
                <h3 class="text-center mb-4">Login</h3>

                <div class="form-outline mb-3">
                    <input type="text" id="user" name="username" class="form-control" required /> <!-- Fix: Add name -->
                    <label class="form-label" for="user">Username</label>
                </div>

                <div class="form-outline mb-3">
                    <input type="password" id="pass" name="password" class="form-control" required /> <!-- Fix: Add name -->
                    <label class="form-label" for="pass">Password</label>
                </div>

                <div class="form-check d-flex align-items-center mb-3 ms-4">
                    <input class="form-check-input me-2" type="checkbox" id="remember" checked />
                    <label class="form-check-label" for="remember"> Remember me </label>
                </div>

                <div class="text-center mb-3">
                    <a href="#!">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary btn-block w-100 mb-3">Sign in</button>

                <div class="text-center">
                    <p>Not a member? <a href="#!">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</form>

<?php if (isset($error)) echo '<p class="text-danger text-center mt-3">' . $error . '</p>'; ?>

<?php include '../includes/footer.php'; ?>
