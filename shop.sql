-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 okt 2017 om 08:57
-- Serverversie: 5.7.11
-- PHP-versie: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `created`, `modified`, `status`) VALUES
(109, 1, 61.00, '2017-10-05 09:55:29', '2017-10-05 09:55:29', '1'),
(110, 3, 158.50, '2017-10-05 10:41:49', '2017-10-05 10:41:49', '1'),
(111, 1, 80.50, '2017-10-05 12:05:45', '2017-10-05 12:05:45', '1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(117, 109, 50, 1),
(118, 109, 46, 2),
(119, 110, 51, 2),
(120, 110, 48, 4),
(121, 110, 50, 1),
(122, 111, 48, 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_desc` text NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_desc`, `product_category`, `image_name`) VALUES
(49, 'Absolut Vodka', '11.95', 'Absolut Vodka 70ML || 40% vol.', 'Vodka', 'Absolut-Vodka-70ml.png'),
(50, 'Smirnoff Premium Vodka', '22.00', 'Smirnoff Premium Vodka 70ML || 40% vol', 'Vodka', 'Smirnoff__Premium_Vodka_70cl.png'),
(51, 'Closdubois', '30.00', 'Closdubois wijn 70ML || 12.5% vol', 'Wijn', 'CLOSDUBOIS.png'),
(46, 'Heineken 24 flesjes', '14.00', 'Heineken bier 24 flesjes 300ML', 'Bier', 'heinekenBtl20pk.png'),
(48, 'Grolsch Pack 24x30CL', '15.00', '24 flesjes in een doos! 30CL per flesje!', 'Bier', 'grolsch_bottlePack_12x330ml.png'),
(53, 'Corona Bier', '6.95', 'Overheerlijk Corona bier | 5% Alc. | 33CL Vol.', 'Bier', 'coronaBtl12pk.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `street`, `place`, `zipcode`, `province`, `country`, `password`, `phone`, `created`, `modified`, `status`, `admin`) VALUES
(1, 'Aaron', 'van den Berg', 'a.vdberg98@gmail.com', 'Straatnaam 12', 'Apeldoorn', '2122 AA', 'Gelderland', 'Nederland', '900150983cd24fb0d6963f7d28e17f72', '0612345678', '2017-05-18 18:41:56', '2017-05-18 18:41:56', '1', 1),
(2, 'Johan', 'de Boer', '1@1.nl', '', '', '', '', '', '698d51a19d8a121ce581499d7b701668', '11111', '2017-10-04 13:05:37', '2017-10-04 13:05:37', '1', 0),
(3, 'Test', 'Persoon', 'test@test.nl', 'Grote straat 2', 'Borculo', '2244 AB', 'Gelderland', 'Nederland', '47bce5c74f589f4867dbd57e9ca9f808', '12332111234', '2017-10-05 08:41:36', '2017-10-05 08:41:36', '1', 0),
(4, 'Kees', 'de Boer', 'keesdeboer@kees.nl', 'Straatnaam 2', 'Apeldoorn', '1122 AB', 'Gelderland', 'Nederland', '47bce5c74f589f4867dbd57e9ca9f808', '0655443322', '2017-10-05 09:16:52', '2017-10-05 09:16:52', '1', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexen voor tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT voor een tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
