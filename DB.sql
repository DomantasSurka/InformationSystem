-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2022 at 10:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `Akcija`
--

CREATE TABLE `Akcija` (
  `pavadinimas` varchar(20) NOT NULL,
  `aprasymas` varchar(20) NOT NULL,
  `id_Akcija` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Akcija`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Akcija`
--

INSERT INTO `Akcija` (`pavadinimas`, `aprasymas`, `id_Akcija`) VALUES
('Ziemos', 'didelės nuolaidos', 1),
('Vasaros', 'didelės nuolaidos', 2),
('Pavasario', 'didelės nuolaidos', 3),
('Rudens', 'didelės nuolaidos', 4),
('Sezono', 'didelės nuolaidos', 5),
('Didysis', 'didelės nuolaidos', 6),
('Mazasis', 'didelės nuolaidos', 7),
('Vidutinis', 'didelės nuolaidos', 8),
('Geriausias', 'didelės nuolaidos', 9),
('Trumpiausias', 'didelės nuolaidos', 10),
('Ilgiausias', 'didelės nuolaidos', 11),
('Vidutiniskas', 'didelės nuolaidos', 12),
('Rimciausias', 'didelės nuolaidos', 13),
('Prasciausias', 'didelės nuolaidos', 14),
('Veliausias', 'didelės nuolaidos', 15),
('Anksciausias', 'didelės nuolaidos', 16),
('Papildomas', 'didelės nuolaidos', 17),
('Geras', 'didelės nuolaidos', 18),
('Geriausias', 'didelės nuolaidos', 19),
('Tas', 'didelės nuolaidos', 20),
('Laukiamiausias', 'didelės nuolaidos', 21),
('Rimtas', 'didelės nuolaidos', 22);

-- --------------------------------------------------------

--
-- Table structure for table `Darbuotojas`
--

CREATE TABLE `Darbuotojas` (
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `darbuotojo_kodas` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Parduotuveid_Darbuotojas` int(11) NOT NULL,
  PRIMARY KEY(`darbuotojo_kodas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Darbuotojas`
--

INSERT INTO `Darbuotojas` (`vardas`, `pavarde`, `darbuotojo_kodas`, `fk_Parduotuveid_Darbuotojas`) VALUES
('Petras', 'Petraitis', 1, 17),
('Petras', 'Jonaitis', 2, 20),
('Gytis', 'Gytaitis', 3, 8),
('Gytis', 'Jonaitis', 4, 10),
('Petras', 'Jonaitis', 5, 7),
('Rytis', 'Rytaitis', 6, 14),
('Jokubas', 'Jokubaitis', 7, 15),
('Vytis', 'Vytaitis', 8, 6),
('Kestas', 'Kestaitis', 9, 14),
('Rokas', 'Rokaitis', 10, 15),
('Domas', 'Domaitis', 11, 6),
('Jokas', 'Domaitis', 12, 20),
('Rokas', 'Jonaitis', 13, 16),
('Jonas', 'Domaitis', 14, 17),
('Juozas', 'Juozaitis', 15, 6),
('Aiste', 'Aistaite', 16, 9),
('Greta', 'Gretaite', 17, 20),
('Domas', 'Gretaitis', 18, 7),
('Rokas', 'Gretaitis', 19, 5),
('Rytis', 'Domaitis', 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `Gamintojas`
--

CREATE TABLE `Gamintojas` (
  `pavadinimas` varchar(20) NOT NULL,
  `id_Gamintojas` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Irenginysid_Irenginys` int(10) NOT NULL,
  PRIMARY KEY(`id_Gamintojas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Gamintojas`
--

INSERT INTO `Gamintojas` (`pavadinimas`, `id_Gamintojas`, `fk_Irenginysid_Irenginys`) VALUES
('Daikin', 1, 8),
('Midea', 2, 14),
('Refra', 3, 7),
('Befra', 4, 15),
('Cidea', 5, 12),
('Badeo', 6, 11),
('Uma', 7, 2),
('Electrolux', 8, 22),
('Bosh', 9, 20),
('Rosh', 10, 5),
('Gosh', 11, 6),
('Faikin', 12, 13),
('Pac', 13, 10),
('Taca', 14, 9),
('Haras', 15, 4),
('Bmw', 16, 17),
('Audi', 17, 1),
('Opel', 18, 16),
('Idas', 19, 18),
('Jush', 20, 19),
('Fargo', 21, 21),
('Hardo', 22, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Irenginys`
--

CREATE TABLE `Irenginys` (
  `tipas` varchar(20) NOT NULL,
  `id_Irenginys` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Irenginys`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Irenginys`
--

INSERT INTO `Irenginys` (`tipas`, `id_Irenginys`) VALUES
('Silumos siurblys', 1),
('Oro kondicionierius', 2),
('Vandens kond.', 3),
('Rekuperatorius', 4),
('Oro rekuperatorius', 5),
('Oro uzuolaida', 6),
('Kondicionierius', 7),
('Auto kondicionierius', 8),
('Radiatorius', 9),
('Plonas radiatorius', 10),
('Oras-vanduo', 11),
('Oras-oras', 12),
('Peciukas', 13),
('Gyvatukas', 14),
('Nesioj. radiatorius', 15),
('Storas radiatorius', 16),
('Siauras radiatorius', 17),
('Trumpas radiatorius', 18),
('Vandens rekupas', 19),
('Oro rekupas', 20),
('Vandens uzuolaida', 21),
('Oro radiatorius', 22);

-- --------------------------------------------------------

--
-- Table structure for table `Klientas`
--

CREATE TABLE `Klientas` (
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `telefonas` varchar(20) NOT NULL,
  `e_pastas` varchar(20) NOT NULL,
  `id_Klientas` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Klientas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Klientas`
--

INSERT INTO `Klientas` (`vardas`, `pavarde`, `telefonas`, `e_pastas`, `id_Klientas`) VALUES
('Rokas', 'Rokaitis', '86775833', 'rokas@gmail.com', 1),
('Domas', 'Domaitis', '867758474', 'domas@gmail.com', 2),
('Gytis', 'Gytaitis', '8677483', 'gytis@gmail.com', 3),
('Juozas', 'Gytaitis', '8675873', 'juze@gmail.com', 4),
('Petras', 'Petraitis', '867584743', 'petras@gmail.com', 5),
('Juozas', 'Domaitis', '86748484', 'zusa@gmail.com', 6),
('Kipras', 'Kipraitis', '86748474', 'fsdfds@gmail.com', 7),
('Prokas', 'Prokaitis', '86748473', 'ruaka@gmail.com', 8),
('Algis', 'Algaitis', '8676445784', 'alga@gmail.com', 9),
('Kestas', 'Jonaitis', '867437373', 'kazas@gmail.com', 10),
('Juze', 'Juzaitis', '8637744', 'juza@gmail.com', 11),
('Domas', 'Gretaitis', '8678373', 'domce@gmail.com', 12),
('Stepas', 'Stepaitis', '86473738', 'stepa@gmail.com', 13),
('Stepas', 'Gretaitis', '86745427', 'steaa@gmail.com', 14),
('Gytis', 'Domaitis', '8674736338', 'gica@gmail.com', 15),
('Virgis', 'Virgaitis', '85757343483', 'virga@gmail.com', 16),
('Nojus', 'Nojaitis', '8674373', 'nojce@gmail.com', 17),
('Petras', 'Algaitas', '86757464', 'patdas@gmail.com', 18),
('Rytis', 'Juozaitis', '86758373', 'rytas@gmail.com', 19),
('Aiste', 'Aistaite', '86746373', 'aista@gmail.com', 20),
('Aiste', 'Juozaite', '86748373', 'juozasea@gmail.com', 21),
('Greta', 'Juozaite', '86747432', 'grtad@gmail.com', 22);

-- --------------------------------------------------------

--
-- Table structure for table `Miestas`
--

CREATE TABLE `Miestas` (
  `pavadinimas` varchar(20) NOT NULL,
  `id_Miestas` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Miestas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Miestas`
--

INSERT INTO `Miestas` (`pavadinimas`, `id_Miestas`) VALUES
('Kaunas', 1),
('Vilnius', 2),
('Klaipeda', 3),
('Palanga', 4),
('Sventoji', 5),
('Zarasai', 6),
('Vilnia', 7),
('Kazlu Ruda', 8),
('Svencionys', 9),
('Kauno rajonas', 10),
('Vilniaus rajonas', 11),
('Zarasu rajonas', 12),
('Trakai', 13),
('Druskininkai', 14),
('Nida', 15),
('Telsiai', 16),
('Plunge', 17),
('Siauliai', 18),
('Panevezys', 19),
('Panevezio rajonas', 20),
('Telsiu rajonas', 21),
('Druskininku rajonas', 22);

-- --------------------------------------------------------

--
-- Table structure for table `Modelis`
--

CREATE TABLE `Modelis` (
  `pavadinimas` varchar(20) NOT NULL,
  `galia` int(10) NOT NULL,
  `energijos_klase` varchar(5) NOT NULL,
  `matmenys` int(10) NOT NULL,
  `triuksmingumo_lygis` int(10) NOT NULL,
  `freonas` varchar(20) NOT NULL,
  `id_Modelis` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Gamintojasid_Gamintojas_ID` int(10) NOT NULL,
  PRIMARY KEY(`id_Modelis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Modelis`
--

INSERT INTO `Modelis` (`pavadinimas`, `galia`, `energijos_klase`, `matmenys`, `triuksmingumo_lygis`, `freonas`, `id_Modelis`, `fk_Gamintojasid_Gamintojas_ID`) VALUES
('FGHT', 12, 'A', 12, 12, '400', 1, 17),
('JGHFS', 43, 'A', 432, 44, '400', 2, 9),
('KLAFKFAD', 3121, 'F', 5454, 545, '200', 3, 6),
('LGDJS', 44, 'G', 54, 2, '200', 4, 1),
('HANCXA', 432, 'A++', 54, 22, '200', 5, 10),
('FAKCN', 12, 'F', 422, 454, '400', 6, 22),
('KBMNCB', 543, 'D', 4314, 11, '400', 7, 21),
('UGHGDNS', 542, 'B', 234, 11, '200', 8, 21),
('AIVHSA', 432, 'F', 55, 11, '200', 9, 8),
('KANXBV', 432, 'A', 2342, 11, '400', 10, 3),
('UAFHFA', 400, 'A', 131, 22, '250', 11, 16),
('HAJNDX', 5232, 'A', 423, 55, '400', 12, 2),
('ADJSAV', 343, 'A', 432, 11, '400', 13, 6),
('AJSDA', 13, 'B', 4233, 112, '400', 14, 11),
('HABCAA', 67, 'A', 754, 123, '400', 15, 13),
('JADJSABC', 1321, 'C', 432, 11, '400', 16, 7),
('JOAFSHF', 400, 'C', 432, 11, '400', 17, 20),
('JKAFBSK', 600, 'G', 544, 23, '40', 18, 13),
('HASGDSA', 167, 'A', 78, 78, '400', 19, 14),
('HVBSKB', 400, 'F', 403, 123, '400', 20, 22);

-- --------------------------------------------------------

--
-- Table structure for table `Mokejimas`
--

CREATE TABLE `Mokejimas` (
  `suma` smallint(6) NOT NULL,
  `data` date NOT NULL,
  `mokejimo_budas` varchar(20) NOT NULL,
  `id_Mokejimas` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Klientasid_Mokejimas` int(10) NOT NULL,
  `fk_Saskaitanumeris` int(10) NOT NULL,
  PRIMARY KEY(`id_Mokejimas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Mokejimas`
--

INSERT INTO `Mokejimas` (`suma`, `data`, `mokejimo_budas`, `id_Mokejimas`, `fk_Klientasid_Mokejimas`, `fk_Saskaitanumeris`) VALUES
(534, '2022-02-01', 'kortele', 1, 1, 1),
(543, '2022-02-01', 'grynais', 2, 2, 2),
(6538, '2022-02-04', 'kortele', 3, 3, 3),
(5354, '2022-02-17', 'kortele', 4, 4, 4),
(333, '2022-02-01', 'grynais', 5, 5, 5),
(321, '2022-02-24', 'grynais', 6, 6, 6),
(764, '2022-02-04', 'kortele', 7, 7, 7),
(1746, '2022-02-10', 'grynais', 8, 8, 8),
(5432, '2022-02-18', 'grynais', 9, 9, 9),
(675, '2022-02-01', 'grynais', 10, 10, 10),
(7648, '2022-02-05', 'grynais', 11, 11, 11),
(541, '2022-02-04', 'grynais', 12, 12, 12),
(521, '2022-02-03', 'grynais', 13, 13, 13),
(6543, '2022-02-03', 'kortele', 14, 14, 14),
(975, '2022-02-11', 'grynais', 15, 15, 15),
(756, '2022-02-17', 'grynais', 16, 16, 16),
(751, '2022-02-09', 'grynais', 17, 17, 17),
(978, '2022-02-16', 'issimoketinai', 18, 18, 18),
(864, '2022-02-04', 'issimoketinai', 19, 19, 19),
(683, '2022-02-04', 'grynais', 20, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `Mokestis`
--

CREATE TABLE `Mokestis` (
  `pavadinimas` varchar(20) NOT NULL,
  `aprasymas` varchar(20) NOT NULL,
  `id_Mokestis` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Mokestis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Mokestis`
--

INSERT INTO `Mokestis` (`pavadinimas`, `aprasymas`, `id_Mokestis`) VALUES
('Varis', 'Papildomas varis', 1),
('Laidai', 'Papildomi laidai', 2),
('Gumos', 'Papildomos gumos', 3),
('Laikikliai', 'Papildomi laikikliai', 4),
('Freonas', 'Papildomas freonas', 5),
('Kuras', 'Kuras', 6),
('Administravimas', 'Adriminstravimas', 7),
('Aptarnavimas', 'Aptarnavimas', 8),
('Tvirtinimai', 'Tvirtinimas', 9),
('Suverzejai', 'Suverzejai', 10),
('Kava', 'Kava', 11),
('Uzsakymas', 'Isankst. uzsakymas', 12),
('Tarpininkavimas', 'Tarpininkavimas', 13),
('Priedai', 'Papildomi priedai', 14),
('Groteles', 'Papildoma detale', 15),
('Ipakavimas', 'Ipakavimas', 16),
('Maiselis', 'Maiselis', 17),
('Deze', 'Papildoma deze', 18),
('Delspinigiai', 'Neapmoketa laiku', 19),
('Konsultacija', 'Naujam klietui', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Papildomas_Mokestis`
--

CREATE TABLE `Papildomas_Mokestis` (
  `atvejis` varchar(20) NOT NULL,
  `kaina` smallint(6) NOT NULL,
  `id_Papildomas_Mokestis` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Mokestisid_Mokestis` int(10) NOT NULL,
  `fk_Uzsakymas_kodas_papildomas` int(10) NOT NULL,
  PRIMARY KEY(`id_Papildomas_Mokestis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Papildomas_Mokestis`
--

INSERT INTO `Papildomas_Mokestis` (`atvejis`, `kaina`, `id_Papildomas_Mokestis`, `fk_Mokestisid_Mokestis`, `fk_Uzsakymas_kodas_papildomas`) VALUES
('Administravimas', 50, 1, 7, 1),
('Aptarnavimas', 60, 2, 8, 2),
('Tarpininkavimas', 50, 3, 13, 3),
('Konsultavimas', 10, 4, 20, 4),
('Ipakavimas', 5, 5, 18, 5),
('Ipakavimas', 4, 6, 17, 6),
('Konsultavimas', 40, 7, 20, 7),
('Nemokejimas laiku', 500, 8, 19, 8),
('Papildoma detale', 100, 9, 15, 9),
('Papildoma detale', 50, 10, 10, 10),
('Papildoma preke', 70, 11, 11, 11),
('Papildoma detale', 10, 12, 6, 12),
('Papildoma detale', 10, 13, 2, 13),
('Isankstinis', 15, 14, 12, 14),
('Papildoma detale', 15, 15, 3, 15),
('Priedai', 70, 16, 14, 16),
('N. konsultacija', 10, 17, 20, 17),
('Nemokejimas laiku', 400, 18, 19, 18),
('Papildoma detale', 100, 19, 1, 19),
('Papildoma detale', 160, 20, 14, 20);

-- --------------------------------------------------------

--
-- Table structure for table `Parduotuve`
--

CREATE TABLE `Parduotuve` (
  `adresas` text NOT NULL,
  `telefonas` varchar(20) NOT NULL,
  `e_pastas` varchar(20) NOT NULL,
  `id_Parduotuve` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Miestasid_Miestas` int(10) NOT NULL,
  PRIMARY KEY(`id_Parduotuve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Parduotuve`
--

INSERT INTO `Parduotuve` (`adresas`, `telefonas`, `e_pastas`, `id_Parduotuve`, `fk_Miestasid_Miestas`) VALUES
('Karkazu g. 16', '867736252', 'karkazai@shop.lt', 1, 1),
('Vilniaus g. 19', '8677564533', 'vilnius@shop.lt', 2, 2),
('Hado g. 14', '8677564537', 'druskininkai@shop.lt', 3, 14),
('Gycio g. 14', '867756473', 'panevezys@shop.lt', 4, 19),
('Plunges g. 20g', '8600594543', 'plunge@shop.lt', 5, 17),
('Sauliu g. 76', '867754733', 'siauliai@shop.lt', 6, 18),
('Karmelavos g. 99', '8677564733', 'vilnia@shop.lt', 7, 7),
('Haraimu g. 342', '8677564743', 'klaipeda@shop.lt', 8, 3),
('Nidos g. 65', '867754743', 'nida@shop.lt', 9, 15),
('Kazlu g. 90', '867757463', 'kazluruda@shop.lt', 10, 8),
('Sventosios g. 76', '86747437', 'sventoji@shop.lt', 11, 5),
('Svencioniu g. 76', '867754838', 'svencionys@shop.lt', 12, 9),
('Zarasu g. 65', '867757338', 'zarasai@shop.lt', 13, 6),
('Plunges g. 4', '86775473', 'plunge@shop.lt', 14, 17),
('Telsiu g. 87', '86757544', 'telsiai@shop.lt', 15, 16),
('Ruklos g. 6', '867575438', 'panrajon@shop.lt', 16, 20),
('Gatviu g. 123', '86757438', 'kaunoraj@shop.lt', 17, 10),
('Langu g. 76', '86747584', 'palanga@shop.lt', 18, 4),
('Gedu g. 54', '86757575', 'vilnraj@shop.lt', 19, 11),
('Harado g. 67', '86757575', 'vilnia@shop.lt', 20, 7);

-- --------------------------------------------------------

--
-- Table structure for table `Paslauga`
--

CREATE TABLE `Paslauga` (
  `pavadinimas` varchar(20) NOT NULL,
  `aprasymas` varchar(20) NOT NULL,
  `id_Paslauga` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY(`id_Paslauga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Paslauga`
--

INSERT INTO `Paslauga` (`pavadinimas`, `aprasymas`, `id_Paslauga`) VALUES
('Montavimas', 'Montavimas', 1),
('Garantinis', 'Garantinis', 2),
('Apziura', 'Produkto apziura', 3),
('Konsultacija', 'Konsultavimas', 4),
('Transportas', 'Transportavimas', 5),
('Remontas', 'Remontavimas', 6),
('Freono pildymas', 'Freono apziura', 7),
('Detaliu keitimas', 'Irangos tvarkymas', 8),
('Prieziura', 'Irangos prieziura', 9),
('Aptarnavimas', 'Aptarnavimas', 10),
('Greitas pristatymas', 'Greitas aptarnavimas', 11),
('Patikra', 'Patikrinimas', 12),
('Valymas', 'Irenginio valymas', 13),
('Papildomos gumos', 'Gumos irenginiui', 14),
('Papildomi laikikliai', 'Laikikliai', 15),
('Izoliavimas', 'Izoliacija', 16),
('Elektros tvarkymas', 'Elektros tvarkymas', 17),
('Laidu pravedimas', 'Laidu pravedimas', 18),
('Variu pravedimas', 'Variu vedziojimas', 19);

-- --------------------------------------------------------

--
-- Table structure for table `Paslaugos_Kaina`
--

CREATE TABLE `Paslaugos_Kaina` (
  `galioja_nuo` datetime NOT NULL,
  `galioja_iki` datetime NOT NULL,
  `kaina_laikotarpiu` smallint(6) NOT NULL,
  `id_Paslaugos_Kaina` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Paslaugaid_Paslauga` int(10) NOT NULL,
  PRIMARY KEY(`id_Paslaugos_Kaina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Paslaugos_Kaina`
--

INSERT INTO `Paslaugos_Kaina` (`galioja_nuo`, `galioja_iki`, `kaina_laikotarpiu`, `id_Paslaugos_Kaina`, `fk_Paslaugaid_Paslauga`) VALUES
('2022-02-01 22:38:29', '2022-02-26 21:36:59', 40, 1, 1),
('2022-02-01 22:38:29', '2022-02-26 21:36:59', 60, 2, 2),
('2022-02-01 22:38:29', '2022-02-26 21:36:59', 45, 3, 3),
('2022-02-01 22:38:29', '2022-02-26 21:36:59', 50, 4, 4),
('2022-02-24 22:38:29', '2022-02-26 21:36:59', 60, 5, 5),
('2022-02-05 22:38:29', '2022-02-26 21:36:59', 30, 6, 6),
('2022-02-20 22:38:29', '2022-02-26 21:36:59', 80, 7, 7),
('2022-02-20 22:38:29', '2022-02-26 21:36:59', 40, 8, 8),
('2022-01-01 22:38:29', '2022-04-01 22:38:29', 70, 9, 9),
('2022-02-17 22:38:29', '2022-02-26 21:36:59', 10, 10, 10),
('2022-02-02 22:38:29', '2022-02-26 21:36:59', 50, 11, 11),
('2022-02-04 22:38:29', '2022-02-26 21:36:59', 100, 12, 12),
('2022-01-04 22:38:29', '2022-02-26 21:36:59', 60, 13, 13),
('2022-02-23 22:38:29', '2022-02-26 21:36:59', 550, 14, 14),
('2022-02-05 22:38:29', '2022-02-26 21:36:59', 42, 15, 15),
('2022-02-11 22:38:29', '2022-02-26 21:36:59', 60, 16, 16),
('2022-02-23 22:38:29', '2022-02-26 21:36:59', 90, 17, 17),
('2022-02-22 22:38:29', '2022-04-06 22:38:29', 190, 18, 18),
('2022-02-24 22:38:29', '2022-02-26 21:36:59', 100, 19, 19);

-- --------------------------------------------------------

--
-- Table structure for table `pristatymo_tipai`
--

CREATE TABLE `pristatymo_tipai` (
  `id_pristatymo_tipai` varchar(20) NOT NULL,
  `name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pristatymo_tipai`
--

INSERT INTO `pristatymo_tipai` (`id_pristatymo_tipai`, `name`) VALUES
('1', 'parduotuveje'),
('2', 'kurjeriu'),
('3', 'pastomatu');

-- --------------------------------------------------------

--
-- Table structure for table `Saskaita`
--

CREATE TABLE `Saskaita` (
  `numeris` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `suma` smallint(6) NOT NULL,
  `prekes` varchar(20) NOT NULL,
  `fk_Uzsakymas_kodas_saskaita` int(10) NOT NULL,
  PRIMARY KEY(`numeris`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Saskaita`
--

INSERT INTO `Saskaita` (`numeris`, `data`, `suma`, `prekes`, `fk_Uzsakymas_kodas_saskaita`) VALUES
(1, '2022-02-02', 123, 'Prekiu duomenys', 1),
(2, '2022-02-16', 543, 'Prekiu duomenys', 2),
(3, '2022-02-01', 534, 'Prekiu duomenys', 3),
(4, '2022-02-03', 432, 'Prekiu duomenys', 4),
(5, '2022-02-02', 643, 'Prekiu duomenys', 5),
(6, '2022-02-16', 765, 'Prekiu duomenys', 6),
(7, '2022-02-02', 532, 'Prekiu duomenys', 7),
(8, '2022-02-10', 642, 'Prekiu duomenys', 8),
(9, '2022-02-12', 345, 'Prekiu duomenys', 9),
(10, '2022-02-11', 534, 'Prekiu duomenys', 10),
(11, '2022-02-05', 6543, 'Prekiu duomenys', 11),
(12, '2022-02-19', 543, 'Prekiu duomenys', 12),
(13, '2022-02-03', 53, 'Prekiu duomenys', 13),
(14, '2022-02-11', 642, 'Prekiu duomenys', 14),
(15, '2022-02-08', 53, 'Prekiu duomenys', 15),
(16, '2022-02-02', 54, 'Prekiu duomenys', 16),
(17, '2022-02-20', 543, 'Prekiu duomenys', 17),
(18, '2022-02-16', 643, 'Prekiu duomenys', 18),
(19, '2022-02-02', 543, 'Prekiu duomenys', 19),
(20, '2022-02-01', 532, 'Prekiu duomenys', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Sumazintas_Mokestis`
--

CREATE TABLE `Sumazintas_Mokestis` (
  `atvejis` varchar(20) NOT NULL,
  `nuolaida` smallint(6) NOT NULL,
  `id_Sumazintas_Mokestis` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Uzsakymas_kodas_sumazintas` int(10) NOT NULL,
  `fk_Akcijaid_Akcija` int(10) NOT NULL,
  PRIMARY KEY(`id_Sumazintas_Mokestis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Sumazintas_Mokestis`
--

INSERT INTO `Sumazintas_Mokestis` (`atvejis`, `nuolaida`, `id_Sumazintas_Mokestis`, `fk_Uzsakymas_kodas_sumazintas`, `fk_Akcijaid_Akcija`) VALUES
('Nuolaida', 20, 1, 1, 3),
('Nuolaida', 50, 2, 2, 6),
('Nuolaida', 35, 3, 3, 5),
('Nuolaida', 65, 4, 4, 4),
('Nuolaida', 35, 5, 5, 5),
('Nuolaida', 5, 6, 6, 6),
('Nuolaida', 30, 7, 7, 7),
('Nuolaida', 45, 8, 8, 8),
('Nuolaida', 30, 9, 9, 15),
('Nuolaida', 20, 10, 10, 5),
('Nuolaida', 10, 11, 11, 1),
('Nuolaida', 15, 12, 12, 18),
('Nuolaida', 15, 13, 13, 16),
('Nuolaida', 25, 14, 14, 14),
('Nuolaida', 5, 15, 15, 5),
('Nuolaida', 15, 16, 16, 14),
('Nuolaida', 40, 17, 17, 9);

-- --------------------------------------------------------

--
-- Table structure for table `Uzsakymas`
--

CREATE TABLE `Uzsakymas` (
  `kodas` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `uzsakymo_tipas` varchar(20) NOT NULL,
  `kaina` int(10) NOT NULL,
  `planuojamas_uzsakymo_ivykdymas` datetime NOT NULL,
  `uzsakymo_busena` varchar(20) NOT NULL,
  `pristatymo_tipas` varchar(20) NOT NULL,
  `fk_Klientasid_Uzsakymas` int(10) NOT NULL,
  `fk_Modelisid_Modelis` int(10) NOT NULL,
  `fk_Parduotuveid_Uzsakymas` int(10) NOT NULL,
  PRIMARY KEY(`kodas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Uzsakymas`
--

INSERT INTO `Uzsakymas` (`kodas`, `data`, `uzsakymo_tipas`, `kaina`, `planuojamas_uzsakymo_ivykdymas`, `uzsakymo_busena`, `pristatymo_tipas`, `fk_Klientasid_Uzsakymas`, `fk_Modelisid_Modelis`, `fk_Parduotuveid_Uzsakymas`) VALUES
(1, '2022-02-02', 'internetu', 54, '2022-02-26 18:06:07', '2', '1', 9, 15, 1),
(2, '2022-02-05', 'parduotuveje', 5544, '2022-02-08 19:06:15', '2', '2', 20, 5, 2),
(3, '2022-02-02', 'parduotuveje', 6533, '2022-02-10 19:06:15', '3', '3', 9, 4, 3),
(4, '2022-02-08', 'internetu', 7564, '2022-02-24 19:06:15', '3', '3', 15, 4, 4),
(5, '2022-02-05', 'garantinis', 633, '2022-02-26 18:06:07', '1', '1', 20, 3, 5),
(6, '2022-02-05', 'garantinis', 7685, '2022-02-26 18:06:07', '3', '1', 17, 12, 6),
(7, '2022-02-01', 'parduotuveje', 433, '2022-02-26 18:06:07', '3', '2', 20, 15, 7),
(8, '2022-02-21', 'parduotuveje', 6574, '2022-03-11 19:06:15', '6', '3', 8, 7, 8),
(9, '2022-02-22', 'internetu', 7684, '2022-02-28 19:06:15', '4', '3', 20, 12, 9),
(10, '2022-02-28', 'garantinis', 7664, '2022-03-18 19:06:15', '4', '3', 12, 5, 10),
(11, '2022-02-18', 'parduotuveje', 874, '2022-02-26 18:06:07', '2', '3', 12, 14, 11),
(12, '2022-02-04', 'garantinis', 653, '2022-02-26 18:06:07', '2', '3', 11, 5, 12),
(13, '2022-02-11', 'garantinis', 653, '2022-02-26 18:06:07', '3', '3', 20, 9, 13),
(14, '2022-02-11', 'garantinis', 543, '2022-02-26 18:06:07', '2', '3', 4, 1, 14),
(15, '2022-02-10', 'parduotuveje', 543, '2022-02-26 18:06:07', '2', '1', 15, 17, 15),
(16, '2022-02-07', 'internetu', 5435, '2022-02-26 18:06:07', '2', '3', 7, 16, 16),
(17, '2022-02-18', 'garantinis', 6542, '2022-02-26 18:06:07', '2', '3', 20, 14, 17),
(18, '2022-02-01', 'garantinis', 534, '2022-02-26 18:06:07', '2', '1', 17, 18, 18),
(19, '2022-02-05', 'parduotuve', 543, '2022-02-26 18:06:07', '2', '3', 3, 5, 19),
(20, '2022-02-05', 'parduotuveje', 755, '2022-02-26 18:06:07', '3', '2', 3, 9, 20);

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymo_busenos`
--

CREATE TABLE `uzsakymo_busenos` (
  `id_uzsakymo_busenos` varchar(20) NOT NULL,
  `name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uzsakymo_busenos`
--

INSERT INTO `uzsakymo_busenos` (`id_uzsakymo_busenos`, `name`) VALUES
('1', 'pateiktas'),
('2', 'patvirtintas'),
('3', 'ruosiamas'),
('4', 'ivykdytas'),
('5', 'atsiimti'),
('6', 'kurjeriu');

-- --------------------------------------------------------

--
-- Table structure for table `Uzsakyta_Paslauga`
--

CREATE TABLE `Uzsakyta_Paslauga` (
  `tipas` varchar(20) NOT NULL,
  `kiekis` smallint(6) NOT NULL,
  `kaina` smallint(6) NOT NULL,
  `id_Uzsakyta_Paslauga` int(10) NOT NULL AUTO_INCREMENT,
  `fk_Uzsakymas_kodas_paslauga` int(10) NOT NULL,
  `fk_Paslaugos_Kainaid_Paslaugos_Kaina` int(10) NOT NULL,
  PRIMARY KEY(`id_Uzsakyta_Paslauga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Uzsakyta_Paslauga`
--

INSERT INTO `Uzsakyta_Paslauga` (`tipas`, `kiekis`, `kaina`, `id_Uzsakyta_Paslauga`, `fk_Uzsakymas_kodas_paslauga`, `fk_Paslaugos_Kainaid_Paslaugos_Kaina`) VALUES
('Garantija', 1, 176, 1, 1, 1),
('Aptarnavimas', 1, 50, 2, 2, 2),
('Prieziura', 1, 100, 3, 3, 3),
('Patikra', 1, 50, 4, 4, 4),
('Aptarnavimas', 1, 0, 5, 5, 5),
('Papildomos gumos', 2, 0, 6, 6, 6),
('Elektros tvarkymas', 2, 600, 7, 7, 7),
('Laikikliai', 2, 100, 8, 8, 8),
('Izoliacija', 2, 120, 9, 9, 9),
('Freono apziura', 3, 0, 10, 10, 10),
('Remontavimas', 1, 150, 11, 11, 11),
('Variu vedziojimas', 2, 0, 12, 12, 12),
('Transportavimas', 1, 0, 13, 13, 13),
('Gumos irenginiui', 3, 0, 14, 14, 14),
('Irenginio valymas', 2, 400, 15, 15, 15),
('Irenginio valymas', 3, 600, 16, 16, 16),
('Elektros taisymas', 1, 0, 17, 17, 17),
('Remontas', 1, 0, 18, 18, 18),
('Greitas aptarnavimas', 1, 100, 19, 19, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Akcija`
--

--
-- Indexes for table `Darbuotojas`
--
ALTER TABLE `Darbuotojas`
  ADD KEY `aptarnauja` (`fk_Parduotuveid_Darbuotojas`);

--
-- Indexes for table `Gamintojas`
--
ALTER TABLE `Gamintojas`
  ADD KEY `turi` (`fk_Irenginysid_Irenginys`);

--
-- Indexes for table `Irenginys`
--

--
-- Indexes for table `Klientas`
--

--
-- Indexes for table `Miestas`
--

--
-- Indexes for table `Modelis`
--
ALTER TABLE `Modelis`
  ADD KEY `priklauso` (`fk_Gamintojasid_Gamintojas_ID`);

--
-- Indexes for table `Mokejimas`
--
ALTER TABLE `Mokejimas`
  ADD KEY `atlieka` (`fk_Klientasid_Mokejimas`),
  ADD KEY `patvirtintas` (`fk_Saskaitanumeris`);

--
-- Indexes for table `Mokestis`
--

--
-- Indexes for table `Papildomas_Mokestis`
--
ALTER TABLE `Papildomas_Mokestis`
  ADD KEY `priskaiciuotas` (`fk_Mokestisid_Mokestis`),
  ADD KEY `priskirtas` (`fk_Uzsakymas_kodas_papildomas`);

--
-- Indexes for table `Parduotuve`
--
ALTER TABLE `Parduotuve`
  ADD KEY `esanti` (`fk_Miestasid_Miestas`);

--
-- Indexes for table `Paslauga`
--

--
-- Indexes for table `Paslaugos_Kaina`
--
ALTER TABLE `Paslaugos_Kaina`
  ADD KEY `teikiamas` (`fk_Paslaugaid_Paslauga`);

--
-- Indexes for table `pristatymo_tipai`
--
ALTER TABLE `pristatymo_tipai`
  ADD PRIMARY KEY (`id_pristatymo_tipai`);

--
-- Indexes for table `Saskaita`
--
ALTER TABLE `Saskaita`
  ADD KEY `israsyta` (`fk_Uzsakymas_kodas_saskaita`);

--
-- Indexes for table `Sumazintas_Mokestis`
--
ALTER TABLE `Sumazintas_Mokestis`
  ADD KEY `skirtas` (`fk_Uzsakymas_kodas_sumazintas`),
  ADD KEY `pritaikyta` (`fk_Akcijaid_Akcija`);

--
-- Indexes for table `Uzsakymas`
--
ALTER TABLE `Uzsakymas`
  ADD UNIQUE KEY `fk_Parduotuveid_Uzsakymas` (`fk_Parduotuveid_Uzsakymas`),
  ADD KEY `uzsakymo_busena` (`uzsakymo_busena`),
  ADD KEY `pristatymo_tipas` (`pristatymo_tipas`),
  ADD KEY `ivykdo` (`fk_Klientasid_Uzsakymas`),
  ADD KEY `sandelyje` (`fk_Modelisid_Modelis`);

--
-- Indexes for table `uzsakymo_busenos`
--
ALTER TABLE `uzsakymo_busenos`
  ADD PRIMARY KEY (`id_uzsakymo_busenos`);

--
-- Indexes for table `Uzsakyta_Paslauga`
--
ALTER TABLE `Uzsakyta_Paslauga`
  ADD KEY `itraukta` (`fk_Uzsakymas_kodas_paslauga`),
  ADD KEY `teikama_uz` (`fk_Paslaugos_Kainaid_Paslaugos_Kaina`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Darbuotojas`
--
ALTER TABLE `Darbuotojas`
  ADD CONSTRAINT `aptarnauja` FOREIGN KEY (`fk_Parduotuveid_Darbuotojas`) REFERENCES `Parduotuve` (`id_Parduotuve`);

--
-- Constraints for table `Gamintojas`
--
ALTER TABLE `Gamintojas`
  ADD CONSTRAINT `turi` FOREIGN KEY (`fk_Irenginysid_Irenginys`) REFERENCES `Irenginys` (`id_Irenginys`);

--
-- Constraints for table `Modelis`
--
ALTER TABLE `Modelis`
  ADD CONSTRAINT `priklauso` FOREIGN KEY (`fk_Gamintojasid_Gamintojas_ID`) REFERENCES `Gamintojas` (`id_Gamintojas`);

--
-- Constraints for table `Mokejimas`
--
ALTER TABLE `Mokejimas`
  ADD CONSTRAINT `atlieka` FOREIGN KEY (`fk_Klientasid_Mokejimas`) REFERENCES `Klientas` (`id_Klientas`),
  ADD CONSTRAINT `patvirtintas` FOREIGN KEY (`fk_Saskaitanumeris`) REFERENCES `Saskaita` (`numeris`);

--
-- Constraints for table `Papildomas_Mokestis`
--
ALTER TABLE `Papildomas_Mokestis`
  ADD CONSTRAINT `priskaiciuotas` FOREIGN KEY (`fk_Mokestisid_Mokestis`) REFERENCES `Mokestis` (`id_Mokestis`),
  ADD CONSTRAINT `priskirtas` FOREIGN KEY (`fk_Uzsakymas_kodas_papildomas`) REFERENCES `Uzsakymas` (`kodas`);

--
-- Constraints for table `Parduotuve`
--
ALTER TABLE `Parduotuve`
  ADD CONSTRAINT `esanti` FOREIGN KEY (`fk_Miestasid_Miestas`) REFERENCES `Miestas` (`id_Miestas`);

--
-- Constraints for table `Paslaugos_Kaina`
--
ALTER TABLE `Paslaugos_Kaina`
  ADD CONSTRAINT `teikiamas` FOREIGN KEY (`fk_Paslaugaid_Paslauga`) REFERENCES `Paslauga` (`id_Paslauga`);

--
-- Constraints for table `Saskaita`
--
ALTER TABLE `Saskaita`
  ADD CONSTRAINT `israsyta` FOREIGN KEY (`fk_Uzsakymas_kodas_saskaita`) REFERENCES `Uzsakymas` (`kodas`);

--
-- Constraints for table `Sumazintas_Mokestis`
--
ALTER TABLE `Sumazintas_Mokestis`
  ADD CONSTRAINT `pritaikyta` FOREIGN KEY (`fk_Akcijaid_Akcija`) REFERENCES `Akcija` (`id_Akcija`),
  ADD CONSTRAINT `skirtas` FOREIGN KEY (`fk_Uzsakymas_kodas_sumazintas`) REFERENCES `Uzsakymas` (`kodas`);

--
-- Constraints for table `Uzsakymas`
--
ALTER TABLE `Uzsakymas`
  ADD CONSTRAINT `ivykdo` FOREIGN KEY (`fk_Klientasid_Uzsakymas`) REFERENCES `Klientas` (`id_Klientas`),
  ADD CONSTRAINT `nurodyta` FOREIGN KEY (`fk_Parduotuveid_Uzsakymas`) REFERENCES `Parduotuve` (`id_Parduotuve`),
  ADD CONSTRAINT `sandelyje` FOREIGN KEY (`fk_Modelisid_Modelis`) REFERENCES `Modelis` (`id_Modelis`),
  ADD CONSTRAINT `uzsakymas_ibfk_1` FOREIGN KEY (`uzsakymo_busena`) REFERENCES `uzsakymo_busenos` (`id_uzsakymo_busenos`),
  ADD CONSTRAINT `uzsakymas_ibfk_2` FOREIGN KEY (`pristatymo_tipas`) REFERENCES `pristatymo_tipai` (`id_pristatymo_tipai`);

--
-- Constraints for table `Uzsakyta_Paslauga`
--
ALTER TABLE `Uzsakyta_Paslauga`
  ADD CONSTRAINT `itraukta` FOREIGN KEY (`fk_Uzsakymas_kodas_paslauga`) REFERENCES `Uzsakymas` (`kodas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
