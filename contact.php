<?php
require 'db.php';
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (full_name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$full_name, $email, $subject, $message]);
    $sent = true;
}

require 'header.php';
?>

<div class="bg-gradient-to-r from-kalinga-800 to-kalinga-600 text-white py-16 px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl font-extrabold">Get in Touch with Kalinga</h1>
    <p class="mt-2 text-kalinga-100 max-w-xl mx-auto text-sm">Have questions about pet adoption, volunteering, or donations? We would love to hear from you.</p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-2xl font-bold text-gray-900">Send Us a Message</h3>

            <?php if ($sent): ?>
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-semibold">
                    <i class="fa-solid fa-circle-check mr-1"></i> Thank you! Your message has been sent to our Mamburao shelter staff.
                </div>
            <?php endif; ?>

            <form method="POST" action="contact.php" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Your Full Name</label>
                    <input type="text" name="full_name" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Juan Dela Cruz">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Email Address</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="juan@gmail.com">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Subject</label>
                    <input type="text" name="subject" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Adoption Inquiry / Volunteering">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Message</label>
                    <textarea name="message" rows="4" required class="w-full px-4 py-3 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-kalinga-500" placeholder="Type your message here..."></textarea>
                </div>
                <button type="submit" class="w-full py-3 bg-kalinga-600 text-white font-bold rounded-xl shadow hover:bg-kalinga-700 transition">Send Message</button>
            </form>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
                <h3 class="text-2xl font-bold text-gray-900">Shelter Information</h3>
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-kalinga-100 text-kalinga-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <p class="font-bold text-gray-900">Shelter Location</p>
                            <p>Barangay Tayamaan / Payompon, Mamburao, Occidental Mindoro, Philippines</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-kalinga-100 text-kalinga-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <p class="font-bold text-gray-900">Email Us</p>
                            <p>support@kalingapets.org</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-kalinga-100 text-kalinga-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <p class="font-bold text-gray-900">Helpline</p>
                            <p>+63 912 345 6789 / (043) 123-4567</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-kalinga-100 text-kalinga-600 rounded-xl flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <p class="font-bold text-gray-900">Visiting Hours</p>
                            <p>Monday – Saturday: 8:00 AM – 5:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>