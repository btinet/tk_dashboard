-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Dez 2022 um 22:06
-- Server-Version: 10.4.25-MariaDB
-- PHP-Version: 8.1.10

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
  `key_question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `exam`
--

INSERT INTO `exam` (`id`, `topic_id`, `key_question`, `year`, `created`, `updated`) VALUES
(1, 1, '﻿Endometriose - wo bleibt die Diagnose?', 2020, '2022-12-10 21:34:07', NULL),
(2, 1, 'Tropenkrankheiten - Tickende Zeitbomben?  - Die Verbreitung von Leishmaniose in Europa', 2020, '2022-12-10 21:34:07', NULL),
(3, 1, 'Epigenetik - Sind Traumata vererbbar?', 2020, '2022-12-10 21:34:07', NULL),
(4, 1, 'Die Heizung aus dem Supermarkt - Eine Untersuchung des Energiespeicherpotenzials von Latentwärmespeichern', 2020, '2022-12-10 21:34:07', NULL),
(5, 1, 'Theatrale Darstellung der Entwicklung der \"Esmeralda\" aus \" Der Glöckner von Dame\" (Victor Hugo, 1831) mit den Mitteln des epischen Theaters.', 2020, '2022-12-10 21:34:07', NULL),
(6, 1, '\"An der Schwelle\" Theatrale Untersuchung mit den Mitteln des Bewegungstheaters und des Lichtdesigns', 2020, '2022-12-10 21:34:07', NULL),
(7, 1, 'Theatrale und filmische Umsetzung des Themas \"Neue Medien\" mit den Mitteln des dokumentarischen Theaters', 2020, '2022-12-10 21:34:07', NULL),
(8, 1, 'Does Jamaica´s colonial past still haunt the country? A closer look at Jamaica´s political, economic and social structure.', 2020, '2022-12-10 21:34:07', NULL),
(9, 1, 'Die Entwicklung und Funktion des Sumosports in der japanischen Geschichte - auch heute ein erhaltenswertes kulturelles Erbe oder unmoralische Gesundheitsgefährdung?', 2020, '2022-12-10 21:34:08', NULL),
(10, 1, 'Jeanne d´Arc - historischer Mythos oder historische Realität?', 2020, '2022-12-10 21:34:08', NULL),
(11, 1, 'Die Gladiatorenkämpfe in Rom - ein sportliches Spektakel zur Belustigung der Bevölkerung oder ein gesellschaftspolitisches Instrument?', 2020, '2022-12-10 21:34:08', NULL),
(12, 1, 'Die Pyramiden von Gizeh: reiner Totenkult oder mathematische Meisterleistung?', 2020, '2022-12-10 21:34:08', NULL),
(13, 1, 'Wurde von allen verhandelt und gebilligt, was alle betraf? Das Einstimmigkeitsprinzip der römischen Republik', 2020, '2022-12-10 21:34:08', NULL),
(14, 1, 'Ging es Malala Yousaftai mit ihrem Engagement nur um eine Reform des pakistanischen Bildungssystems oder um eine grundsätzliche Kritik an den Taliban?', 2020, '2022-12-10 21:34:08', NULL),
(15, 1, 'Japans Traditionssport - Half die Kampfkunst Karate der japanischen Bevüölkerung, sich gegen die Ausbeutung durch das Kaisertum zur Wehr zu setzen?', 2020, '2022-12-10 21:34:08', NULL),
(16, 1, 'Wurde von allen verhandelt und gebilligt, was alle betraf? Das Einstimmigkeitsprinzip der römischen Republik', 2020, '2022-12-10 21:34:08', NULL),
(17, 1, 'Ist der Anbau von Ölpalmen ein Gewinn für die Sozioökonomie auf Sumatra oder eine ökologische Katastrophe?', 2020, '2022-12-10 21:34:08', NULL),
(18, 1, 'Veganismus -  Ein Schlüssel zum Umweltschutz oder ein moderner Ernährungstrend?', 2020, '2022-12-10 21:34:08', NULL),
(19, 1, 'Das Insektensterben in Deutschland - ein unaufhaltsamer Prozess?', 2020, '2022-12-10 21:34:08', NULL),
(20, 1, 'Konzeptionierung und Vorstellung eines Adbusting-Projekts als politischer Protest im urbanen Raum', 2020, '2022-12-10 21:34:08', NULL),
(21, 1, 'Mit welchen malerischen Mitteln lässt sich der Tod aus persönlicher und philosophischer Sicht adäquat darstellen?', 2020, '2022-12-10 21:34:08', NULL),
(22, 1, 'Welche Prägung hat die DDR-Fotografie 30 Jahre nach der Wende? Eine multimediale Reise aus verschiedenen Blickwinkeln', 2020, '2022-12-10 21:34:08', NULL),
(23, 1, 'Wie hat sich das Ziselierhandwerk im Industrialisierungsprozess verändert? Untersuchung und Vergleich der Arbeitsverfahren in den letzten 300 Jahren.', 2020, '2022-12-10 21:34:08', NULL),
(24, 1, 'Inwiefern kann die Erprobung von gestischen und abstrakten Vorgehensweisen in der Malerei eine Überwindung von Verhaltensmustern unterstützen?', 2020, '2022-12-10 21:34:08', NULL),
(25, 1, '25 Jahre Einfluss auf mein Schönheitsideal - Fotografische Auseinandersetzung', 2020, '2022-12-10 21:34:08', NULL),
(26, 1, 'Bin ich schön? Der Körper zwischen biologischer Funktion und künstlerischem Ausdruck.', 2020, '2022-12-10 21:34:08', NULL),
(27, 1, 'Inwiefern kann mit Methoden des \"Liquid Light\" die Stimmung von life-music-performances verstärkt werden?', 2020, '2022-12-10 21:34:08', NULL),
(28, 1, 'Ist Latein die Mutter der europäischen Sprachen? Geschichtliche Untersuchung anhand der Völkerwanderung', 2020, '2022-12-10 21:34:08', NULL),
(29, 1, 'Autonome Elektromobilität in Großstädten. Was erwarten wir von modernen Fahrzeugantrieben?', 2020, '2022-12-10 21:34:08', NULL),
(30, 1, 'Gibt es eine Grenze des menschlichen Potenzials?', 2020, '2022-12-10 21:34:08', NULL),
(31, 1, 'Sind die \"psychisch Gesunden\" in der modernen Gesellschaft in Wirklichkeit krank? - Eine Auseinandersetzungmit Erich Fromms Bild des modernen Menschen im Hinblick auf Narzissmus, Entfremdung, Konformismus und Verlust von Individualität.', 2020, '2022-12-10 21:34:08', NULL),
(32, 1, 'Künstliche und menschliche Intelligenz - werden immer wesentliche Unterschiede zwischen beiden bestehen oder können die Gemeinsamkeiten überwiegen?', 2020, '2022-12-10 21:34:08', NULL),
(33, 1, 'Die Funktion der Kunst des Expressionismus - Katharsis oder negative Utopie?', 2020, '2022-12-10 21:34:08', NULL),
(34, 1, 'Zerstört der Kapitalismus unsere Fähigkeit zu wahrer Liebe? Eine Auseinandersetzung mit Erich Fromm und Eva Illouz', 2020, '2022-12-10 21:34:08', NULL),
(35, 1, 'Geschlechteridentität: Führt eine genderneutrale Erziehung zur Entwicklung einer autonomen Pesönlichkeit? Eine Untersuchung unter psychologischen und biologischen Gesichtspunkten.', 2020, '2022-12-10 21:34:08', NULL),
(36, 1, '\"Glückliche Frauen gebären glückliche Kinder.\" Ist es tatsächlich so einfach? [Eine psychologische Betrachtung]', 2020, '2022-12-10 21:34:08', NULL),
(37, 1, 'Zucker, ein Nahrungsmittel oder ein Suchtstoff?', 2020, '2022-12-10 21:34:08', NULL),
(38, 1, 'Lie to me - Kann Körpersprache unsere Gedanken verraten?', 2020, '2022-12-10 21:34:08', NULL),
(39, 1, 'Inszenierung des Black Metal - Eine bewusste Provokation?', 2020, '2022-12-10 21:34:08', NULL),
(40, 1, 'Gefangen in den Hörgewohnheiten unserer Vorfahren - Ist der Mensch musikalisch geprägt?', 2020, '2022-12-10 21:34:08', NULL),
(41, 1, 'Neuroleptika - zwingend notwendig zur Behandlung von Schizophrenie?', 2020, '2022-12-10 21:34:08', NULL),
(42, 1, 'Entsprechen Pippi Langstrumpf, Tommy und Annika dem Es, dem Ich und dem Über-Ich nach S. Freud? Analyse eines Romans von Astrid Lindgren in Bezug auf das 3 Instanzenmodell nach S. Freud', 2020, '2022-12-10 21:34:08', NULL),
(43, 1, 'Hypersensibilität: eine Einschränkung oder eine besondere Fähigkeit?', 2020, '2022-12-10 21:34:08', NULL),
(44, 1, 'Südafrika - Ein problemloser Übergang von der Apartheid in die Demokratie oder ein Land im Stillstand?', 2020, '2022-12-10 21:34:08', NULL),
(45, 1, 'Die Globalisierung: Ein Gewinn für die Indigenen Völker im brasilianischen Amazonasgebiet oder die Zerstörung ihrer Lebensgrundlage?', 2020, '2022-12-10 21:34:08', NULL),
(46, 1, 'Frauenquote - ein sinnvolles Mittel zur Gleichberechtigung der Frau?', 2020, '2022-12-10 21:34:08', NULL),
(47, 1, 'Sind Tierversuche noch aktuell? Eine Untersuchung anhand von Beispielen aus der molekularen Genetik', 2021, '2022-12-10 21:34:08', NULL),
(48, 1, 'Inwiefern kann der gezielte Einsatz von Mykorrhiza-Pilzen im Gemüseanbau das Problem des kommenden Nahrungsmangels abmildern oder sogar verhindern?', 2021, '2022-12-10 21:34:08', NULL),
(49, 1, 'Gefangen im Rausch. Welchen Einfluss hat ein übermäßiger Alkoholkonsum oder eine Alkoholsucht auf den Körper und inwiefern beeinflussen biologische Schäden und Veränderungen die psychische Gesundheit?', 2021, '2022-12-10 21:34:08', NULL),
(50, 1, 'Der Reiter formt das Pferd - Welchen Einfluss hat die sportliche Ausbildung des Reiters auf die körperliche Gesunderhaltung des Pferdes?', 2021, '2022-12-10 21:34:08', NULL),
(51, 1, 'Schülererwartungen im Umgang mit Modellen: Empirische Analyse der Modellkompetenz am Beispiel des biologischen Modells der DNA-Helix.', 2021, '2022-12-10 21:34:08', NULL),
(52, 1, 'Inwiefern lässt sich mit den Mitteln des politischen Theaters die gesellschaftliche Spaltung durch rassistische Ideologien darstellen?', 2021, '2022-12-10 21:34:08', NULL),
(53, 1, 'Warum gab es keine Entschädigung für vietnamesische Agent-Orange-Opfer in Folge des Vietnam-Krieges? Eine Untersuchung der politischen und rechtlichen Hintergründe.', 2021, '2022-12-10 21:34:08', NULL),
(54, 1, 'Warum entwickelte sich die Tattoo-Mode von außergewöhnlichen Einzelfällen zu einem Massenphänomen?', 2021, '2022-12-10 21:34:08', NULL),
(55, 1, 'Hannibal ante portas? Warum verzichtete Hannibal nach der Schlacht bei Cannae 216 v. Chr. Auf den Angriff auf Rom?', 2021, '2022-12-10 21:34:08', NULL),
(56, 1, 'Der Einfluss neoliberaler Theorien auf die Diktatur Augusto Pinochets - Impulse für eine Modernisierung des Landes zum Wohle der Bevölkerung?', 2021, '2022-12-10 21:34:08', NULL),
(57, 1, 'War die Gründung der ersten Kreuzfahrerstaaten legitim? - Eine Betrachtung am Beispiel Bohemumds von Tarent, Fürst von Antiochia.', 2021, '2022-12-10 21:34:08', NULL),
(58, 1, 'Globalisierte Landwirtschaft in den Entwicklungsländern: Ist ein nachhaltiges und ertragsfähiges Wirtschaften nur mit Einflussnahme von transnationalen Agrarkonzernen möglich?', 2021, '2022-12-10 21:34:08', NULL),
(59, 1, 'Aquaponik - Ein vielversprechendes nachhaltiges System für die Nahrungsmittelproduktion oder ein Irrweg?', 2021, '2022-12-10 21:34:08', NULL),
(60, 1, '\"Fridays for Future\" - ein geografisch und psychologisch determiniertes Phänomen der entwickelten Nationen?', 2021, '2022-12-10 21:34:08', NULL),
(61, 1, 'Black Art? - Folgt meine eigene künstlerische Expedition Klischees, die man mit \"Black Art\" verbindet oder kann ich mich davon absetzen?', 2021, '2022-12-10 21:34:08', NULL),
(62, 1, 'Landschaft im Computerspiel. Wie entwickle ich künstlerische Techniken um Fiktion und Natur im Baukastenprinzip zusammenzubringen?', 2021, '2022-12-10 21:34:08', NULL),
(63, 1, 'Upcycling - wie können wir durch kreatives Gestalten den persönlichen Selbstwert und materiellen Neuwert steigern?', 2021, '2022-12-10 21:34:08', NULL),
(64, 1, 'Sind die Grundprinzipien der Bautechnik des antiken römischen Reiches heutzutage noch aktuell? Eine Untersuchenug am Beispiel von opus caementitium, Rundbogen und römischem Straßennetz zur Zeit Vitruvs.', 2021, '2022-12-10 21:34:08', NULL),
(65, 1, 'Inwiefern lassen sich physikalische Grundprinzipien nutzen, um, anstelle von Virostatika unsd Antibiotika, virale und bakterielle Erkrankungen zu bekämpfen?', 2021, '2022-12-10 21:34:08', NULL),
(66, 1, 'Brauchen wir physische Prototypen für Tests im Windkanal? Untersuchung zur Aerodynamik am Beispiel vom Fahrzeugdesign im Vergleich von Realem und Computersimulation.', 2021, '2022-12-10 21:34:08', NULL),
(67, 1, 'Eine ethische Auseinandersetzung mit dem moralischen Status künstlich erzeugter Lebewesen - Welche Folgen hat die unklare Artzuweisung von Mensch-Tier-Chimären für die Kategorisierung von Lebewesen und das Selbstverständnis des Menschen?', 2021, '2022-12-10 21:34:08', NULL),
(68, 1, 'Warum fragen wir uns, ob wir nicht allein sind? Eine philosophische Untersuchung des Begriffs der Neugier, betrachtet am Beispiel der Suche nach extraterrestrischer Intelligenz', 2021, '2022-12-10 21:34:08', NULL),
(69, 1, 'Sind wir wirklich frei in unserer (Un) Freiheit? - Das jetzige deutsche Bildungssystem als exemplarisches Spannungsfeld einer möglichen menschlichen Fehlentwicklung', 2021, '2022-12-10 21:34:08', NULL),
(70, 1, 'Inwiefern wirken sich biologische Vorgänge im Darm auf kognitive Prozesse und die psychische Gesundheit aus? Ist diese Verbindung beeinflussbar?', 2021, '2022-12-10 21:34:08', NULL),
(71, 1, 'Vom Partyrausch zur psychischen Störung - Gefährdet unsere Partykultur und der Substanzgebrauch die Gesundheit einer gesamten Generation?', 2021, '2022-12-10 21:34:09', NULL),
(72, 1, 'Inwieweit bestimmt Medienkonsum die Gehirnentwicklung und damit die Persönlichkeit im Kleinkindalter?', 2021, '2022-12-10 21:34:09', NULL),
(73, 1, '2020 - Ein Jahr der psychischen Krisen? Inwiefern können spielend dargestellte Verhaltensmuster die Selbstreflexion zur Bewältigung der psychischen Krisen aus dem Corona-Jahr 2020 unterstützen?', 2021, '2022-12-10 21:34:09', NULL),
(74, 1, 'Gibt es psychologische Gemeinsamkeiten in der Persönlichkeitsstruktur von Despoten? Eine historische Untersuchung am Beispiel von Idi Amin, Duda und Augusto Pinochet.', 2021, '2022-12-10 21:34:09', NULL),
(75, 1, 'Könnte Bildung für alle Schichten die soziale Zerissenheit der südafrikanischen Gesellschft beenden? Eine sozialpsychologische Betrachtung unter Beachtung der ökonomischen Verhältnisse', 2021, '2022-12-10 21:34:09', NULL),
(76, 1, 'Das Fleischparadoxon - Wie können wir damit umgehen? Welche psychologischen Prozesse ermöglichen die differnzierte Betrachtung von Tieren als Lebensmittel und inwiefern hat die Rationalisierung der landwirtschaftlichen Tierproduktion dazu beigetragen?', 2021, '2022-12-10 21:34:09', NULL),
(77, 1, 'Ist Verhütung Frauensache? Geschlechtergleichberechtigung in Forschung und Marketing zur Kontrazeption', 2021, '2022-12-10 21:34:09', NULL),
(78, 1, 'Der Contergan-Fall der 1950er und 1960er Jahre - eine unvermeidbare Arzneimittelkatastrophe?', 2021, '2022-12-10 21:34:09', NULL),
(79, 1, 'Warum liegt vielen Verschwörungstheorien ein antisemitischer Kern zugrunde? Eine Analyse anhand der aktuellen Corona-Proteste', 2021, '2022-12-10 21:34:09', NULL),
(80, 1, 'Der Sezessionskrieg in den USA (1861-1865) - War eine kriegerische Auseinandersetzung notwendig oder hätte sie verhindert werden können?', 2021, '2022-12-10 21:34:09', NULL),
(81, 1, 'Inwiefern können psychische als auch geografische Faktoren die Krankheit \"Psoriasis Vulgaris\" beeinflussen?', 2022, '2022-12-10 21:34:09', NULL),
(82, 1, 'Wie funktioniert die chemische Kommunikation der Ameisen und inwiefern ist diese der entscheidende Faktor für ihren evolutionären Erfolg?', 2022, '2022-12-10 21:34:09', NULL),
(83, 1, 'Der Friseur als Proteinchemiker. Sind Colorationen eine Form der Kunst oder gefährlich für Haut und Haar?', 2022, '2022-12-10 21:34:09', NULL),
(84, 1, 'Alleskönner Kunststoff! Altagsgegenstand Acrylglas und seine künstlerische Verfremdung', 2022, '2022-12-10 21:34:09', NULL),
(85, 1, 'Inwiefern kann ein Verfremdungseffekt das Märchen \"Hänsel und Gretel\" eine Veränderung der Aussage bei dr Zielgruppe bewirken?', 2022, '2022-12-10 21:34:09', NULL),
(86, 1, 'Die eigentliche Bedeutung Albert Einsteins bei der Neufassung der klassischen Physik im 20. Jahrhundert. Warum gelang ihm, woran alle anderen vor ihm scheiterten?', 2022, '2022-12-10 21:34:09', NULL),
(87, 1, 'Der deutsche Schäferhund - Warum diente gerade diese Hunderasse als nationalsozialistisches Symbol?', 2022, '2022-12-10 21:34:09', NULL),
(88, 1, 'Inwiefern ist die Enigma ein Beispiel dafür, dass die Kryptographie für die Kommunikation im 2. Weltkrieg notwendig geworden ist?', 2022, '2022-12-10 21:34:09', NULL),
(89, 1, 'Inwiefern war die zunehmende Gleichstellung der Frau in der Weimarer Republik ein gesellschaftlicher und persönlicher Erfolg?', 2022, '2022-12-10 21:34:09', NULL),
(90, 1, 'Gleichstellungspolitik heute - Inklusion aller im Zeichen des gesellschaftlichen Egalitarismus oder Exklusion des Männlichen?', 2022, '2022-12-10 21:34:09', NULL),
(91, 1, 'Inwiefern ist der Film \"Swing Kids\" in der Lage, die Situation der deutschen Swing Jugend während der NS-Zeit historisch korrekt zu illustrieren?', 2022, '2022-12-10 21:34:09', NULL),
(92, 1, 'Inwiefern war der deutsche Film 1933-1945 ein Instrument zur Vermittlung faschistischer Ideologien?', 2022, '2022-12-10 21:34:09', NULL),
(93, 1, 'Die Herstellung von Kokain in Kolumbien: Warum wird der Standort für die Herstellung von Kokain favorisiert?', 2022, '2022-12-10 21:34:09', NULL),
(94, 1, 'Inwiefern kann der Desertifikation in Saudi-Arabien biotechnologisch entgegengewirkt werden?', 2022, '2022-12-10 21:34:09', NULL),
(95, 1, 'Die wirtschaftliche Situation Nigerias: Ein Erbe der Kolonialzeit?', 2022, '2022-12-10 21:34:09', NULL),
(96, 1, 'Der Nil: Wasser als Basis historischer und neuzeitiger politischer Konflikte seiner Anrainerstaaten?', 2022, '2022-12-10 21:34:09', NULL),
(97, 1, 'Der Handelskrieg zwischen den USA und China während Donald Trumps Präsidentschaft: Folgenreicher Aufschwung der chinesischen Technik-Industrie?', 2022, '2022-12-10 21:34:09', NULL),
(98, 1, 'Demographie und Stadtentwicklung in dem australischen Bezirk Footscray, Melbourne. Gentrifizierung; wird Footscray dadurch besser?', 2022, '2022-12-10 21:34:09', NULL),
(99, 1, 'Kann der Anbau der hanfpflanze Cannabidoil (CBD) ein wirtschaftlicher Entwicklungsmotor sein, z.B. für Simbabwe?', 2022, '2022-12-10 21:34:09', NULL),
(100, 1, 'Der Wiener Aktionismus - von der psychologischen Intension und Wirkung des Rituellen und Morbiden in der Kunst', 2022, '2022-12-10 21:34:09', NULL),
(101, 1, 'Inwiefern ist der goldene Schnitt in mathematischen Formen heute noch in alter und moderner Kunst in Berlin zu finden?', 2022, '2022-12-10 21:34:09', NULL),
(102, 1, 'Inwiefern wird sich die Funktionsweise der Quantencomputer auf heutige Verschlüsselungstechniken auswirken?', 2022, '2022-12-10 21:34:09', NULL),
(103, 1, 'Gerechtigkeit in der Gesellschaft - Sollte das Erbrecht in der Bundesrepublik Deutschland im Interesse einer gerechteren Verteilung des gesellschaftlichen Reichtums reformiert werden?', 2022, '2022-12-10 21:34:09', NULL),
(104, 1, 'Inwiefern lässt sich das Recht auf selbstbestimmtes Sterben unter Berücksichtigung des Schmerzempfindens im philosophischen und psychologischen Kontext begründen?', 2022, '2022-12-10 21:34:09', NULL),
(105, 1, 'Stellt eine generelle KI eine konzeptionelle Herausforderung für das menschliche Selbstbild dar?', 2022, '2022-12-10 21:34:09', NULL),
(106, 1, 'Wie sollten wir mit Erkenntnissen aus unmoralischer Forschung umgehen? Hinterfragung am Beispiel der Forschung an Menschen in Deutschland von 1939-1945', 2022, '2022-12-10 21:34:09', NULL),
(107, 1, 'Inwiefern ist ein Dualismus von Körper und Geist vereinbar mit dem interdisziplinären Fachgebiet der Psychosomatik der Moderne? ', 2022, '2022-12-10 21:34:09', NULL),
(108, 1, 'Kann man den buddhistischen Wahrheitsbegriff mit den Vorstellungen des späten Wittgenstein vereinbaren und damit adäquater für den deutschen Kulturraum übersetzen?', 2022, '2022-12-10 21:34:09', NULL),
(109, 1, 'Ist die Leidensfähigkeit eines Wesensein hinreichendes Kriterium für die Zuschreibung von Würde?', 2022, '2022-12-10 21:34:09', NULL),
(110, 1, 'Ist es sinnvoll anzunehmen, dass eine erhöhte Sprachkompetenz Qualia nachvollziehbarer transportieren?', 2022, '2022-12-10 21:34:09', NULL),
(111, 1, 'Ist der Verweis auf das physikalische Konzept Relativität in philosophischen Diskussionen ein Missverständnis?', 2022, '2022-12-10 21:34:09', NULL),
(112, 1, 'Der freie Wille - kann er dem Menschen aus biologischer Sicht aberkannt werden?', 2022, '2022-12-10 21:34:09', NULL),
(113, 1, 'Inwiefern lässt sich eine Übertragung eines Traumas auf nachfolgende Generationen nachweisen? Der Versuch einer Analyse am Beispiel des spanischen Bürgerkrieges', 2022, '2022-12-10 21:34:09', NULL),
(114, 1, 'Hochbegabung - Fluch oder Segen? Inwiefern ist Hochbegabung genetisch bedingt?', 2022, '2022-12-10 21:34:09', NULL),
(115, 1, 'Profiling unter besonderer Beachtung biologischer Aspekte - Mythos oder wichtiges Werkzeug der Forensik?', 2022, '2022-12-10 21:34:09', NULL),
(116, 1, 'War die Black Pather Party eine Bedrohung für die innere Sicherheit der USA oder doch nur eine Rebellion gegen Rassismus?', 2022, '2022-12-10 21:34:09', NULL),
(117, 1, 'Politische Kunst: Beeinflussung des politischen Meinungsbildes am Beispiel von Joseph Beuys.', 2022, '2022-12-10 21:34:09', NULL),
(118, 1, 'Chinas Handelspolitik heute - wie weitreichend ist Chinas Einfluss auf den Welthandel der Gegenwart?', 2022, '2022-12-10 21:34:09', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_has_exam_status`
--

CREATE TABLE `exam_has_exam_status` (
  `id` int(11) NOT NULL,
  `user_exam_id` int(11) NOT NULL,
  `exam_status_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `exam_has_exam_status`
--

INSERT INTO `exam_has_exam_status` (`id`, `user_exam_id`, `exam_status_id`, `supervisor_id`, `info`, `created`, `updated`) VALUES
(14, 14, 3, 2, 'Antrag angelegt', '2022-12-08 07:19:01', NULL),
(15, 14, 6, 6, 'Bitte Leitfrage überarbeiten', '2022-12-08 07:40:03', NULL),
(16, 15, 3, 2, 'Antrag angelegt', '2022-12-10 08:20:48', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_has_school_subject`
--

CREATE TABLE `exam_has_school_subject` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `school_subject_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_main_school_subject` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `exam_has_school_subject`
--

INSERT INTO `exam_has_school_subject` (`id`, `exam_id`, `school_subject_id`, `user_id`, `is_main_school_subject`, `created`, `updated`) VALUES
(1, 1, 1, NULL, 1, '2022-12-10 21:34:07', NULL),
(2, 1, 18, NULL, 0, '2022-12-10 21:34:07', NULL),
(3, 2, 1, NULL, 1, '2022-12-10 21:34:07', NULL),
(4, 2, 10, NULL, 0, '2022-12-10 21:34:07', NULL),
(5, 3, 1, NULL, 1, '2022-12-10 21:34:07', NULL),
(6, 3, 3, NULL, 0, '2022-12-10 21:34:07', NULL),
(7, 4, 2, NULL, 1, '2022-12-10 21:34:07', NULL),
(8, 4, 12, NULL, 0, '2022-12-10 21:34:07', NULL),
(9, 5, 22, NULL, 1, '2022-12-10 21:34:07', NULL),
(10, 5, 3, NULL, 0, '2022-12-10 21:34:07', NULL),
(11, 6, 22, NULL, 1, '2022-12-10 21:34:07', NULL),
(12, 6, 19, NULL, 0, '2022-12-10 21:34:07', NULL),
(13, 7, 22, NULL, 1, '2022-12-10 21:34:07', NULL),
(14, 7, 19, NULL, 0, '2022-12-10 21:34:07', NULL),
(15, 8, 6, NULL, 1, '2022-12-10 21:34:08', NULL),
(16, 8, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(17, 9, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(18, 9, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(19, 10, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(20, 10, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(21, 11, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(22, 11, 20, NULL, 0, '2022-12-10 21:34:08', NULL),
(23, 12, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(24, 12, 23, NULL, 0, '2022-12-10 21:34:08', NULL),
(25, 13, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(26, 13, 9, NULL, 0, '2022-12-10 21:34:08', NULL),
(27, 14, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(28, 14, 10, NULL, 0, '2022-12-10 21:34:08', NULL),
(29, 15, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(30, 15, 20, NULL, 0, '2022-12-10 21:34:08', NULL),
(31, 16, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(32, 16, 9, NULL, 0, '2022-12-10 21:34:08', NULL),
(33, 17, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(34, 17, 2, NULL, 0, '2022-12-10 21:34:08', NULL),
(35, 18, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(36, 18, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(37, 19, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(38, 19, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(39, 20, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(40, 20, 17, NULL, 0, '2022-12-10 21:34:08', NULL),
(41, 21, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(42, 21, 11, NULL, 0, '2022-12-10 21:34:08', NULL),
(43, 22, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(44, 22, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(45, 23, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(46, 23, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(47, 24, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(48, 24, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(49, 25, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(50, 25, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(51, 26, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(52, 26, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(53, 27, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(54, 27, 12, NULL, 0, '2022-12-10 21:34:08', NULL),
(55, 28, 9, NULL, 1, '2022-12-10 21:34:08', NULL),
(56, 28, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(57, 29, 12, NULL, 1, '2022-12-10 21:34:08', NULL),
(58, 29, 2, NULL, 0, '2022-12-10 21:34:08', NULL),
(59, 30, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(60, 30, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(61, 31, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(62, 31, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(63, 32, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(64, 32, 4, NULL, 0, '2022-12-10 21:34:08', NULL),
(65, 33, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(66, 33, 19, NULL, 0, '2022-12-10 21:34:08', NULL),
(67, 34, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(68, 34, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(69, 35, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(70, 35, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(71, 36, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(72, 36, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(73, 37, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(74, 37, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(75, 38, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(76, 38, 22, NULL, 0, '2022-12-10 21:34:08', NULL),
(77, 39, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(78, 39, 19, NULL, 0, '2022-12-10 21:34:08', NULL),
(79, 40, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(80, 40, 24, NULL, 0, '2022-12-10 21:34:08', NULL),
(81, 41, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(82, 41, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(83, 42, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(84, 42, 5, NULL, 0, '2022-12-10 21:34:08', NULL),
(85, 43, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(86, 43, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(87, 44, 17, NULL, 1, '2022-12-10 21:34:08', NULL),
(88, 44, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(89, 45, 17, NULL, 1, '2022-12-10 21:34:08', NULL),
(90, 45, 10, NULL, 0, '2022-12-10 21:34:08', NULL),
(91, 46, 17, NULL, 1, '2022-12-10 21:34:08', NULL),
(92, 46, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(93, 47, 1, NULL, 1, '2022-12-10 21:34:08', NULL),
(94, 47, 2, NULL, 0, '2022-12-10 21:34:08', NULL),
(95, 48, 1, NULL, 1, '2022-12-10 21:34:08', NULL),
(96, 48, 10, NULL, 0, '2022-12-10 21:34:08', NULL),
(97, 49, 1, NULL, 1, '2022-12-10 21:34:08', NULL),
(98, 49, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(99, 50, 1, NULL, 1, '2022-12-10 21:34:08', NULL),
(100, 50, 20, NULL, 0, '2022-12-10 21:34:08', NULL),
(101, 51, 1, NULL, 1, '2022-12-10 21:34:08', NULL),
(102, 51, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(103, 52, 22, NULL, 1, '2022-12-10 21:34:08', NULL),
(104, 52, 17, NULL, 0, '2022-12-10 21:34:08', NULL),
(105, 53, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(106, 53, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(107, 54, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(108, 54, 19, NULL, 0, '2022-12-10 21:34:08', NULL),
(109, 55, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(110, 55, 9, NULL, 0, '2022-12-10 21:34:08', NULL),
(111, 56, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(112, 56, 11, NULL, 0, '2022-12-10 21:34:08', NULL),
(113, 57, 18, NULL, 1, '2022-12-10 21:34:08', NULL),
(114, 57, 17, NULL, 0, '2022-12-10 21:34:08', NULL),
(115, 58, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(116, 58, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(117, 59, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(118, 59, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(119, 60, 10, NULL, 1, '2022-12-10 21:34:08', NULL),
(120, 60, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(121, 61, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(122, 61, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(123, 62, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(124, 62, 4, NULL, 0, '2022-12-10 21:34:08', NULL),
(125, 63, 19, NULL, 1, '2022-12-10 21:34:08', NULL),
(126, 63, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(127, 64, 9, NULL, 1, '2022-12-10 21:34:08', NULL),
(128, 64, 18, NULL, 0, '2022-12-10 21:34:08', NULL),
(129, 65, 12, NULL, 1, '2022-12-10 21:34:08', NULL),
(130, 65, 2, NULL, 0, '2022-12-10 21:34:08', NULL),
(131, 66, 12, NULL, 1, '2022-12-10 21:34:08', NULL),
(132, 66, 4, NULL, 0, '2022-12-10 21:34:08', NULL),
(133, 67, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(134, 67, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(135, 68, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(136, 68, 12, NULL, 0, '2022-12-10 21:34:08', NULL),
(137, 69, 11, NULL, 1, '2022-12-10 21:34:08', NULL),
(138, 69, 3, NULL, 0, '2022-12-10 21:34:08', NULL),
(139, 70, 3, NULL, 1, '2022-12-10 21:34:08', NULL),
(140, 70, 1, NULL, 0, '2022-12-10 21:34:08', NULL),
(141, 71, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(142, 71, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(143, 72, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(144, 72, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(145, 73, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(146, 73, 22, NULL, 0, '2022-12-10 21:34:09', NULL),
(147, 74, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(148, 74, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(149, 75, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(150, 75, 10, NULL, 0, '2022-12-10 21:34:09', NULL),
(151, 76, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(152, 76, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(153, 77, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(154, 77, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(155, 78, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(156, 78, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(157, 79, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(158, 79, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(159, 80, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(160, 80, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(161, 81, 1, NULL, 1, '2022-12-10 21:34:09', NULL),
(162, 81, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(163, 82, 2, NULL, 1, '2022-12-10 21:34:09', NULL),
(164, 82, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(165, 83, 2, NULL, 1, '2022-12-10 21:34:09', NULL),
(166, 83, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(167, 84, 2, NULL, 1, '2022-12-10 21:34:09', NULL),
(168, 84, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(169, 85, 22, NULL, 1, '2022-12-10 21:34:09', NULL),
(170, 85, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(171, 86, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(172, 86, 12, NULL, 0, '2022-12-10 21:34:09', NULL),
(173, 87, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(174, 87, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(175, 88, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(176, 88, 4, NULL, 0, '2022-12-10 21:34:09', NULL),
(177, 89, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(178, 89, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(179, 90, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(180, 90, 17, NULL, 0, '2022-12-10 21:34:09', NULL),
(181, 91, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(182, 91, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(183, 92, 18, NULL, 1, '2022-12-10 21:34:09', NULL),
(184, 92, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(185, 93, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(186, 93, 17, NULL, 0, '2022-12-10 21:34:09', NULL),
(187, 94, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(188, 94, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(189, 95, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(190, 95, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(191, 96, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(192, 96, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(193, 97, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(194, 97, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(195, 98, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(196, 98, 6, NULL, 0, '2022-12-10 21:34:09', NULL),
(197, 99, 10, NULL, 1, '2022-12-10 21:34:09', NULL),
(198, 99, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(199, 100, 19, NULL, 1, '2022-12-10 21:34:09', NULL),
(200, 100, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(201, 101, 23, NULL, 1, '2022-12-10 21:34:09', NULL),
(202, 101, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(203, 102, 12, NULL, 1, '2022-12-10 21:34:09', NULL),
(204, 102, 4, NULL, 0, '2022-12-10 21:34:09', NULL),
(205, 103, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(206, 103, 17, NULL, 0, '2022-12-10 21:34:09', NULL),
(207, 104, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(208, 104, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(209, 105, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(210, 105, 4, NULL, 0, '2022-12-10 21:34:09', NULL),
(211, 106, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(212, 106, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(213, 107, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(214, 107, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(215, 108, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(216, 108, 5, NULL, 0, '2022-12-10 21:34:09', NULL),
(217, 109, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(218, 109, 3, NULL, 0, '2022-12-10 21:34:09', NULL),
(219, 110, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(220, 110, 5, NULL, 0, '2022-12-10 21:34:09', NULL),
(221, 111, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(222, 111, 12, NULL, 0, '2022-12-10 21:34:09', NULL),
(223, 112, 11, NULL, 1, '2022-12-10 21:34:09', NULL),
(224, 112, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(225, 113, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(226, 113, 18, NULL, 0, '2022-12-10 21:34:09', NULL),
(227, 114, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(228, 114, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(229, 115, 3, NULL, 1, '2022-12-10 21:34:09', NULL),
(230, 115, 1, NULL, 0, '2022-12-10 21:34:09', NULL),
(231, 116, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(232, 116, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(233, 117, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(234, 117, 19, NULL, 0, '2022-12-10 21:34:09', NULL),
(235, 118, 17, NULL, 1, '2022-12-10 21:34:09', NULL),
(236, 118, 10, NULL, 0, '2022-12-10 21:34:09', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_status`
--

CREATE TABLE `exam_status` (
  `id` int(11) NOT NULL,
  `label` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `exam_status`
--

INSERT INTO `exam_status` (`id`, `label`, `created`, `updated`) VALUES
(3, 'clearance', '2022-11-11 13:14:52', NULL),
(6, 'revise', '2022-11-11 13:16:06', NULL),
(7, 'approve', '2022-11-11 13:16:23', NULL),
(8, 'release', '2022-11-11 13:16:29', NULL),
(9, 'draft', '2022-11-11 13:16:55', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `role_permission`
--

INSERT INTO `role_permission` (`id`, `label`, `description`, `created`, `updated`) VALUES
(8, 'show_admin', 'Administration anzeigen', '2022-11-05 14:26:34', '2022-11-07 06:28:34'),
(9, 'show_role', 'Rollen anzeigen', '2022-11-05 14:26:59', '2022-11-07 06:28:25'),
(10, 'show_permission', 'Berechtigungen anzeigen', '2022-11-05 14:27:09', '2022-11-07 06:28:19'),
(11, 'show_exam', 'Leitfragen anzeigen', '2022-11-05 14:27:23', '2022-11-07 06:28:12'),
(12, 'show_dashboard', 'Admin Dashboard anzeigen', '2022-11-05 14:27:33', '2022-11-07 06:27:27'),
(14, 'show_group', 'Gruppen anzeigen', '2022-11-05 16:02:12', '2022-11-07 06:27:20'),
(15, 'show_profile', 'Eigenes Benutzerprofil anzeigen', '2022-11-05 16:56:54', NULL),
(16, 'show_user_exam', 'Leitfrage des Benutzers anzeigen', '2022-11-05 18:06:31', NULL),
(17, 'show_school_subject', 'Fächer anzeigen', '2022-11-08 18:02:09', '2022-11-08 18:02:47'),
(18, 'show_school_subject_type', 'Fachbereiche anzeigen', '2022-11-08 18:46:40', NULL),
(19, 'show_topic', 'Themengruppen anzeigen', '2022-11-09 18:10:07', NULL),
(20, 'show_exam_status', 'Aktuellen Workflow-Status der Leitfrage anzeigen', '2022-11-11 11:55:36', NULL),
(21, 'create_key_question', 'Leitfrage erstellen oder übernehmen', '2022-11-13 06:01:32', NULL),
(22, 'show_approval_process', 'Workflow zum Übernehmen einer Leitfrage anzeigen', '2022-11-13 16:09:34', NULL),
(23, 'show_my_group', 'Eigene Gruppenmitglieder anzeigen', '2022-12-08 19:02:05', NULL),
(24, 'upload_data', 'CSV-Datenimport durchführen', '2022-12-10 17:30:02', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school_subject`
--

CREATE TABLE `school_subject` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbr` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_subject_type_id` int(11) DEFAULT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `school_subject`
--

INSERT INTO `school_subject` (`id`, `label`, `abbr`, `school_subject_type_id`, `color`, `created`, `updated`) VALUES
(1, 'Biologie', 'bi', 1, '#9FE2BF', '2022-09-09 15:22:15', '2022-12-10 17:00:32'),
(2, 'Chemie', 'ch', 1, '#40E0D0', '2022-09-09 15:22:15', '2022-12-10 11:52:39'),
(3, 'Psyschologie', 'psy', 9, '#DFFF00', '2022-09-09 15:36:41', '2022-12-10 11:52:44'),
(4, 'Informatik', 'inf', 5, '#6495ED', '2022-09-09 19:59:45', '2022-12-10 11:52:49'),
(5, 'Deutsch', 'de', 2, '#6495ED', '2022-09-10 10:45:31', '2022-12-10 11:52:22'),
(6, 'Englisch', 'en', 3, '#40E0D0', '2022-09-10 10:45:31', '2022-12-10 11:52:59'),
(7, 'Französisch', 'fr', 3, '#6495ED', '2022-09-10 10:45:59', '2022-12-10 11:53:04'),
(8, 'Spanisch', 'spa', 3, '#FFBF00', '2022-09-10 10:45:59', '2022-12-10 11:53:08'),
(9, 'Latein', 'lat', 3, '#FFBF00', '2022-09-10 10:46:27', '2022-12-10 11:53:15'),
(10, 'Geographie', 'geo', 7, '#9FE2BF', '2022-09-10 10:46:27', '2022-12-10 11:53:20'),
(11, 'Philosophie', 'phi', 10, '#FF7F50', '2022-09-10 10:47:06', '2022-12-10 11:53:24'),
(12, 'Physik', 'ph', 1, '#DE3163', '2022-09-10 10:47:06', '2022-12-10 11:53:26'),
(17, 'Politikwissenschaft', 'pw', 7, '#6495ED', '2022-09-10 15:50:21', '2022-12-10 11:53:30'),
(18, 'Geschichte', 'ge', 8, '#FFBF00', '2022-09-10 15:50:21', '2022-12-10 11:53:35'),
(19, 'Kunst', 'ku', 8, '#FFBF00', '2022-11-12 07:41:14', '2022-12-10 11:53:37'),
(20, 'Sport', 'sp', 12, '#CCCCFF', '2022-12-10 11:12:32', '2022-12-10 17:08:30'),
(22, 'Darstellendes Spiel', 'ds', 8, '#9f24b3', '2022-12-10 17:05:03', NULL),
(23, 'Mathematik', 'ma', 4, '#f70a2a', '2022-12-10 17:11:04', NULL),
(24, 'Musik', 'mu', 8, '', '2022-12-10 21:32:19', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `school_subject_type`
--

CREATE TABLE `school_subject_type` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `topic`
--

INSERT INTO `topic` (`id`, `title`, `description`, `created`, `updated`) VALUES
(1, 'Naturheilkunde', NULL, '2022-09-09 15:11:18', '2022-09-14 11:45:57'),
(2, 'Humanmedizin', NULL, '2022-09-09 15:12:36', '2022-09-14 11:45:55'),
(3, 'Verhaltensbiologie', NULL, '2022-09-09 15:15:03', '2022-09-14 11:45:52'),
(4, 'Cannabis', NULL, '2022-09-09 15:16:56', '2022-09-14 11:45:49'),
(6, 'Gesundheit', NULL, '2022-09-14 11:19:22', NULL),
(7, 'Kommunikation', NULL, '2022-09-14 11:19:22', NULL),
(8, 'Chemie im Alltag', NULL, '2022-09-14 11:20:30', NULL),
(9, 'Kunststoffe', NULL, '2022-09-14 11:20:30', NULL),
(10, 'Deutung und Interpretation', NULL, '2022-09-14 11:22:18', NULL),
(11, 'Kryptographie', NULL, '2022-09-14 11:22:18', NULL),
(12, 'Lebenswerke', NULL, '2022-09-14 11:23:49', NULL),
(13, 'Ideologische Symbole', NULL, '2022-09-14 11:23:49', NULL),
(14, 'gesellschaftliche Gleichstellung', NULL, '2022-09-14 11:25:04', NULL),
(15, 'Einfluss von Medien', NULL, '2022-09-14 11:25:04', NULL),
(16, 'Betäubungsmittel', NULL, '2022-09-14 11:26:03', NULL),
(17, 'Terraforming', NULL, '2022-09-14 11:26:03', NULL),
(18, 'Kolonialisierung', NULL, '2022-09-14 11:27:30', NULL),
(19, 'Politische Konflikte', NULL, '2022-09-14 11:27:30', NULL),
(20, 'Industrialisierung', NULL, '2022-09-14 11:28:07', NULL),
(21, 'Handel und Wirtschaft', NULL, '2022-09-14 11:28:07', NULL),
(22, 'Demographie und Stadtentwicklung', NULL, '2022-09-14 11:29:33', NULL),
(23, 'Kunststile und -epochen', NULL, '2022-09-14 11:29:33', NULL),
(24, 'Mathematik in der Natur', NULL, '2022-09-14 11:30:29', NULL),
(25, 'Quantenmechanik', NULL, '2022-09-14 11:30:29', NULL),
(26, 'Gerechtigkeit', NULL, '2022-09-14 11:30:58', NULL),
(27, 'Selbstbestimmtes Handeln', NULL, '2022-09-14 11:30:58', NULL),
(28, 'Mensch und Maschine', NULL, '2022-09-14 11:31:45', NULL),
(29, 'Körper und Geist', NULL, '2022-09-14 11:31:45', NULL),
(30, 'Religion und Philosopie', NULL, '2022-09-14 11:32:35', NULL),
(31, 'Artspezifische Sprache', NULL, '2022-09-14 11:32:35', NULL),
(32, 'Würde des Menschen', NULL, '2022-09-14 11:34:29', NULL),
(33, 'Konzeptionellle Relativität', NULL, '2022-09-14 11:34:29', NULL),
(34, 'Der freie Wille', NULL, '2022-09-14 11:35:22', NULL),
(35, 'Gedächtnis der Generationen', NULL, '2022-09-14 11:35:22', NULL),
(36, 'Menschliche Leistungen', NULL, '2022-09-14 11:37:03', NULL),
(37, 'Forensik', NULL, '2022-09-14 11:37:03', NULL),
(38, 'Politische Kunst', NULL, '2022-09-14 11:37:24', NULL),
(39, 'Politische Bewegungen', NULL, '2022-09-14 11:37:24', NULL),
(40, 'Mensch und Natur', NULL, '2022-09-14 11:38:12', NULL),
(41, 'Nahrungsmittel', NULL, '2022-09-14 11:38:12', NULL),
(42, 'Wissenschaftliche Modelle', NULL, '2022-09-14 11:39:21', NULL),
(43, 'Kriege und Konflikte', NULL, '2022-09-14 11:39:21', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `user_locale` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `is_active`, `created`, `updated`, `user_locale`) VALUES
(2, 'Benjamin', 'Wagner', 'wagnerpictures', '$2y$10$sWj3tTJwLfE5hcKWjTCVneb0MmD5Hvqy1QdmM66Q4dN/iWBUS1JDu', 'service@wagnerpictures.com', 1, '2022-09-17 07:32:23', NULL, 'de'),
(5, 'Anna', 'Rölke', 'aroelke', '$2y$10$td1xlnbJxsjInL9OkZ8r/./XjqfSI2cWXpL22CSTRs2uJg35m6BXa', 'aroelke@treptow-kolleg.de', 1, '2022-11-05 06:11:38', NULL, 'de'),
(6, 'Annika', 'Kottwitz', 'akottwitz', '$2y$10$E6NG4drsf1i8TayMIOFmAOHN0ZDsEQ6jgY6hnO64ApvLRU4S0EKx6', 'kottwitz@treptowkolleg.de', 1, '2022-11-10 05:30:35', NULL, 'de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_key` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_group`
--

INSERT INTO `user_group` (`id`, `label`, `description`, `group_key`, `created`, `updated`, `role_id`) VALUES
(8, 'A21Q1_MA1', 'Jahrgang 2021, Q1 / LK MA1', NULL, '2022-09-17 21:05:14', '2022-11-07 06:33:14', 16),
(9, 'A21ES1', 'Jahrgang 2021, E1 / ES1', NULL, '2022-09-17 21:06:27', '2022-11-07 06:35:27', 17),
(10, 'A21EFL', 'Jahrgang 2021, E1 / EFL', NULL, '2022-09-17 21:08:03', '2022-11-07 06:35:31', 17),
(15, 'A20Q3', '', 'qeMcbfoX', '2022-11-06 09:28:06', '2022-11-07 06:33:20', 16);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_group_has_user`
--

INSERT INTO `user_group_has_user` (`id`, `user_group_id`, `user_id`, `created`, `updated`) VALUES
(1, 8, 2, '2022-11-05 13:55:43', NULL),
(2, 9, 2, '2022-11-09 19:30:59', NULL),
(3, 8, 6, '2022-11-10 05:32:06', NULL),
(5, 8, 5, '2022-12-09 06:41:16', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_exam`
--

CREATE TABLE `user_has_exam` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `key_question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_id` int(11) NOT NULL,
  `main_subject_id` int(11) NOT NULL,
  `secondary_subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_has_exam`
--

INSERT INTO `user_has_exam` (`id`, `user_id`, `created`, `updated`, `key_question`, `topic_id`, `main_subject_id`, `secondary_subject_id`) VALUES
(14, 2, '2022-12-08 07:19:01', NULL, 'Inwieweit können 3D-Drucker die Organspende revolutionieren?', 2, 1, 4),
(15, 2, '2022-12-10 08:20:48', NULL, 'Inwieweit können 3D-Drucker die Organspende revolutionieren?', 2, 1, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_is_responsible_for_subject_type`
--

CREATE TABLE `user_is_responsible_for_subject_type` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_type_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_is_responsible_for_subject_type`
--

INSERT INTO `user_is_responsible_for_subject_type` (`id`, `user_id`, `subject_type_id`, `from_date`, `to_date`, `created`, `updated`) VALUES
(1, 6, 4, '2022-08-08', NULL, '2022-12-05 14:15:38', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_role`
--

INSERT INTO `user_role` (`id`, `label`, `description`, `created`, `updated`) VALUES
(1, 'Administrator:in', 'Darf alle ändern.', '2022-09-17 14:33:57', '2022-09-17 20:06:55'),
(7, 'Gruppenadministrator:in', 'Darf alles innerhalb einer Gruppe ändern.', '2022-09-17 20:06:34', '2022-09-17 20:36:00'),
(8, 'Schulleiter:in', 'Darf Rollen und Gruppen ändern.', '2022-09-17 20:43:31', NULL),
(9, 'Tutor:in', 'Darf eigene Gruppe ändern.', '2022-09-17 20:44:43', NULL),
(10, 'Kollegiat:in', 'Darf Themen ansehen und erstellen', '2022-09-17 20:45:45', NULL),
(11, 'Dozent:in', 'Darf eigene Gruppe ändern.', '2022-09-17 20:47:10', NULL),
(16, 'Qualifikationsphase', 'Darf Leitfragen erstellen und belegen', '2022-11-07 06:31:45', NULL),
(17, 'Einführungsphase', 'Darf Leitfragen anzeigen', '2022-11-07 06:32:13', NULL),
(18, 'Lehrkraft', 'Darf sich als Betreuung anbieten', '2022-12-08 16:59:48', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_role_has_role_permission`
--

INSERT INTO `user_role_has_role_permission` (`id`, `user_role_id`, `role_permission_id`, `created`, `updated`) VALUES
(3, 1, 8, '2022-11-05 14:27:54', NULL),
(11, 1, 10, '2022-11-05 16:46:55', NULL),
(12, 1, 14, '2022-11-05 16:46:55', NULL),
(14, 1, 12, '2022-11-05 16:57:11', NULL),
(19, 1, 11, '2022-11-06 09:27:41', NULL),
(20, 1, 9, '2022-11-06 09:32:41', NULL),
(23, 1, 15, '2022-11-06 09:33:44', NULL),
(24, 1, 16, '2022-11-06 09:33:44', NULL),
(25, 10, 15, '2022-11-06 14:34:56', NULL),
(26, 10, 16, '2022-11-06 14:34:56', NULL),
(27, 1, 17, '2022-11-08 18:02:57', NULL),
(28, 1, 18, '2022-11-08 18:46:45', NULL),
(29, 1, 19, '2022-11-09 18:10:45', NULL),
(30, 9, 15, '2022-11-10 05:32:56', NULL),
(31, 1, 20, '2022-11-11 11:55:43', NULL),
(32, 16, 21, '2022-11-13 06:01:50', NULL),
(33, 1, 21, '2022-11-13 16:09:43', NULL),
(34, 1, 22, '2022-11-13 16:09:43', NULL),
(35, 10, 21, '2022-11-13 16:09:53', NULL),
(36, 10, 22, '2022-11-13 16:09:53', NULL),
(37, 9, 23, '2022-12-08 19:02:19', NULL),
(38, 1, 23, '2022-12-08 19:22:30', NULL),
(39, 1, 24, '2022-12-10 17:30:09', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user_role_has_user`
--

INSERT INTO `user_role_has_user` (`id`, `user_id`, `user_role_id`, `created`, `updated`) VALUES
(1, 5, 10, '2022-11-05 06:11:38', NULL),
(2, 2, 1, '2022-11-05 13:55:19', NULL),
(4, 6, 9, '2022-11-10 05:31:11', '2022-11-10 05:31:35'),
(5, 2, 10, '2022-12-04 07:21:28', NULL),
(6, 6, 18, '2022-12-08 17:00:27', NULL);

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
-- Indizes für die Tabelle `exam_has_exam_status`
--
ALTER TABLE `exam_has_exam_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_status_id` (`exam_status_id`),
  ADD KEY `supervisor_id` (`supervisor_id`),
  ADD KEY `user_exam_id` (`user_exam_id`);

--
-- Indizes für die Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_subject_id` (`school_subject_id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `exam_status`
--
ALTER TABLE `exam_status`
  ADD PRIMARY KEY (`id`);

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
-- Indizes für die Tabelle `user_has_exam`
--
ALTER TABLE `user_has_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `main_subject_id` (`main_subject_id`),
  ADD KEY `secondary_subject_id` (`secondary_subject_id`);

--
-- Indizes für die Tabelle `user_is_responsible_for_subject_type`
--
ALTER TABLE `user_is_responsible_for_subject_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_type_id` (`subject_type_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT für Tabelle `exam_has_exam_status`
--
ALTER TABLE `exam_has_exam_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT für Tabelle `exam_status`
--
ALTER TABLE `exam_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `school_subject_type`
--
ALTER TABLE `school_subject_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `user_group_has_user`
--
ALTER TABLE `user_group_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user_has_exam`
--
ALTER TABLE `user_has_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT für Tabelle `user_is_responsible_for_subject_type`
--
ALTER TABLE `user_is_responsible_for_subject_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_role_permission`
--
ALTER TABLE `user_role_has_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_user`
--
ALTER TABLE `user_role_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints der Tabelle `exam_has_exam_status`
--
ALTER TABLE `exam_has_exam_status`
  ADD CONSTRAINT `exam_has_exam_status_ibfk_1` FOREIGN KEY (`exam_status_id`) REFERENCES `exam_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_has_exam_status_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_has_exam_status_ibfk_3` FOREIGN KEY (`user_exam_id`) REFERENCES `user_has_exam` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  ADD CONSTRAINT `exam_has_school_subject_ibfk_1` FOREIGN KEY (`school_subject_id`) REFERENCES `school_subject` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_has_school_subject_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_has_school_subject_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

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
-- Constraints der Tabelle `user_has_exam`
--
ALTER TABLE `user_has_exam`
  ADD CONSTRAINT `user_has_exam_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_exam_ibfk_5` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_exam_ibfk_6` FOREIGN KEY (`main_subject_id`) REFERENCES `school_subject` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_exam_ibfk_7` FOREIGN KEY (`secondary_subject_id`) REFERENCES `school_subject` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_is_responsible_for_subject_type`
--
ALTER TABLE `user_is_responsible_for_subject_type`
  ADD CONSTRAINT `user_is_responsible_for_subject_type_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_is_responsible_for_subject_type_ibfk_2` FOREIGN KEY (`subject_type_id`) REFERENCES `school_subject_type` (`id`) ON UPDATE CASCADE;

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
