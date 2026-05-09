<?php
$pageTitle = 'Register - MetroBus Johannesburg';
require_once 'includes/header.php';
require_once 'includes/auth.php';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

if ($password !== $confirmPassword) {
        $message = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $message = 'Password must be at least 6 characters long.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email address.';
    } else {
if (registerUser($name, $email, $password)) {
        $success = true;
        $message = 'Registration successful! You can now login.';
   } else {
        $message = 'Registration failed. Email may already be in use.';
    }
    }
}
?>
<main>
    <section class="container mt-3">
    <div class="grid grid-2">
    <div class="card">
    <h2>Create Your Account</h2>
    <?php if ($message): ?>
    <div class="alert <?php echo $success ? 'alert-success' : 'alert-error'; ?>">
    <?php echo htmlspecialchars($message); ?>
    </div>
    <?php endif; ?>
    <form method="POST">
    <div class="form-group">
    <label for="name">Full Name</label>
    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
    </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required minlength="6">
    <small>Minimum 6 characters</small>
    </div>
    <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div class="form-group">
    <label>
    <input type="checkbox" name="terms" required> I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
    </label>
    </div>
    <button type="submit" class="btn">Register</button>
    </form>
    <div class="mt-2">
    <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
    </div>
    <div class="card">
    <h2>Benefits of Registration</h2>
    <ul>
    <li>Save and manage favorite routes</li>
    <li>Receive personalized service updates</li>
    <li>Access to trip planning history</li>
    <li>Faster booking and reservations</li>
    <li>Exclusive offers and discounts</li>
    <li>Priority customer support</li>
    </ul>
    <div class="mt-2">
    <h4>Stay Connected</h4>
    <p>Get notified about:</p>
    <ul>
    <li>Route changes and delays</li>
    <li>New services and features</li>
    <li>Community events</li>
    <li>Safety alerts</li>
    </ul>
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

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    body.dark-mode .alert-success {
        background-color: #1a2a1a;
        color: #a0e0a0;
        border-color: #2a5a2a;
    }

    body.dark-mode .alert-error {
        background-color: #2a1a1a;
        color: #e0a0a0;
        border-color: #5a2a2a;
    }

    small {
        color: #666;
        font-size: 0.875rem;
    }

    body.dark-mode small {
        color: #aaa;
    }
</style>
<script>
    document.getElementById('confirm_password').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const confirmPassword = this.value;
if (password !== confirmPassword) {
        this.setCustomValidity('Passwords do not match');
        } else {
        this.setCustomValidity('');
        }
    });
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strength = calculatePasswordStrength(password);
        const existing = this.parentNode.querySelector('.password-strength');
if (existing) existing.remove();
if (password.length > 0) {
        const strengthDiv = document.createElement('div');
        strengthDiv.className = 'password-strength';
        strengthDiv.textContent = `Password strength: ${strength}`;
        strengthDiv.style.color = strength === 'Weak' ? '#dc3545' : strength === 'Medium' ? '#ffc107' : '#28a745';
        this.parentNode.appendChild(strengthDiv);
        }
    });
function calculatePasswordStrength(password) {
        let score = 0;
        if (password.length >= 6) score++;
        if (password.match(/[a-z]/)) score++;
        if (password.match(/[A-Z]/)) score++;
        if (password.match(/[0-9]/)) score++;
        if (password.match(/[^a-zA-Z0-9]/)) score++;
        if (score <= 2) return 'Weak';
        if (score <= 3) return 'Medium';
        return 'Strong';
    }
</script>
<?php require_once 'includes/footer.php'; ?>