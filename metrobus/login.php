<?php
$pageTitle = 'Login - MetroBus Johannesburg';
require_once 'includes/header.php';
$message = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
if (loginUser($email, $password)) {
    header("Location: index.php");
    exit();
    } else {
    $message = "Invalid email or password.";
    }
}
?>
<?php if (!empty($message)): ?>
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
    <?php echo $message; ?>
    </div>
    <?php endif; ?>
    <main>
    <section class="container mt-3">
    <div class="grid grid-2">
    <div class="card">
<h2>Login to Your Account</h2>
    <?php if ($message): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST">
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    </div>
    <div class="form-group">
    <label>
    <input type="checkbox" name="remember"> Remember me
    </label>
    </div>
    <button type="submit" class="btn">Login</button>
    </form>
    <div class="mt-2">
<p>Don't have an account? <a href="register.php">Register here</a></p>
    <p><a href="forgot_password.php">Forgot your password?</a></p>
    </div>
    </div>
    <div class="card">
    <h2>Why Login?</h2>
    <ul>
    <li>Save favorite routes</li>
    <li>Access trip history</li>
    <li>Receive personalized notifications</li>
    <li>Quick access to saved trips</li>
    <li>Priority customer support</li>
    </ul>
    <div class="mt-2">
    <a href="register.php" class="btn btn-secondary">Create Account</a>
    </div>
    </div>
    </div>
    </section>
</main>
<style>
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    body.dark-mode .alert-error {
        background-color: #2a1a1a;
        color: #e0a0a0;
        border-color: #5a2a2a;
    }
</style>
<?php require_once 'includes/footer.php'; ?>