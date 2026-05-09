<?php
session_start();
require_once __DIR__ . '/db.php';
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
   }
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
   }
function isLoggedIn() {
    return isset($_SESSION['user_id']);
   }
function getCurrentUser() {
    if (!isLoggedIn()) return null;
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
   }
function loginUser($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
if ($user && verifyPassword($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    return true;
    }
    return false;
   }
function logoutUser() {
    session_destroy();
   }
function registerUser($name, $email, $password) {
    global $pdo;
    $hashedPassword = hashPassword($password);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPassword]);
   }
function isAdmin() {
    $user = getCurrentUser();
    return $user && $user['role'] === 'admin';
   }
?>