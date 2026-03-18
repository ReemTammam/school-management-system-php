<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isTeacher() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'teacher';
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: auth-login.php");
        exit();
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>