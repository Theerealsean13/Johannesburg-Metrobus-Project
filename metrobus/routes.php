<?php
$pageTitle = 'Routes - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM routes ORDER BY route_name");
$routes = $stmt->fetchAll();
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filteredRoutes = $routes;
if ($searchQuery) {
$filteredRoutes = array_filter($routes, function($route) use ($searchQuery) {
return stripos($route['route_name'], $searchQuery) !== false ||
stripos($route['start_point'], $searchQuery) !== false ||
stripos($route['end_point'], $searchQuery) !== false;
});
}
?>
<main>
<section class="container mt-3">
<h1>Bus Routes</h1>
<p>Find and explore all available MetroBus routes in Johannesburg.</p>
<div class="card mb-3">
<div class="grid grid-2">
<div class="form-group">
<label for="route-search">Search Routes</label>
<input type="text" id="route-search" placeholder="Search by route name, start, or end point..." value="<?php echo htmlspecialchars($searchQuery); ?>">
</div>
<div class="form-group">
<label for="route-filter">Filter by Status</label>
<select id="route-filter">
<option value="all">All Routes</option>
<option value="active">Active Only</option>
<option value="delayed">Delayed</option>
<option value="cancelled">Cancelled</option>
</select>
</div>
</div>
</div>
<div id="routes-container" class="grid grid-2">
<?php foreach ($filteredRoutes as $route): ?>
<div class="card route-card" data-route-id="<?php echo $route['id']; ?>">
<h3><?php echo htmlspecialchars($route['route_name']); ?></h3>
<p><strong>From:</strong> <?php echo htmlspecialchars($route['start_point']); ?></p>
<p><strong>To:</strong> <?php echo htmlspecialchars($route['end_point']); ?></p>
<span class="status-badge status-<?php echo strtolower($route['status'] ?? 'active'); ?>"><?php echo ucfirst($route['status'] ?? 'Active'); ?></span>
<div style="display: flex; flex-direction: column; gap: 0.8rem; align-items: flex-start; margin-top: auto; padding-top: 1.5rem; width: 100%;">
<button class="btn btn-secondary" onclick="toggleTimetable(<?php echo $route['id']; ?>)">View Timetable</button>
<div id="timetable-<?php echo $route['id']; ?>" class="timetable" style="display: none; width: 100%;">
<h4>Timetable</h4>
<?php
$stmt = $pdo->prepare("SELECT * FROM timetables WHERE route_id = ? ORDER BY departure_time");
$stmt->execute([$route['id']]);
$timetables = $stmt->fetchAll();
if ($timetables): ?>
<table>
<thead>
<tr>
<th>Departure</th>
<th>Arrival</th>
<th>Day Type</th>
</tr>
</thead>
<tbody>
<?php foreach ($timetables as $timetable): ?>
<tr>
<td><?php echo date('H:i', strtotime($timetable['departure_time'])); ?></td>
<td><?php echo date('H:i', strtotime($timetable['arrival_time'])); ?></td>
<td><?php echo ucfirst($timetable['day_type']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php else: ?>
<p>No timetable available.</p>
<?php endif; ?>
</div>
<button class="btn" onclick="viewStops(<?php echo $route['id']; ?>)">View Stops</button>
<div id="stops-<?php echo $route['id']; ?>" class="stops-list" style="display: none; width: 100%;">
<h4>Bus Stops</h4>
<ul>
<?php
$stmt = $pdo->prepare("SELECT * FROM stops WHERE route_id = ? ORDER BY stop_order");
$stmt->execute([$route['id']]);
$stops = $stmt->fetchAll();
foreach ($stops as $stop): ?>
<li><?php echo htmlspecialchars($stop['stop_name']); ?></li>
<?php endforeach; ?>
</ul>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php if (empty($filteredRoutes)): ?>
<div class="card text-center">
<h3>No routes found</h3>
<p>Try adjusting your search criteria.</p>
</div>
<?php endif; ?>
<div class="card mt-3">
<h2>Route Map</h2>
<div id="map-placeholder" style="height: 400px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
<p>Interactive map would be displayed here (Google Maps integration)</p>
</div>
</div>
</section>
</main>
<style>
.timetable, .stops-list {
margin-top: 0.5rem;
padding: 1rem;
background-color: #f9f9f9;
border-radius: 4px;
}
body.dark-mode .timetable,
body.dark-mode .stops-list {
background-color: #2a2a2a;
}
.timetable table {
width: 100%;
border-collapse: collapse;
}
.timetable th, .timetable td {
padding: 0.5rem;
text-align: left;
border-bottom: 1px solid #ddd;
}
.stops-list ul {
list-style-type: none;
padding: 0;
}
.stops-list li {
padding: 0.25rem 0;
border-bottom: 1px solid #eee;
}
</style>
<script>
document.getElementById('route-search').addEventListener('input', debounce(function() {
filterRoutes();
}, 300));
document.getElementById('route-filter').addEventListener('change', filterRoutes);
function filterRoutes() {
const searchTerm = document.getElementById('route-search').value.toLowerCase();
const filterStatus = document.getElementById('route-filter').value;
const routeCards = document.querySelectorAll('.route-card');
routeCards.forEach(card => {
const routeName = card.querySelector('h3').textContent.toLowerCase();
const startPoint = card.querySelector('p').textContent.toLowerCase();
const endPoint = card.querySelectorAll('p')[1].textContent.toLowerCase();
const matchesSearch = routeName.includes(searchTerm) || startPoint.includes(searchTerm) || endPoint.includes(searchTerm);
const badgeText = card.querySelector('.status-badge').textContent.toLowerCase();
const matchesFilter = filterStatus === 'all' || badgeText === filterStatus;
if (matchesSearch && matchesFilter) {
card.style.display = 'block';
} else {
card.style.display = 'none';
}
});
}
function toggleTimetable(routeId) {
const timetable = document.getElementById(`timetable-${routeId}`);
timetable.style.display = timetable.style.display === 'none' ? 'block' : 'none';
}
function viewStops(routeId) {
const stops = document.getElementById(`stops-${routeId}`);
stops.style.display = stops.style.display === 'none' ? 'block' : 'none';
}
function debounce(func, wait) {
let timeout;
return function executedFunction(...args) {
const later = () => {
clearTimeout(timeout);
func(...args);
};
clearTimeout(timeout);
timeout = setTimeout(later, wait);
};
}
</script>
<?php require_once 'includes/footer.php'; ?>