<?php
$pageTitle = 'Notices - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/db.php';
$stmt = $pdo->query("SELECT * FROM notices ORDER BY created_at DESC");
$notices = $stmt->fetchAll();
?>
<main>
<section class="container mt-3">
<h1>Service Notices & Alerts</h1>
<p>Stay informed about route changes, service disruptions, and system updates.</p>
<div id="notices-container" class="grid grid-1 mt-2">
<?php if (empty($notices)): ?>
<div class="card text-center">
<h3>No active notices</h3>
<p>All MetroBus services are operating normally.</p>
</div>
<?php else: ?>
<?php foreach ($notices as $notice): ?>
<?php 
$borderColor = '#0052CC';
if ($notice['category'] === 'Alert') $borderColor = '#dc3545';
if ($notice['category'] === 'Maintenance') $borderColor = '#ffc107';
?>
<div class="card mb-2" style="border-left: 4px solid <?php echo $borderColor; ?>;">
<div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.5rem;">
<h3 style="margin: 0;"><?php echo htmlspecialchars($notice['title']); ?></h3>
<span class="status-badge" style="background-color: <?php echo $borderColor; ?>; color: <?php echo $notice['category'] === 'Maintenance' ? '#000' : '#fff'; ?>;">
<?php echo htmlspecialchars($notice['category']); ?>
</span>
</div>
<p style="color: #666; font-size: 0.85rem; margin-bottom: 1rem;">Posted: <?php echo date('F j, Y, g:i a', strtotime($notice['created_at'])); ?></p>
<p style="margin: 0;"><?php echo nl2br(htmlspecialchars($notice['content'])); ?></p>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</section>
</main>
<?php require_once 'includes/footer.php'; ?>