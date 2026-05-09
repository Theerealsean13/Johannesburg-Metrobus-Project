<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
try {
    $stmt = $pdo->query("SELECT * FROM routes WHERE status = 'active' ORDER BY route_name");
    $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
    'success' => true,
    'routes' => $routes
    ]);
} catch (Exception $e) {
    echo json_encode([
    'success' => false,
    'error' => 'Failed to fetch routes'
    ]);
}
?>