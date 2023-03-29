-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3325
-- Erstellungszeit: 15. Jan 2023 um 23:54
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webtechdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contact_query`
--

CREATE TABLE `contact_query` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `contact_query`
--

INSERT INTO `contact_query` (`id`, `created`, `name`, `email`, `subject`, `message`) VALUES
(1, '2023-01-14 23:05:08', 'Daniel Pfeifhofer', 'daniel.pfeifhofer.98@gmail.com', 'Reservierung stornieren bitte', 'Habe kein Geld mehr. Danke!'),
(2, '2023-01-14 23:05:08', 'Daniel Holzner', 'daniel.pfeifhofer.98@gmail.com', 'Seven Summits', 'Servus');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `img_directory` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`id`, `created`, `title`, `text`, `img_directory`) VALUES
(30, '2023-01-15', 'Ein neues wunderschönes Jahr', 'Wir hoffen Sie sind alle gut in das neue Jahr gerutscht! Wir freuen uns schon auf Sie!\r\n\r\nEin frohes Neues wünscht Ihnen das ganze Hotel Springer Team!', '.\\..\\..\\uploads\\news\\63c45a49452126.36598813.jpg'),
(31, '2023-01-15', 'Zu Hause ist, wo die Berge sind!', 'Bergtage sind meine Lieblingstage\r\n\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '.\\..\\..\\uploads\\news\\63c45aa5c5b902.42836897.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservations`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `reservations`
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
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'active',
  `form_of_adress` varchar(256) NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `useremail` varchar(256) CHARACTER SET utf8 NOT NULL,
  `birth_date` date NOT NULL,
  `has_newsletter` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `status`, `form_of_adress`, `name`, `surname`, `username`, `password`, `useremail`, `birth_date`, `has_newsletter`, `role`) VALUES
(19, 'active', 'Herr', 'admin', 'admin', 'admin', '$2y$10$TonXUyREKJCg6oxw/zELVeu255snqz04FZa4k04/Ls1hwLdt.R5dG', 'admin@gmail.com', '2023-01-11', 'false', 'administrator'),
(20, 'active', 'Herr', 'Reinhold', 'Messner', 'reinhold', '$2y$10$8i04ftZHS/AxADuyJ45.FumMFOhFJQTeLkPeGU7TaZX13ic1l5rxm', 'reinhold@gmail.com', '2023-01-09', 'false', 'customer');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `contact_query`
--
ALTER TABLE `contact_query`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `contact_query`
--
ALTER TABLE `contact_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT für Tabelle `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
