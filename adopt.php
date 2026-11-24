<?php
require 'db.php';

// Handle Form Submission for Adoption or Shelter Visit
$success_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_application'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $ref_id = 'KLG-' . rand(100000, 999999);
    $user_id = $_SESSION['user_id'];
    $pet_id = $_POST['pet_id'];
    $app_type = $_POST['app_type'];
    $applicant_name = trim($_POST['applicant_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $visit_datetime = $_POST['visit_datetime'] ?: 'N/A (Online Application)';
    $household = $_POST['household'] ?: 'N/A';
    $reason = $_POST['reason'] ?: 'N/A';

    $stmt = $pdo->prepare("INSERT INTO applications (reference_id, user_id, pet_id, app_type, applicant_name, phone, address, visit_datetime, household, reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$ref_id, $user_id, $pet_id, $app_type, $applicant_name, $phone, $address, $visit_datetime, $household, $reason]);

    header("Location: dashboard.php?success=" . $ref_id);
    exit;
}

// Fetch Search and Filter Parameters
$search = $_GET['search'] ?? '';
$species = $_GET['species'] ?? '';
$status = $_GET['status'] ?? '';

$query = "SELECT * FROM pets WHERE (name LIKE ? OR breed LIKE ? OR location LIKE ?)";
$params = ["%$search%", "%$search%", "%$search%"];

if ($species !== '') {
    $query .= " AND species = ?";
    $params[] = $species;
}
if ($status !== '') {
    $query .= " AND status = ?";
    $params[] = $status;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$pets = $stmt->fetchAll();

// Check if a specific pet was selected for modal display
$selected_pet = null;
if (isset($_GET['pet_id'])) {
    $p_stmt = $pdo->prepare("SELECT * FROM pets WHERE id = ?");
    $p_stmt->execute([$_GET['pet_id']]);
    $selected_pet = $p_stmt->fetch();
}

require 'header.php';
?>

<div class="bg-gradient-to-r from-kalinga-800 to-kalinga-600 text-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-3xl font-extrabold">Meet Our Rescued Animals</h1>
        <p class="mt-2 text-kalinga-100 text-sm max-w-xl mx-auto">Every pet listed here is cared for, vaccinated, and waiting for a loving family across Occidental Mindoro.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Search & Filter Form -->
    <form method="GET" action="adopt.php" class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-96">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"><i class="fa-solid fa-search"></i></span>
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search by name, breed, or rescue location..." class="w-full pl-10 pr-4 py-2 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500">
        </div>
        <div class="flex flex-wrap gap-3 w-full md:w-auto">
            <select name="species" class="px-4 py-2 border rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-kalinga-500">
                <option value="">All Species</option>
                <option value="Dog" <?= $species === 'Dog' ? 'selected' : '' ?>>Dogs</option>
                <option value="Cat" <?= $species === 'Cat' ? 'selected' : '' ?>>Cats</option>
            </select>
            <select name="status" class="px-4 py-2 border rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-kalinga-500">
                <option value="">All Status</option>
                <option value="Available" <?= $status === 'Available' ? 'selected' : '' ?>>Available</option>
                <option value="Fostered" <?= $status === 'Fostered' ? 'selected' : '' ?>>Fostered</option>
                <option value="Medical Care" <?= $status === 'Medical Care' ? 'selected' : '' ?>>Medical Care</option>
            </select>
            <button type="submit" class="px-5 py-2 bg-kalinga-600 text-white font-semibold rounded-xl text-sm hover:bg-kalinga-700 transition">Filter</button>
        </div>
    </form>

    <!-- Pets Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        <?php if (empty($pets)): ?>
            <div class="col-span-full text-center py-12 text-gray-500">
                <i class="fa-solid fa-paw text-4xl mb-3 text-kalinga-300"></i>
                <p>No matching pets found in database.</p>
            </div>
        <?php else: ?>
            <?php foreach ($pets as $pet): ?>
                <?php $status_color = $pet['status'] === 'Available' ? 'bg-emerald-500' : ($pet['status'] === 'Fostered' ? 'bg-blue-500' : 'bg-amber-500'); ?>
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition flex flex-col justify-between">
                    <div>
                        <div class="relative h-56 overflow-hidden">
                            <img src="<?= htmlspecialchars($pet['image']) ?>" alt="<?= htmlspecialchars($pet['name']) ?>" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            <span class="absolute top-3 right-3 <?= $status_color ?> text-white text-xs font-bold px-3 py-1 rounded-full shadow"><?= htmlspecialchars($pet['status']) ?></span>
                            <span class="absolute top-3 left-3 bg-black/60 backdrop-blur-sm text-white text-xs font-semibold px-2.5 py-1 rounded-full"><i class="fa-solid fa-tag mr-1"></i> <?= htmlspecialchars($pet['species']) ?></span>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($pet['name']) ?></h3>
                                    <p class="text-xs text-gray-500"><?= htmlspecialchars($pet['breed']) ?> • <?= htmlspecialchars($pet['age']) ?></p>
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 bg-kalinga-50 text-kalinga-700 rounded-lg"><?= htmlspecialchars($pet['gender']) ?></span>
                            </div>
                            <p class="text-xs text-gray-600"><i class="fa-solid fa-location-dot text-kalinga-600 mr-1"></i> <?= htmlspecialchars($pet['location']) ?></p>
                            <p class="text-xs text-gray-700 bg-gray-50 p-2.5 rounded-xl border border-gray-100">"<?= htmlspecialchars($pet['temperament']) ?>"</p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 grid grid-cols-2 gap-3">
                        <a href="adopt.php?pet_id=<?= $pet['id'] ?>#petModal" class="py-2.5 px-3 bg-gray-100 text-gray-700 hover:bg-gray-200 font-semibold rounded-xl text-xs transition text-center flex items-center justify-center">View Profile</a>
                        <a href="adopt.php?pet_id=<?= $pet['id'] ?>#adoptModal" class="py-2.5 px-3 bg-kalinga-600 text-white hover:bg-kalinga-700 font-bold rounded-xl text-xs shadow transition text-center flex items-center justify-center">Adopt / Visit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- PET PROFILE & ADOPTION APPLICATION MODAL -->
<?php if ($selected_pet): ?>
<div class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-xl w-full overflow-hidden shadow-2xl my-8 p-6 sm:p-8 space-y-6">
        <div class="flex justify-between items-center border-b pb-4">
            <div>
                <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($selected_pet['name']) ?> (<?= htmlspecialchars($selected_pet['pet_code']) ?>)</h3>
                <p class="text-xs text-gray-500"><?= htmlspecialchars($selected_pet['breed']) ?> • <?= htmlspecialchars($selected_pet['age']) ?></p>
            </div>
            <a href="adopt.php" class="text-gray-400 hover:text-gray-600 text-xl"><i class="fa-solid fa-xmark"></i></a>
        </div>

        <div class="space-y-4 text-xs bg-gray-50 p-4 rounded-2xl border">
            <p><strong>Medical:</strong> <?= htmlspecialchars($selected_pet['medical']) ?></p>
            <p><strong>Notes:</strong> <?= htmlspecialchars($selected_pet['notes']) ?></p>
        </div>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl text-center space-y-3">
                <p class="text-xs font-semibold text-amber-900">Please log in to submit an adoption application or schedule a shelter visit for <?= htmlspecialchars($selected_pet['name']) ?>.</p>
                <div class="flex justify-center gap-3">
                    <a href="login.php" class="px-4 py-2 bg-kalinga-600 text-white font-bold rounded-xl text-xs">Log In</a>
                    <a href="register.php" class="px-4 py-2 bg-white border border-kalinga-600 text-kalinga-600 font-bold rounded-xl text-xs">Register</a>
                </div>
            </div>
        <?php else: ?>
            <form method="POST" action="adopt.php" class="space-y-4">
                <input type="hidden" name="pet_id" value="<?= $selected_pet['id'] ?>">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Application Type</label>
                    <select name="app_type" id="app_type" onchange="toggleFields()" class="w-full px-4 py-2.5 border rounded-xl text-sm bg-white">
                        <option value="Online Adoption">Online Adoption Application</option>
                        <option value="Shelter Visit">Schedule In-Person Shelter Visit</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Full Legal Name</label>
                        <input type="text" name="applicant_name" value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>" required class="w-full px-4 py-2.5 border rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Contact Number</label>
                        <input type="text" name="phone" value="<?= htmlspecialchars($_SESSION['user_phone'] ?? '') ?>" required class="w-full px-4 py-2.5 border rounded-xl text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Complete Address</label>
                    <input type="text" name="address" value="<?= htmlspecialchars($_SESSION['user_address'] ?? '') ?>" required class="w-full px-4 py-2.5 border rounded-xl text-sm">
                </div>
                <div id="visit_box" class="hidden">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Preferred Shelter Visit Date & Time</label>
                    <input type="datetime-local" name="visit_datetime" class="w-full px-4 py-2.5 border rounded-xl text-sm">
                </div>
                <div id="adopt_box" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Household Type & Living Situation</label>
                        <input type="text" name="household" placeholder="Owned home, fenced yard" class="w-full px-4 py-2.5 border rounded-xl text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Reason for Adopting</label>
                        <textarea name="reason" rows="2" placeholder="Why do you want to adopt?" class="w-full px-4 py-2.5 border rounded-xl text-sm"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit_application" class="w-full py-3 bg-kalinga-600 text-white font-bold rounded-xl shadow hover:bg-kalinga-700 transition">Submit Request</button>
            </form>
            <script>
                function toggleFields() {
                    const type = document.getElementById('app_type').value;
                    document.getElementById('visit_box').classList.toggle('hidden', type !== 'Shelter Visit');
                    document.getElementById('adopt_box').classList.toggle('hidden', type === 'Shelter Visit');
                }
            </script>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php require 'footer.php'; ?>