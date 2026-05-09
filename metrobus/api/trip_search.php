<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
if  ($_SERVER['REQUEST_METHOD'] !== 'GET') {
     echo json_encode(['success' => false, 'error' => 'Invalid request method']);
exit;
    }
    $from = trim($_GET['from'] ?? '');
    $to = trim($_GET['to'] ?? '');
if  (empty($from) || empty($to)) {
    echo json_encode(['success' => false, 'error' => 'From and to locations are required']);
exit;
    }

try {
    $trips = [
    [
    'route' => 'Route 1',
    'departure' => '08:00',
    'arrival' => '09:00',
    'duration' => '1h 0m',
    'fare' => 25.00,
    'transfers' => 0,
    'stops' => ['Sandton Station', 'Rosebank Mall', 'Johannesburg Station']
    ],
    [
    'route' => 'Route 2',
    'departure' => '08:30',
    'arrival' => '09:45',
    'duration' => '1h 15m',
    'fare' => 30.00,
    'transfers' => 1,
    'stops' => ['Rosebank Station', 'Midrand Station']
    ]
    ];
    echo json_encode([
    'success' => true,
    'trips' => $trips
    ]);
    } catch (Exception $e) {
    echo json_encode([
    'success' => false,
    'error' => 'Failed to search trips'
    ]);
}
?>