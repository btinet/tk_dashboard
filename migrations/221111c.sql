-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Nov 2022 um 13:24
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
-- Datenbank: `test`
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
(3, 4, 'Eine Untersuchung der\r\nneurophysiologischen, psychischen und gesellschaftlichen Auswirkungen des\r\nTHC-Konsums bei Jugendlichen und jungen Erwachsenen', 1969, '2022-09-09 15:20:38', '2022-09-10 11:10:40'),
(956, 2, 'Inwiefern können psychische als auch geografische Faktoren die Krankheit \"Psoriasis Vulgaris\" beeinflussen?', 2022, '0000-00-00 00:00:00', '2022-09-14 11:42:16'),
(957, 1, 'Wie funktioniert die chemische Kommunikation der Ameisen und inwiefern ist diese der entscheidende Faktor f?r ihren evolution?ren Erfolg?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(958, 1, 'Der Friseur als Proteinchemiker. Sind Colorationen eine Form der Kunst oder gef?hrlich f?r Haut und Haar?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(959, 1, 'Allesk?nner Kunststoff! Altagsgegenstand Acrylglas und seine k?nstlerische Verfremdung', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(960, 1, 'Inwiefern kann ein Verfremdungseffekt das M?rchen \"H?nsel und Gretel\" eine Ver?nderung der Aussage bei dr Zielgruppe bewirken?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(961, 1, 'Die eigentliche Bedeutung Albert Einsteins bei der Neufassung der klassischen Physik im 20. Jahrhundert. Warum gelang ihm, woran alle anderen vor ihm scheiterten?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(962, 1, 'Der deutsche Sch?ferhund - Warum diente gerade diese Hunderasse als nationalsozialistisches Symbol?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(963, 1, 'Inwiefern ist die Enigma ein Beispiel daf?r, dass die Kryptographie f?r die Kommunikation im 2. Weltkrieg notwendig geworden ist?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(964, 1, 'Inwiefern war die zunehmende Gleichstellung der Frau in der Weimarer Republik ein gesellschaftlicher und pers?nlicher Erfolg?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(965, 1, 'Gleichstellungspolitik heute - Inklusion aller im Zeichen des gesellschaftlichen Egalitarismus oder Exklusion des M?nnlichen?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(966, 1, 'Inwiefern ist der Film \"Swing Kids\" in der Lage, die Situation der deutschen Swing Jugend w?hrend der NS-Zeit historisch korrekt zu illustrieren?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(967, 1, 'Inwiefern war der deutsche Film 1933-1945 ein Instrument zur Vermittlung faschistischer Ideologien?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(968, 1, 'Die Herstellung von Kokain in Kolumbien: Warum wird der Standort f?r die Herstellung von Kokain favorisiert?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(969, 1, 'Inwiefern kann der Desertifikation in Saudi-Arabien biotechnologisch entgegengewirkt werden?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(970, 1, 'Die wirtschaftliche Situation Nigerias: Ein Erbe der Kolonialzeit?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(971, 1, 'Der Nil: Wasser als Basis historischer und neuzeitiger politischer Konflikte seiner Anrainerstaaten?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(972, 1, 'Der Handelskrieg zwischen den USA und China w?hrend Donald Trumps Pr?sidentschaft: Folgenreicher Aufschwung der chinesischen Technik-Industrie?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(973, 1, 'Demographie und Stadtentwicklung in dem australischen Bezirk Footscray, Melbourne. Gentrifizierung; wird Footscray dadurch besser?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(974, 1, 'Kann der Anbau der hanfpflanze Cannabidoil (CBD) ein wirtschaftlicher Entwicklungsmotor sein, z.B. f?r Simbabwe?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(975, 1, 'Der Wiener Aktionismus - von der psychologischen Intension und Wirkung des Rituellen und Morbiden in der Kunst', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(976, 1, 'Inwiefern ist der goldene Schnitt in mathematischen Formen heute noch in alter und moderner Kunst in Berlin zu finden?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(977, 1, 'Inwiefern wird sich die Funktionsweise der Quantencomputer auf heutige Verschl?sselungstechniken auswirken?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(978, 1, 'Gerechtigkeit in der Gesellschaft - Sollte das Erbrecht in der Bundesrepublik Deutschland im Interesse einer gerechteren Verteilung des gesellschaftlichen Reichtums reformiert werden?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(979, 1, 'Inwiefern l?sst sich das Recht auf selbstbestimmtes Sterben unter Ber?cksichtigung des Schmerzempfindens im philosophischen und psychologischen Kontext begr?nden?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(980, 1, 'Stellt eine generelle KI eine konzeptionelle Herausforderung f?r das menschliche Selbstbild dar?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(981, 1, 'Wie sollten wir mit Erkenntnissen aus unmoralischer Forschung umgehen? Hinterfragung am Beispiel der Forschung an Menschen in Deutschland von 1939-1945', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(982, 1, 'Inwiefern ist ein Dualismus von K?rper und Geist vereinbar mit dem interdisziplin?ren Fachgebiet der Psychosomatik der Moderne? ', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(983, 1, 'Kann man den buddhistischen Wahrheitsbegriff mit den Vorstellungen des sp?ten Wittgenstein vereinbaren und damit ad?quater f?r den deutschen Kulturraum ?bersetzen?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(984, 1, 'Ist die Leidensf?higkeit eines Wesensein hinreichendes Kriterium f?r die Zuschreibung von W?rde?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(985, 1, 'Ist es sinnvoll anzunehmen, dass eine erh?hte Sprachkompetenz Qualia nachvollziehbarer transportieren?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(986, 1, 'Ist der Verweis auf das physikalische Konzept Relativit?t in philosophischen Diskussionen ein Missverst?ndnis?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(987, 1, 'Der freie Wille - kann er dem Menschen aus biologischer Sicht aberkannt werden?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(988, 1, 'Inwiefern l?sst sich eine ?bertragung eines Traumas auf nachfolgende Generationen nachweisen? Der Versuch einer Analyse am Beispiel des spanischen B?rgerkrieges', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(989, 1, 'Hochbegabung - Fluch oder Segen? Inwiefern ist Hochbegabung genetisch bedingt?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(990, 1, 'Profiling unter besonderer Beachtung biologischer Aspekte - Mythos oder wichtiges Werkzeug der Forensik?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(991, 1, 'War die Black Pather Party eine Bedrohung f?r die innere Sicherheit der USA oder doch nur eine Rebellion gegen Rassismus?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(992, 1, 'Politische Kunst: Beeinflussung des politischen Meinungsbildes am Beispiel von Joseph Beuys.', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(993, 1, 'Chinas Handelspolitik heute - wie weitreichend ist Chinas Einfluss auf den Welthandel der Gegenwart?', 2022, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(994, 1, 'Sind Tierversuche noch aktuell? Eine Untersuchung anhand von Beispielen aus der molekularen Genetik', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(995, 1, 'Inwiefern kann der gezielte Einsatz von Mykorrhiza-Pilzen im Gem?seanbau das Problem des kommenden Nahrungsmangels abmildern oder sogar verhindern?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(996, 1, 'Gefangen im Rausch. Welchen Einfluss hat ein ?berm??iger Alkoholkonsum oder eine Alkoholsucht auf den K?rper und inwiefern beeinflussen biologische Sch?den und Ver?nderungen die psychische Gesundheit?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(997, 1, 'Der Reiter formt das Pferd - Welchen Einfluss hat die sportliche Ausbildung des Reiters auf die k?rperliche Gesunderhaltung des Pferdes?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(998, 1, 'Sch?lererwartungen im Umgang mit Modellen: Empirische Analyse der Modellkompetenz am Beispiel des biologischen Modells der DNA-Helix.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(999, 1, 'Inwiefern l?sst sich mit den Mitteln des politischen Theaters die gesellschaftliche Spaltung durch rassistische Ideologien darstellen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1000, 1, 'Warum gab es keine Entsch?digung f?r vietnamesische Agent-Orange-Opfer in Folge des Vietnam-Krieges? Eine Untersuchung der politischen und rechtlichen Hintergr?nde.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1001, 1, 'Warum entwickelte sich die Tattoo-Mode von au?ergew?hnlichen Einzelf?llen zu einem Massenph?nomen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1002, 1, 'Hannibal ante portas? Warum verzichtete Hannibal nach der Schlacht bei Cannae 216 v. Chr. Auf den Angriff auf Rom?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1003, 1, 'Der Einfluss neoliberaler Theorien auf die Diktatur Augusto Pinochets - Impulse f?r eine Modernisierung des Landes zum Wohle der Bev?lkerung?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1004, 1, 'War die Gr?ndung der ersten Kreuzfahrerstaaten legitim? - Eine Betrachtung am Beispiel Bohemumds von Tarent, F?rst von Antiochia.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1005, 1, 'Globalisierte Landwirtschaft in den Entwicklungsl?ndern: Ist ein nachhaltiges und ertragsf?higes Wirtschaften nur mit Einflussnahme von transnationalen Agrarkonzernen m?glich?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1006, 1, 'Aquaponik - Ein vielversprechendes nachhaltiges System f?r die Nahrungsmittelproduktion oder ein Irrweg?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1007, 1, '\"Fridays for Future\" - ein geografisch und psychologisch determiniertes Ph?nomen der entwickelten Nationen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1008, 1, 'Black Art? - Folgt meine eigene k?nstlerische Expedition Klischees, die man mit \"Black Art\" verbindet oder kann ich mich davon absetzen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1009, 1, 'Landschaft im Computerspiel. Wie entwickle ich k?nstlerische Techniken um Fiktion und Natur im Baukastenprinzip zusammenzubringen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1010, 1, 'Upcycling - wie k?nnen wir durch kreatives Gestalten den pers?nlichen Selbstwert und materiellen Neuwert steigern?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1011, 1, 'Sind die Grundprinzipien der Bautechnik des antiken r?mischen Reiches heutzutage noch aktuell? Eine Untersuchenug am Beispiel von opus caementitium, Rundbogen und r?mischem Stra?ennetz zur Zeit Vitruvs.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1012, 1, 'Inwiefern lassen sich physikalische Grundprinzipien nutzen, um, anstelle von Virostatika unsd Antibiotika, virale und bakterielle Erkrankungen zu bek?mpfen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1013, 1, 'Brauchen wir physische Prototypen f?r Tests im Windkanal? Untersuchung zur Aerodynamik am Beispiel vom Fahrzeugdesign im Vergleich von Realem und Computersimulation.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1014, 1, 'Eine ethische Auseinandersetzung mit dem moralischen Status k?nstlich erzeugter Lebewesen - Welche Folgen hat die unklare Artzuweisung von Mensch-Tier-Chim?ren f?r die Kategorisierung von Lebewesen und das Selbstverst?ndnis des Menschen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1015, 1, 'Warum fragen wir uns, ob wir nicht allein sind? Eine philosophische Untersuchung des Begriffs der Neugier, betrachtet am Beispiel der Suche nach extraterrestrischer Intelligenz', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1016, 1, 'Sind wir wirklich frei in unserer (Un) Freiheit? - Das jetzige deutsche Bildungssystem als exemplarisches Spannungsfeld einer m?glichen menschlichen Fehlentwicklung', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1017, 1, 'Inwiefern wirken sich biologische Vorg?nge im Darm auf kognitive Prozesse und die psychische Gesundheit aus? Ist diese Verbindung beeinflussbar?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1018, 1, 'Vom Partyrausch zur psychischen St?rung - Gef?hrdet unsere Partykultur und der Substanzgebrauch die Gesundheit einer gesamten Generation?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1019, 1, 'Inwieweit bestimmt Medienkonsum die Gehirnentwicklung und damit die Pers?nlichkeit im Kleinkindalter?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1020, 1, '2020 - Ein Jahr der psychischen Krisen? Inwiefern k?nnen spielend dargestellte Verhaltensmuster die Selbstreflexion zur Bew?ltigung der psychischen Krisen aus dem Corona-Jahr 2020 unterst?tzen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1021, 1, 'Gibt es psychologische Gemeinsamkeiten in der Pers?nlichkeitsstruktur von Despoten? Eine historische Untersuchung am Beispiel von Idi Amin, Duda und Augusto Pinochet.', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1022, 1, 'K?nnte Bildung f?r alle Schichten die soziale Zerissenheit der s?dafrikanischen Gesellschft beenden? Eine sozialpsychologische Betrachtung unter Beachtung der ?konomischen Verh?ltnisse', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1023, 1, 'Das Fleischparadoxon - Wie k?nnen wir damit umgehen? Welche psychologischen Prozesse erm?glichen die differnzierte Betrachtung von Tieren als Lebensmittel und inwiefern hat die Rationalisierung der landwirtschaftlichen Tierproduktion dazu beigetragen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1024, 1, 'Ist Verh?tung Frauensache? Geschlechtergleichberechtigung in Forschung und Marketing zur Kontrazeption', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1025, 1, 'Der Contergan-Fall der 1950er und 1960er Jahre - eine unvermeidbare Arzneimittelkatastrophe?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1026, 1, 'Warum liegt vielen Verschw?rungstheorien ein antisemitischer Kern zugrunde? Eine Analyse anhand der aktuellen Corona-Proteste', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1027, 1, 'Der Sezessionskrieg in den USA (1861-1865) - War eine kriegerische Auseinandersetzung notwendig oder h?tte sie verhindert werden k?nnen?', 2021, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1028, 1, 'Endometriose - wo bleibt die Diagnose?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1029, 1, 'Tropenkrankheiten - Tickende Zeitbomben?  - Die Verbreitung von Leishmaniose in Europa', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1030, 1, 'Epigenetik - Sind Traumata vererbbar?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1031, 1, 'Die Heizung aus dem Supermarkt - Eine Untersuchung des Energiespeicherpotenzials von Latentw?rmespeichern', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1032, 1, 'Theatrale Darstellung der Entwicklung der \"Esmeralda\" aus \" Der Gl?ckner von Dame\" (Victor Hugo, 1831) mit den Mitteln des epischen Theaters.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1033, 1, '\"An der Schwelle\" Theatrale Untersuchung mit den Mitteln des Bewegungstheaters und des Lichtdesigns', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1034, 1, 'Theatrale und filmische Umsetzung des Themas \"Neue Medien\" mit den Mitteln des dokumentarischen Theaters', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1035, 1, 'Does Jamaica?s colonial past still haunt the country? A closer look at Jamaica?s political, economic and social structure.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1036, 1, 'Die Entwicklung und Funktion des Sumosports in der japanischen Geschichte - auch heute ein erhaltenswertes kulturelles Erbe oder unmoralische Gesundheitsgef?hrdung?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1037, 1, 'Jeanne d?Arc - historischer Mythos oder historische Realit?t?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1038, 1, 'Die Gladiatorenk?mpfe in Rom - ein sportliches Spektakel zur Belustigung der Bev?lkerung oder ein gesellschaftspolitisches Instrument?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1039, 1, 'Die Pyramiden von Gizeh: reiner Totenkult oder mathematische Meisterleistung?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1040, 1, 'Wurde von allen verhandelt und gebilligt, was alle betraf? Das Einstimmigkeitsprinzip der r?mischen Republik', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1041, 1, 'Ging es Malala Yousaftai mit ihrem Engagement nur um eine Reform des pakistanischen Bildungssystems oder um eine grunds?tzliche Kritik an den Taliban?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1042, 1, 'Japans Traditionssport - Half die Kampfkunst Karate der japanischen Bev??lkerung, sich gegen die Ausbeutung durch das Kaisertum zur Wehr zu setzen?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1043, 1, 'Wurde von allen verhandelt und gebilligt, was alle betraf? Das Einstimmigkeitsprinzip der r?mischen Republik', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1044, 1, 'Ist der Anbau von ?lpalmen ein Gewinn f?r die Sozio?konomie auf Sumatra oder eine ?kologische Katastrophe?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1045, 1, 'Veganismus -  Ein Schl?ssel zum Umweltschutz oder ein moderner Ern?hrungstrend?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1046, 1, 'Das Insektensterben in Deutschland - ein unaufhaltsamer Prozess?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1047, 1, 'Konzeptionierung und Vorstellung eines Adbusting-Projekts als politischer Protest im urbanen Raum', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1048, 1, 'Mit welchen malerischen Mitteln l?sst sich der Tod aus pers?nlicher und philosophischer Sicht ad?quat darstellen?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1049, 1, 'Welche Pr?gung hat die DDR-Fotografie 30 Jahre nach der Wende? Eine multimediale Reise aus verschiedenen Blickwinkeln', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1050, 1, 'Wie hat sich das Ziselierhandwerk im Industrialisierungsprozess ver?ndert? Untersuchung und Vergleich der Arbeitsverfahren in den letzten 300 Jahren.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1051, 1, 'Inwiefern kann die Erprobung von gestischen und abstrakten Vorgehensweisen in der Malerei eine ?berwindung von Verhaltensmustern unterst?tzen?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1052, 1, '25 Jahre Einfluss auf mein Sch?nheitsideal - Fotografische Auseinandersetzung', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1053, 1, 'Bin ich sch?n? Der K?rper zwischen biologischer Funktion und k?nstlerischem Ausdruck.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1054, 1, 'Inwiefern kann mit Methoden des \"Liquid Light\" die Stimmung von life-music-performances verst?rkt werden?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1055, 1, 'Ist Latein die Mutter der europ?ischen Sprachen? Geschichtliche Untersuchung anhand der V?lkerwanderung', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1056, 1, 'Autonome Elektromobilit?t in Gro?st?dten. Was erwarten wir von modernen Fahrzeugantrieben?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1057, 1, 'Gibt es eine Grenze des menschlichen Potenzials?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1058, 1, 'Sind die \"psychisch Gesunden\" in der modernen Gesellschaft in Wirklichkeit krank? - Eine Auseinandersetzungmit Erich Fromms Bild des modernen Menschen im Hinblick auf Narzissmus, Entfremdung, Konformismus und Verlust von Individualit?t.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1059, 1, 'K?nstliche und menschliche Intelligenz - werden immer wesentliche Unterschiede zwischen beiden bestehen oder k?nnen die Gemeinsamkeiten ?berwiegen?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1060, 1, 'Die Funktion der Kunst des Expressionismus - Katharsis oder negative Utopie?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1061, 1, 'Zerst?rt der Kapitalismus unsere F?higkeit zu wahrer Liebe? Eine Auseinandersetzung mit Erich Fromm und Eva Illouz', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1062, 1, 'Geschlechteridentit?t: F?hrt eine genderneutrale Erziehung zur Entwicklung einer autonomen Pes?nlichkeit? Eine Untersuchung unter psychologischen und biologischen Gesichtspunkten.', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1063, 1, '\"Gl?ckliche Frauen geb?ren gl?ckliche Kinder.\" Ist es tats?chlich so einfach? [Eine psychologische Betrachtung]', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1064, 1, 'Zucker, ein Nahrungsmittel oder ein Suchtstoff?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1065, 1, 'Lie to me - Kann K?rpersprache unsere Gedanken verraten?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1066, 1, 'Inszenierung des Black Metal - Eine bewusste Provokation?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1067, 1, 'Gefangen in den H?rgewohnheiten unserer Vorfahren - Ist der Mensch musikalisch gepr?gt?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1068, 1, 'Neuroleptika - zwingend notwendig zur Behandlung von Schizophrenie?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1069, 1, 'Entsprechen Pippi Langstrumpf, Tommy und Annika dem Es, dem Ich und dem ?ber-Ich nach S. Freud? Analyse eines Romans von Astrid Lindgren in Bezug auf das 3 Instanzenmodell nach S. Freud', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1070, 1, 'Hypersensibilit?t: eine Einschr?nkung oder eine besondere F?higkeit?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1071, 1, 'S?dafrika - Ein problemloser ?bergang von der Apartheid in die Demokratie oder ein Land im Stillstand?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1072, 1, 'Die Globalisierung: Ein Gewinn f?r die Indigenen V?lker im brasilianischen Amazonasgebiet oder die Zerst?rung ihrer Lebensgrundlage?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1073, 1, 'Frauenquote - ein sinnvolles Mittel zur Gleichberechtigung der Frau?', 2020, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `exam_has_school_subject`
--

INSERT INTO `exam_has_school_subject` (`id`, `exam_id`, `school_subject_id`, `user_id`, `is_main_school_subject`, `created`, `updated`) VALUES
(1, 1, 1, NULL, 1, '2022-09-09 15:36:03', '2022-11-05 13:54:29'),
(2, 1, 3, NULL, 0, '2022-09-09 15:37:00', '2022-09-12 14:51:37'),
(3, 2, 1, NULL, 1, '2022-09-09 19:59:22', '2022-09-12 15:03:20'),
(4, 2, 4, NULL, 0, '2022-09-09 20:00:03', '2022-09-12 15:03:11'),
(6, 3, 1, NULL, 1, '2022-09-10 11:11:47', NULL),
(7, 3, 3, NULL, 0, '2022-09-10 11:11:47', NULL),
(8, 956, 1, NULL, 1, '2022-09-14 11:43:12', NULL),
(9, 956, 3, NULL, 0, '2022-09-14 11:43:12', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_status`
--

CREATE TABLE `exam_status` (
  `id` int(11) NOT NULL,
  `label` varchar(64) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(20, 'show_exam_status', 'Aktuellen Workflow-Status der Leitfrage anzeigen', '2022-11-11 11:55:36', NULL);

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
(12, 'Physik', 'ph', 1, '2022-09-10 10:47:06', NULL),
(17, 'Politikwissenschaft', 'pw', 7, '2022-09-10 15:50:21', NULL),
(18, 'Geschichte', 'ge', 8, '2022-09-10 15:50:21', NULL);

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
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `user_locale` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `label` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `group_key` varchar(8) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user_group_has_user`
--

INSERT INTO `user_group_has_user` (`id`, `user_group_id`, `user_id`, `created`, `updated`) VALUES
(1, 8, 2, '2022-11-05 13:55:43', NULL),
(2, 9, 2, '2022-11-09 19:30:59', NULL),
(3, 8, 6, '2022-11-10 05:32:06', NULL),
(4, 8, 5, '2022-11-10 05:34:04', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_exam`
--

CREATE TABLE `user_has_exam` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
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
(17, 'Einführungsphase', 'Darf Leitfragen anzeigen', '2022-11-07 06:32:13', NULL);

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
(31, 1, 20, '2022-11-11 11:55:43', NULL);

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
-- Daten für Tabelle `user_role_has_user`
--

INSERT INTO `user_role_has_user` (`id`, `user_id`, `user_role_id`, `created`, `updated`) VALUES
(1, 5, 10, '2022-11-05 06:11:38', NULL),
(2, 2, 1, '2022-11-05 13:55:19', NULL),
(4, 6, 9, '2022-11-10 05:31:11', '2022-11-10 05:31:35');

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
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1074;

--
-- AUTO_INCREMENT für Tabelle `exam_has_school_subject`
--
ALTER TABLE `exam_has_school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `exam_status`
--
ALTER TABLE `exam_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `school_subject`
--
ALTER TABLE `school_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `user_has_exam`
--
ALTER TABLE `user_has_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_role_permission`
--
ALTER TABLE `user_role_has_role_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT für Tabelle `user_role_has_user`
--
ALTER TABLE `user_role_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

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
  ADD CONSTRAINT `user_has_exam_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam_has_school_subject` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_exam_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_has_exam_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `exam_status` (`id`) ON UPDATE CASCADE;

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
