<?php
$pageTitle = 'Manage Users - Admin';
require_once 'includes/header.php';
require_once 'includes/auth.php';
if (!isLoggedIn() || strtolower(getCurrentUser()['role']) !== 'admin') {
header('Location: index.php');
exit;
}
if (isset($_POST['update_role'])) {
$stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->execute([$_POST['role'], $_POST['user_id']]);
}
$stmt = $pdo->query("SELECT id, name, email, role FROM users ORDER BY name ASC");
$users = $stmt->fetchAll();
?>
<main>
<section class="container mt-3">
<h1>System Users</h1>
<div class="card">
<table style="width:100%; border-collapse: collapse;">
<thead>
<tr style="text-align:left; border-bottom: 2px solid #ddd;">
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $u): ?>
<tr style="border-bottom: 1px solid #eee;">
<td><?php echo htmlspecialchars($u['name']); ?></td>
<td><?php echo htmlspecialchars($u['email']); ?></td>
<form method="POST">
<td>
<select name="role">
<option value="user" <?php echo $u['role'] === 'user' ? 'selected' : ''; ?>>User</option>
<option value="admin" <?php echo $u['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
</select>
</td>
<td>
<input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
<button type="submit" name="update_role" class="btn" style="padding:5px 10px;">Update</button>
</td>
</form>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</section>
</main>
<?php require_once 'includes/footer.php'; ?>