<?php
require 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->fetch()) {
        $error = "This email is already registered. Please log in.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $email, $phone, $address, $password]);

        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $full_name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_phone'] = $phone;
        $_SESSION['user_address'] = $address;

        header("Location: index.php");
        exit;
    }
}

require 'header.php';
?>

<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl border border-kalinga-100 p-8 space-y-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-kalinga-600 text-white rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 shadow-md">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-gray-900">Create Adopter Account</h2>
            <p class="text-xs text-gray-500 mt-1">Join Kalinga to adopt or schedule visits in Mamburao</p>
        </div>

        <?php if ($error): ?>
            <div class="p-3 bg-red-50 text-red-700 text-xs rounded-xl border border-red-200"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="register.php" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Full Legal Name</label>
                <input type="text" name="full_name" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Juan Dela Cruz">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Email Address</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="juan@gmail.com">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Contact Number</label>
                    <input type="text" name="phone" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="09123456789">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Address (Barangay / Municipality)</label>
                <input type="text" name="address" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Brgy. Tayamaan, Mamburao">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Password</label>
                <input type="password" name="password" required minlength="6" class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Minimum 6 characters">
            </div>
            <button type="submit" class="w-full py-3 bg-kalinga-600 text-white font-bold rounded-xl shadow hover:bg-kalinga-700 transition">Complete Registration</button>
        </form>

        <p class="text-center text-xs text-gray-500 pt-2 border-t">
            Already registered? <a href="login.php" class="text-kalinga-600 font-bold hover:underline">Log In Here</a>
        </p>
    </div>
</div>

<?php require 'footer.php'; ?>