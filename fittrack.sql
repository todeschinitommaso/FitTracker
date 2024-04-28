-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 28, 2024 alle 15:15
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fittrack`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alimenti`
--

CREATE TABLE `alimenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `calorie` int(11) NOT NULL,
  `proteine` int(11) NOT NULL,
  `carboidrati` int(11) NOT NULL,
  `grassi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `alimenti`
--

INSERT INTO `alimenti` (`id`, `nome`, `id_categoria`, `calorie`, `proteine`, `carboidrati`, `grassi`) VALUES
(25, 'Mela', 1, 52, 0, 14, 0),
(26, 'Banana', 1, 89, 1, 23, 0),
(27, 'Arancia', 1, 47, 1, 12, 0),
(28, 'Pera', 1, 57, 0, 15, 0),
(29, 'Fragole', 1, 32, 1, 8, 0),
(30, 'Kiwi', 1, 61, 1, 15, 1),
(31, 'Ananas', 1, 50, 1, 13, 0),
(32, 'Pesca', 1, 39, 1, 10, 0),
(33, 'Uva', 1, 67, 1, 17, 0),
(34, 'Limone', 1, 29, 1, 9, 0),
(35, 'Pomodoro', 2, 18, 1, 4, 0),
(36, 'Cetriolo', 2, 15, 1, 4, 0),
(37, 'Carota', 2, 41, 1, 10, 0),
(38, 'Zucchina', 2, 17, 1, 3, 0),
(39, 'Broccoli', 2, 34, 3, 7, 0),
(40, 'Peperone', 2, 31, 1, 6, 0),
(41, 'Cavolfiore', 2, 25, 2, 5, 0),
(42, 'Cipolla', 2, 40, 1, 9, 0),
(43, 'Patata', 2, 77, 2, 17, 0),
(44, 'Asparagi', 2, 20, 2, 4, 0),
(45, 'Pollo', 3, 165, 31, 0, 4),
(46, 'Manzo', 3, 250, 26, 0, 15),
(47, 'Maiale', 3, 242, 25, 0, 16),
(48, 'Tacchino', 3, 189, 29, 0, 8),
(49, 'Agnello', 3, 206, 25, 0, 11),
(50, 'Salmone', 3, 208, 20, 0, 13),
(51, 'Tonno', 3, 144, 30, 0, 2),
(52, 'Uova', 3, 155, 13, 1, 11),
(53, 'Anatra', 3, 337, 19, 0, 28),
(54, 'Sardine', 3, 208, 25, 0, 11),
(55, 'Lenticchie', 4, 116, 9, 20, 0),
(56, 'Ceci', 4, 378, 19, 27, 6),
(57, 'Fagioli neri', 4, 333, 22, 60, 1),
(58, 'Tofu', 4, 145, 15, 2, 9),
(59, 'Quinoa', 4, 120, 4, 21, 2),
(60, 'Seitan', 4, 370, 75, 15, 2),
(61, 'Tempeh', 4, 193, 19, 9, 11),
(62, 'Edamame', 4, 122, 11, 10, 5),
(63, 'Noci', 4, 654, 15, 14, 65),
(64, 'Mandorle', 4, 576, 21, 21, 50),
(65, 'Avena', 5, 389, 17, 66, 7),
(66, 'Riso', 5, 130, 3, 28, 0),
(67, 'Quinoa', 5, 120, 4, 21, 2),
(68, 'Farro', 5, 337, 13, 72, 2),
(69, 'Orzo', 5, 354, 13, 74, 1),
(70, 'Segale', 5, 335, 9, 75, 2),
(71, 'Mais', 5, 86, 3, 20, 1),
(72, 'Grano saraceno', 5, 343, 13, 72, 3),
(73, 'Couscous', 5, 376, 14, 77, 1),
(74, 'Miglio', 5, 378, 11, 72, 4),
(75, 'Olio di oliva', 6, 884, 0, 0, 100),
(76, 'Burro', 6, 717, 1, 0, 81),
(77, 'Olio di cocco', 6, 862, 0, 0, 100),
(78, 'Olio di semi di girasole', 6, 884, 0, 0, 100),
(79, 'Olio di semi di mais', 6, 884, 0, 0, 100),
(80, 'Olio di semi di arachidi', 6, 884, 0, 0, 100),
(81, 'Olio di semi di sesamo', 6, 884, 0, 0, 100),
(82, 'Olio di semi di lino', 6, 884, 0, 0, 100),
(83, 'Olio di semi di soia', 6, 884, 0, 0, 100),
(84, 'Olio di semi di canapa', 6, 884, 0, 0, 100),
(85, 'Latte', 7, 42, 3, 5, 1),
(86, 'Yogurt', 7, 61, 10, 5, 0),
(87, 'Formaggio', 7, 402, 25, 1, 33),
(88, 'Panna', 7, 292, 3, 3, 30),
(89, 'Burrata', 7, 292, 5, 1, 28),
(90, 'Mozzarella', 7, 280, 22, 2, 20),
(91, 'Ricotta', 7, 174, 11, 3, 12),
(92, 'Gorgonzola', 7, 353, 21, 0, 30),
(93, 'Mascarpone', 7, 429, 4, 4, 43),
(94, 'Parmigiano Reggiano', 7, 392, 35, 1, 28),
(95, 'Noci', 8, 654, 15, 14, 65),
(96, 'Mandorle', 8, 576, 21, 21, 50),
(97, 'Nocciole', 8, 628, 14, 17, 61),
(98, 'Pistacchi', 8, 562, 20, 28, 45),
(99, 'Anacardi', 8, 553, 18, 29, 44),
(100, 'Pignoli', 8, 673, 14, 13, 68),
(101, 'Semi di zucca', 8, 574, 30, 19, 49),
(102, 'Semi di girasole', 8, 584, 21, 24, 52),
(103, 'Semi di lino', 8, 534, 18, 29, 42),
(104, 'Semi di sesamo', 8, 573, 17, 23, 50),
(105, 'Cioccolato fondente', 10, 546, 5, 58, 31),
(106, 'Gelato', 10, 207, 3, 26, 10),
(107, 'Marmellata', 10, 246, 0, 63, 0),
(108, 'Miele', 10, 304, 0, 82, 0),
(109, 'Zucchero', 10, 387, 0, 100, 0),
(110, 'Caramelle gommose', 10, 325, 1, 82, 0),
(111, 'Panna montata', 10, 257, 3, 11, 22),
(112, 'Nutella', 10, 539, 6, 56, 30),
(113, 'Torta di mele', 10, 237, 2, 34, 11),
(114, 'Tiramisù', 10, 320, 5, 21, 24);

-- --------------------------------------------------------

--
-- Struttura della tabella `allenamento`
--

CREATE TABLE `allenamento` (
  `id` int(11) NOT NULL,
  `id_giorno` int(11) NOT NULL,
  `id_esercizio` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `serie` int(1) NOT NULL,
  `reps` int(2) NOT NULL,
  `pausa` int(5) NOT NULL,
  `peso` int(3) DEFAULT NULL,
  `intensita` varchar(50) NOT NULL,
  `altro` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `allenamento`
--

INSERT INTO `allenamento` (`id`, `id_giorno`, `id_esercizio`, `id_utente`, `serie`, `reps`, `pausa`, `peso`, `intensita`, `altro`) VALUES
(54, 7, 21, 7, 4, 6, 1, 30, 'buffer = 2', ''),
(56, 7, 22, 7, 3, 12, 1, 16, 'utima a cedimento', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie_alimenti`
--

CREATE TABLE `categorie_alimenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categorie_alimenti`
--

INSERT INTO `categorie_alimenti` (`id`, `nome`) VALUES
(1, 'Frutta'),
(2, 'Verdura'),
(3, 'Proteine animali'),
(4, 'Proteine vegetali'),
(5, 'Cereali'),
(6, 'Grassi e oli'),
(7, 'Latticini'),
(8, 'Frutta secca e semi'),
(10, 'Dolci e zuccheri');

-- --------------------------------------------------------

--
-- Struttura della tabella `dieta`
--

CREATE TABLE `dieta` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) NOT NULL,
  `id_giorno` int(11) NOT NULL,
  `id_pasto` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

CREATE TABLE `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_muscolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `nome`, `id_muscolo`) VALUES
(21, 'Panca Piana Bilancere', 7),
(22, 'Panca Inclinata Manubri', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `giorni`
--

CREATE TABLE `giorni` (
  `id` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `giorni`
--

INSERT INTO `giorni` (`id`, `nome`) VALUES
(1, 'Lunedi'),
(2, 'Martedí'),
(3, 'Mercoledí'),
(4, 'Giovedí'),
(5, 'Venerdí'),
(6, 'Sabato'),
(7, 'Domenica');

-- --------------------------------------------------------

--
-- Struttura della tabella `muscoli`
--

CREATE TABLE `muscoli` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `muscoli`
--

INSERT INTO `muscoli` (`id`, `nome`) VALUES
(1, 'Addominali'),
(2, 'Abduttori'),
(3, 'Adduttori'),
(4, 'Bicipiti'),
(5, 'Polpacci'),
(6, 'Cardio'),
(7, 'Petto'),
(8, 'Avambracci'),
(9, 'Glutei'),
(10, 'Femorali'),
(11, 'Lats'),
(12, 'Lombari'),
(13, 'Collo'),
(14, 'Quadricipiti'),
(15, 'Spalle'),
(16, 'Trapezio'),
(19, 'Tricipiti'),
(20, 'Upper Back');

-- --------------------------------------------------------

--
-- Struttura della tabella `pasti`
--

CREATE TABLE `pasti` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pasti`
--

INSERT INTO `pasti` (`id`, `nome`) VALUES
(1, 'Colazione'),
(2, 'Spuntino'),
(3, 'Pranzo'),
(4, 'Merenda'),
(5, 'Cena');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `data_nascita` date NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `username`, `email`, `password`, `nome`, `cognome`, `data_nascita`, `admin`) VALUES
(7, 'Tode', 'tommaso.todeschini05@gmail.com', '$2y$10$CuYsMBASQU9VPjFBEMWrNOldZGSMbk719NsNrmGlLQx03j9s4PNHK', 'Tommaso', 'Todeschini', '2005-01-19', 1),
(8, 'Dome', 'domy.manca.ciao@gmail.com', '$2y$10$hVi07ijaegLxD9CtSoxasergKkZGS2.SJrhjaQe6SaiwGTqpJ0Soa', 'Domenico', 'Manca', '0005-06-25', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alimenti`
--
ALTER TABLE `alimenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_categoria` (`id_categoria`);

--
-- Indici per le tabelle `allenamento`
--
ALTER TABLE `allenamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_giorno` (`id_giorno`),
  ADD KEY `rif_esercizio` (`id_esercizio`),
  ADD KEY `rif_utente` (`id_utente`);

--
-- Indici per le tabelle `categorie_alimenti`
--
ALTER TABLE `categorie_alimenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_pasto` (`id_pasto`),
  ADD KEY `rif_alimento` (`id_alimento`),
  ADD KEY `rif_giorno1` (`id_giorno`),
  ADD KEY `rif_utente1` (`id_utente`);

--
-- Indici per le tabelle `esercizi`
--
ALTER TABLE `esercizi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_esercizio` (`nome`),
  ADD KEY `rif_muscolo` (`id_muscolo`);

--
-- Indici per le tabelle `giorni`
--
ALTER TABLE `giorni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `muscoli`
--
ALTER TABLE `muscoli`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `pasti`
--
ALTER TABLE `pasti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alimenti`
--
ALTER TABLE `alimenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT per la tabella `categorie_alimenti`
--
ALTER TABLE `categorie_alimenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `dieta`
--
ALTER TABLE `dieta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `giorni`
--
ALTER TABLE `giorni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `muscoli`
--
ALTER TABLE `muscoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `pasti`
--
ALTER TABLE `pasti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `alimenti`
--
ALTER TABLE `alimenti`
  ADD CONSTRAINT `rif_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorie_alimenti` (`id`);

--
-- Limiti per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  ADD CONSTRAINT `rif_esercizio` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_giorno` FOREIGN KEY (`id_giorno`) REFERENCES `giorni` (`id`),
  ADD CONSTRAINT `rif_utente` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `dieta`
--
ALTER TABLE `dieta`
  ADD CONSTRAINT `rif_alimento` FOREIGN KEY (`id_alimento`) REFERENCES `alimenti` (`id`),
  ADD CONSTRAINT `rif_giorno1` FOREIGN KEY (`id_giorno`) REFERENCES `giorni` (`id`),
  ADD CONSTRAINT `rif_pasto` FOREIGN KEY (`id_pasto`) REFERENCES `pasti` (`id`),
  ADD CONSTRAINT `rif_utente1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  ADD CONSTRAINT `rif_muscolo` FOREIGN KEY (`id_muscolo`) REFERENCES `muscoli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
