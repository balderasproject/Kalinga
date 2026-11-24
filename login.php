<?php
require 'db.php';
$error = '';
$success = '';

// Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_btn'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_phone'] = $user['phone'];
        $_SESSION['user_address'] = $user['address'];
        
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email address or password.";
    }
}

// Handle Password Reset Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_btn'])) {
    $reset_email = trim($_POST['reset_email']);
    $new_pass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$new_pass, $reset_email]);

    if ($stmt->rowCount() > 0) {
        $success = "Password successfully updated! You can now log in.";
    } else {
        $error = "No account found with that email address.";
    }
}

require 'header.php';
?>

<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-kalinga-100 p-8 space-y-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-kalinga-600 text-white rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 shadow-md">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-900">Log In to Kalinga</h2>
            <p class="text-xs text-gray-500 mt-1">Demo Account: <strong>juan.delacruz@gmail.com</strong> / <strong>kalinga123</strong></p>
        </div>

        <?php if ($error): ?>
            <div class="p-3 bg-red-50 text-red-700 text-xs rounded-xl border border-red-200"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="p-3 bg-emerald-50 text-emerald-700 text-xs rounded-xl border border-emerald-200"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="juan.delacruz@gmail.com">
            </div>
            <div>
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <button type="button" onclick="document.getElementById('resetBox').classList.toggle('hidden')" class="text-xs text-kalinga-600 font-semibold hover:underline">Forgot password?</button>
                </div>
                <input type="password" name="password" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="••••••••">
            </div>
            <button type="submit" name="login_btn" class="w-full py-3 bg-kalinga-600 text-white font-bold rounded-xl shadow hover:bg-kalinga-700 transition">Sign In</button>
        </form>

        <!-- Toggleable Password Reset Box -->
        <div id="resetBox" class="hidden pt-4 border-t space-y-3">
            <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wide">Recover Password</h4>
            <form method="POST" action="login.php" class="space-y-3">
                <input type="email" name="reset_email" required placeholder="Enter registered email" class="w-full px-3 py-2 border rounded-xl text-xs">
                <input type="password" name="new_password" required placeholder="Enter new password" class="w-full px-3 py-2 border rounded-xl text-xs">
                <button type="submit" name="reset_btn" class="w-full py-2 bg-gray-800 text-white font-bold rounded-xl text-xs hover:bg-gray-900 transition">Update Password</button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-500 pt-2 border-t">
            Don't have an account? <a href="register.php" class="text-kalinga-600 font-bold hover:underline">Create an Account</a>
        </p>
    </div>
</div>

<?php require 'footer.php'; ?>