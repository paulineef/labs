-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 30 nov 2017 kl 21:48
-- Serverversion: 5.6.35
-- PHP-version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databas: `reads`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `articles`
--

CREATE TABLE `articles` (
  `articleID` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `articles`
--

INSERT INTO `articles` (`articleID`, `title`, `text`, `author`, `date`) VALUES
('1', 'Welcome to Reads!', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae odio porro iure doloremque placeat veritatis tempora quibusdam ullam repellat quod rem maxime fugit enim itaque a numquam similique debitis, eligendi.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae odio porro iure doloremque placeat veritatis tempora quibusdam ullam repellat quod rem maxime fugit enim itaque a numquam similique debitis, eligendi.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae odio porro iure doloremque placeat veritatis tempora quibusdam ullam repellat quod remmaxime fugit enim itaque a numquam similique debitis, eligendi!<br/><br/> \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae odio porro iure doloremque placeat veritatis tempora quibusdam ullam repellat quod rem maxime fugit enim itaque a numquam similique debitis, eligendi!', 'Founder', '2017-09-01'),
('2', 'New scripts by dead beloved author found ', 'Mel ne primis accusam ponderum, per sensibus sadipscing interpretaris ne, altera discere fuisset mei ei. Liber movet singulis has eu, te qui indoctum maiestatis, sed at salutatus theophrastus. Eu usu vero movet, qui id illud facer. Eam ea aliquip persequeris, timeam convenire nam ne. Vivendum dissentias eam no, assum mundi pri ut, timeam aeterno deseruisse mei cu. Te eum patrioque dissentias, utinam impedit deseruisse ius te, suscipit intellegat ea vel.\r\n\r\nNam eu vero sententiae, no solet temporibus est, eos harum consulatu id. In idque nobis eam, ad vis augue postea. Te vim dicam verear, nec melius voluptatum percipitur ea, vel in aliquip deseruisse voluptatibus. Mea eu melius perpetua accommodare. Porro lorem in his.<br/><br/>\r\n\r\nNe dolorum sapientem his, soluta nominavi pri ei, vide sententiae mel in. Ad novum nominati gloriatur eum. Ex sit suas pericula. Est inermis delicata ea, at pro menandri torquatos, mei te hinc qualisque evertitur.<br/><br/>\r\n\r\nAt has quot meis sapientem, nam ex falli senserit cotidieque. Ludus melius scribentur mel ex. Erant saepe discere mel te, eam et sint pertinax dissentias, error fierent offendit cum no. Nam et verear integre. Te putant offendit per, quis vero cu est, cibo euismod maluisset per at. Ad soleat malorum menandri vis, ne nec unum tempor vocibus, diam impedit concludaturque eu pro.<br/><br/>\r\n', 'Jane Doe', '2017-11-09');

-- --------------------------------------------------------

--
-- Tabellstruktur `authors`
--

CREATE TABLE `authors` (
  `authorID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `authors`
--

INSERT INTO `authors` (`authorID`, `name`) VALUES
(1, 'Rupi Kaur'),
(2, 'Kazuo Ishiguro'),
(3, 'John Green'),
(4, 'John Le Carre'),
(5, 'Dan Brown');

-- --------------------------------------------------------

--
-- Tabellstruktur `author_books`
--

CREATE TABLE `author_books` (
  `bookID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `author_books`
--

INSERT INTO `author_books` (`bookID`, `authorID`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 3),
(5, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur `books`
--

CREATE TABLE `books` (
  `bookID` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `reserved` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `books`
--

INSERT INTO `books` (`bookID`, `title`, `reserved`) VALUES
(1, 'Milk and Honey', 0),
(2, 'Never let me go', 0),
(3, 'The remains of the day', 0),
(4, 'Turtles all the way down', 0),
(5, 'Legacy of spies', 0),
(6, 'Origin', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`userID`, `username`, `password`) VALUES
(1, 'pauline', 'e4b4cd4210ee87c60da653c1b6a77d529c1a079d');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articleID`);

--
-- Index för tabell `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authorID`);

--
-- Index för tabell `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;