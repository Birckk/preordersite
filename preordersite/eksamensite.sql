-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1
-- Genereringstid: 13. 04 2018 kl. 13:06:57
-- Serverversion: 10.1.25-MariaDB
-- PHP-version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eksamensite`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `comments`
--

CREATE TABLE `comments` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `comments`
--

INSERT INTO `comments` (`cid`, `uid`, `date`, `message`, `news_id`) VALUES
(103, 4, '2018-04-11 18:02:26', 'ER DU VIMMER HVOR BLIVER HVOR BLIVER DET BARE FEDT\r\n', 16),
(104, 4, '2018-04-11 18:02:38', 'jeg glÃ¦der mig helt vildt', 16),
(105, 4, '2018-04-11 18:03:25', 'glÃ¦der mig til det er fikset\r\n', 17),
(106, 3, '2018-04-11 18:03:39', 'samme gÃ¦lder for meget bliver godt nÃ¥r det er done', 17),
(107, 3, '2018-04-11 18:03:49', 'wup wup det bliver awesome', 16),
(108, 3, '2018-04-11 18:04:12', 'Jeg har ventet pÃ¥ det her i super lang tid\r\n', 18),
(109, 4, '2018-04-12 09:04:39', 'q', 16),
(110, 4, '2018-04-12 09:06:18', 'ggg', 18),
(111, 4, '2018-04-12 10:16:05', 'g er cool f', 18),
(112, 4, '2018-04-12 11:20:01', '\"--\r\n', 18);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` text NOT NULL,
  `newsmessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `news`
--

INSERT INTO `news` (`news_id`, `date`, `title`, `newsmessage`) VALUES
(16, '2018-04-11 17:57:41', 'Nye Produkter pÃ¥ vej', 'Nye produkter er pÃ¥ vej til at blive sat tilgÃ¦ngelige sÃ¥ vent spÃ¦ndt'),
(17, '2018-04-11 17:58:09', 'website under konstruktion ', 'der har vÃ¦ret klager over fejl og andre problemer og de vil blive lÃ¸st hurtigst muligt'),
(18, '2018-04-11 17:58:54', 'Nyt website pÃ¥ vej vÃ¦r klar', 'det bliver vildt websitet er pÃ¥ vej og bliver snart klar');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `end_date`) VALUES
(1, 'Ultra bike 3000', './images/1.jpg', 799.00, '2018-04-13 16:50:34'),
(2, 'pentaphone II', './images/2.jpg', 599.00, '2018-04-11 16:50:27'),
(3, 'BESTWATCH', './images/3.jpg', 273.00, '2018-04-11 16:50:45');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `sales`
--

INSERT INTO `sales` (`sales_id`, `user_id`, `product_id`, `date`) VALUES
(10, 4, 1, '2018-04-10 14:40:18'),
(11, 4, 1, '2018-04-10 14:40:18'),
(12, 4, 2, '2018-04-10 14:40:18'),
(13, 4, 2, '2018-04-10 14:40:18'),
(14, 3, 3, '2018-04-10 15:36:59'),
(15, 7, 2, '2018-04-11 08:32:20'),
(16, 9, 2, '2018-04-11 10:31:25'),
(1222, 4, 1, '2018-04-12 12:46:47');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `is_admin`, `user_uid`, `user_pwd`) VALUES
(3, 'f', 'f', 'f@mail.com', 0, 'f', '$2y$10$aT2WqY2EHPfH8PqD5uqUS.mmAShu0UYtfbxiii3w.L.33pzu0QYFS'),
(4, 'q', 'q', 'q@mail.com', 0, 'q', '$2y$10$hIj79pZwI70aj0XcAV9JtOX3lXKrj6X7FzzX.CwtJU9I4gUdNIkhO'),
(5, 'a', 'a', 'a@mail.com', 0, 'a', '$2y$10$maxB8Lq1qbwcRE4kpAL2mOQT0pFHxsQlGMlmMpITg6OhdiMm9zEMy'),
(6, 'l', 'l', 'l@mail.dk', 0, 'l', '$2y$10$iYEhTT36KrKqjogbVDLlm.3c.l2eSXShw/xx/NsAj.VA5mXbFum82'),
(7, 'ah', 'ah', 'ah@mail.com', 0, 'ah', '$2y$10$p/hak03.iq4AyY9odYYzkOKc7HB4W3u9TBwci1o6dCS3z1kgzeSvS'),
(8, 'mr', 'awesome', 'admin@fakemail.com', 1, 'admin', '$2y$10$/ZwwTxGkihUt6XHIkEbqQe5HembhcL57DNA0IRfZzeiy.GvzK94uK'),
(9, 'tobias', 'birck', 't@mail.com', 0, 't', '$2y$10$CLNmHdb4snFI/vDr1QFHH.aFioylDQVCQnwv7BclUt3ruKl6zzZ8q'),
(11, 'anders', 'anders', 'anders@mail.com', 0, 'anders', '$2y$10$nrcVGbsOE3A8C5CrVC6JDuk3YddpMLYcjSgEm0IrVv.TpTeYjvylW'),
(12, 'kage', 'mand', 'kagemand@gmail.com', 0, 'kage', '$2y$10$113.RA9v/ah5sBiRpYjvvO9ZwVWfYYw7FwsBkSqw2oTmA/mZ.xU7S');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `uid` (`uid`);

--
-- Indeks for tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indeks for tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- Tilføj AUTO_INCREMENT i tabel `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tilføj AUTO_INCREMENT i tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tilføj AUTO_INCREMENT i tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1223;
--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Begrænsninger for tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
