<?php
$pageTitle = 'Live Tracking - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT ls.*, r.route_name FROM live_status ls JOIN routes r ON ls.route_id = r.id ORDER BY ls.updated_at DESC");
$liveStatuses = $stmt->fetchAll();
?>
<main>
<section class="container mt-3">
<h1>Live Bus Tracking</h1>
<p>Real-time information on bus locations and service status.</p>
<div class="grid grid-4 mb-3">
<div class="card text-center">
<h3><?php echo count(array_filter($liveStatuses, fn($s) => $s['status'] === 'on_time')); ?></h3>
<p>On Time</p>
</div>
<div class="card text-center">
<h3><?php echo count(array_filter($liveStatuses, fn($s) => $s['status'] === 'delayed')); ?></h3>
<p>Delayed</p>
</div>
<div class="card text-center">
<h3><?php echo count(array_filter($liveStatuses, fn($s) => $s['status'] === 'cancelled')); ?></h3>
<p>Cancelled</p>
</div>
<div class="card text-center">
<h3><?php echo count($liveStatuses); ?></h3>
<p>Total Routes</p>
</div>
</div>
<div class="card">
<h2>Current Service Status</h2>
<div id="status-container" class="table-responsive">
<table id="status-table">
<thead>
<tr>
<th>Route</th>
<th>Status</th>
<th>Delay</th>
<th>Last Updated</th>
<th>Estimated Arrival</th>
</tr>
</thead>
<tbody>
<?php foreach ($liveStatuses as $status): ?>
<tr>
<td><?php echo htmlspecialchars($status['route_name']); ?></td>
<td>
<span class="status-badge status-<?php echo $status['status']; ?>">
<?php echo ucfirst(str_replace('_', ' ', $status['status'])); ?>
</span>
</td>
<td><?php echo $status['delay_minutes'] ? $status['delay_minutes'] . ' min' : 'N/A'; ?></td>
<td><?php echo date('H:i', strtotime($status['updated_at'])); ?></td>
<td id="arrival-<?php echo $status['id']; ?>">
<span class="loading"></span>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<div class="card mt-3">
<h2>Live Route Map</h2>
<div id="live-map" style="height: 500px; border-radius: 8px; overflow: hidden; box-shadow: inset 0 0 10px rgba(0,0,0,0.1);">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114584.72622765039!2d27.948039304928254!3d-26.204102800000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e950c68f0406a51%3A0x238ac9d9b1d34041!2sJohannesburg!5e0!3m2!1sen!2sza!4v1715420000000!5m2!1sen!2sza" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
<div class="card mt-3">
<p><strong>Auto-refresh:</strong> Status updates every 15 seconds. Last updated: <span id="last-update"><?php echo date('H:i:s'); ?></span></p>
<button id="manual-refresh" class="btn btn-secondary">Refresh Now</button>
</div>
</section>
</main>
<style>
.table-responsive {
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}
.table-responsive table {
min-width: 600px;
}
@media (max-width: 768px) {
.table-responsive th, 
.table-responsive td {
white-space: nowrap;
}
}
#status-table {
width: 100%;
border-collapse: collapse;
}
#status-table th, #status-table td {
padding: 0.75rem;
text-align: left;
border-bottom: 1px solid #ddd;
}
#status-table th {
background-color: #f8f9fa;
font-weight: bold;
}
body.dark-mode #status-table th {
background-color: #2a2a2a;
}
body.dark-mode #status-table td {
border-bottom: 1px solid #444;
}
.status-on_time { background-color: #28a745; color: white; }
.status-delayed { background-color: #ffc107; color: black; }
.status-cancelled { background-color: #dc3545; color: white; }
</style>
<script>
let updateInterval;
function updateLiveStatus() {
fetch('api/get_live_status.php')
.then(response => response.json())
.then(data => {
if (data.success) {
updateStatusTable(data.statuses);
document.getElementById('last-update').textContent = new Date().toLocaleTimeString();
}
})
.catch(error => console.error('Error updating status:', error));
}
function updateStatusTable(statuses) {
const tbody = document.querySelector('#status-table tbody');
tbody.innerHTML = '';
statuses.forEach(status => {
const row = document.createElement('tr');
row.innerHTML = `
<td>${status.route_name}</td>
<td><span class="status-badge status-${status.status}">${status.status.replace('_', ' ')}</span></td>
<td>${status.delay_minutes ? status.delay_minutes + ' min' : 'N/A'}</td>
<td>${new Date(status.updated_at).toLocaleTimeString()}</td>
<td id="arrival-${status.id}"><span class="loading"></span></td>
`;
tbody.appendChild(row);
setTimeout(() => {
const arrivalCell = document.getElementById(`arrival-${status.id}`);
const now = new Date();
const delay = status.delay_minutes || 0;
const estimatedArrival = new Date(now.getTime() + (delay * 60000) + (Math.random() * 30 * 60000));
arrivalCell.innerHTML = estimatedArrival.toLocaleTimeString();
}, 1000);
});
}
function startAutoRefresh() {
updateInterval = setInterval(updateLiveStatus, 15000);
}
function stopAutoRefresh() {
clearInterval(updateInterval);
}
document.getElementById('manual-refresh').addEventListener('click', function() {
stopAutoRefresh();
updateLiveStatus();
startAutoRefresh();
});
document.addEventListener('DOMContentLoaded', function() {
updateLiveStatus();
startAutoRefresh();
});
document.addEventListener('visibilitychange', function() {
if (document.hidden) {
stopAutoRefresh();
} else {
updateLiveStatus();
startAutoRefresh();
}
});
</script>
<?php require_once 'includes/footer.php'; ?>