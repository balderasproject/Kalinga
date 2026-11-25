-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2026 at 07:39 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kalinga_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `app_type` enum('Online Adoption','Shelter Visit') NOT NULL,
  `applicant_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `visit_datetime` varchar(50) DEFAULT 'N/A',
  `household` varchar(255) DEFAULT 'N/A',
  `reason` text DEFAULT NULL,
  `status` enum('Pending Review','Approved','Completed','Rejected') DEFAULT 'Pending Review',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `reference_id`, `user_id`, `pet_id`, `app_type`, `applicant_name`, `phone`, `address`, `visit_datetime`, `household`, `reason`, `status`, `created_at`) VALUES
(1, 'KLG-362328', 2, 1, 'Online Adoption', 'Haziel Montabon', '0929 543 2155', 'Brgy. Payompon Mamburao Occidental Mindoro', 'N/A (Online Application)', 'Owned Home', 'I want to adopt kasi ang cute nila', 'Pending Review', '2026-11-14 02:33:01'),
(2, 'KLG-743037', 2, 2, 'Online Adoption', 'Haziel Montabon', '0929 543 2155', 'Brgy. Payompon Mamburao Occidental Mindoro', 'N/A (Online Application)', 'Owned Home', 'hsgfvhjbvkj', 'Pending Review', '2026-11-14 02:36:17'),
(3, 'KLG-576490', 3, 1, 'Shelter Visit', 'Shennel Balderas', '0912345678', 'Brgy. Payompon Mamburao Occidental Mindoro', '2026-11-14T13:50', 'N/A', 'N/A', 'Pending Review', '2026-11-14 05:50:10'),
(4, 'KLG-509784', 4, 1, 'Shelter Visit', 'Maryloi Yves Ricalde', '0929 543 2155', 'Brgy. Tangkalan Mmaburao', '2026-11-14T14:17', 'N/A', 'N/A', 'Pending Review', '2026-11-14 06:17:28'),
(5, 'KLG-409705', 4, 5, 'Online Adoption', 'Maryloi Yves Ricalde', '0929 543 2155', 'Brgy. Tangkalan Mmaburao', 'N/A (Online Application)', 'Fenced Yard', 'Gusto ko ng kasama sa bahay', 'Pending Review', '2026-11-14 06:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `full_name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Maryloi Yves Ricalde', 'maloichi@gmail.com', 'Adoption Inquiry', 'reserve me a pet breed is aspin', '2026-11-14 06:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `pet_code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `species` enum('Dog','Cat') NOT NULL,
  `breed` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `color` varchar(100) NOT NULL,
  `size` varchar(50) NOT NULL,
  `location` varchar(150) NOT NULL,
  `status` enum('Available','Fostered','Medical Care','Adopted') DEFAULT 'Available',
  `temperament` text NOT NULL,
  `medical` text NOT NULL,
  `notes` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `pet_code`, `name`, `species`, `breed`, `age`, `gender`, `color`, `size`, `location`, `status`, `temperament`, `medical`, `notes`, `image`) VALUES
(1, 'PET-001', 'Max', 'Dog', 'Aspin / Mixed', '1 year old', 'Male', 'Brown & White', 'Medium (14 kg)', 'Brgy. Tayamaan, Mamburao', 'Available', 'Friendly, energetic, great with children and other dogs.', 'Fully vaccinated (Rabies/DHPP), dewormed, neutered.', 'Rescued near Sitio Aroma market. Very playful and affectionate.', 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&w=600&q=80'),
(2, 'PET-002', 'Luna', 'Cat', 'Domestic Shorthair', '8 months old', 'Female', 'Calico / Orange-White', 'Small (3.5 kg)', 'Brgy. Payompon, Mamburao', 'Available', 'Calm, cuddly, indoor-trained, gentle purrer.', 'Vaccinated for Feline Distemper, dewormed, spayed.', 'Found seeking shelter outside local barangay hall during heavy rain.', 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&w=600&q=80'),
(3, 'PET-003', 'Bruno', 'Dog', 'Labrador Mix', '2 years old', 'Male', 'Black', 'Large (22 kg)', 'Brgy. Balansay, Mamburao', 'Available', 'Loyal, protective, calm disposition, obedient.', 'Up-to-date vaccinations, treated for tick-borne wellness, neutered.', 'Gentle giant who loves long walks and belly rubs.', 'https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&w=600&q=80'),
(4, 'PET-004', 'Bella', 'Dog', 'Aspin', '6 months old', 'Female', 'Golden Tan', 'Small-Medium (9 kg)', 'Brgy. Fatima, Mamburao', 'Available', 'Playful, curious, fast learner, loves treats.', 'First booster shots given, dewormed.', 'Rescued as a puppy with her siblings. Very affectionate.', 'https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?auto=format&fit=crop&w=600&q=80'),
(5, 'PET-005', 'Simba', 'Cat', 'Tabby', '1 year old', 'Male', 'Ginger Tabby', 'Medium (4.2 kg)', 'Brgy. Tayamaan, Mamburao', 'Fostered', 'Curious, independent yet affectionate when resting.', 'Fully vaccinated, dewormed, neutered.', 'Currently staying with a foster family in Tayamaan.', 'https://images.unsplash.com/photo-1533738363-b7f9aef128ce?auto=format&fit=crop&w=600&q=80'),
(6, 'PET-006', 'Rocky', 'Dog', 'Aspin / Shepherd Mix', '3 years old', 'Male', 'Brindle', 'Large (20 kg)', 'Brgy. Payompon, Mamburao', 'Available', 'Watchful, gentle with family, energetic outdoors.', 'Complete annual shots, dewormed, neutered.', 'Strong and healthy companion for active households.', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=600&q=80'),
(7, 'PET-007', 'Nala', 'Cat', 'Siamese Mix', '1.5 years old', 'Female', 'Cream & Dark Points', 'Small (3.8 kg)', 'Brgy. Balansay, Mamburao', 'Available', 'Vocal, elegant, loves sitting by windows.', 'Vaccinated and spayed.', 'Very graceful cat who enjoys quiet environments.', 'https://images.unsplash.com/photo-1513360371669-4adf3dd7dff8?auto=format&fit=crop&w=600&q=80'),
(8, 'PET-008', 'Cooper', 'Dog', 'Beagle Mix', '2.5 years old', 'Male', 'Tri-color (Tan, Black, White)', 'Medium (12 kg)', 'Brgy. Fatima, Mamburao', 'Medical Care', 'Friendly, scent-driven, loves exploring.', 'Undergoing skin treatment; recovering well.', 'Will be ready for adoption upon completion of topical treatment.', 'https://images.unsplash.com/photo-1505628346881-b72b27e84530?auto=format&fit=crop&w=600&q=80'),
(9, 'PET-009', 'Chloe', 'Cat', 'Domestic Medium Hair', '11 months old', 'Female', 'Fluffy Grey & White', 'Medium (4 kg)', 'Brgy. Tayamaan, Mamburao', 'Available', 'Sweet-natured, fluffy, loves gentle brushing.', 'Fully vaccinated, dewormed, spayed.', 'Extremely soft coat and very lap-oriented.', 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?auto=format&fit=crop&w=600&q=80'),
(10, 'PET-010', 'Charlie', 'Dog', 'Terrier Mix', '1.5 years old', 'Male', 'Scruffy Cream', 'Small (8 kg)', 'Brgy. Poblacion 1, Mamburao', 'Available', 'Cheerful, alert, loves playing fetch.', 'Fully vaccinated, dewormed, neutered.', 'Great apartment or small-yard dog with big personality.', 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?auto=format&fit=crop&w=600&q=80'),
(11, 'PET-011', 'Daisy', 'Dog', 'Aspin', '2 years old', 'Female', 'White with Brown Spots', 'Medium (13 kg)', 'Brgy. Tangkalan, Mamburao', 'Available', 'Sweet, calm, walks nicely on a leash.', 'Vaccinated, dewormed, spayed.', 'Rescued along Tangkalan road; warms up quickly to kind voices.', 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&w=600&q=80'),
(12, 'PET-012', 'Milo', 'Cat', 'Tuxedo Shorthair', '9 months old', 'Male', 'Black & White', 'Small (3.9 kg)', 'Brgy. Payompon, Mamburao', 'Available', 'Playful, loves feather toys, litter-trained.', 'Vaccinated, dewormed, neutered.', 'Dapper tuxedo markings and very sociable with visitors.', 'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?auto=format&fit=crop&w=600&q=80'),
(13, 'PET-013', 'Bantay', 'Dog', 'Native Aspin', '4 years old', 'Male', 'Tan & Black Muzzle', 'Medium (16 kg)', 'Brgy. San Luis, Mamburao', 'Available', 'Devoted, steady, excellent family companion.', 'Annual boosters complete, heartworm negative, neutered.', 'A loyal older boy looking for a peaceful home.', 'https://images.unsplash.com/photo-1561037404-61cd46aa615b?auto=format&fit=crop&w=600&q=80'),
(14, 'PET-014', 'Molly', 'Dog', 'Spitz / Aspin Mix', '1 year old', 'Female', 'Snow White', 'Small (7.5 kg)', 'Brgy. Poblacion 4, Mamburao', 'Fostered', 'Fluffy, bubbly, loves cuddling on couches.', 'Fully vaccinated, dewormed, spayed.', 'Currently in foster care; available for scheduled meet-and-greets.', 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?auto=format&fit=crop&w=600&q=80'),
(15, 'PET-015', 'Duke', 'Dog', 'Hound / Aspin Mix', '2 years old', 'Male', 'Reddish Brown', 'Large (21 kg)', 'Brgy. Talabaan, Mamburao', 'Available', 'Athletic, smart, loves outdoor space and running.', 'Vaccinated, dewormed, neutered.', 'Rescued near Talabaan river; thrives with active owners.', 'https://images.unsplash.com/photo-1534361960057-19889db9621e?auto=format&fit=crop&w=600&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `address`, `password`, `created_at`) VALUES
(1, 'Juan Dela Cruz', 'juan.delacruz@gmail.com', '09123456789', 'Brgy. Tayamaan, Mamburao', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2026-11-14 01:55:06'),
(2, 'Haziel Montabon', 'montabonhaziel@gmail.com', '0929 543 2155', 'Brgy. Payompon Mamburao Occidental Mindoro', '$2y$10$JEeX2tJzkTe9mtlrg.F1vebJg8ovK71YbvrouI5QmdWNzGXpT8wwe', '2026-11-14 02:29:01'),
(3, 'Shennel Balderas', 'shennelmarie@gmail.com', '0912345678', 'Brgy. Payompon Mamburao Occidental Mindoro', '$2y$10$KPhkyWH.2ZQwrt3kcu9CQuGNtyuCLGWBYUv40VCdjW24dnu/f8rjy', '2026-11-14 05:48:57'),
(4, 'Maryloi Yves Ricalde', 'maloichi@gmail.com', '0929 543 2155', 'Brgy. Tangkalan Mmaburao', '$2y$10$bFkrmNK0ytE56yF8KFe3n.6KrnWvlSjrrx2yCGmguAN6Q991af8Re', '2026-11-14 06:16:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference_id` (`reference_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pet_code` (`pet_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
