-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 14 Maj 2017, 21:09
-- Wersja serwera: 5.7.18-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `text` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `userId`, `postId`, `creation_date`, `text`) VALUES
(1, 1, 1, '2016-04-28 00:00:00', 'that is first comment'),
(2, 2, 5, '2017-04-23 00:00:00', 'first comment'),
(6, 2, 5, '2017-05-01 20:00:28', 'this is second comment'),
(7, 2, 5, '2017-05-01 20:31:28', 'I want to comment'),
(8, 2, 5, '2017-05-01 20:31:33', 'I want to comment'),
(9, 2, 5, '2017-05-01 20:33:48', 'one more comment'),
(10, 2, 5, '2017-05-01 20:34:18', 'one more comment'),
(11, 2, 5, '2017-05-01 20:34:51', 'one more comment'),
(12, 1, 1, '2017-05-01 20:35:10', 'This is second comment'),
(13, 2, 5, '2017-05-04 20:47:40', 'this is second comment'),
(16, 1, 19, '2017-05-04 21:26:56', 'no comment'),
(17, 1, 19, '2017-05-04 21:26:59', 'no comment'),
(18, 1, 19, '2017-05-04 21:34:15', 'This is second comment'),
(19, 1, 19, '2017-05-04 21:34:20', 'This is second comment'),
(20, 1, 22, '2017-05-05 19:07:39', 'komencik'),
(21, 1, 23, '2017-05-06 17:46:18', 'komencik'),
(22, 1, 23, '2017-05-06 17:46:24', 'komencik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE `Message` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `isRead` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Message`
--

INSERT INTO `Message` (`id`, `senderId`, `receiverId`, `isRead`, `message`, `creationDate`) VALUES
(1, 1, 2, 1, 'Hejka!', '2017-05-07 11:36:31'),
(2, 1, 2, 0, 'elo', '2017-05-07 11:41:30'),
(3, 1, 2, 0, 'elo', '2017-05-07 11:42:06'),
(4, 1, 2, 0, 'there is problem on returning Arabic text, as they are words with combined letters if the second parameter(100) is not at end of Arabic words on the last while ', '2017-05-07 13:41:29'),
(5, 2, 1, 1, 'witaj!', '2017-05-07 11:30:31'),
(6, 1, 2, 0, 'Whatsup', '2017-05-08 19:03:06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE `Tweet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tekst` varchar(140) NOT NULL,
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `userId`, `tekst`, `creationDate`) VALUES
(1, 1, 'hohoho to jest pierwszy tweet', '2017-04-20'),
(2, 1, 'Tweet2', '2017-04-19'),
(5, 2, 'tweet3', '2017-03-01'),
(19, 2, 'tweet4', '2017-01-01'),
(20, 1, 'hello world', '2017-05-01'),
(21, 1, 'hello world', '2017-05-01'),
(22, 1, 'hello world', '2017-05-01'),
(23, 1, 'Hejka!', '2017-05-06'),
(24, 1, 'Hejka!', '2017-05-06'),
(25, 1, 'What a beautiful day!', '2017-05-08');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `username`, `email`, `hash_password`) VALUES
(1, 'yololo', 'tt@tt.pl', 'kotik'),
(2, 'yol', 'oo@tt.pl', 'komonso'),
(3, 'Jan', 'lolo@wp.pl', 'pqwerty'),
(4, 'Emilka', 'emilka@wp.pl', 'emilka'),
(5, 'user', 'user@yahoo.com', 'userek'),
(6, 'user6', 'user@as.co', 'pofdanl'),
(7, 'Kot', 'dbkwbdk@op.pl', 'pokbl'),
(8, 'Ted', 'ted@sm.cm', 'uvluivyliu'),
(92, 'Ian', 'ian@re.re', 'fdnol'),
(94, 'Aaa', 'aaa@sp.ps', 'vgkhvj'),
(99, 'Pololo', 'goolk@wp.fl', 'bjnbo');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `Tweet`
--
ALTER TABLE `Tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT dla tabeli `Message`
--
ALTER TABLE `Message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `Tweet` (`id`);

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
