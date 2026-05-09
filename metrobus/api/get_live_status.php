<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
try {
    $stmt = $pdo->query("SELECT ls.*, r.route_name FROM live_status ls JOIN routes r ON ls.route_id = r.id ORDER BY ls.updated_at DESC");
    $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
    'success' => true,
    'statuses' => $statuses
    ]);
} catch (Exception $e) {
    echo json_encode([
    'success' => false,
    'error' => 'Failed to fetch live status'
    ]);
}
?>