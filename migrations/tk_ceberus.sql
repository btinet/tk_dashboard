-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 10. Sep 2022 um 15:26
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tk_ceberus`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `key_question` text NOT NULL,
  `year` year(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `exam`
--

INSERT INTO `exam` (`id`, `topic_id`, `key_question`, `year`, `created`, `updated`) VALUES
(1, 4, 'Eine Untersuchung der\r\nneurophysiologischen, psychischen und gesellschaftlichen Auswirkungen des\r\nTHC-Konsums bei Jugendlichen und jungen Erwachsenen', 2021, '2022-09-09 15:20:38', NULL),
(2, 2, 'Inwieweit können 3D-Drucker die Organspende revolutionieren?', 2019, '2022-09-09 19:58:35', NULL),
(3, 4, 'Eine Untersuchung der\r\nneurophysiologischen, psychischen und gesellschaftlichen Auswirkungen des\r\nTHC-Konsums bei Jugendlichen und jungen Erwachsenen', 1969, '2022-09-09 15:20:38', '2022-09-10 11:10:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_has_school_subject`
--

CREATE TABLE `exam_has_school_subject` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `school_subject_id` int(11) DEFAULT NULL,
  `is_main_school_subject` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `exam_has_school_subject`
--

INSERT INTO `exam_has_school_subject` (`id`, `exam_id`, `school_subject_id`, `is_main_school_subject`, `created`, `updated`) VALUES
(1, 1, 1, 1, '2022-09-09 15:36:03', NULL),
(2, 1, 3, 0, '2022-09-09 15:37:00', NULL),
(3, 2, 1, 1, '2022-09-09 19:59:22', NULL),
(4, 2, 4, 0, '2022-09-09 20:00:03', NULL),
(6, 3, 1, 1, '2022-09-10 11:11:47', NULL),
(7, 3, 3, 0, '2022-09-10 11:11:47', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school_subject`
--

CREATE TABLE `school_subject` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `abbr` varchar(3) NOT NULL,
  `school_subject_type_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `school_subject`
--

INSERT INTO `school_subject` (`id`, `label`, `abbr`, `school_subject_type_id`, `created`, `updated`) VALUES
(1, 'Biologie', 'bio', 1, '2022-09-09 15:22:15', '2022-09-09 15:32:42'),
(2, 'Chemie', 'ch', 1, '2022-09-09 15:22:15', '2022-09-09 15:32:52'),
(3, 'Psyschologie', 'psy', 9, '2022-09-09 15:36:41', NULL),
(4, 'Informatik', 'inf', 5, '2022-09-09 19:59:45', NULL),
(5, 'Deutsch', 'de', 2, '2022-09-10 10:45:31', NULL),
(6, 'Englisch', 'en', 3, '2022-09-10 10:45:31', NULL),
(7, 'Französisch', 'fr', 3, '2022-09-10 10:45:59', NULL),
(8, 'Spanisch', 'spa', 3, '2022-09-10 10:45:59', NULL),
(9, 'Latein', 'lat', 3, '2022-09-10 10:46:27', NULL),
(10, 'Geographie', 'geo', 7, '2022-09-10 10:46:27', NULL),
(11, 'Philosophie', 'phi', 10, '2022-09-10 10:47:06', NULL),
(12, 'Physik', 'ph', 1, '2022-09-10 10:47:06', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school_subject_type`
--

CREATE TABLE `school_subject_type` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `school_subject_type`
--

INSERT INTO `school_subject_type` (`id`, `label`, `description`, `created`, `updated`) VALUES
(1, 'Naturwissenschaften', NULL, '2022-09-09 15:23:49', NULL),
(2, 'Deutsch', NULL, '2022-09-09 15:24:02', NULL),
(3, 'Fremdsprachen', NULL, '2022-09-09 15:24:18', NULL),
(4, 'Mathematik', NULL, '2022-09-09 15:24:29', NULL),
(5, 'Informatik', NULL, '2022-09-09 15:24:56', NULL),
(6, 'Technik', NULL, '2022-09-09 15:24:56', NULL),
(7, 'Gesellschaftswissenschaften', NULL, '2022-09-09 15:25:43', NULL),
(8, 'Musische Fächer', NULL, '2022-09-09 15:25:43', NULL),
(9, 'Psyschologie', NULL, '2022-09-09 15:26:22', NULL),
(10, 'Philosophie', NULL, '2022-09-09 15:26:22', NULL),
(11, 'Ethik', NULL, '2022-09-09 15:26:46', NULL),
(12, 'Sport', NULL, '2022-09-09 15:26:46', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `topic`
--

INSERT INTO `topic` (`id`, `title`, `description`, `created`, `updated`) VALUES
(1, 'Naturheilkunde', 'Pflanzliche und natürliche Wirkstoffe', '2022-09-09 15:11:18', NULL),
(2, 'Humanmedizin', 'Organismen und Organsysteme', '2022-09-09 15:12:36', NULL),
(3, 'Verhaltensbiologie', 'Sozialentwicklung von Wirbeltieren', '2022-09-09 15:15:03', NULL),
(4, 'Cannabis', 'Physische und psychische Auswirkungen', '2022-09-09 15:16:56', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `is_active`, `created`, `updated`) VALUES
(1, 'Benjamin', 'Wagner', 'bwagner', '4a84748fe21ac71ac3862699858977f7b5232c72', 'bwagner@vapita.de', 1, '2022-09-08 21:48:02', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_group_has_user`
--

CREATE TABLE `user_group_has_user` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role_has_role_permission`
--

CREATE TABLE `user_role_has_role_permission` (
  `id` int(11) NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `role_permission_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role_has_user`
--

CREATE TABLE `user_role_has_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_ibfk_1` (`topic_id`);

--
-- Indizes für die Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_subject_id` (`school_subject_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indizes für die Tabelle `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indizes für die Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `abbr` (`abbr`,`label`),
  ADD KEY `school_subject_type_id` (`school_subject_type_id`);

--
-- Indizes für die Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indizes für die Tabelle `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indizes für die Tabelle `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indizes für die Tabelle `user_group_has_user`
--
ALTER TABLE `user_group_has_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_group_id` (`user_group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`);

--
-- Indizes für die Tabelle `user_role_has_role_permission`
--
ALTER TABLE `user_role_has_role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_has_role_permission_ibfk_1` (`role_permission_id`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indizes für die Tabelle `user_role_has_user`
--
ALTER TABLE `user_role_has_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_id` (`user_role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_group_has_user`
--
ALTER TABLE `user_group_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_role_permission`
--
ALTER TABLE `user_role_has_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_user`
--
ALTER TABLE `user_role_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  ADD CONSTRAINT `exam_has_school_subject_ibfk_1` FOREIGN KEY (`school_subject_id`) REFERENCES `school_subject` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_has_school_subject_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  ADD CONSTRAINT `school_subject_ibfk_1` FOREIGN KEY (`school_subject_type_id`) REFERENCES `school_subject_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_group_has_user`
--
ALTER TABLE `user_group_has_user`
  ADD CONSTRAINT `user_group_has_user_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_group` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_has_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_role_has_role_permission`
--
ALTER TABLE `user_role_has_role_permission`
  ADD CONSTRAINT `user_role_has_role_permission_ibfk_1` FOREIGN KEY (`role_permission_id`) REFERENCES `role_permission` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_has_role_permission_ibfk_2` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_role_has_user`
--
ALTER TABLE `user_role_has_user`
  ADD CONSTRAINT `user_role_has_user_ibfk_2` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_has_user_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
