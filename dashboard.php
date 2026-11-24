<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch all applications submitted by the logged-in user joined with pet details
$stmt = $pdo->prepare("
    SELECT a.*, p.name AS pet_name, p.pet_code, p.image AS pet_image 
    FROM applications a 
    JOIN pets p ON a.pet_id = p.id 
    WHERE a.user_id = ? 
    ORDER BY a.created_at DESC
");
$stmt->execute([$_SESSION['user_id']]);
$my_apps = $stmt->fetchAll();

require 'header.php';
?>

<div class="bg-gradient-to-r from-kalinga-800 to-kalinga-600 text-white py-12 px-4">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-3xl font-extrabold">My Adoption Applications & Visits</h1>
            <p class="text-kalinga-100 text-sm mt-1">Track your submitted requests and print your shelter appointment slips.</p>
        </div>
        <a href="adopt.php" class="px-5 py-2.5 bg-white text-kalinga-700 font-bold rounded-xl text-sm shadow hover:bg-kalinga-50 transition">Adopt Another Pet</a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
    <?php if (isset($_GET['success'])): ?>
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl text-sm font-semibold flex items-center justify-between">
            <div>
                <i class="fa-solid fa-circle-check mr-2"></i> Application successfully submitted! Your Reference ID is: <strong><?= htmlspecialchars($_GET['success']) ?></strong>
            </div>
            <button onclick="window.print()" class="text-xs bg-emerald-600 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-emerald-700"><i class="fa-solid fa-print mr-1"></i> Print Slip</button>
        </div>
    <?php endif; ?>

    <?php if (empty($my_apps)): ?>
        <div class="bg-white p-12 rounded-3xl text-center border border-gray-100 shadow-sm space-y-4">
            <i class="fa-solid fa-clipboard-question text-5xl text-kalinga-300"></i>
            <h3 class="text-xl font-bold text-gray-800">No Applications Yet</h3>
            <p class="text-sm text-gray-500 max-w-md mx-auto">Browse our rescued pets in Mamburao to submit an adoption request or book a shelter visit appointment.</p>
            <a href="adopt.php" class="inline-block px-6 py-3 bg-kalinga-600 text-white font-bold rounded-xl text-sm shadow hover:bg-kalinga-700 transition">Browse Pets</a>
        </div>
    <?php else: ?>
        <?php foreach ($my_apps as $app): ?>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6">
                <img src="<?= htmlspecialchars($app['pet_image']) ?>" alt="<?= htmlspecialchars($app['pet_name']) ?>" class="w-full md:w-40 h-36 object-cover rounded-2xl">
                <div class="flex-grow space-y-2 text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                        <div>
                            <span class="text-xs font-bold text-kalinga-600"><?= htmlspecialchars($app['reference_id']) ?></span>
                            <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($app['pet_name']) ?> (<?= htmlspecialchars($app['pet_code']) ?>)</h3>
                        </div>
                        <span class="px-3 py-1 bg-amber-100 text-amber-800 font-bold rounded-full text-xs inline-block"><?= htmlspecialchars($app['status']) ?></span>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-gray-600">
                        <p><strong>Application Type:</strong> <?= htmlspecialchars($app['app_type']) ?></p>
                        <p><strong>Date Submitted:</strong> <?= htmlspecialchars($app['created_at']) ?></p>
                        <p><strong>Contact Number:</strong> <?= htmlspecialchars($app['phone']) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($app['address']) ?></p>
                        <?php if ($app['app_type'] === 'Shelter Visit'): ?>
                            <p class="col-span-2 text-kalinga-700 font-semibold"><i class="fa-solid fa-calendar-days mr-1"></i> Visit Schedule: <?= htmlspecialchars($app['visit_datetime']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="w-full md:w-auto flex flex-col gap-2">
                    <button onclick="window.print()" class="px-4 py-2.5 bg-kalinga-50 text-kalinga-700 font-semibold rounded-xl text-xs hover:bg-kalinga-100 transition"><i class="fa-solid fa-print mr-1"></i> Print Slip</button>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>