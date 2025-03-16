<?php
session_start();

// Check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['user']);
}

// Get the logged-in user data
function getUser() {
    return $_SESSION['user'] ?? null;
}

// Redirect if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /auth/login.php');
        exit();
    }
}