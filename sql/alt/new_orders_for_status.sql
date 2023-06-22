-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Mai 2023 um 14:43
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
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `new_orders`
--

CREATE TABLE `new_orders` (
  `id` int(11) NOT NULL,
  `buyer_name` varchar(50) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `new_orders`
--

INSERT INTO `new_orders` (`id`, `buyer_name`, `buyer_email`, `product_id`, `quantity`, `total_price`, `status`) VALUES
(1, 'Order Status', 'mail@mail.mail', 1234, 1, '123', 'delivered'),
(2, 'Order Status', 'mail@mail.mail', 1235, 1, '133', 'delivered'),
(3, '23', '23', 2, 1, '499', 'pending'),
(4, '23', '23', 8, 2, '2599', 'processing'),
(5, '23', '23', 10, 1, '1099', 'shipped'),
(6, '23', '23', 24, 2, '1199', 'delivered'),
(7, '23', '23', 24, 1, '599', 'cancelled'),
(8, '23', 'bestellstatus_test', 24, 1, '599', 'delivered'),
(9, '23', 'bestellstatus_test', 19, 1, '99', 'delivered'),
(10, '23', 'bestellstatus_test', 6, 1, '599', 'delivered'),
(11, '23', 'bestellstatus_test', 11, 1, '899', 'delivered');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `new_orders`
--
ALTER TABLE `new_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `new_orders`
--
ALTER TABLE `new_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
