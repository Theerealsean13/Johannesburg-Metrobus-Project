<?php
$pageTitle = 'Post Notices - Admin';
require_once 'includes/header.php';
require_once 'includes/db.php';
require_once 'includes/auth.php';
if (!isLoggedIn() || strtolower(getCurrentUser()['role']) !== 'admin') {
header('Location: index.php');
exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$type = $_POST['type'];
$stmt = $pdo->prepare("INSERT INTO notices (title, description, type, created_at) VALUES (?, ?, ?, NOW())");
$stmt->execute([$title, $description, $type]);
header('Location: notices.php');
exit;
}
?>
<main>
<section class="container mt-3">
<h1>Post New Notice</h1>
<div class="card">
<form method="POST">
<div class="form-group">
<label>Notice Title</label>
<input type="text" name="title" required placeholder="e.g. Service Disruption">
</div>
<div class="form-group">
<label>Notice Type</label>
<select name="type">
<option value="info">Info</option>
<option value="warning">Warning</option>
<option value="alert">Alert</option>
</select>
</div>
<div class="form-group">
<label>Description</label>
<textarea name="description" rows="5" required placeholder="Describe the update here..."></textarea>
</div>
<button type="submit" class="btn btn-secondary">Post Notice</button>
<a href="profile.php" class="btn">Cancel</a>
</form>
</div>
</section>
</main>
<?php require_once 'includes/footer.php'; ?>