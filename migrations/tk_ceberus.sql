-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 08. Sep 2022 um 22:24
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

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
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school_subject_type`
--

CREATE TABLE `school_subject_type` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `school_subject_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD UNIQUE KEY `abbr` (`abbr`,`label`);

--
-- Indizes für die Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label` (`label`),
  ADD KEY `school_subject_id` (`school_subject_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints der Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  ADD CONSTRAINT `school_subject_type_ibfk_1` FOREIGN KEY (`school_subject_id`) REFERENCES `school_subject` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
