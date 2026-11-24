<?php
require 'db.php';
require 'header.php';
?>

<div class="bg-gradient-to-r from-kalinga-800 to-kalinga-600 text-white py-16 px-4 sm:px-6 lg:px-8 text-center">
    <h1 class="text-4xl font-extrabold">About Kalinga</h1>
    <p class="mt-2 text-kalinga-100 max-w-2xl mx-auto text-sm sm:text-base">Care, protection, and nurturing for stray and abandoned animals in Mamburao, Occidental Mindoro.</p>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <span class="text-kalinga-600 font-bold text-sm tracking-widest uppercase">Our Core Purpose</span>
            <h2 class="text-3xl font-bold text-gray-900">Transforming Stray Animal Welfare in Occidental Mindoro</h2>
            <p class="text-gray-600 text-sm leading-relaxed">
                Kalinga was established to bridge the gap between rescued strays and compassionate families. Historically, local rescue efforts relied on manual paper logbooks and scattered social media posts. The Kalinga: Stray Pet Adoption System introduces a centralized digital platform to streamline rescue records, adoption applications, and shelter operations.
            </p>
            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <i class="fa-solid fa-shield-heart text-kalinga-600 text-xl mb-2"></i>
                    <h4 class="font-bold text-gray-900 text-sm">Protection & Care</h4>
                    <p class="text-xs text-gray-500 mt-1">Safe temporary shelter and veterinary treatment.</p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                    <i class="fa-solid fa-handshake-angle text-kalinga-600 text-xl mb-2"></i>
                    <h4 class="font-bold text-gray-900 text-sm">Transparent Process</h4>
                    <p class="text-xs text-gray-500 mt-1">Clear online application and visit scheduling.</p>
                </div>
            </div>
        </div>
        <div class="bg-white p-8 rounded-3xl shadow-md border border-kalinga-100 space-y-6">
            <h3 class="text-xl font-bold text-kalinga-800"><i class="fa-solid fa-bullseye mr-2"></i> Key Project Objectives</h3>
            <ul class="space-y-3 text-sm text-gray-700">
                <li class="flex items-start"><i class="fa-solid fa-circle-check text-kalinga-600 mt-1 mr-3"></i> Centralized digital database for animal profiles & medical records.</li>
                <li class="flex items-start"><i class="fa-solid fa-circle-check text-kalinga-600 mt-1 mr-3"></i> Public web interface to browse pets and submit applications electronically.</li>
                <li class="flex items-start"><i class="fa-solid fa-circle-check text-kalinga-600 mt-1 mr-3"></i> Administrative module for shelter staff to screen and review requests.</li>
                <li class="flex items-start"><i class="fa-solid fa-circle-check text-kalinga-600 mt-1 mr-3"></i> Post-adoption tracking to ensure lifelong welfare and support.</li>
            </ul>
        </div>
    </div>

    <div class="bg-kalinga-800 text-white p-10 rounded-3xl text-center space-y-6 shadow-xl">
        <h2 class="text-3xl font-bold">Ready to Meet Your New Best Friend?</h2>
        <p class="text-kalinga-100 max-w-xl mx-auto text-sm">Browse our 15 available rescued dogs and cats or visit our shelter facility in Mamburao today.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="adopt.php" class="px-6 py-3 bg-white text-kalinga-800 font-bold rounded-xl shadow hover:bg-kalinga-50 transition">Browse Available Pets</a>
            <a href="contact.php" class="px-6 py-3 bg-kalinga-700 text-white font-semibold rounded-xl border border-kalinga-500 hover:bg-kalinga-600 transition">Contact Shelter</a>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>