<?php
$pageTitle = 'Manage Routes - MetroBus Admin';
require_once '../includes/header.php';
require_once '../includes/auth.php';
if (!isAdmin()) {
    header('Location: ../index.php');
    exit;
}
require_once '../includes/db.php';
$stmt = $pdo->query("SELECT * FROM routes ORDER BY route_name");
$routes = $stmt->fetchAll();
?>
<main>
    <section class="container mt-3">
    <h1>Manage Routes</h1>
    <p>Add, edit, or remove bus routes.</p>
      <div class="mb-3">
      <button class="btn" onclick="showAddRouteForm()">Add New Route</button>
      </div>
      <div class="card">
      <h2>All Routes</h2>
      <table id="routes-table">
      <thead>
      <tr>
      <th>Route Name</th>
      <th>Start Point</th>
      <th>End Point</th>
      <th>Status</th>
      <th>Actions</th>
      </tr>
      </thead>
    <tbody>
<?php foreach ($routes as $route): ?>
<tr>
<td><?php echo htmlspecialchars($route['route_name']); ?></td>
<td><?php echo htmlspecialchars($route['start_point']); ?></td>
<td><?php echo htmlspecialchars($route['end_point']); ?></td>
<td><span class="status-badge status-<?php echo $route['status']; ?>"><?php echo ucfirst($route['status']); ?></span></td>
<td>
<button class="btn btn-secondary" onclick="editRoute(<?php echo $route['id']; ?>)">Edit</button>
<button class="btn" style="background-color: #dc3545;" onclick="deleteRoute(<?php echo $route['id']; ?>)">Delete</button>
</td>
</tr>
<?php endforeach; ?>
</tbody>
  </table>
  </div>
  </section>
  </main> 
  <style>
  #routes-table {
  width: 100%;
  border-collapse: collapse;
  }
  #routes-table th, #routes-table td {
  padding: 0.75rem;
  text-align: left;
  border-bottom: 1px solid #ddd;
  }
  #routes-table th {
  background-color: #f8f9fa;
  font-weight: bold;
  }
  body.dark-mode #routes-table th {
  background-color: #2a2a2a;
  }
  </style>
  <script>
  function showAddRouteForm() {
  alert('Add route form would open here');
  }
  function editRoute(id) {
  alert('Edit route ' + id + ' form would open here');
  }
  function deleteRoute(id) {
  if (confirm('Are you sure you want to delete this route?')) {
  alert('Route ' + id + ' would be deleted');
  }
  }
</script>
<?php require_once '../includes/footer.php'; ?>