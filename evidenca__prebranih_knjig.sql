-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2026 at 07:56 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 8.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kovacman_evidenca_knjig`
--

-- --------------------------------------------------------

--
-- Table structure for table `avtorji`
--

CREATE TABLE `avtorji` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `priimek` varchar(50) NOT NULL,
  `leto_rojstva` int(11) DEFAULT NULL,
  `drzava` varchar(50) DEFAULT NULL,
  `slika` varchar(255) DEFAULT 'default_avtor.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `avtorji`
--

INSERT INTO `avtorji` (`id`, `ime`, `priimek`, `leto_rojstva`, `drzava`, `slika`) VALUES
(1, 'George R.R.', 'Martin', 1948, 'ZDA', 'georgerrmartin.png'),
(2, 'J.K.', 'Rowling', 1965, 'Velika Britanija', 'J.K.-Rowling-2021-Photography-Debra-Hurford-Brown-scaled.jpg'),
(3, 'George', 'Orwell', 1903, 'Velika Britanija', 'George-Orwell-circa-1940.webp'),
(4, 'France', 'Prešeren', 1800, 'Slovenija', 'default_avtor.png'),
(5, 'Ivan', 'Cankar', 1876, 'Slovenija', 'default_avtor.png'),
(6, 'Stephen', 'King', 1947, 'ZDA', 'Stephen_King_at_the_2024_Toronto_International_Film_Festival_2_(cropped).jpg'),
(7, 'J.R.R.', 'Tolkien', 1892, 'Velika Britanija', 'J._R._R._Tolkien,_ca._1925.jpg'),
(8, 'Agatha', 'Christie', 1890, 'Velika Britanija', 'MV5BMTU3OTYzMzY4NV5BMl5BanBnXkFtZTcwMDIxOTIyOA@@._V1_.jpg'),
(9, 'Jane', 'Austen', 1775, 'Velika Britanija', 'default_avtor.png'),
(10, 'Drago', 'Jančar', 1948, 'Slovenija', 'stajerci-Img_00001622-800x1057.jpg'),
(11, 'France', 'Bevk', 1890, 'Slovenija', 'France_Bevk_1953.jpg'),
(14, 'Friedrich', 'Nietzsche', 1844, 'Nemčija', 'images (2).jfif');

-- --------------------------------------------------------

--
-- Table structure for table `knjige`
--

CREATE TABLE `knjige` (
  `id` int(11) NOT NULL,
  `naslov` varchar(150) NOT NULL,
  `leto_izdaje` int(11) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `dodana` timestamp NOT NULL DEFAULT current_timestamp(),
  `slika` varchar(255) DEFAULT 'default_knjiga.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `knjige`
--

INSERT INTO `knjige` (`id`, `naslov`, `leto_izdaje`, `opis`, `dodana`, `slika`) VALUES
(1, 'Igra prestolov (Pesem ledu in ognja)', 2001, 'Prva knjiga iz epske fantazijske serije o Zahodnjem.', '2026-06-08 15:22:22', '9789610131847.jpg'),
(2, 'Harry Potter in kamen modrosti', 1999, 'Prva knjiga v zbirki o mladem čarovniku.', '2026-06-08 15:22:22', '9789610118381.webp'),
(3, '1984', 1949, 'Kultni distopični roman o Velikem bratu.', '2026-06-08 15:22:22', '1984GeorgeOrwell.webp'),
(4, 'Poezije', 1847, 'Zbirka pesmi našega največjega pesnika.', '2026-06-08 15:22:22', 'default_knjiga.png'),
(5, 'Na klancu', 1902, 'Zgodba o siromašni družini in hrepenečem življenju.', '2026-06-08 15:22:22', 'default_knjiga.png'),
(6, 'Izžrebanec (The Shining)', 1977, 'Slavna grozljivka o izoliranem hotelu Overlook.', '2026-06-08 15:22:22', 'izzarevanje.jpg'),
(7, 'Gospodar prstanov: Bratovščina prstana', 1954, 'Začetek epskega potovanja po Srednjem svetu.', '2026-06-08 15:22:22', 'GP_Bratovščina-naslovnica-slo.jpg'),
(8, 'Umor na Orient ekspresu', 1934, 'Slavni primer detektiva Hercula Poirota.', '2026-06-08 15:22:22', 'Umor-na-Orient-ekspresu-naslovnica-1100-px.webp'),
(9, 'Prevzetnost in pristranost', 1813, 'Brezčasna ljubezenska zgodba o Elizabeth Bennet.', '2026-06-08 15:22:22', 'default_knjiga.png'),
(13, 'Skodelica kave', 1910, 'Skodelica kave je ena najbolj znanih črtic Ivana Cankarja iz zbirke Moje življenje. V njej pisatelj opisuje občutek neizmerne krivice in kesanja, ko je kot študent v svojem čemernem razpoloženju osorno zavrnil mater, ki mu je z ljubeznijo prinesla skodelico kave.', '2026-06-09 16:53:45', 'Skodelica.jpg'),
(18, 'test', 2222, 'ne vem', '2026-06-11 15:02:46', 'default_knjiga.png');

-- --------------------------------------------------------

--
-- Table structure for table `knjige_avtorji`
--

CREATE TABLE `knjige_avtorji` (
  `id` int(11) NOT NULL,
  `avtor_id` int(11) NOT NULL,
  `knjiga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `knjige_avtorji`
--

INSERT INTO `knjige_avtorji` (`id`, `avtor_id`, `knjiga_id`) VALUES
(21, 1, 1),
(23, 2, 2),
(24, 3, 3),
(4, 4, 4),
(5, 5, 5),
(25, 6, 6),
(32, 7, 7),
(26, 8, 8),
(28, 9, 9),
(22, 5, 13);

-- --------------------------------------------------------

--
-- Table structure for table `knjige_zanri`
--

CREATE TABLE `knjige_zanri` (
  `id` int(11) NOT NULL,
  `zanr_id` int(11) NOT NULL,
  `knjiga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `knjige_zanri`
--

INSERT INTO `knjige_zanri` (`id`, `zanr_id`, `knjiga_id`) VALUES
(21, 1, 1),
(23, 1, 2),
(24, 3, 3),
(4, 5, 4),
(5, 4, 5),
(25, 6, 6),
(32, 1, 7),
(26, 2, 8),
(28, 7, 9),
(22, 17, 13),
(20, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

CREATE TABLE `ocene` (
  `id` int(11) NOT NULL,
  `ocena` int(11) NOT NULL,
  `mnenje` mediumtext DEFAULT NULL,
  `ustvarjeno` timestamp NOT NULL DEFAULT current_timestamp(),
  `uporabnik_id` int(11) NOT NULL,
  `knjiga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_slovenian_as_ci;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`id`, `ocena`, `mnenje`, `ustvarjeno`, `uporabnik_id`, `knjiga_id`) VALUES
(2, 1, 'Učiteljica mi je dala enko pri predstavitvi te knjige!!!', '2026-06-11 14:14:11', 3, 13),
(5, 5, 'test', '2026-06-11 14:25:29', 2, 13),
(7, 5, 'Solza se mi je utrnila T_T', '2026-06-11 14:27:44', 1, 13),
(10, 2, 'Preveč temačno zame :(', '2026-06-11 14:37:50', 1, 1),
(11, 5, 'Super knjiga', '2026-06-12 15:02:18', 2, 1),
(12, 5, 'Učiteljica mi jo je priporočala nisem je še prebral, ampak predvidevam, da bo odlično!', '2026-06-12 16:15:12', 1, 3),
(13, 5, 'scary', '2026-06-13 16:33:11', 2, 6),
(14, 1, 'Nikoli bral samo predvidevam, da je slabo', '2026-06-13 19:14:17', 7, 2),
(15, 5, 'Ivan Cankar mi je ob Skodelici kave spremenil pogled na življenje.', '2026-06-13 19:19:11', 6, 13),
(16, 3, 'Na katerem\r\nklancu se to sploh\r\ndogaja?', '2026-06-14 16:42:50', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE `uporabniki` (
  `id` int(11) NOT NULL,
  `uporabnisko_ime` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `geslo_hash` varchar(255) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `priimek` varchar(50) NOT NULL,
  `datum_registracije` timestamp NOT NULL DEFAULT current_timestamp(),
  `vloga_id` int(11) NOT NULL,
  `slika` varchar(255) DEFAULT 'default_prof.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `uporabniki`
--

INSERT INTO `uporabniki` (`id`, `uporabnisko_ime`, `email`, `geslo_hash`, `ime`, `priimek`, `datum_registracije`, `vloga_id`, `slika`) VALUES
(1, 'SladkiJure12', 'jure202@gmail.com', '$2y$10$0JbDlm2IsnBAX7ZpmrAbheNFckibjs8Rntt5d6H9yXZpoNb0j1EyC', 'Jure', 'Primer', '2026-06-08 16:31:11', 2, 'SladekSladekJure.jpg'),
(2, 'admin', 'admin@gmail.com', '$2y$10$Gav7V0ZGHSJDgviRO20pc.lh3uhNWO6YDGVJNhuPuHxpzLdjOsLaG', 'Miran', 'Zevnik', '2026-06-09 14:19:04', 1, 'istockphoto-1446459788-612x612.jpg'),
(3, 'JohnDoe', 'JohnanDoe1999@gmail.com', '$2y$10$2dtdYiOek/kFOwwy7cmWOOlerqOfR41WrAdG2X9AqEMIo6XjYLUGq', 'Johan', 'Doe', '2026-06-11 13:24:31', 2, 'This_Man_original_drawing.jpg'),
(6, 'Roky', 'rok997582@gmail.com', '$2y$10$5rJZuQb7I4rRfyu1R7CTQ.PTrbR4pvhOEiceDiGfc8ASvXG0KjUO6', 'Rok', 'Marinšek', '2026-06-13 18:58:30', 2, 'default_prof.png'),
(7, 'Yaka', 'JakaKosir@gmail.com', '$2y$10$tGQRy0dK8LR4.fcllh7TPO3tGmyfBMFmJuVtRzfl4xA0QgIoBONgO', 'Jaka', 'Košir', '2026-06-13 19:04:06', 1, 'Jaka.png'),
(8, 'Jarazar', 'jarik12@gmail.com', '$2y$10$6EXIcxbQ/eBba.tnPvopFe52eD4o0tT1OIs/NqhYNzfgxENx0qrWe', 'Jaroslav', 'Zarochintcev', '2026-06-13 19:04:48', 2, 'default_prof.png');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik_knjige`
--

CREATE TABLE `uporabnik_knjige` (
  `id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `datum_zacetka` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `datum_konca` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ustvarjeno` timestamp NOT NULL DEFAULT current_timestamp(),
  `uporabnik_id` int(11) NOT NULL,
  `knjiga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `uporabnik_knjige`
--

INSERT INTO `uporabnik_knjige` (`id`, `status`, `datum_zacetka`, `datum_konca`, `ustvarjeno`, `uporabnik_id`, `knjiga_id`) VALUES
(1, 'berem', '2026-06-13 18:55:20', '0000-00-00 00:00:00', '2026-06-09 15:23:04', 2, 1),
(3, 'zelim_prebrati', '2026-06-11 12:54:53', '0000-00-00 00:00:00', '2026-06-11 12:54:53', 1, 7),
(4, 'berem', '2026-06-11 12:55:06', '0000-00-00 00:00:00', '2026-06-11 12:55:06', 1, 13),
(7, 'prebrano', '2026-06-13 13:28:49', '0000-00-00 00:00:00', '2026-06-12 15:38:21', 2, 4),
(8, 'zelim_prebrati', '2026-06-13 18:08:51', '0000-00-00 00:00:00', '2026-06-13 13:28:40', 2, 3),
(12, 'zelim_prebrati', '2026-06-13 19:17:55', '0000-00-00 00:00:00', '2026-06-13 19:17:55', 2, 6),
(13, 'zelim_prebrati', '2026-06-14 16:05:58', '0000-00-00 00:00:00', '2026-06-14 16:05:58', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `vloge`
--

CREATE TABLE `vloge` (
  `id` int(11) NOT NULL,
  `naziv_vloge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `vloge`
--

INSERT INTO `vloge` (`id`, `naziv_vloge`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `zanri`
--

CREATE TABLE `zanri` (
  `id` int(11) NOT NULL,
  `naziv_zanra` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_slovenian_ci;

--
-- Dumping data for table `zanri`
--

INSERT INTO `zanri` (`id`, `naziv_zanra`) VALUES
(1, 'Fantastika'),
(2, 'Kriminalka'),
(3, 'Znanstvena fantastika'),
(4, 'Klasični roman'),
(5, 'Poezija'),
(6, 'Grozljivka'),
(7, 'Romantika'),
(8, 'Zgodovinski roman'),
(9, 'Drama'),
(10, 'Psihološki roman'),
(11, 'Biografija / Avtobiografija'),
(12, 'Otroška literatura'),
(13, 'Mladinska literatura'),
(14, 'Strokovna literatura'),
(15, 'Potopis'),
(16, 'Dnevnik'),
(17, 'Črtica'),
(18, 'Triler'),
(19, 'Strip'),
(20, 'Manga'),
(22, 'Novela'),
(23, 'Pravljica'),
(24, 'Basen'),
(25, 'Legenda'),
(26, 'Satira'),
(27, 'Distopija'),
(28, 'Komedija'),
(29, 'Zgodovinska fikcija'),
(30, 'Mitologija'),
(31, 'Kulinarična literatura'),
(32, 'Poljudnoznanstvena literatura'),
(33, 'Osebna rast / Samopomoč'),
(34, 'Duhovnost'),
(35, 'Politični triler'),
(36, 'Esej'),
(37, 'Cyberpunk'),
(38, 'Steampunk'),
(39, 'Zgodovinski triler'),
(40, 'Pravni triler'),
(41, 'Medicinski triler'),
(42, 'Vojaški roman'),
(43, 'Avanturistični roman'),
(44, 'Western'),
(45, 'Epska fantastika'),
(46, 'Urbana fantastika'),
(47, 'Temna fantastika'),
(48, 'Mistični realizem'),
(49, 'Filozofski roman'),
(50, 'Socialni roman'),
(51, 'Umetnost'),
(52, 'Ekonomija'),
(53, 'Potovanja in vodniki'),
(54, 'Zdravje in medicina'),
(55, 'Šport'),
(56, 'Učbeniki'),
(57, 'Antologija'),
(58, 'Gledališka igra / Drama'),
(59, 'Humoristični esej');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avtorji`
--
ALTER TABLE `avtorji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knjige`
--
ALTER TABLE `knjige`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knjige_avtorji`
--
ALTER TABLE `knjige_avtorji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_knjiga_avtor` (`knjiga_id`,`avtor_id`),
  ADD KEY `AVTORJI_KNJIGE_AVTORJI` (`avtor_id`);

--
-- Indexes for table `knjige_zanri`
--
ALTER TABLE `knjige_zanri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_knjiga_zanr` (`knjiga_id`,`zanr_id`),
  ADD KEY `ZANRI_KNJIGE_ZANRI` (`zanr_id`);

--
-- Indexes for table `ocene`
--
ALTER TABLE `ocene`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_ocene_uporabnik_knjiga` (`uporabnik_id`,`knjiga_id`),
  ADD KEY `KNJIGE_OCENE` (`knjiga_id`);

--
-- Indexes for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_uporabnisko_ime` (`uporabnisko_ime`),
  ADD UNIQUE KEY `unq_email` (`email`),
  ADD KEY `VLOGA_UPORABNIKI` (`vloga_id`);

--
-- Indexes for table `uporabnik_knjige`
--
ALTER TABLE `uporabnik_knjige`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unq_uporabnik_knjiga` (`uporabnik_id`,`knjiga_id`),
  ADD KEY `KNJIGE_UPORABNIK_KNJIGE` (`knjiga_id`);

--
-- Indexes for table `vloge`
--
ALTER TABLE `vloge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zanri`
--
ALTER TABLE `zanri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avtorji`
--
ALTER TABLE `avtorji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `knjige`
--
ALTER TABLE `knjige`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `knjige_avtorji`
--
ALTER TABLE `knjige_avtorji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `knjige_zanri`
--
ALTER TABLE `knjige_zanri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ocene`
--
ALTER TABLE `ocene`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `uporabnik_knjige`
--
ALTER TABLE `uporabnik_knjige`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vloge`
--
ALTER TABLE `vloge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zanri`
--
ALTER TABLE `zanri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knjige_avtorji`
--
ALTER TABLE `knjige_avtorji`
  ADD CONSTRAINT `AVTORJI_KNJIGE_AVTORJI` FOREIGN KEY (`avtor_id`) REFERENCES `avtorji` (`id`),
  ADD CONSTRAINT `KNJIGE_KNJIGE_AVTORJI` FOREIGN KEY (`knjiga_id`) REFERENCES `knjige` (`id`);

--
-- Constraints for table `knjige_zanri`
--
ALTER TABLE `knjige_zanri`
  ADD CONSTRAINT `KNJIGE_KNJIGE_ZANRI` FOREIGN KEY (`knjiga_id`) REFERENCES `knjige` (`id`),
  ADD CONSTRAINT `ZANRI_KNJIGE_ZANRI` FOREIGN KEY (`zanr_id`) REFERENCES `zanri` (`id`);

--
-- Constraints for table `ocene`
--
ALTER TABLE `ocene`
  ADD CONSTRAINT `KNJIGE_OCENE` FOREIGN KEY (`knjiga_id`) REFERENCES `knjige` (`id`),
  ADD CONSTRAINT `UPORABNIKI_OCENE` FOREIGN KEY (`uporabnik_id`) REFERENCES `uporabniki` (`id`);

--
-- Constraints for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD CONSTRAINT `VLOGA_UPORABNIKI` FOREIGN KEY (`vloga_id`) REFERENCES `vloge` (`id`);

--
-- Constraints for table `uporabnik_knjige`
--
ALTER TABLE `uporabnik_knjige`
  ADD CONSTRAINT `KNJIGE_UPORABNIK_KNJIGE` FOREIGN KEY (`knjiga_id`) REFERENCES `knjige` (`id`),
  ADD CONSTRAINT `UPORABNIKI_UPORABNIK_KNJIGE` FOREIGN KEY (`uporabnik_id`) REFERENCES `uporabniki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
