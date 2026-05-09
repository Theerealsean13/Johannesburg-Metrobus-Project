<?php
$pageTitle = 'Feedback - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
require_once 'includes/auth.php';
$user = isLoggedIn() ? getCurrentUser() : false;
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$category = $_POST['category'] ?? '';
$feedback_message = trim($_POST['message'] ?? '');
$rating = $_POST['rating'] ?? 5;
$message = 'Thank you for your feedback! We value your input.';
}
?>
<main>
<section class="container mt-3">
<h1>Share Your Feedback</h1>
<p>Your feedback helps us improve MetroBus services. We value your input!</p>
<?php if ($message): ?>
<div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<div class="card mb-3">
<h2>Submit Feedback</h2>
<form method="POST" id="feedback-form">
<div class="grid grid-2">
<div class="form-group">
<label for="name">Name *</label>
<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user && is_array($user) ? $user['name'] : ''); ?>" required>
</div>
<div class="form-group">
<label for="email">Email *</label>
<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user && is_array($user) ? $user['email'] : ''); ?>" required>
</div>
</div>
<div class="form-group">
<label>Rating *</label>
<div class="rating-stars" style="color: #FFCC00; font-size: 1.5rem; cursor: pointer;">
<span data-rating="1">&#9733;</span>
<span data-rating="2">&#9733;</span>
<span data-rating="3">&#9733;</span>
<span data-rating="4">&#9733;</span>
<span data-rating="5">&#9733;</span>
</div>
<input type="hidden" name="rating" id="rating-input" value="5">
</div>
<div class="form-group">
<label for="category">Category *</label>
<select id="category" name="category" required>
<option value="">Select a category...</option>
<option value="Driver Behavior">Driver Behavior</option>
<option value="Bus Cleanliness">Bus Cleanliness</option>
<option value="Punctuality">Punctuality</option>
<option value="App/Website Issue">App/Website Issue</option>
<option value="General Suggestion">General Suggestion</option>
</select>
</div>
<div class="form-group">
<label for="message">Message *</label>
<textarea id="message" name="message" rows="5" required placeholder="Please share your feedback, suggestions, or concerns..."></textarea>
</div>
<button type="submit" class="btn btn-secondary">Submit Feedback</button>
</form>
</div>
</section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
const stars = document.querySelectorAll('.rating-stars span');
const ratingInput = document.getElementById('rating-input');
stars.forEach(star => {
star.addEventListener('click', function() {
const rating = this.getAttribute('data-rating');
ratingInput.value = rating;
updateStars(rating);
});
});
function updateStars(rating) {
stars.forEach(star => {
if (parseInt(star.getAttribute('data-rating')) <= rating) {
star.innerHTML = '&#9733;';
} else {
star.innerHTML = '&#9734;';
}
});
}
});
</script>
<?php require_once 'includes/footer.php'; ?>