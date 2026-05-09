<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
try {
    $activities = [
        ['description' => 'New user registered', 'timestamp' => date('Y-m-d H:i:s', strtotime('-1 hour'))],
        ['description' => 'Route 1 status updated', 'timestamp' => date('Y-m-d H:i:s', strtotime('-2 hours'))],
        ['description' => 'Feedback submitted', 'timestamp' => date('Y-m-d H:i:s', strtotime('-3 hours'))],
        ['description' => 'Notice published', 'timestamp' => date('Y-m-d H:i:s', strtotime('-4 hours'))],
    ];
    echo json_encode([
        'success' => true,
        'activities' => $activities
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to fetch activities'
    ]);
}
?>