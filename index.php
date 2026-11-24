<?php
require 'db.php';

// Fetch shelter statistics and featured pets directly from MySQL
$total_pets = $pdo->query("SELECT COUNT(*) FROM pets WHERE status = 'Available'")->fetchColumn();
$total_rehomed = 48; // Can be a dynamic count if you track adopted status
$featured_pets = $pdo->query("SELECT * FROM pets WHERE status = 'Available' LIMIT 3")->fetchAll();

require 'header.php';
?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-kalinga-800 to-kalinga-600 text-white py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">Occidental Mindoro Stray Initiative</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight">Give Homeless Pets a Second Chance at <span class="text-kalinga-200">Kalinga</span></h1>
            <p class="text-lg text-kalinga-100">Care, protection, and nurturing for abandoned dogs and cats across Mamburao and nearby barangays. Browse available rescues or schedule an in-person shelter visit today.</p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="adopt.php" class="px-6 py-3 bg-white text-kalinga-700 font-bold rounded-xl shadow-lg hover:bg-kalinga-50 transition transform hover:-translate-y-0.5"><i class="fa-solid fa-paw mr-2"></i> Browse Available Pets</a>
                <a href="about.php" class="px-6 py-3 bg-kalinga-700 text-white font-semibold rounded-xl border border-kalinga-500 hover:bg-kalinga-800 transition">Our Mission</a>
            </div>
        </div>
        <div class="relative flex justify-center">
            <div class="w-full max-w-md bg-white/10 p-6 rounded-3xl backdrop-blur-md border border-white/20 shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-lg text-white"><i class="fa-solid fa-heart-pulse mr-2 text-kalinga-200"></i> Shelter Quick Stats</h3>
                    <span class="text-xs bg-emerald-500 text-white px-2.5 py-1 rounded-full font-medium">Live MySQL Database</span>
                </div>
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="bg-white/10 p-4 rounded-2xl">
                        <p class="text-3xl font-extrabold text-white"><?= $total_pets ?></p>
                        <p class="text-xs text-kalinga-200 mt-1">Rescues in Shelter</p>
                    </div>
                    <div class="bg-white/10 p-4 rounded-2xl">
                        <p class="text-3xl font-extrabold text-white"><?= $total_rehomed ?></p>
                        <p class="text-xs text-kalinga-200 mt-1">Successfully Rehomed</p>
                    </div>
                </div>
                <div class="mt-4 p-3 bg-white/10 rounded-xl text-xs text-kalinga-100 flex items-center justify-between">
                    <span><i class="fa-solid fa-location-dot mr-1"></i> Mamburao, Occ. Mindoro</span>
                    <span class="font-semibold text-white">Open Mon-Sat</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Pets Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10">
        <div>
            <span class="text-kalinga-600 font-bold text-sm tracking-widest uppercase">Ready For Forever Homes</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-1">Featured Rescued Pets</h2>
        </div>
        <a href="adopt.php" class="mt-4 md:mt-0 text-kalinga-600 hover:text-kalinga-800 font-semibold flex items-center text-sm group">
            View All Pets <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($featured_pets as $pet): ?>
            <?php 
                $status_color = $pet['status'] === 'Available' ? 'bg-emerald-500' : ($pet['status'] === 'Fostered' ? 'bg-blue-500' : 'bg-amber-500'); 
            ?>
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
                    <a href="adopt.php?pet_id=<?= $pet['id'] ?>" class="py-2.5 px-3 bg-gray-100 text-gray-700 hover:bg-gray-200 font-semibold rounded-xl text-xs transition text-center flex items-center justify-center">View Profile</a>
                    <a href="adopt.php?pet_id=<?= $pet['id'] ?>" class="py-2.5 px-3 bg-kalinga-600 text-white hover:bg-kalinga-700 font-bold rounded-xl text-xs shadow transition text-center flex items-center justify-center">Adopt / Visit</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- How It Works Section -->
<section class="bg-white py-16 border-t border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-kalinga-600 font-bold text-sm tracking-widest uppercase">Simple & Transparent Process</span>
            <h2 class="text-3xl font-bold text-gray-900 mt-1">How Adoption Works</h2>
            <p class="text-gray-500 text-sm mt-2">Whether you prefer to apply online or visit our shelter in Mamburao, we make giving a stray a home seamless.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-kalinga-50 p-8 rounded-2xl border border-kalinga-100 text-center relative">
                <div class="w-14 h-14 bg-kalinga-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-6 shadow-md">1</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Browse & Select</h3>
                <p class="text-gray-600 text-sm">Explore complete profiles, medical histories, vaccination status, and temperaments of our 15 rescued dogs and cats.</p>
            </div>
            <div class="bg-kalinga-50 p-8 rounded-2xl border border-kalinga-100 text-center relative">
                <div class="w-14 h-14 bg-kalinga-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-6 shadow-md">2</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Apply or Schedule Visit</h3>
                <p class="text-gray-600 text-sm">Submit your adoption application online or book an appointment slip for an in-person shelter visit in Mamburao.</p>
            </div>
            <div class="bg-kalinga-50 p-8 rounded-2xl border border-kalinga-100 text-center relative">
                <div class="w-14 h-14 bg-kalinga-600 text-white rounded-2xl flex items-center justify-center text-xl font-bold mx-auto mb-6 shadow-md">3</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Screening & Welcome Home</h3>
                <p class="text-gray-600 text-sm">Our shelter staff reviews details, coordinates final paperwork, and welcomes your new furry family member home!</p>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>