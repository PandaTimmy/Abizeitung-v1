-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 22. Jul 2024 um 23:16
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hgu-abi-25_abizeitungDB`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abstimmungen`
--

CREATE TABLE `abstimmungen` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `beichten`
--

CREATE TABLE `beichten` (
  `beichte` text NOT NULL,
  `datum` datetime NOT NULL,
  `favorit` int(11) NOT NULL,
  `id` text NOT NULL,
  `autor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `beichten`
--

INSERT INTO `beichten` (`beichte`, `datum`, `favorit`, `id`, `autor`) VALUES
('Ich habe heimlich den XXXXXXX für edits gefilmt', '2024-02-15 14:56:30', 0, '55095737', 'Der Urwirt'),
('Ich habe Bilder des XXXXXXX für brinstone edits missbraucht', '2024-02-15 15:21:32', 0, '90636486', 'Anonym');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzerkonten`
--

CREATE TABLE `benutzerkonten` (
  `nachname` text NOT NULL,
  `vorname` text NOT NULL,
  `benutzername` text NOT NULL,
  `hash` text NOT NULL,
  `rechte` int(11) DEFAULT 0,
  `sex` text NOT NULL,
  `login` int(11) DEFAULT NULL,
  `steckbriefFrei` int(11) DEFAULT 0,
  `realpassunlocked` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `benutzerkonten`
--

INSERT INTO `benutzerkonten` (`nachname`, `vorname`, `benutzername`, `hash`, `rechte`, `sex`, `login`, `steckbriefFrei`, `realpassunlocked`) VALUES
('Mustermann', 'Max', 'MustermannMax', 'f92a61bc5438be89ecb1317df902d906e9ef5d296447fb7d3050cb86951d7499d275de522aa7366e678e2f6acc0ffae7074d8b28831c342bf6da76cc4c8a88d9', 0, 'f', 0, 0, '0'),
('Doe', 'Jane', 'DoeJan', '1aa919822c4a4fe01c18281f366fdb2fc6753eb47e3ab966eec8861b0523d60b9b1fdb5a495b9c2fe446578e9fa4fb85be4ab0fcbc299ef1ac45807d541d71d0', 0, 'm', 0, 0, '0'),
('Klimke', 'Timothy', 'KlimkeTim', '3f045c1b91f04a0b2b09a67b50987b7506385bd665a3300cbbbf4c4c91bc67a2613560786b74f13caaa08f6c79e253d135a7f427626594d895cc4a7c34fdfef6', 1, 'm', 0, 1, '1');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dateien`
--

CREATE TABLE `dateien` (
  `benutzer` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `pfad` text DEFAULT NULL,
  `dateityp` text DEFAULT NULL,
  `datei` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rankings`
--

CREATE TABLE `rankings` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `steckbriefeantworten`
--

CREATE TABLE `steckbriefeantworten` (
  `benutzername` text NOT NULL,
  `9739271195008642` text DEFAULT NULL,
  `8752794658732644` text DEFAULT NULL,
  `660da7217c5ef` text DEFAULT NULL,
  `660db9c0b46b8` text DEFAULT NULL,
  `660db9c75def0` text DEFAULT NULL,
  `660db9d049822` text DEFAULT NULL,
  `660db9da7b85a` text DEFAULT NULL,
  `660f08d35bdea` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `steckbriefeeinstellungen`
--

CREATE TABLE `steckbriefeeinstellungen` (
  `name` text NOT NULL,
  `wert` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `steckbriefeeinstellungen`
--

INSERT INTO `steckbriefeeinstellungen` (`name`, `wert`) VALUES
('bearbeitbar', '1'),
('ansehbar', '1'),
('maxWeitereBilder', '2'),
('formatWeitereBilder', '3 zu 4'),
('formatTitelBild', '3 zu 4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `steckbriefefragen`
--

CREATE TABLE `steckbriefefragen` (
  `frage` text NOT NULL,
  `id` int(11) DEFAULT NULL,
  `randomId` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `steckbriefefragen`
--

INSERT INTO `steckbriefefragen` (`frage`, `id`, `randomId`) VALUES
('Geburtstag', 2, '9739271195008642'),
('Spitznamen', 1, '8752794658732644'),
('Lieblingsfach', 3, '660da7217c5ef'),
('Lieblingslehrer', 4, '660db9c0b46b8'),
('Leistungskurse', 5, '660db9c75def0'),
('In diesem Fach hatte ich die erste 6', 6, '660db9d049822');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `storys`
--

CREATE TABLE `storys` (
  `story` text NOT NULL,
  `datum` datetime NOT NULL,
  `favorit` int(11) NOT NULL DEFAULT 0,
  `id` text NOT NULL,
  `storytitel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `storys`
--

INSERT INTO `storys` (`story`, `datum`, `favorit`, `id`, `storytitel`) VALUES
('Im Geo Unterricht spawnt eine Biene direkt neben Leo. Er springt vor Schreck auf, nur um zu bemerken, dass er sein iPad noch bei der Biene gelassen hat. Er  fasst den heldenhaften Entschluss sich noch mal an seinen Platz zu trauen um sein iPad vor der bösen Biene zu retten.', '2024-04-30 09:29:55', 0, '6636548caf91c', 'Leo und die böse Biene'),
('XXXX', '2024-02-15 18:44:27', 1, '660da909dc521', 'Der Klagemauer Incident'),
('Ich habe in der neunten Klasse bei frau Reiser in Chemie immer extra provokant jede Woche einen Kinder Bueno mit Messer und Gabel im Fachraum gegessen. Hat sie aber nie gemerkt', '2024-02-15 18:09:13', 0, '663653f668af2', 'Bueno in Chemie');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tree`
--

CREATE TABLE `tree` (
  `branch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `umfragen`
--

CREATE TABLE `umfragen` (
  `titel` text NOT NULL,
  `beschreibung` text NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `umfragen`
--

INSERT INTO `umfragen` (`titel`, `beschreibung`, `name`, `status`) VALUES
('Testumfrage', 'Lorem Ipsum dolor sit amet.', 'Testumfrage', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `umfrage_Testumfrage`
--

CREATE TABLE `umfrage_Testumfrage` (
  `hash` text DEFAULT NULL,
  `antwort` text DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `favorit` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `umfrage_Testumfrage`
--

INSERT INTO `umfrage_Testumfrage` (`hash`, `antwort`, `datum`, `favorit`) VALUES
('aac85f8af505455fe194d46b2875e3b341a25f5c789f6a84a6027af362783cd6f40ea5b076e1867842bfe3a32398ef32f0beba0b4d13176a70ca7311b8595e1b', 'hey', '2023-12-17 14:56:52', 0),
('e1322da3ca623a6261f83ba8d2b4050b55a153cea8ae6164c6339582831f060ab18758c18f24bc9b0bddbc69af99c437ded32de5a97a207e233b90519f582591', 'LOL', '2023-12-17 14:57:10', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zitate`
--

CREATE TABLE `zitate` (
  `zitat` text NOT NULL,
  `datum` datetime NOT NULL,
  `favorit` int(11) NOT NULL,
  `id` text NOT NULL,
  `zitatkontext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `zitate`
--

INSERT INTO `zitate` (`zitat`, `datum`, `favorit`, `id`, `zitatkontext`) VALUES
('Sascha Huber Daddy', '2024-05-03 13:16:57', 0, '6635f0dfe9476', 'Frau XXXXX out of Kontext'),
('Bro Bro Bro', '2024-05-03 13:17:59', 0, '662e841a2ae38', 'XXX zu XXX in Deutsch'),
('So jetzt müsste eigentlich Funktionieren.', '2024-04-08 10:49:05', 0, '663551529ce3e', 'Physik experiment, Herr Mayer'),
('Frau XXXX: XX zeig mal dein WhatsApp Chat mit XXXX', '2024-05-10 07:57:50', 0, '663db75e27f6e', 'XXXX muss nachschreiben seit 2 Wochen kommt aber nicht (Kunst)'),
('Der Drucker hat mich Hops genommen', '2024-05-10 08:38:14', 0, '663dc0d6afb67', 'Frau XXXX in Kunst'),
('Pommes', '2024-06-30 11:50:06', 0, '66812a4ea86f2', 'Hallo');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abstimmungen`
--
ALTER TABLE `abstimmungen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `abstimmungen`
--
ALTER TABLE `abstimmungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
