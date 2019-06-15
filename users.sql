-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Cze 2019, 08:30
-- Wersja serwera: 10.3.15-MariaDB-100.cba
-- Wersja PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `juliasmile`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `liczba_dni` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `haslo`, `email`, `liczba_dni`) VALUES
(6, 'kot', '$2y$10$8YEBbZsXkFe5Ws6Uj9nBVutc4UrTZ1IpPrYu55xBBjIPl2sph1m/K', 'kot@kotecki.com', 6),
(3, 'rrrr', '$2y$10$0UhgqSbFO28UMUxsEvbvNOm8/QhSijL12pC.vUarP3YiDtS0L4PAq', 'eee@ffff.rrr', 0),
(4, 'qqq', '$2y$10$lHoREXHxkOIhVE15GQU9JuyF/Eui.z03e2dQDAl7R5SNEtsV5Dm.u', 'qq@qq.q', 0),
(5, 'aaa', '$2y$10$vIX14sERGWDd41IOUjIgg.LU0BNsGcZ2NK5pAns.bpihEEBcwXeMK', 'aaa@aaa.aaa', 0),
(1, 'aaa', 'aaa', 'aaa@aaa.aa', 4),
(2, '222', '222', '222@222.22', 2),
(19, 'julia', '$2y$10$3Druf9DnzQw8k979wnT4cO1dXlR5Ekc3gpxl/biC6UuIoBXsOUZAW', 'abuziarovajulia@gmail.com', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
