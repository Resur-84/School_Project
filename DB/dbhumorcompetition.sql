-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 08, 2022 alle 19:24
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbhumorcompetition`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `jokes`
--

CREATE TABLE `jokes` (
  `id_joke` int(10) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `text_joke` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `shows` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `jokes`
--

INSERT INTO `jokes` (`id_joke`, `id_user`, `title`, `text_joke`, `created_at`, `shows`) VALUES
(1, 1, 'Knock knock', 'Who’s there?Interrupting cow.\r\nInterrupting c–.MOO!', '2022-03-31 23:36:12', 1),
(2, 2, 'Boomerang', 'What do you call a boomerang that won’t come back?\r\nA stick', '2022-03-31 23:36:12', 1),
(3, 5, 'Cloud', 'What does a cloud wear under his raincoat?\r\nThunderwear.', '2022-03-31 23:36:12', 1),
(4, 7, 'Two pickles', 'Two pickles fell out of a jar onto the floor. \r\nWhat did one say to the other?Dill with it.', '2022-03-31 23:36:12', 1),
(5, 9, 'Clock', 'What time is it when the clock strikes 13?\r\nTime to get a new clock.', '2022-03-31 23:36:12', 1),
(6, 6, 'Toilet', 'What did one toilet say to the other?\r\nYou look a bit flushed.', '2022-03-31 23:36:12', 1),
(7, 12, 'New word', 'I invented a new word! \r\nPlagiarism!', '2022-04-06 19:52:35', 1),
(9, 15, 'Scientists ', 'Why don’t scientists trust atoms?\r\nBecause they make up everything.', '2022-04-06 22:38:13', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_user` varchar(12) DEFAULT NULL,
  `teacher` tinyint(1) DEFAULT NULL,
  `temporary_password` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `email`, `password_user`, `teacher`, `temporary_password`) VALUES
(1, 'matteo.loverde@galileo.galileicrema.it', '1234', 0, NULL),
(2, 'marco.granata@galileo.galileicrema.it', '1234', 0, NULL),
(3, 'manuela.mileo@galileo.galileicrema.it', '1234', 1, NULL),
(4, 'alberto.cannizzaro@galileo.galileicrema.it', '1234', 1, NULL),
(5, '22364@aeffl.pt', '1234', 0, NULL),
(6, '22976@aeffl.pt', '1234', 0, NULL),
(7, 'riccardo.nosotti@galileo.galileicrema.it', '12345', 0, NULL),
(8, 'nadia.manclossi@galileo.galileicrema.it', '1234', 1, NULL),
(9, '22244@aeffl.pt', '1234', 0, NULL),
(10, 'dora.ramponi@galileo.galileicrema.it', '1234', 1, NULL),
(11, 'claudiaxavier@aeffl.pt', '1234', 1, NULL),
(12, 'irvano.bianchi@galileo.galileicrema.it', '1234', 0, NULL),
(13, 'simone.conte@galileo.galileicrema.it', '1234', 0, NULL),
(14, 'true.admin@galileo.galileicrema.it', 'admin', 1, NULL),
(15, 'sofia.orsi@galileo.galileicrema.it', '1234', 0, NULL),
(16, 'jacopo.gerosa@galileo.galileicrema.it', '1234', 0, '5597');

-- --------------------------------------------------------

--
-- Struttura della tabella `votes`
--

CREATE TABLE `votes` (
  `id_joke` int(10) DEFAULT NULL,
  `id_user` int(10) DEFAULT NULL,
  `vote` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `votes`
--

INSERT INTO `votes` (`id_joke`, `id_user`, `vote`) VALUES
(3, 2, 3),
(3, 6, 4),
(3, 3, 4),
(5, 2, 1),
(6, 6, 4),
(4, 7, 2),
(3, 7, 1),
(3, 9, 1),
(5, 7, 4),
(9, 7, 5),
(7, 7, 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `jokes`
--
ALTER TABLE `jokes`
  ADD PRIMARY KEY (`id_joke`),
  ADD KEY `id_user` (`id_user`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indici per le tabelle `votes`
--
ALTER TABLE `votes`
  ADD KEY `id_joke` (`id_joke`),
  ADD KEY `id_user` (`id_user`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `jokes`
--
ALTER TABLE `jokes`
  ADD CONSTRAINT `jokes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_joke`) REFERENCES `jokes` (`id_joke`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
