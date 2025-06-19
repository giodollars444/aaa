-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 19, 2025 alle 22:07
-- Versione del server: 10.11.11-MariaDB-cll-lve
-- Versione PHP: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buonafor_akira`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `fasce_orarie`
--

CREATE TABLE `fasce_orarie` (
  `id` int(11) NOT NULL,
  `orario` time NOT NULL,
  `attivo` tinyint(1) DEFAULT 1,
  `descrizione` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `fasce_orarie`
--

INSERT INTO `fasce_orarie` (`id`, `orario`, `attivo`, `descrizione`) VALUES
(1, '12:00:00', 1, 'Pranzo'),
(2, '12:30:00', 1, 'Pranzo'),
(3, '13:00:00', 1, 'Pranzo'),
(4, '13:30:00', 1, 'Pranzo'),
(5, '19:00:00', 1, 'Cena'),
(6, '19:30:00', 1, 'Cena'),
(7, '20:00:00', 1, 'Cena'),
(8, '20:30:00', 1, 'Cena'),
(9, '21:00:00', 1, 'Cena'),
(10, '21:30:00', 1, 'Cena'),
(11, '22:00:00', 1, 'Cena'),
(12, '22:30:00', 1, 'Cena');

-- --------------------------------------------------------

--
-- Struttura della tabella `giorni_lavorativi`
--

CREATE TABLE `giorni_lavorativi` (
  `id` int(11) NOT NULL,
  `giorno_settimana` enum('lunedi','martedi','mercoledi','giovedi','venerdi','sabato','domenica') DEFAULT NULL,
  `orario_apertura` time DEFAULT NULL,
  `orario_chiusura` time DEFAULT NULL,
  `attivo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `giorni_lavorativi`
--

INSERT INTO `giorni_lavorativi` (`id`, `giorno_settimana`, `orario_apertura`, `orario_chiusura`, `attivo`) VALUES
(1, 'lunedi', NULL, NULL, 0),
(2, 'martedi', '12:00:00', '23:00:00', 1),
(3, 'mercoledi', '12:00:00', '23:00:00', 1),
(4, 'giovedi', '12:00:00', '23:00:00', 1),
(5, 'venerdi', '12:00:00', '23:00:00', 1),
(6, 'sabato', '12:00:00', '23:00:00', 1),
(7, 'domenica', '12:00:00', '23:00:00', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `limiti_date_specifiche`
--

CREATE TABLE `limiti_date_specifiche` (
  `id` int(11) NOT NULL,
  `data_specifica` date DEFAULT NULL,
  `limite_persone` int(11) DEFAULT 20,
  `attivo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `limiti_orari`
--

CREATE TABLE `limiti_orari` (
  `id` int(11) NOT NULL,
  `orario` time DEFAULT NULL,
  `limite_persone` int(11) DEFAULT 20,
  `attivo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `prezzo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `menu`
--

INSERT INTO `menu` (`id`, `nome`, `prezzo`) VALUES
(1, 'Menu Degustazione Chef', 85.00),
(2, 'Menu Omakase Premium', 120.00),
(3, 'Menu Sashimi Selection', 65.00),
(4, 'Menu Nigiri Tradizionale', 45.00),
(5, 'Menu Maki & Uramaki', 35.00),
(6, 'Menu Vegetariano', 40.00),
(7, 'Menu Bambini', 25.00),
(8, 'Cena Romantica (2 persone)', 180.00),
(9, 'Aperitivo Giapponese', 30.00),
(10, 'Menu Business Lunch', 28.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `numero_persone` int(11) DEFAULT 1,
  `note_allergie` text DEFAULT NULL,
  `tavolo_preferito` enum('interno','esterno','privato','sushi_bar') DEFAULT 'interno',
  `data_prenotazione` date DEFAULT NULL,
  `orario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ruolo` text DEFAULT NULL,
  `turno` enum('pranzo','cena','tutto_giorno') DEFAULT 'tutto_giorno',
  `attivo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `staff`
--

INSERT INTO `staff` (`id`, `nome`, `cognome`, `telefono`, `email`, `ruolo`, `turno`, `attivo`) VALUES
(1, 'Akira', 'Tanaka', '+39 123 456 7890', 'akira@akiraone.it', 'Head Chef & Proprietario', 'tutto_giorno', 1),
(2, 'Yuki', 'Sato', '+39 123 456 7891', 'yuki@akiraone.it', 'Sous Chef Sushi', 'cena', 1),
(3, 'Marco', 'Rossi', '+39 123 456 7892', 'marco@akiraone.it', 'Cameriere Senior', 'tutto_giorno', 1),
(4, 'Sakura', 'Yamamoto', '+39 123 456 7893', 'sakura@akiraone.it', 'Sommelier Sake', 'cena', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tavoli`
--

CREATE TABLE `tavoli` (
  `id` int(11) NOT NULL,
  `numero_tavolo` varchar(10) NOT NULL,
  `posti` int(11) NOT NULL,
  `tipo` enum('interno','esterno','privato','sushi_bar') DEFAULT 'interno',
  `attivo` tinyint(1) DEFAULT 1,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `tavoli`
--

INSERT INTO `tavoli` (`id`, `numero_tavolo`, `posti`, `tipo`, `attivo`, `note`) VALUES
(1, 'T1', 2, 'interno', 1, 'Tavolo romantico vicino alla finestra'),
(2, 'T2', 4, 'interno', 1, 'Tavolo famiglia'),
(3, 'T3', 6, 'interno', 1, 'Tavolo grande per gruppi'),
(4, 'T4', 2, 'esterno', 1, 'Terrazza con vista'),
(5, 'T5', 4, 'esterno', 1, 'Terrazza'),
(6, 'SB1', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(7, 'SB2', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(8, 'SB3', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(9, 'SB4', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(10, 'SB5', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(11, 'SB6', 1, 'sushi_bar', 1, 'Posto al bancone sushi'),
(12, 'P1', 8, 'privato', 1, 'Sala privata per eventi'),
(13, 'P2', 12, 'privato', 1, 'Sala privata grande');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `fasce_orarie`
--
ALTER TABLE `fasce_orarie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `giorni_lavorativi`
--
ALTER TABLE `giorni_lavorativi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `giorno_settimana` (`giorno_settimana`);

--
-- Indici per le tabelle `limiti_date_specifiche`
--
ALTER TABLE `limiti_date_specifiche`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `limiti_orari`
--
ALTER TABLE `limiti_orari`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indici per le tabelle `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tavoli`
--
ALTER TABLE `tavoli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_tavolo` (`numero_tavolo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `fasce_orarie`
--
ALTER TABLE `fasce_orarie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `giorni_lavorativi`
--
ALTER TABLE `giorni_lavorativi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `limiti_date_specifiche`
--
ALTER TABLE `limiti_date_specifiche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `limiti_orari`
--
ALTER TABLE `limiti_orari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tavoli`
--
ALTER TABLE `tavoli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
