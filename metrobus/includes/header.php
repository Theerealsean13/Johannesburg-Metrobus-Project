<?php
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($pageTitle) ? $pageTitle : 'MetroBus - Johannesburg Public Transport'; ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="assets/css/responsive.css?v=<?php echo time(); ?>">
<link rel="icon" href="assets/images/favicon.png" type="image/png">
<script src="assets/js/app.js" defer></script>
</head>
<body>
<header class="header">
<div class="container">
<div class="logo">
<a href="index.php" style="display: flex; align-items: center; gap: 10px;">
<img src="assets/images/logo1.png" alt="MetroBus Logo" class="header-logo">
<span>MetroBus</span>
</a>
</div>
<nav class="nav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="routes.php">Routes</a></li>
<li><a href="live_tracking.php">Live Tracking</a></li>
<li><a href="trip_planner.php">Trip Planner</a></li>
<li><a href="fares.php">Fares</a></li>
<li><a href="passenger_info.php">Info</a></li>
<li><a href="notices.php">Notices</a></li>
<li><a href="events.php">Events</a></li>
<li><a href="feedback.php">Feedback</a></li>
<?php if (isLoggedIn()): ?>
<li><a href="profile.php">Profile</a></li>
<li><a href="logout.php">Logout</a></li>
<?php else: ?>
<li><a href="login.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<?php endif; ?>
</ul>
</nav>
<div class="theme-toggle">
<button id="theme-toggle" aria-label="Toggle dark mode">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.59-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.59-1.591zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" fill="currentColor"/>
</svg>
</button>
</div>
<div class="mobile-menu-toggle">
<button id="mobile-menu-toggle-btn" aria-label="Toggle mobile menu">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
</svg>
</button>
</div>
</div>
</header>
<div class="mobile-nav" id="mobile-nav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="routes.php">Routes</a></li>
<li><a href="live_tracking.php">Live Tracking</a></li>
<li><a href="trip_planner.php">Trip Planner</a></li>
<li><a href="fares.php">Fares</a></li>
<li><a href="passenger_info.php">Info</a></li>
<li><a href="notices.php">Notices</a></li>
<li><a href="events.php">Events</a></li>
<li><a href="feedback.php">Feedback</a></li>
<?php if (isLoggedIn()): ?>
<li><a href="profile.php">Profile</a></li>
<li><a href="logout.php">Logout</a></li>
<?php else: ?>
<li><a href="login.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<?php endif; ?>
</ul>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
const mobileBtn = document.getElementById('mobile-menu-toggle-btn');
const mobileNav = document.getElementById('mobile-nav');
let menuOpen = false;
if(mobileBtn && mobileNav) {
mobileBtn.addEventListener('click', function(e) {
e.preventDefault();
menuOpen = !menuOpen;
if(menuOpen) {
mobileNav.style.left = '0';
} else {
mobileNav.style.left = '-100%';
}
});
}
const themeBtn = document.getElementById('theme-toggle');
if(themeBtn) {
if(localStorage.getItem('theme') === 'dark') {
document.body.classList.add('dark-mode');
}
themeBtn.addEventListener('click', function(e) {
e.preventDefault();
document.body.classList.toggle('dark-mode');
if(document.body.classList.contains('dark-mode')) {
localStorage.setItem('theme', 'dark');
} else {
localStorage.setItem('theme', 'light');
}
});
}
});
</script>