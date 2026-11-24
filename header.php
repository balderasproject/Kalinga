<?php
$current_page = basename($_SERVER['PHP_SELF']);
$app_count = 0;
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM applications WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $app_count = $stmt->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalinga: Stray Pet Adoption System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kalinga: {
                            50: '#fdf2f4', 100: '#fbe7eb', 200: '#f6d3d9',
                            300: '#f0b4be', 400: '#e58797', 500: '#d55f74',
                            600: '#c0445d', 700: '#a2354c', 800: '#872e41', 900: '#732a39',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-kalinga-50 text-gray-800 antialiased min-h-screen flex flex-col justify-between">

<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <a href="index.php" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-kalinga-600 rounded-full flex items-center justify-center text-white shadow-lg">
                    <i class="fa-solid fa-paw text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-bold tracking-tight text-kalinga-800">KALINGA</span>
                    <p class="text-xs text-gray-500 font-medium">Stray Pet Adoption System • Mamburao</p>
                </div>
            </a>

            <nav class="hidden md:flex items-center space-x-2 lg:space-x-6">
                <a href="index.php" class="px-3 py-2 rounded-lg text-sm <?= $current_page == 'index.php' ? 'font-semibold text-kalinga-600 bg-kalinga-100' : 'font-medium text-gray-600 hover:text-kalinga-600' ?>">Home</a>
                <a href="adopt.php" class="px-3 py-2 rounded-lg text-sm <?= $current_page == 'adopt.php' ? 'font-semibold text-kalinga-600 bg-kalinga-100' : 'font-medium text-gray-600 hover:text-kalinga-600' ?>">Adopt a Pet</a>
                <a href="about.php" class="px-3 py-2 rounded-lg text-sm <?= $current_page == 'about.php' ? 'font-semibold text-kalinga-600 bg-kalinga-100' : 'font-medium text-gray-600 hover:text-kalinga-600' ?>">About Us</a>
                <a href="contact.php" class="px-3 py-2 rounded-lg text-sm <?= $current_page == 'contact.php' ? 'font-semibold text-kalinga-600 bg-kalinga-100' : 'font-medium text-gray-600 hover:text-kalinga-600' ?>">Contact Us</a>
            </nav>

            <div class="hidden md:flex items-center space-x-3">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="px-4 py-2 text-sm font-medium text-kalinga-600 hover:bg-kalinga-100 rounded-lg transition">Login</a>
                    <a href="register.php" class="px-4 py-2 text-sm font-medium text-white bg-kalinga-600 hover:bg-kalinga-700 rounded-lg shadow-sm transition">Register</a>
                <?php else: ?>
                    <a href="dashboard.php" class="relative p-2 text-gray-600 hover:text-kalinga-600 transition" title="My Applications">
                        <i class="fa-solid fa-clipboard-list text-xl"></i>
                        <span class="absolute -top-1 -right-1 bg-kalinga-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold"><?= $app_count ?></span>
                    </a>
                    <div class="flex items-center space-x-2 bg-kalinga-100 px-3 py-1.5 rounded-full">
                        <i class="fa-solid fa-user-circle text-kalinga-700 text-lg"></i>
                        <span class="text-sm font-semibold text-kalinga-800"><?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    </div>
                    <a href="logout.php" class="text-gray-500 hover:text-red-600 text-sm font-medium px-2 py-1 transition" title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-lg"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<main class="flex-grow">