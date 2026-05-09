<?php
$pageTitle = 'Profile - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/auth.php';
if (!isLoggedIn()) {
header('Location: login.php');
exit;
}
$user = getCurrentUser();
if (!$user) {
if(session_status() === PHP_SESSION_ACTIVE) { session_destroy(); }
header('Location: login.php');
exit;
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
if (verifyPassword($_POST['current_password'], $user['password'])) {
$newPassword = hashPassword($_POST['new_password']);
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->execute([$newPassword, $user['id']]);
$message = 'Password updated successfully.';
} else {
$message = 'Current password is incorrect.';
}
} else {
$stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
$stmt->execute([$name, $email, $user['id']]);
$message = 'Profile updated successfully.';
$user = getCurrentUser();
}
}
?>
<main>
<section class="container mt-3">
<h1>My Profile</h1>
<p>Manage your account settings and preferences.</p>
<?php if ($message): ?>
<div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<?php if (strtolower($user['role'] ?? 'user') === 'admin'): ?>
<div class="card mb-3" style="border: 2px solid #00AD43; background: rgba(0,173,67,0.05);">
<h2 style="color: #00AD43;">Admin Controls</h2>
<p>You have administrator privileges. Access the system management tools below.</p>
<div class="grid grid-3 mt-2">
<a href="admin_routes.php" class="btn" style="text-align: center;">Manage Routes</a>
<a href="admin_users.php" class="btn" style="text-align: center;">Manage Users</a>
<a href="admin_notices.php" class="btn" style="text-align: center;">Post Notices</a>
</div>
</div>
<?php endif; ?>
<div class="grid grid-2">
<div class="card">
<h2>Profile Information</h2>
<form method="POST">
<div class="form-group">
<label for="name">Full Name</label>
<input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
</div>
<div class="form-group">
<label for="email">Email</label>
<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
</div>
<div class="form-group">
<label for="role">Account Type</label>
<input type="text" value="<?php echo ucfirst($user['role'] ?? 'User'); ?>" readonly>
</div>
<button type="submit" class="btn">Update Profile</button>
</form>
</div>
<div class="card">
<h2>Change Password</h2>
<form method="POST">
<div class="form-group">
<label for="current_password">Current Password</label>
<input type="password" id="current_password" name="current_password">
</div>
<div class="form-group">
<label for="new_password">New Password</label>
<input type="password" id="new_password" name="new_password" minlength="6">
</div>
<div class="form-group">
<label for="confirm_new_password">Confirm New Password</label>
<input type="password" id="confirm_new_password" name="confirm_new_password">
</div>
<button type="submit" class="btn">Change Password</button>
</form>
</div>
</div>
<div class="card mt-3">
<h2>Saved Routes</h2>
<p>You haven't saved any routes yet.</p>
<p><a href="routes.php" style="color: #0052CC; text-decoration: underline;">Browse routes</a> to save your favorites.</p>
</div>
</section>
</main>
<script>
document.getElementById('confirm_new_password').addEventListener('input', function() {
const newPassword = document.getElementById('new_password').value;
const confirmPassword = this.value;
if (newPassword !== confirmPassword) {
this.setCustomValidity('Passwords do not match');
} else {
this.setCustomValidity('');
}
});
</script>
<?php require_once 'includes/footer.php'; ?>