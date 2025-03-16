<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cat Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<style>
    #nav {
        margin-bottom: 480px;
    };
    #content {
        margin-top: 200px;
    };
</style>
<body class="homepage">
    <nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
        <div class="container-fluid">
                <div class="row justify-content-between align-items-center w-100">
                    <div class="col-auto">
                        <a class="navbar-brand text-white" href="index.html">
                            <img height="45" viewBox="0 0 112 45" src="../src/logo-min.png"></img>
                        </a>
                    </div>
                    
                    <div class="col-auto justify-content-start">
                        <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1 gap-md-5 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" href="../#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../includes/pictures.php">Pictures</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../includes/facts.php">Facts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../includes/about.php">About</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>

                <div class="col-3 col-lg-auto align-items-end ps-3">
                    <ul class="navbar-nav justify-content-end flex-grow-1 gap-md-2 ps-3">
                        <?php if (!isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <a href="/auth/login.php" class="text-uppercase mx-3">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="/auth/register.php" class="text-uppercase mx-3">Sign Up</a>
                            </li>
                        <?php else: ?>
                            <li class="d-none d-lg-block nav-item dropdown ps-3">
                            <a class="nav-link dropdown-toggle active" href="#" id="dropdownHome" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">My Account</a>
                                <ul class="dropdown-menu list-unstyled" aria-labelledby="dropdownHome">
                                    <li>
                                        <a href="/src/profile.php" class="dropdown-item item-anchor">My Details</a>
                                    </li>
                                    <li>
                                        <a href="/auth/logout.php" class="dropdown-item item-anchor">Log Out</a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">