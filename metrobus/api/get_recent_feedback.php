<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
try {
    $stmt = $pdo->query("SELECT name, rating, category, message, created_at FROM feedback ORDER BY created_at DESC LIMIT 5");
    $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        'success' => true,
        'feedback' => $feedback
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch feedback'
    ]);
}
?>