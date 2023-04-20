-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 10:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Computers'),
(2, 'Laptops'),
(3, 'Tablets'),
(4, 'Printers'),
(5, 'Headphones'),
(6, 'Speakers'),
(7, 'Cameras'),
(8, 'Microphones'),
(9, 'Gaming Consoles'),
(10, 'Smart Home Devices'),
(11, 'TVs'),
(12, 'Projectors'),
(13, 'VR Headsets'),
(14, 'Drones'),
(15, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `contact_query`
--

CREATE TABLE `contact_query` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_query`
--

INSERT INTO `contact_query` (`id`, `created`, `name`, `email`, `subject`, `message`) VALUES
(1, '2023-01-14 23:05:08', 'Daniel Pfeifhofer', 'daniel.pfeifhofer.98@gmail.com', 'Reservierung stornieren bitte', 'Habe kein Geld mehr. Danke!'),
(2, '2023-01-14 23:05:08', 'Daniel Holzner', 'daniel.pfeifhofer.98@gmail.com', 'Seven Summits', 'Servus');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `img_directory` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `created`, `title`, `text`, `img_directory`) VALUES
(30, '2023-01-15', 'Ein neues wunderschönes Jahr', 'Wir hoffen Sie sind alle gut in das neue Jahr gerutscht! Wir freuen uns schon auf Sie!\r\n\r\nEin frohes Neues wünscht Ihnen das ganze Hotel Springer Team!', '.\\..\\..\\uploads\\news\\63c45a49452126.36598813.jpg'),
(31, '2023-01-15', 'Zu Hause ist, wo die Berge sind!', 'Bergtage sind meine Lieblingstage\r\n\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '.\\..\\..\\uploads\\news\\63c45aa5c5b902.42836897.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `buyer_name` varchar(50) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `category_id`, `name`, `description`, `price`) VALUES
(2, 1, 1, 'Desktop Computer 2', 'Affordable desktop computer with AMD Ryzen processor and integrated graphics.', 499.99),
(3, 1, 1, 'Desktop Computer 3', 'High-end desktop computer with Intel Core i9 processor and Nvidia RTX graphics card.', 1999.99),
(4, 1, 1, 'Desktop Computer 4', 'Gaming desktop computer with AMD Ryzen processor and Nvidia GTX graphics card.', 1499.99),
(5, 1, 2, 'Laptop 1', 'Thin and light laptop with 11th gen Intel Core i5 processor and 14-inch display.', 799.99),
(6, 1, 2, 'Laptop 2', 'Mid-range laptop with AMD Ryzen 5 processor and 15.6-inch display.', 599.99),
(7, 1, 2, 'Laptop 3', 'Premium laptop with 11th gen Intel Core i7 processor and 4K touchscreen display.', 1499.99),
(8, 1, 2, 'Laptop 4', 'Gaming laptop with AMD Ryzen 7 processor and Nvidia RTX graphics card.', 1299.99),
(9, 1, 3, 'Tablet 1', 'Affordable Android tablet with 10-inch display and 32GB storage.', 149.99),
(10, 1, 3, 'Tablet 2', 'iPad Pro with 12.9-inch Liquid Retina XDR display and 5G connectivity.', 1099.99),
(11, 1, 3, 'Tablet 3', 'Microsoft Surface Pro 7 with Intel Core i5 processor and 8GB RAM.', 899.99),
(12, 1, 3, 'Tablet 4', 'Samsung Galaxy Tab S7 with 11-inch display and 128GB storage.', 749.99),
(13, 1, 4, 'Printer 1', 'All-in-one inkjet printer with wireless connectivity and automatic document feeder.', 149.99),
(14, 1, 4, 'Printer 2', 'Laser printer with fast printing speed and automatic duplex printing.', 199.99),
(15, 1, 4, 'Printer 3', 'Large-format photo printer with 8-color dye ink system and CD/DVD printing.', 799.99),
(16, 1, 4, 'Printer 4', 'Portable thermal label printer for home or office use.', 59.99),
(17, 1, 5, 'Headphones 1', 'Wireless over-ear headphones with noise cancelling and 30-hour battery life.', 299.99),
(18, 1, 5, 'Headphones 2', 'True wireless earbuds with active noise cancelling and touch controls.', 149.99),
(19, 1, 5, 'Headphones 3', 'Gaming headset with 7.1 surround sound and noise-cancelling microphone.', 99.99),
(20, 1, 5, 'Headphones 4', 'On-ear headphones with wired connection and foldable design.', 49.99),
(21, 1, 6, 'Speaker 1', 'Wireless smart speaker with Alexa voice control and 360-degree sound.', 199.99),
(22, 1, 6, 'Speaker 2', 'Portable Bluetooth speaker with IPX7 waterproof rating and 20-hour battery life.', 99.99),
(23, 1, 6, 'Speaker 3', 'Bookshelf speakers with 5.25-inch woofer and 1-inch tweeter for hi-fi audio.', 349.99),
(24, 1, 6, 'Speaker 4', 'Soundbar with Dolby Atmos and DTS:X support for immersive home theater audio.', 599.99),
(25, 1, 7, 'Camera 1', 'Mirrorless camera with 24.2MP APS-C sensor and 4K video recording.', 899.99),
(26, 1, 7, 'Camera 2', 'Compact point-and-shoot camera with 20.1MP sensor and 30x optical zoom.', 449.99),
(27, 1, 7, 'Camera 3', 'Professional-grade DSLR camera with 45.7MP full-frame sensor and 4K UHD video.', 2799.99),
(28, 1, 7, 'Camera 4', 'Action camera with 4K/60fps video recording and waterproof housing.', 299.99),
(29, 1, 8, 'Microphone 1', 'Condenser microphone with cardioid polar pattern for podcasting and voiceover.', 99.99),
(30, 1, 8, 'Microphone 2', 'Dynamic microphone with supercardioid polar pattern for live performance and recording.', 199.99),
(31, 1, 8, 'Microphone 3', 'USB microphone with bidirectional polar pattern for conference calls and interviews.', 149.99),
(32, 1, 8, 'Microphone 4', 'Lavalier microphone with omnidirectional polar pattern for mobile recording and streaming.', 49.99),
(33, 1, 9, 'Gaming Console 1', 'PlayStation 5 with 825GB SSD and DualSense wireless controller.', 499.99),
(34, 1, 9, 'Gaming Console 2', 'Xbox Series X with 1TB SSD and Xbox Wireless Controller.', 499.99),
(35, 1, 9, 'Gaming Console 3', 'Nintendo Switch with 6.2-inch touchscreen and Joy-Con controllers.', 299.99),
(36, 1, 9, 'Gaming Console 4', 'Retro gaming console with built-in 600 classic games and two wireless controllers.', 59.99),
(37, 1, 10, 'Smart Home Device 1', 'Smart thermostat with Wi-Fi connectivity and voice control.', 249.99),
(38, 1, 10, 'Smart Home Device 2', 'Smart security camera with 1080p HD video and two-way audio.', 99.99),
(39, 1, 10, 'Smart Home Device 3', 'Smart lighting kit with color-changing bulbs and app control.', 149.99),
(40, 1, 10, 'Smart Home Device 4', 'Smart plug with energy monitoring and voice control.', 29.99),
(41, 1, 11, 'TV 1', '4K UHD TV with HDR10+ and built-in Alexa voice control.', 699.99),
(42, 1, 11, 'TV 2', '8K QLED TV with 120Hz refresh rate and Dolby Vision IQ.', 3499.99),
(43, 1, 11, 'TV 3', 'OLED TV with Dolby Atmos and webOS smart platform.', 1999.99),
(44, 1, 11, 'TV 4', 'Budget LED TV with 720p HD resolution and HDMI connectivity.', 199.99),
(45, 1, 12, 'Projector 1', 'Full HD home theater projector with 3,000 lumens and 10,000:1 contrast ratio.', 699.99),
(46, 1, 12, 'Projector 2', 'Portable mini projector with 1080p support and built-in battery.', 299.99),
(47, 1, 12, 'Projector 3', 'Laser TV projector with 4K UHD resolution and 120-inch projection screen.', 2999.99),
(48, 1, 12, 'Projector 4', 'Outdoor movie projector with 720p HD resolution and 150-inch screen.', 499.99),
(49, 1, 13, 'VR Headset 1', 'Oculus Quest 2 all-in-one VR headset with 6DoF and hand tracking.', 299.99),
(50, 1, 13, 'VR Headset 2', 'HTC Vive Pro 2 with 5K resolution and 120Hz refresh rate.', 1399.99),
(51, 1, 13, 'VR Headset 3', 'PlayStation VR with motion controllers and VR Worlds game bundle.', 399.99),
(52, 1, 13, 'VR Headset 4', 'Windows Mixed Reality headset with inside-out tracking and motion controllers.', 499.99),
(53, 1, 14, 'Drone 1', 'DJI Mavic 2 Pro with 4K Hasselblad camera and 31-minute flight time.', 1499.99),
(54, 1, 14, 'Drone 2', 'Holy Stone HS100D with 1080p camera and GPS assisted flight.', 199.99),
(55, 1, 14, 'Drone 3', 'Autel Robotics EVO II with 8K camera and 40-minute flight time.', 1799.99),
(56, 1, 14, 'Drone 4', 'Mini drone with 720p camera and altitude hold mode for beginners.', 59.99),
(57, 1, 15, 'Accessory 1', 'Wireless keyboard and mouse combo with ergonomic design.', 49.99),
(58, 1, 15, 'Accessory 2', 'External hard drive with 2TB capacity and USB 3.0 interface.', 79.99),
(60, 1, 15, 'Accessory 4', 'Gaming mouse pad with RGB lighting and micro-textured surface.', 29.99);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` varchar(256) NOT NULL,
  `date_arrival` date DEFAULT NULL,
  `date_departure` date DEFAULT NULL,
  `menu` varchar(256) DEFAULT NULL,
  `has_pets` varchar(256) DEFAULT NULL,
  `availability` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `userID`, `price`, `created`, `type`, `date_arrival`, `date_departure`, `menu`, `has_pets`, `availability`) VALUES
(1, 20, 250, '2023-01-15 23:49:18', 'suite', '2023-01-19', '2023-01-20', 'breakfast', 'true', 'unavailable'),
(2, NULL, 250, '2023-01-15 19:27:11', 'suite', NULL, NULL, NULL, NULL, 'available'),
(3, NULL, 250, '2023-01-15 19:27:03', 'suite', NULL, NULL, NULL, NULL, 'available'),
(4, 20, 100, '2023-01-15 23:49:33', 'single_room', '2023-01-26', '2023-01-27', 'fullBoard', 'false', 'unavailable'),
(5, NULL, 100, '2023-01-15 19:23:18', 'single_room', NULL, NULL, NULL, NULL, 'available'),
(6, NULL, 100, '2023-01-15 19:23:18', 'single_room', NULL, NULL, NULL, NULL, 'available'),
(7, NULL, 100, '2023-01-15 19:23:18', 'single_room', NULL, NULL, NULL, NULL, 'available'),
(8, NULL, 160, '2023-01-15 19:23:18', 'double_room', NULL, NULL, NULL, NULL, 'available'),
(9, NULL, 160, '2023-01-15 19:23:18', 'double_room', NULL, NULL, NULL, NULL, 'available'),
(10, NULL, 160, '2023-01-15 19:23:18', 'double_room', NULL, NULL, NULL, NULL, 'available'),
(11, NULL, 160, '2023-01-15 19:23:18', 'double_room', NULL, NULL, NULL, NULL, 'available'),
(12, NULL, 160, '2023-01-15 19:23:18', 'double_room', NULL, NULL, NULL, NULL, 'available'),
(13, 20, 10, '2023-01-15 23:49:18', 'parking_open', '2023-01-19', '2023-01-20', NULL, NULL, 'unavailable'),
(14, NULL, 10, '2023-01-15 19:23:18', 'parking_open', NULL, NULL, NULL, NULL, 'available'),
(15, NULL, 10, '2023-01-15 19:23:18', 'parking_open', NULL, NULL, NULL, NULL, 'available'),
(16, NULL, 10, '2023-01-15 00:00:00', 'parking_open', NULL, NULL, NULL, NULL, 'available'),
(17, 20, 25, '2023-01-15 23:49:33', 'parking_roofed', '2023-01-26', '2023-01-27', NULL, NULL, 'unavailable'),
(18, NULL, 25, '2023-01-15 19:27:03', 'parking_roofed', NULL, NULL, NULL, NULL, 'available'),
(19, NULL, 25, '2023-01-15 00:00:00', 'parking_roofed', NULL, NULL, NULL, NULL, 'available'),
(20, NULL, 25, '2023-01-15 00:00:00', 'parking_roofed', NULL, NULL, NULL, NULL, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`) VALUES
(1, 'ABC Electronics', 'abcelectronics@example.com'),
(2, 'XYZ Technologies', 'xyztech@example.com'),
(3, 'Tech Planet', 'techplanet@example.com'),
(4, 'Gadget Zone', 'gadgetzone@example.com'),
(5, 'E-Tech Emporium', 'etech@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'active',
  `form_of_adress` varchar(256) NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `useremail` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `has_newsletter` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'customer',
  `seller_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `status`, `form_of_adress`, `name`, `surname`, `username`, `password`, `useremail`, `birth_date`, `has_newsletter`, `role`, `seller_id`) VALUES
(19, 'active', 'Herr', 'admin', 'admin', 'admin', '$2y$10$TonXUyREKJCg6oxw/zELVeu255snqz04FZa4k04/Ls1hwLdt.R5dG', 'admin@gmail.com', '2023-01-11', 'false', 'administrator', NULL),
(20, 'active', 'Herr', 'Reinhold', 'Messner', 'reinhold', '$2y$10$8i04ftZHS/AxADuyJ45.FumMFOhFJQTeLkPeGU7TaZX13ic1l5rxm', 'reinhold@gmail.com', '2023-01-09', 'false', 'customer', NULL),
(21, 'active', 'Herr', 'raffi', 'raffi', 'raffi', '$2y$10$r4qu.wXDpygFFLpVXCT1yeT25GRzKUpbfkviBTvHWwgCrjVpMUP1W', 'raffi@gmail.com', '2023-03-11', 'false', 'customer', NULL),
(22, 'active', 'Herr', 'Firma', 'ABC Electronics', 'ABC Electronics', '$2y$10$XBXZ0D1xSn31/1mFtdxGuu7FMvLhxhIm5IgQ/rBJFza4yurkgq9Ay', 'abcelectronics@example.com', '1909-02-22', 'false', 'seller', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_query`
--
ALTER TABLE `contact_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seller_id` (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact_query`
--
ALTER TABLE `contact_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
