-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 11, 2023 at 06:48 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_price` float(10,2) NOT NULL,
  `item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `customer_email`, `item_name`, `item_price`, `item_price_currency`, `paid_amount`, `paid_amount_currency`, `txn_id`, `payment_status`, `created`, `modified`) VALUES
(1, 'Hiep Le', 'hieple@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PD7KociCd3jZw0IT04vyy', 'succeeded', '2023-05-05 16:03:57', '2023-05-05 16:03:57'),
(2, 'hiep', 'hiep99@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PIcKociCd3jZw0RerWE5X', 'succeeded', '2023-05-05 16:08:21', '2023-05-05 16:08:21'),
(3, 'hiep', 'hiep@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PLOKociCd3jZw0oyYvM8W', 'succeeded', '2023-05-05 16:11:15', '2023-05-05 16:11:15'),
(4, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PVDKociCd3jZw0uxZvZDw', 'succeeded', '2023-05-05 16:21:22', '2023-05-05 16:21:22'),
(5, 'bread2', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PX9KociCd3jZw0gVmoB2k', 'succeeded', '2023-05-05 16:23:23', '2023-05-05 16:23:23'),
(6, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PaTKociCd3jZw0svJnW2d', 'succeeded', '2023-05-05 16:26:46', '2023-05-05 16:26:46'),
(7, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4Pc9KociCd3jZw1Ui5Y5NY', 'succeeded', '2023-05-05 16:28:23', '2023-05-05 16:28:23'),
(8, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PkbKociCd3jZw1rJJXgL3', 'succeeded', '2023-05-05 16:37:10', '2023-05-05 16:37:10'),
(9, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4PloKociCd3jZw1xNu3KgF', 'succeeded', '2023-05-05 16:38:21', '2023-05-05 16:38:21'),
(10, 'bread2', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N4Q7aKociCd3jZw02BbabHj', 'succeeded', '2023-05-05 17:00:55', '2023-05-05 17:00:55'),
(11, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N5PedKociCd3jZw1bi2bdF9', 'succeeded', '2023-05-08 10:43:05', '2023-05-08 10:43:05'),
(12, 'Hiep Le', 'hieplecoding@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N6JcxKociCd3jZw0Bt9Njyc', 'succeeded', '2023-05-10 22:33:16', '2023-05-10 22:33:16'),
(13, 'bread', 'bread@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N6K8jKociCd3jZw0GxJPdzn', 'succeeded', '2023-05-10 23:02:00', '2023-05-10 23:02:00'),
(14, 'Hiep Le', 'hieplecoding@gmail.com', 'Demo Product', 25.00, 'USD', 25.00, 'usd', 'pi_3N6LVOKociCd3jZw1rcJj8e6', 'succeeded', '2023-05-11 00:29:23', '2023-05-11 00:29:23'),
(15, 'hiep', 'hieplecoding@gmail.com', 'Demo Product', 500.00, 'USD', 500.00, 'usd', 'pi_3N6Sr5FTxKF1xWdr0NTfLlB3', 'succeeded', '2023-05-11 08:20:27', '2023-05-11 08:20:27'),
(16, 'bread', 'bread@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6T1HFTxKF1xWdr1fCEmBux', 'succeeded', '2023-05-11 08:30:47', '2023-05-11 08:30:47'),
(17, 'hiep', 'hieplecoding@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6T38FTxKF1xWdr15UtEAcs', 'succeeded', '2023-05-11 08:32:45', '2023-05-11 08:32:45'),
(18, 'hiep', 'hiepvieost@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6T4QFTxKF1xWdr1NJX3K3Z', 'succeeded', '2023-05-11 08:34:11', '2023-05-11 08:34:11'),
(19, 'hiep', 'hiepvieost@gmail.com', 'Demo Product', 100.00, 'USD', 100.00, 'usd', 'pi_3N6T69FTxKF1xWdr1E1wR6XH', 'succeeded', '2023-05-11 08:35:53', '2023-05-11 08:35:53'),
(20, 'hiep', 'hieplecoding@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6T8CFTxKF1xWdr1hbA4TuG', 'succeeded', '2023-05-11 08:38:07', '2023-05-11 08:38:07'),
(21, 'hiep', 'hieplecoding@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6TATFTxKF1xWdr1PZi2QE7', 'succeeded', '2023-05-11 08:40:18', '2023-05-11 08:40:18'),
(22, 'hiep', 'hieplecoding@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6TFRFTxKF1xWdr1rnGdO3F', 'succeeded', '2023-05-11 08:45:27', '2023-05-11 08:45:27'),
(23, 'hiep', 'hiep@gmail.com', 'Demo Product', 99999.00, 'USD', 99999.00, 'usd', 'pi_3N6TH2FTxKF1xWdr1mi1YCoa', 'succeeded', '2023-05-11 08:47:06', '2023-05-11 08:47:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
