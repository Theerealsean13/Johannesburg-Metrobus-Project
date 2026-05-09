<?php
$pageTitle = 'Trip Planner - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT DISTINCT point FROM (SELECT start_point AS point FROM routes UNION SELECT end_point AS point FROM routes) AS locations ORDER BY point");
$locations = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<main>
<section class="container mt-3">
<h1>Plan Your Trip</h1>
<p>Use our interactive trip planner to find the best MetroBus routes for your journey.</p>
<div class="grid grid-2">
<div class="card">
<h2>Journey Details</h2>
<form id="trip-planner-form">
<div class="form-group">
<label for="from-location">From</label>
<select id="from-location" required>
<option value="">Select starting point...</option>
<?php foreach ($locations as $location): ?>
<option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="form-group">
<label for="to-location">To</label>
<select id="to-location" required>
<option value="">Select destination...</option>
<?php foreach ($locations as $location): ?>
<option value="<?php echo htmlspecialchars($location); ?>"><?php echo htmlspecialchars($location); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="grid grid-2">
<div class="form-group">
<label for="trip-date">Date</label>
<input type="date" id="trip-date" required>
</div>
<div class="form-group">
<label for="trip-time">Time</label>
<input type="time" id="trip-time" required>
</div>
</div>
<button type="submit" class="btn btn-secondary" style="width: 100%;">Plan My Trip</button>
</form>
</div>
<div class="card" style="display: flex; flex-direction: column;">
<h2>Interactive Map</h2>
<div id="map-placeholder" style="flex-grow: 1; min-height: 300px; border-radius: 8px; overflow: hidden; box-shadow: inset 0 0 10px rgba(0,0,0,0.1);">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114584.72622765039!2d27.948039304928254!3d-26.204102800000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e950c68f0406a51%3A0x238ac9d9b1d34041!2sJohannesburg!5e0!3m2!1sen!2sza!4v1715420000000!5m2!1sen!2sza" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</div>
</div>
<div id="loading-spinner" class="text-center mt-3" style="display: none;">
<div class="loading" style="width: 40px; height: 40px; border-width: 4px;"></div>
<p class="mt-1">Calculating best routes...</p>
</div>
<div id="trip-results" class="mt-3" style="display: none;">
<h2>Suggested Routes</h2>
<div id="results-container" class="grid grid-1">
</div>
</div>
</section>
</main>
<style>
.itinerary-card {
border-left: 4px solid #0052CC;
display: flex;
flex-direction: column;
gap: 1rem;
}
.itinerary-header {
display: flex;
justify-content: space-between;
align-items: center;
border-bottom: 1px solid #eee;
padding-bottom: 1rem;
}
body.dark-mode .itinerary-header {
border-bottom: 1px solid #333;
}
.itinerary-step {
display: flex;
align-items: flex-start;
gap: 1rem;
}
.step-icon {
width: 24px;
height: 24px;
color: #00AD43;
flex-shrink: 0;
}
.step-details h4 {
margin-bottom: 0.2rem;
}
.step-details p {
margin-bottom: 0;
font-size: 0.9rem;
color: #555;
}
body.dark-mode .step-details p {
color: #aaa;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
const dateInput = document.getElementById('trip-date');
const timeInput = document.getElementById('trip-time');
const now = new Date();
dateInput.value = now.toISOString().split('T')[0];
timeInput.value = now.toTimeString().slice(0,5);
});
document.getElementById('trip-planner-form').addEventListener('submit', function(e) {
e.preventDefault();
const fromLoc = document.getElementById('from-location').value;
const toLoc = document.getElementById('to-location').value;
const tripTime = document.getElementById('trip-time').value;
if (fromLoc === toLoc) {
alert('Starting point and destination cannot be the same.');
return;
}
document.getElementById('trip-results').style.display = 'none';
document.getElementById('loading-spinner').style.display = 'block';
setTimeout(() => {
document.getElementById('loading-spinner').style.display = 'none';
generateSimulatedItinerary(fromLoc, toLoc, tripTime);
document.getElementById('trip-results').style.display = 'block';
document.getElementById('trip-results').scrollIntoView({ behavior: 'smooth' });
}, 1500);
});
function generateSimulatedItinerary(from, to, time) {
const container = document.getElementById('results-container');
const [hours, minutes] = time.split(':').map(Number);
const arrivalTime = new Date();
arrivalTime.setHours(hours + 1, minutes + 15);
const formattedArrival = arrivalTime.toTimeString().slice(0,5);
const randomRoute = Math.floor(Math.random() * 50) + 1;
container.innerHTML = `
<div class="card itinerary-card">
<div class="itinerary-header">
<div>
<h3 style="margin-bottom: 0; color: #0052CC;">Fastest Route</h3>
<p style="margin-bottom: 0;">1 hr 15 mins • R25.00</p>
</div>
<div class="text-right">
<h3 style="margin-bottom: 0;">${time} - ${formattedArrival}</h3>
</div>
</div>
<div class="itinerary-step">
<svg class="step-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
<div class="step-details">
<h4>Walk to ${from} Station</h4>
<p>Approximately 5 minutes</p>
</div>
</div>
<div class="itinerary-step">
<svg class="step-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z"/></svg>
<div class="step-details">
<h4>Board MetroBus Route ${randomRoute}</h4>
<p>Departing at ${time}. Stay on for 8 stops.</p>
</div>
</div>
<div class="itinerary-step">
<svg class="step-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
<div class="step-details">
<h4>Arrive at ${to}</h4>
<p>Estimated arrival at ${formattedArrival}</p>
</div>
</div>
</div>
`;
}
</script>
<?php require_once 'includes/footer.php'; ?>