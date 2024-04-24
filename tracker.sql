-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 24, 2024 alle 17:57
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
-- Struttura della tabella `allenamento`
--

CREATE TABLE `allenamento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_es1` int(11) DEFAULT NULL,
  `id_es2` int(11) DEFAULT NULL,
  `id_es3` int(11) DEFAULT NULL,
  `id_es4` int(11) DEFAULT NULL,
  `id_es5` int(11) DEFAULT NULL,
  `id_es6` int(11) DEFAULT NULL,
  `id_es7` int(11) DEFAULT NULL,
  `id_es8` int(11) DEFAULT NULL,
  `id_es9` int(11) DEFAULT NULL,
  `id_es10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `allenamento`
--

INSERT INTO `allenamento` (`id`, `nome`, `id_es1`, `id_es2`, `id_es3`, `id_es4`, `id_es5`, `id_es6`, `id_es7`, `id_es8`, `id_es9`, `id_es10`) VALUES
(1, 'Push', 3, 4, 6, 7, 8, 1, 2, 5, NULL, NULL);

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
(8, 'Pushdown Corda', 3, 12, '1\"', 14, 'cedimento', 19, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `giorni`
--

CREATE TABLE `giorni` (
  `id` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `id_allenamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `giorni`
--

INSERT INTO `giorni` (`id`, `nome`, `id_allenamento`) VALUES
(1, 'Lunedi', 1),
(2, 'Martedí', NULL),
(3, 'Mercoledí', NULL),
(4, 'Giovedí', 1),
(5, 'Venerdí', NULL),
(6, 'Sabato', NULL),
(7, 'Domenica', NULL);

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

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `allenamento`
--
ALTER TABLE `allenamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_1` (`id_es1`),
  ADD KEY `rif_2` (`id_es2`),
  ADD KEY `rif_3` (`id_es3`),
  ADD KEY `rif_4` (`id_es4`),
  ADD KEY `rif_5` (`id_es5`),
  ADD KEY `rif_6` (`id_es6`),
  ADD KEY `rif_7` (`id_es7`),
  ADD KEY `rif_8` (`id_es8`),
  ADD KEY `rif_9` (`id_es9`),
  ADD KEY `rif_10` (`id_es10`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `rif_allenamento` (`id_allenamento`);

--
-- Indici per le tabelle `muscoli`
--
ALTER TABLE `muscoli`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `allenamento`
--
ALTER TABLE `allenamento`
  ADD CONSTRAINT `rif_1` FOREIGN KEY (`id_es1`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_10` FOREIGN KEY (`id_es10`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_2` FOREIGN KEY (`id_es2`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_3` FOREIGN KEY (`id_es3`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_4` FOREIGN KEY (`id_es4`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_5` FOREIGN KEY (`id_es5`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_6` FOREIGN KEY (`id_es6`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_7` FOREIGN KEY (`id_es7`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_8` FOREIGN KEY (`id_es8`) REFERENCES `esercizi` (`id`),
  ADD CONSTRAINT `rif_9` FOREIGN KEY (`id_es9`) REFERENCES `esercizi` (`id`);

--
-- Limiti per la tabella `esercizi`
--
ALTER TABLE `esercizi`
  ADD CONSTRAINT `rif_muscolo` FOREIGN KEY (`id_muscolo`) REFERENCES `muscoli` (`id`);

--
-- Limiti per la tabella `giorni`
--
ALTER TABLE `giorni`
  ADD CONSTRAINT `rif_allenamento` FOREIGN KEY (`id_allenamento`) REFERENCES `allenamento` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
