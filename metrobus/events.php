<?php
$pageTitle = 'Events - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll();
$eventsByCategory = [];
foreach ($events as $event) {
$eventsByCategory[$event['category']][] = $event;
}
?>
<main>
<section class="container mt-3">
<h1>MetroBus Events</h1>
<p>Stay connected with MetroBus through our events, campaigns, and community initiatives.</p>
<div class="card">
<h2>Filter Events</h2>
<div class="grid grid-4">
<button class="btn filter-btn active" data-filter="all">All Events</button>
<button class="btn filter-btn" data-filter="MetroBus">MetroBus</button>
<button class="btn filter-btn" data-filter="Community">Community</button>
<button class="btn filter-btn" data-filter="City of Johannesburg">City Events</button>
</div>
</div>
<div id="events-container" class="mt-3">
<?php if (!empty($events)): ?>
<?php foreach ($eventsByCategory as $category => $categoryEvents): ?>
<div class="category-section" data-category="<?php echo htmlspecialchars($category); ?>">
<h2><?php echo htmlspecialchars($category); ?> Events</h2>
<div class="grid grid-2">
<?php foreach ($categoryEvents as $event): ?>
<div class="card event-card">
<div class="event-header">
<h3><?php echo htmlspecialchars($event['title']); ?></h3>
<span class="status-badge status-active"><?php echo htmlspecialchars($event['category']); ?></span>
</div>
<p><?php echo htmlspecialchars($event['description']); ?></p>
<div class="event-details">
<p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
<p><strong>Category:</strong> <?php echo htmlspecialchars($event['category']); ?></p>
</div>
<button class="btn" style="margin-top: 1rem;" onclick="viewEventDetails(<?php echo $event['id']; ?>)">Learn More</button>
</div>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
<?php else: ?>
<div class="card text-center">
<h3>No upcoming events</h3>
<p>Check back later for new events and announcements.</p>
</div>
<?php endif; ?>
</div>
<div class="card mt-3">
<h2>Event Calendar</h2>
<div id="calendar-placeholder" style="height: 400px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
<p>Interactive calendar would be displayed here (FullCalendar integration)</p>
</div>
</div>
<div class="card mt-3">
<h2>Event Categories</h2>
<div class="grid grid-3">
<div class="text-center">
<h4>MetroBus Events</h4>
<p>Official MetroBus announcements, launches, and celebrations</p>
</div>
<div class="text-center">
<h4>Community Outreach</h4>
<p>Programs for seniors, students, and local communities</p>
</div>
<div class="text-center">
<h4>City of Johannesburg</h4>
<p>City-wide events and initiatives involving public transport</p>
</div>
</div>
</div>
<div class="card mt-3">
<h2>Host an Event with MetroBus</h2>
<p>Planning a group event? MetroBus can help with transportation solutions.</p>
<div class="grid grid-2">
<div>
<h4>School Trips</h4>
<p>Educational excursions and field trips</p>
<ul>
<li>Discounted group rates</li>
<li>Dedicated bus charters</li>
<li>Educator supervision</li>
</ul>
</div>
<div>
<h4>Corporate Events</h4>
<p>Team building and company outings</p>
<ul>
<li>Customized routes</li>
<li>Professional drivers</li>
<li>Flexible scheduling</li>
</ul>
</div>
</div>
<div class="text-center mt-2">
<a href="mailto:events@metrobus.co.za" class="btn">Contact Events Team</a>
</div>
</div>
</section>
</main>
<style>
.event-card {
height: 100%;
display: flex;
flex-direction: column;
}
.event-header {
display: flex;
justify-content: space-between;
align-items: flex-start;
margin-bottom: 0.5rem;
}
.event-header h3 {
margin: 0;
flex: 1;
}
.event-details {
margin-top: auto;
padding-top: 1rem;
}
.category-section {
margin-bottom: 2rem;
}
.filter-btn {
margin-bottom: 0.5rem;
}
.filter-btn.active {
background-color: #0052CC;
color: white;
}
.filter-btn:not(.active) {
background-color: #f8f9fa;
color: #333;
}
body.dark-mode .filter-btn:not(.active) {
background-color: #2a2a2a;
color: #e0e0e0;
}
</style>
<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
btn.addEventListener('click', function() {
const filter = this.getAttribute('data-filter');
document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
this.classList.add('active');
const categories = document.querySelectorAll('.category-section');
categories.forEach(category => {
if (filter === 'all' || category.getAttribute('data-category') === filter) {
category.style.display = 'block';
} else {
category.style.display = 'none';
}
});
});
});
function viewEventDetails(eventId) {
showAlert('Event details would be displayed here. Event ID: ' + eventId, 'info');
}
</script>
<?php require_once 'includes/footer.php'; ?>