<?php
header('Content-Type: application/json');
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit;
}
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);
$category = trim($_POST['category'] ?? '');
$message = trim($_POST['message'] ?? '');
$anonymous = isset($_POST['anonymous']) && $_POST['anonymous'] === 'true';

if  (empty($name) || empty($email) || empty($category) || empty($message) || $rating < 1 || $rating > 5) {
     echo json_encode(['success' => false, 'error' => 'All fields are required']);
exit;
    }

if  (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     echo json_encode(['success' => false, 'error' => 'Invalid email address']);
exit;
    }

try {
    $stmt = $pdo->prepare("INSERT INTO feedback (name, email, rating, category, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$anonymous ? 'Anonymous' : $name, $anonymous ? '' : $email, $rating, $category, $message]);
    echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully']);
    } catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Failed to submit feedback']);
    }
?>