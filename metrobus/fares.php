<?php
$pageTitle = 'Fares - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT f.*, r.route_name FROM fares f JOIN routes r ON f.route_id = r.id ORDER BY f.price");
$fares = $stmt->fetchAll();
?>
<main>
<section class="container mt-3">
<h1>Fare Information</h1>
<p>Check fares for MetroBus routes and available discounts.</p>
<div class="card">
<h2>Fare Calculator</h2>
<form id="fare-calculator">
<div class="grid grid-2">
<div class="form-group">
<label for="route-select">Select Route</label>
<select id="route-select" required>
<option value="">Choose a route...</option>
<?php
$stmt = $pdo->query("SELECT id, route_name FROM routes WHERE status = 'active' ORDER BY route_name");
$routes = $stmt->fetchAll();
foreach ($routes as $route): ?>
<option value="<?php echo $route['id']; ?>"><?php echo htmlspecialchars($route['route_name']); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="form-group">
<label for="passenger-type">Passenger Type</label>
<select id="passenger-type" required>
<option value="adult">Adult</option>
<option value="student">Student</option>
<option value="pensioner">Pensioner</option>
<option value="child">Child (under 12)</option>
</select>
</div>
</div>
<button type="submit" class="btn">Calculate Fare</button>
</form>
<div id="fare-result" class="mt-2" style="display: none;">
<div class="fare-info">
<h3>Calculated Fare</h3>
<p id="fare-amount"></p>
<p id="fare-discount"></p>
</div>
</div>
</div>
<div class="card mt-3">
<h2>All Fares</h2>
<div class="table-responsive">
<table id="fare-table">
<thead>
<tr>
<th>Route</th>
<th>Base Fare</th>
<th>Student Discount</th>
<th>Pensioner Discount</th>
<th>Discount Info</th>
</tr>
</thead>
<tbody>
<?php foreach ($fares as $fare): ?>
<tr>
<td><?php echo htmlspecialchars($fare['route_name']); ?></td>
<td>R<?php echo number_format($fare['price'], 2); ?></td>
<td>R<?php echo number_format($fare['price'] * 0.8, 2); ?> (20% off)</td>
<td>R<?php echo number_format($fare['price'] * 0.5, 2); ?> (50% off)</td>
<td><?php echo htmlspecialchars($fare['discount_info']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<div class="card mt-3">
<h2>Discount Categories</h2>
<div class="grid grid-2">
<div>
<h3>Student Discount</h3>
<p>20% off base fare</p>
<p>Valid student card required</p>
<ul>
<li>Full-time students</li>
<li>University and college students</li>
<li>Valid for weekdays only</li>
</ul>
</div>
<div>
<h3>Pensioner Discount</h3>
<p>50% off base fare</p>
<p>Senior citizen card required</p>
<ul>
<li>Age 60 and above</li>
<li>Valid ID required</li>
<li>Available on all days</li>
</ul>
</div>
<div>
<h3>Child Fare</h3>
<p>Free for children under 6</p>
<p>50% off for children 6-12</p>
<ul>
<li>Valid for accompanied children</li>
<li>Maximum 2 children per adult</li>
</ul>
</div>
<div>
<h3>Group Travel</h3>
<p>Discounts for groups of 10+</p>
<p>Contact MetroBus for details</p>
<ul>
<li>School groups</li>
<li>Tour groups</li>
<li>Corporate travel</li>
</ul>
</div>
</div>
</div>
<div class="card mt-3">
<h2 class="text-center mb-3">Payment Methods</h2>
<div class="grid grid-3 text-center">
<div>
<svg width="32" height="32" fill="#00AD43" class="mb-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 4.01 2 6.5s4.48 4.5 10 4.5 10-2.01 10-4.5S17.52 2 12 2zm0 7c-4.32 0-8.17-1.42-9.66-3.52C2.86 6.59 4.29 7.5 6.75 8.16c1.55.41 3.33.67 5.25.67s3.7-.26 5.25-.67c2.46-.66 3.89-1.57 4.41-2.68C20.17 7.58 16.32 9 12 9zm0 2.5c-5.52 0-10-2.01-10-4.5v3c0 2.49 4.48 4.5 10 4.5s10-2.01 10-4.5v-3c0 2.49-4.48 4.5-10 4.5zm0 5c-5.52 0-10-2.01-10-4.5v3c0 2.49 4.48 4.5 10 4.5s10-2.01 10-4.5v-3c0 2.49-4.48 4.5-10 4.5z"/></svg>
<h3>Cash</h3>
<p>Pay directly to the driver</p>
<p>Exact change preferred</p>
</div>
<div>
<svg width="32" height="32" fill="#00AD43" class="mb-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
<h3>MetroCard</h3>
<p>Prepaid travel card</p>
<p>Available at major stations</p>
</div>
<div>
<svg width="32" height="32" fill="#00AD43" class="mb-1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm8-2v8h8V3h-8zm6 6h-4V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm13-2h-2v2h-2v-2h-2v2h4v2h-2v2h2v-2h2v2h2v-2h-2v-2h2v-2h-2v2zm-2 4h2v2h-2v-2zm4-6h-4v2h4v-2z"/></svg>
<h3>Mobile Payment</h3>
<p>Scan QR code</p>
<p>Supported apps: PayFast, SnapScan</p>
</div>
</div>
</div>
</section>
</main>
<style>
.table-responsive {
overflow-x: auto;
}
#fare-table {
width: 100%;
border-collapse: collapse;
}
#fare-table th, #fare-table td {
padding: 0.75rem;
text-align: left;
border-bottom: 1px solid #ddd;
}
#fare-table th {
background-color: #f8f9fa;
font-weight: bold;
}
body.dark-mode #fare-table th {
background-color: #2a2a2a;
}
.fare-info {
background-color: #e8f4fd;
padding: 1rem;
border-radius: 4px;
border-left: 4px solid #0052CC;
}
body.dark-mode .fare-info {
background-color: #1a3a5c;
}
.fare-info h3 {
margin-top: 0;
color: #0052CC;
}
</style>
<script>
document.getElementById('fare-calculator').addEventListener('submit', function(e) {
e.preventDefault();
const routeId = document.getElementById('route-select').value;
const passengerType = document.getElementById('passenger-type').value;
if (!routeId) {
showAlert('Please select a route.', 'error');
return;
}
fetch(`api/get_fare.php?route_id=${routeId}&passenger_type=${passengerType}`)
.then(response => response.json())
.then(data => {
if (data.success) {
displayFareResult(data);
} else {
showAlert('Error calculating fare. Please try again.', 'error');
}
})
.catch(error => {
console.error('Error:', error);
showAlert('Error calculating fare. Please try again.', 'error');
});
});
function displayFareResult(data) {
const resultDiv = document.getElementById('fare-result');
const amountSpan = document.getElementById('fare-amount');
const discountSpan = document.getElementById('fare-discount');
amountSpan.textContent = `Total Fare: R${data.fare.toFixed(2)}`;
discountSpan.textContent = data.discount ? `Discount Applied: ${data.discount}` : 'No discount applied';
resultDiv.style.display = 'block';
resultDiv.scrollIntoView({ behavior: 'smooth' });
}
</script>
<?php require_once 'includes/footer.php'; ?>