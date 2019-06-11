-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Cze 2019, 12:35
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
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `id` int(11) NOT NULL,
  `tresc` text COLLATE utf8_polish_ci NOT NULL,
  `odpa` text COLLATE utf8_polish_ci NOT NULL,
  `odpb` text COLLATE utf8_polish_ci NOT NULL,
  `odpc` text COLLATE utf8_polish_ci NOT NULL,
  `odpd` text CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `answer` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pytania`
--

INSERT INTO `pytania` (`id`, `tresc`, `odpa`, `odpb`, `odpc`, `odpd`, `answer`) VALUES
(1, 'wybierz pasujące tłumaczenie dla słowa \"płyta główna \"', 'motherbroad', 'main memory', 'hard disk drive', 'power supply unit', 'a'),
(2, 'wybierz niepasujące tłumaczenie dla słowa \"staż,praktyki\"', 'overtime', 'internship', 'job training', 'apprenticeship', 'a'),
(3, 'wybierz niepasujące tłumaczenie dla słowa \" urządzenie\"', 'device', 'appliance', 'equipment', 'random', 'd'),
(4, 'wybierz pasujące tłumaczenie dla słowa \"analiza\"', 'analyst', 'analyse', 'analysis', 'analytics', 'c'),
(5, 'wybierz pasujące tłumaczenie dla słowa \"usunąć\"', 'remove', 'delete', 'take out', 'broke', 'd'),
(6, 'przetłumacz na język angielski \"analityk bazy danych\"', 'network administrator', 'network architect', 'IT support officer', 'database analyst', 'd'),
(7, 'Wybierz odpowiedni opis słowa \"TRAFFIC\"', 'increasing the number of visitors to your site', 'the movement and actions of visitors to your site', 'information about a user and the sites they browse', 'information about where the visitors to your site are from', 'b'),
(8, 'przetłumacz na język angielski \"wprowadzanie danych\"', 'data coding', 'data entry', 'data tabulation', 'data validation', 'b'),
(9, 'przetłumacz na język angielski \"zewnętrzny dysk twardy\"\r\n', 'usb flash drive', 'hard disk', 'externa hard drive', 'server', 'c'),
(10, 'przetłumacz na język angielski \"szyfrować\"', 'encrypt', 'emerging', 'protect', 'provide', 'a'),
(11, 'Choose the type of data it works with for the company departament \"Finance\'  ', 'data about employees,training, recruitment needs', 'data about product specification,details and design', 'data about profits, tax, loans, shares and cash', 'data about volume of products sold', 'c'),
(12, 'przetłumacz na język angielski \"potwierdzenie\"', 'confirmation', 'rejection', 'complete', 'gateway', 'a'),
(13, 'Choose the description for a word \"a modem\" ', 'is an entrance to another network', 'allows wireless devices to connect to the network', 'send the digital signalfurther on in the network', 'modulates and demodulates the data into a digital or an analog signal', 'd'),
(14, 'przetłumacz na język angielski \"odłączony\"', 'disconnected', 'unplugged', 'checked', 'switched', 'b'),
(15, 'Choose the option how  reversible ratchet driver to use', 'used to prevent electrostatic discharge', 'used for inserting and removing fibre connectors in tight spaces', 'used to hold small objects', 'used for easy driving of screws and nuts ', 'd'),
(16, 'Software that replaces the user\'s search engine with its own', 'malware attack', 'spyware ', 'browser hijacker', 'virus', 'c'),
(17, 'Select the purpose for the security solution \"firewall\"', 'protects the system from public access', 'check the user is allowed to use system', 'blocks unauthorised access codes', 'prevents damage that viruses might cause', 'a'),
(18, 'Select the verb for the noun \"files\"', 'install', 'follow', 'transfer', 'report', 'c'),
(19, 'przetłumacz na język angielski \"zasilacz\"', 'keyboard', 'monitor', 'expansion card', 'power supply unit', 'd'),
(20, 'Choose the website analysis tool  for the description:\r\ninformation about where the visitor to your site are from', 'meta tag', 'visitor map', 'user profile', 'page optimisation', 'b');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
