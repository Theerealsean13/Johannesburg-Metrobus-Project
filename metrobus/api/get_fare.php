<?php
header('Content-Type: application/json');
require_once '../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
      }
      $routeId = (int)($_GET['route_id'] ?? 0);
      $passengerType = trim($_GET['passenger_type'] ?? '');
if   (!$routeId || !in_array($passengerType, ['adult', 'student', 'pensioner', 'child'])) {
      echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
      exit;
      }

try   {
      $stmt = $pdo->prepare("SELECT * FROM fares WHERE route_id = ?");
      $stmt->execute([$routeId]);
      $fare = $stmt->fetch(PDO::FETCH_ASSOC);
if   (!$fare) {
      echo json_encode(['success' => false, 'error' => 'Fare not found']);
      exit;
      }
      $baseFare = $fare['price'];
      $discount = '';
      $finalFare = $baseFare;
switch ($passengerType) {
case 'student':
      $finalFare = $baseFare * 0.8;
      $discount = '20% student discount applied';
break;
case  'pensioner':
      $finalFare = $baseFare * 0.5;
      $discount = '50% pensioner discount applied';
break;
case  'child':
      $finalFare = 0;
      $discount = 'Free for children under 12';
break;
      }

      echo json_encode([
      'success' => true,
      'fare' => round($finalFare, 2),
      'discount' => $discount,
      'base_fare' => $baseFare
      ]);
}catch (Exception $e) {
      echo json_encode([
      'success' => false,
      'error' => 'Failed to calculate fare'
      ]);
}
?>