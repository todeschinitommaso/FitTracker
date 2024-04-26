-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 26, 2024 alle 18:31
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
-- Database: `tracker`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alimenti`
--

CREATE TABLE `alimenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `calorie` int(11) NOT NULL,
  `proteine` int(11) NOT NULL,
  `carboidrati` int(11) NOT NULL,
  `grassi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `alimenti`
--

INSERT INTO `alimenti` (`id`, `nome`, `calorie`, `proteine`, `carboidrati`, `grassi`) VALUES
(1, 'Latte Parzialmente Scremato', 47, 3, 5, 2),
(2, 'Pane', 271, 9, 50, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `allenamento`
--

CREATE TABLE `allenamento` (
  `id` int(11) NOT NULL,
  `id_giorno` int(11) NOT NULL,
  `id_esercizio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `allenamento`
--

INSERT INTO `allenamento` (`id`, `id_giorno`, `id_esercizio`) VALUES
(19, 1, 1),
(20, 4, 1),
(21, 1, 2),
(22, 4, 2),
(23, 1, 3),
(24, 4, 3),
(25, 1, 4),
(26, 4, 4),
(27, 1, 5),
(28, 4, 5),
(29, 1, 6),
(30, 4, 6),
(31, 1, 7),
(32, 4, 7),
(33, 1, 8),
(34, 4, 8),
(35, 2, 9),
(36, 5, 9),
(37, 2, 10),
(38, 5, 10),
(39, 2, 11),
(40, 5, 11),
(41, 2, 12),
(42, 5, 12),
(43, 2, 13),
(44, 5, 13),
(45, 2, 14),
(46, 5, 14),
(47, 2, 15),
(48, 5, 15),
(49, 3, 16),
(50, 3, 17),
(51, 3, 18),
(52, 3, 19),
(53, 3, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `dieta`
--

CREATE TABLE `dieta` (
  `id` int(11) NOT NULL,
  `id_giorno` int(11) NOT NULL,
  `id_pasto` int(11) NOT NULL,
  `id_alimento` int(11) NOT NULL,
  `quantita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dieta`
--

INSERT INTO `dieta` (`id`, `id_giorno`, `id_pasto`, `id_alimento`, `quantita`) VALUES
(1, 5, 1, 1, 200),
(2, 5, 1, 2, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `esercizi`
--

CREATE TABLE `esercizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `serie` int(1) NOT NULL,
  `reps` int(2) NOT NULL,
  `pausa` varchar(6) NOT NULL,
  `peso` int(3) NOT NULL,
  `intensita` varchar(50) NOT NULL,
  `id_muscolo` int(11) NOT NULL,
  `altro` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `esercizi`
--

INSERT INTO `esercizi` (`id`, `nome`, `serie`, `reps`, `pausa`, `peso`, `intensita`, `id_muscolo`, `altro`) VALUES
(1, 'Panca Piana Bilancere', 4, 6, '1.30\"', 50, 'buffer = 2', 7, ''),
(2, 'Panca Inclinata Manubri', 3, 12, '1.30\"', 16, 'ultima a cedimento', 7, ''),
(3, 'Dips', 2, 15, '1\"', 0, 'cedimento', 7, ''),
(4, 'Croci Basse', 2, 15, '1\"', 9, 'cedimento', 7, ''),
(5, 'Spinte Manubri', 3, 10, '1.30\"', 14, 'cedimento', 15, ''),
(6, 'Alzate Laterali', 3, 15, '1\"', 10, 'cedimento', 15, ''),
(7, 'French Press EZ', 3, 12, '1\"', 15, 'cedimento', 19, ''),
(8, 'Pushdown Corda', 3, 12, '1\"', 14, 'cedimento', 19, ''),
(9, 'Trazioni Zavorrate', 5, 5, '1.30\"', 5, 'cedimento', 11, ''),
(10, 'Rematore su Panca Inclinata', 3, 12, '1.30\"', 14, 'cedimento', 20, ''),
(11, 'Lat Machine Presa Neutra', 3, 12, '1\"', 32, 'cedimento', 11, ''),
(12, 'Pulley Triangolo', 3, 12, '1\"', 27, 'cedimento', 20, ''),
(13, 'Face Pull', 3, 15, '1\"', 27, 'cedimento', 15, ''),
(14, 'Spider Curl', 3, 12, '1\"', 10, 'cedimento', 4, ''),
(15, 'Curl Panca Inclinata', 3, 12, '1', 8, 'cedimento', 4, ''),
(16, 'Affondi Bulgari', 4, 10, '1.30\"', 16, 'cedimento', 14, ''),
(17, 'Leg Extension', 3, 15, '1.30\"', 56, 'cedimento', 14, ''),
(18, 'RDL Multipower con manubri', 3, 12, '1,30', 16, 'cedimento', 10, 'Stinco appoggiato al bilancere e usi i manubri per scendere, posiziona 2 dischi da 5 sotto le punte dei piedi'),
(19, 'Calf Raise', 3, 15, '1', 60, 'cedimento', 5, ''),
(20, 'Abductor Machine', 3, 12, '1\"', 29, 'cedimento', 3, '');

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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alimenti`
--
ALTER TABLE `alimenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `allenamento`
--
ALTER TABLE `allenamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_giorno` (`id_giorno`),
  ADD KEY `rif_esercizio` (`id_esercizio`);

--
-- Indici per le tabelle `dieta`
--
ALTER TABLE `dieta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_pasto` (`id_pasto`),
  ADD KEY `rif_alimento` (`id_alimento`),
  ADD KEY `rif_giorno1` (`id_giorno`);

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
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alimenti`
--
ALTER TABLE `alimenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT per la tabella `dieta`
--
ALTER TABLE `dieta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  ADD CONSTRAINT `rif_esercizio` FOREIGN KEY (`id_esercizio`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_giorno` FOREIGN KEY (`id_giorno`) REFERENCES `giorni` (`id`);

--
-- Limiti per la tabella `dieta`
--
ALTER TABLE `dieta`
  ADD CONSTRAINT `rif_alimento` FOREIGN KEY (`id_alimento`) REFERENCES `alimenti` (`id`),
  ADD CONSTRAINT `rif_giorno1` FOREIGN KEY (`id_giorno`) REFERENCES `giorni` (`id`),
  ADD CONSTRAINT `rif_pasto` FOREIGN KEY (`id_pasto`) REFERENCES `pasti` (`id`);

--
-- Limiti per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  ADD CONSTRAINT `rif_muscolo` FOREIGN KEY (`id_muscolo`) REFERENCES `muscoli` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
