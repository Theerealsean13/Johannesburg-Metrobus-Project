<?php
$pageTitle = 'Admin Dashboard - MetroBus Johannesburg';
require_once '../includes/header.php';
require_once '../includes/auth.php';
if (!isAdmin()) {
header('Location: ../index.php');
exit;
}
require_once '../includes/db.php';
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$routeCount = $pdo->query("SELECT COUNT(*) FROM routes WHERE status = 'active'")->fetchColumn();
$feedbackCount = $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
$noticeCount = $pdo->query("SELECT COUNT(*) FROM notices")->fetchColumn();
?>
<main>
<section class="container mt-3">
<h1>Admin Dashboard</h1>
    <p>Welcome to the MetroBus administration panel.</p>
    <div class="grid grid-4">
    <div class="card text-center">
    <h3><?php echo $userCount; ?></h3>
    <p>Total Users</p>
    </div>
    <div class="card text-center">
    <h3><?php echo $routeCount; ?></h3>
    <p>Active Routes</p>
    </div>
    <div class="card text-center">
    <h3><?php echo $feedbackCount; ?></h3>
    <p>Feedback Submissions</p>
    </div>
    <div class="card text-center">
    <h3><?php echo $noticeCount; ?></h3>
    <p>Active Notices</p>
    </div>
    </div>
    <div class="card mt-3">
    <h2>Quick Actions</h2>
    <div class="grid grid-4">
    <a href="manage_routes.php" class="btn">Manage Routes</a>
    <a href="manage_users.php" class="btn">Manage Users</a>
    <a href="manage_notices.php" class="btn">Manage Notices</a>
    <a href="analytics.php" class="btn">View Analytics</a>
    </div>
    </div>
    <div class="card mt-3">
    <h2>Recent Activity</h2>
    <div id="recent-activity">
    <div class="loading"></div>
    </div>
    </div>
    </section>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    fetch('../api/get_recent_activity.php')
      .then(response => response.json())
      .then(data => {
        const container = document.getElementById('recent-activity');
        if (data.success) {
        let html = '<ul>';
        data.activities.forEach(activity => {
        html += `<li>${activity.description} - ${new Date(activity.timestamp).toLocaleString()}</li>`;
        });
    html += '</ul>';
    container.innerHTML = html;
    } else {
    container.innerHTML = '<p>No recent activity.</p>';
    }
    })
      .catch(error => {
       console.error('Error loading activity:', error);
       document.getElementById('recent-activity').innerHTML = '<p>Error loading activity.</p>';
    });
    });
</script>
<?php require_once '../includes/footer.php'; ?>