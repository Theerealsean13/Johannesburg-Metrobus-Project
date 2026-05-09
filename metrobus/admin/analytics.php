<?php
$pageTitle = 'Analytics - MetroBus Admin';
require_once '../includes/header.php';
require_once '../includes/auth.php';
if (!isAdmin()) {
header('Location: ../index.php');
exit;
}
require_once '../includes/db.php';
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$routeCount = $pdo->query("SELECT COUNT(*) FROM routes")->fetchColumn();
$feedbackCount = $pdo->query("SELECT COUNT(*) FROM feedback")->fetchColumn();
$avgRating = $pdo->query("SELECT AVG(rating) FROM feedback")->fetchColumn();
?>
<main>
  <section class="container mt-3">
  <h1>Analytics Dashboard</h1>
  <p>Key metrics and insights for MetroBus operations.</p>
    <div class="grid grid-4">
    <div class="card text-center">
    <h3><?php echo $userCount; ?></h3>
    <p>Registered Users</p>
    </div>
    <div class="card text-center">
    <h3><?php echo $routeCount; ?></h3>

    <p>Total Routes</p>
    </div>
    <div class="card text-center">
    <h3><?php echo $feedbackCount; ?></h3>

    <p>Feedback Submissions</p>
    </div>
    <div class="card text-center">
    <h3><?php echo number_format($avgRating, 1); ?>/5</h3>
    <p>Average Rating</p>
    </div>

    </div>
    <div class="card mt-3">
    <h2>Usage Statistics</h2>
    <div id="charts-placeholder" style="height: 400px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
    <p>Interactive charts would be displayed here (Chart.js integration)</p>
    </div>
    </div>
    <div class="card mt-3">
            
    <h2>Recent Feedback</h2>
    <div id="recent-feedback-admin">
    <div class="loading"></div>
    </div>
    </div>
    </section>
    </main>
    <script>

    document.addEventListener('DOMContentLoaded', function() {
        fetch('../api/get_recent_feedback.php')
        .then(response => response.json())
        .then(data => {
        const container = document.getElementById('recent-feedback-admin');
        if (data.success && data.feedback.length > 0) {
        let html = '<div class="grid grid-2">';
        data.feedback.forEach(item => {
        html += `
        <div class="card">
        <div class="feedback-rating">${'★'.repeat(item.rating)}${'☆'.repeat(5-item.rating)}</div>
        <p><strong>${item.category}:</strong> ${item.message.substring(0, 100)}${item.message.length > 100 ? '...' : ''}</p>
        <small>By ${item.name} on ${new Date(item.created_at).toLocaleDateString()}</small>
        </div>
        `;
        });
        html += '</div>';
        container.innerHTML = html;
        } else {
        container.innerHTML = '<p>No recent feedback.</p>';
        }
        })
        .catch(error => {
         console.error('Error loading feedback:', error);
         document.getElementById('recent-feedback-admin').innerHTML = '<p>Error loading feedback.</p>';
        });
    });
</script>
<?php require_once '../includes/footer.php'; ?>