<?php
$pageTitle = 'Home - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM notices ORDER BY created_at DESC LIMIT 3");
$notices = $stmt->fetchAll();
$stmt = $pdo->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3");
$events = $stmt->fetchAll();
$stmt = $pdo->query("SELECT COUNT(*) as total_routes FROM routes WHERE status = 'active'");
$totalRoutes = $stmt->fetch()['total_routes'];
$stmt = $pdo->query("SELECT COUNT(*) as total_stops FROM stops");
$totalStops = $stmt->fetch()['total_stops'];
?>
<main>
<section class="hero">
<div class="container">
<h1>Welcome to MetroBus</h1>
<p>Your reliable public transport solution in Johannesburg</p>
<div class="search-bar">
<input type="text" id="route-search" placeholder="Search for routes, stops, or destinations..." aria-label="Search routes">
<button type="button" onclick="searchRoutes()">Search</button>
</div>
</div>
</section>
<section class="container mt-3">
<div class="grid grid-4 mb-3">
<div class="card text-center" style="display: flex; flex-direction: column; height: 100%;">
<div style="flex-grow: 1;">
<h3>Find Routes</h3>
<p>Discover all available bus routes in Johannesburg</p>
</div>
<a href="routes.php" class="btn mt-1" style="margin-top: auto;">View Routes</a>
</div>
<div class="card text-center" style="display: flex; flex-direction: column; height: 100%;">
<div style="flex-grow: 1;">
<h3>Live Tracking</h3>
<p>Real-time bus locations and arrival times</p>
</div>
<a href="live_tracking.php" class="btn mt-1" style="margin-top: auto;">Track Buses</a>
</div>
<div class="card text-center" style="display: flex; flex-direction: column; height: 100%;">
<div style="flex-grow: 1;">
<h3>Trip Planner</h3>
<p>Plan your journey with ease</p>
</div>
<a href="trip_planner.php" class="btn mt-1" style="margin-top: auto;">Plan Trip</a>
</div>
<div class="card text-center" style="display: flex; flex-direction: column; height: 100%;">
<div style="flex-grow: 1;">
<h3>Fare Information</h3>
<p>Check fares and available discounts</p>
</div>
<a href="fares.php" class="btn mt-1" style="margin-top: auto;">View Fares</a>
</div>
</div>
</section>
<section class="container mt-3">
<h2>Live Service Alerts</h2>
<div class="grid grid-3">
<?php if (empty($notices)): ?>
<div class="card" style="grid-column: span 3; text-align: center;">
<p>All MetroBus services are currently operating normally.</p>
</div>
<?php else: ?>
<?php foreach ($notices as $notice): ?>
<?php 
$badgeColor = '#0052CC';
$textColor = '#fff';
if ($notice['category'] === 'Alert') { $badgeColor = '#dc3545'; }
if ($notice['category'] === 'Maintenance') { $badgeColor = '#ffc107'; $textColor = '#000'; }
?>
<div class="card" style="border-top: 4px solid <?php echo $badgeColor; ?>;">
<h3 style="margin-bottom: 0.5rem;"><?php echo htmlspecialchars($notice['title']); ?></h3>
<span class="status-badge" style="background-color: <?php echo $badgeColor; ?>; color: <?php echo $textColor; ?>; margin-bottom: 1rem; display: inline-block;">
<?php echo htmlspecialchars($notice['category']); ?>
</span>
<p style="font-size: 0.9rem;"><?php echo substr(htmlspecialchars($notice['content']), 0, 100) . '...'; ?></p>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
<div class="text-center mt-2">
<a href="notices.php" class="btn btn-secondary">View All Notices</a>
</div>
</section>
<section class="container mt-3">
<h2>Upcoming Events</h2>
<div class="grid grid-3">
<?php if (empty($events)): ?>
<div class="card" style="grid-column: span 3; text-align: center;">
<p>No upcoming events at this time.</p>
</div>
<?php else: ?>
<?php foreach ($events as $event): ?>
<div class="card">
<h3><?php echo htmlspecialchars($event['title']); ?></h3>
<p style="font-size: 0.9rem;"><?php echo substr(htmlspecialchars($event['description']), 0, 100) . '...'; ?></p>
<p style="margin-bottom: 0.5rem;"><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
<span class="status-badge status-active"><?php echo htmlspecialchars($event['category']); ?></span>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
<div class="text-center mt-2">
<a href="events.php" class="btn btn-secondary">View All Events</a>
</div>
</section>
<section class="container mt-3">
<div class="mt-3">
<h2 class="mb-2">MetroBus by Numbers</h2>
<div class="grid grid-4 mb-3">
<div class="card text-center">
<svg width="36" height="36" fill="#0052CC" class="mb-1" style="margin: 0 auto;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/></svg>
<h3><?php echo $totalRoutes; ?></h3>
<p>Active Routes</p>
</div>
<div class="card text-center">
<svg width="36" height="36" fill="#0052CC" class="mb-1" style="margin: 0 auto;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
<h3><?php echo $totalStops; ?></h3>
<p>Bus Stops</p>
</div>
<div class="card text-center">
<svg width="36" height="36" fill="#0052CC" class="mb-1" style="margin: 0 auto;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
<h3>24/7</h3>
<p>Service Availability</p>
</div>
<div class="card text-center">
<svg width="36" height="36" fill="#0052CC" class="mb-1" style="margin: 0 auto;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
<h3>100%</h3>
<p>Reliable Transport</p>
</div>
</div>
</div>
</section>
<section class="container mt-3">
<div class="card">
<h2>Plan Your Trip</h2>
<p>Use our trip planner to find the best routes for your journey.</p>
<form id="quick-trip-form">
<div class="grid grid-2">
<div class="form-group">
<label for="start-location">From</label>
<input type="text" id="start-location" placeholder="Enter starting point" required>
</div>
<div class="form-group">
<label for="end-location">To</label>
<input type="text" id="end-location" placeholder="Enter destination" required>
</div>
</div>
<button type="submit" class="btn">Plan My Trip</button>
</form>
</div>
</section>
<section class="container mt-3 mobile-quick-actions" style="display: none;">
<h2>Quick Actions</h2>
<div class="grid grid-2">
<a href="live_tracking.php" class="btn">Live Tracking</a>
<a href="trip_planner.php" class="btn btn-secondary">Trip Planner</a>
</div>
</section>
</main>
<script>
function searchRoutes() {
const query = document.getElementById('route-search').value;
if (query.trim()) {
window.location.href = `routes.php?search=${encodeURIComponent(query)}`;
}
}
document.getElementById('quick-trip-form').addEventListener('submit', function(e) {
e.preventDefault();
const start = document.getElementById('start-location').value;
const end = document.getElementById('end-location').value;
if (start && end) {
window.location.href = `trip_planner.php?from=${encodeURIComponent(start)}&to=${encodeURIComponent(end)}`;
}
});
if (window.innerWidth <= 768) {
document.querySelector('.mobile-quick-actions').style.display = 'block';
}
</script>
<?php require_once 'includes/footer.php'; ?>