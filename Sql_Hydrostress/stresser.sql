

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `stresser`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adminlogs`
--

CREATE TABLE `adminlogs` (
  `username` varchar(15) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `api` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blacklist`
--

CREATE TABLE `blacklist` (
  `ID` int(11) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chargebacks`
--

CREATE TABLE `chargebacks` (
  `ID` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(50) CHARACTER SET latin1 NOT NULL,
  `skype` varchar(80) CHARACTER SET latin1 NOT NULL,
  `email` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `address` varchar(2000) CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fe`
--

CREATE TABLE `fe` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `type` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forgotconfig`
--

CREATE TABLE `forgotconfig` (
  `Subject` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `Header` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `website` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `email` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `forgotconfig`
--

INSERT INTO `forgotconfig` (`Subject`, `Header`, `website`, `email`, `message`) VALUES
('Password Recovery - Hydrostress', 'Hydrostress', '', 'admin@hydrocoin.xyz', ''),
('Password Recovery - Hydrostress', 'Hydrostress', 'http://cannon.hydroclub.info', 'admin@hydrocoin.xyz', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forgotlogs`
--

CREATE TABLE `forgotlogs` (
  `email` varchar(40) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gateway`
--

CREATE TABLE `gateway` (
  `email` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `gateway`
--

INSERT INTO `gateway` (`email`) VALUES
('moayadskillz@gmail.com\r\n');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `iplogs`
--

CREATE TABLE `iplogs` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `logged` varchar(15) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `iplogs`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginip`
--

CREATE TABLE `loginip` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `logged` varchar(15) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginlogs`
--

CREATE TABLE `loginlogs` (
  `username` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `loginlogs`
--

INSERT INTO `loginlogs` (`username`, `ip`, `date`, `country`) VALUES
('flo3477', '178.191.215.222', 1485016537, ''),
('flo3477', '213.162.68.59', 1485027990, ''),
('flo3477', '192.168.0.150', 1485280170, ''),
('flo3477', '192.168.0.150', 1485344397, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logs`
--

CREATE TABLE `logs` (
  `user` varchar(15) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `port` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `method` varchar(10) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `logs`
--

INSERT INTO `logs` (`user`, `ip`, `port`, `time`, `method`, `date`) VALUES
('flo3477', '85.180.130.254', 80, 3, 'UDP', 1485077808),
('flo3477', '193.70.79.228', 80, 30, 'SLOWLORIS', 1485097773),
('Nicolas', '94.23.207.127', 25565, 100, 'UDP', 1485098873),
('flo3477', '46.102.232.178', 80, 30, 'SLOWLORIS', 1485105282),
('flo3477', '46.102.232.178', 80, 30, 'SLOWLORIS', 1485105418);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `messageid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `messages`
--

INSERT INTO `messages` (`messageid`, `ticketid`, `content`, `sender`) VALUES
(1, 2, 'om Thank', 'Admin: '),
(2, 3, 'danke du wurdest geupdated', 'Admin: ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `paid` float NOT NULL,
  `plan` int(11) NOT NULL,
  `user` int(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tid` varchar(30) NOT NULL,
  `date` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `plans`
--

CREATE TABLE `plans` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `mbt` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `length` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `plans`
--

INSERT INTO `plans` (`ID`, `name`, `description`, `mbt`, `unit`, `length`, `price`) VALUES
(6, 'Demo', 'Test Service', 250, 'Days', 1, 1),
(8, 'I Want a Stresser', 'High Quality Stresstest ', 650, 'Months', 1, 10),
(7, 'Kidy Plan', 'Boot like a Kidy Scripter', 300, 'Months', 1, 5),
(9, 'Boot like a Big One', 'Profi', 1500, 'Months', 1, 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `refers`
--

CREATE TABLE `refers` (
  `user` varchar(255) CHARACTER SET latin1 NOT NULL,
  `referals` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `referuser`
--

CREATE TABLE `referuser` (
  `referrer` varchar(255) CHARACTER SET latin1 NOT NULL,
  `referred` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `registerlogs`
--

CREATE TABLE `registerlogs` (
  `username` varchar(15) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL,
  `date` int(11) NOT NULL,
  `country` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Daten für Tabelle `registerlogs`
--

INSERT INTO `registerlogs` (`username`, `ip`, `date`, `country`) VALUES
('flo3477', '213.47.198.11', 1485009711, ''),
('vidaboa', '179.35.155.150', 1485136991, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `enabled` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `SiteConfig`
--

CREATE TABLE `SiteConfig` (
  `Header` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `Tab` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `email` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `nemail` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `sitename` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `api` varchar(900) CHARACTER SET latin1 NOT NULL,
  `skypeapi` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `ip2skypeapi` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `phoneapi` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `gmailapi` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `custom` text CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `SiteConfig`
--

INSERT INTO `SiteConfig` (`Header`, `Tab`, `email`, `nemail`, `sitename`, `api`, `skypeapi`, `ip2skypeapi`, `phoneapi`, `gmailapi`, `custom`) VALUES
('HÌ”Í„Í•Í‡Ì­yÌÍ£Í„ÌšÌ‘Ì’Ì•ÍÌ»ÌªÌdÍ†ÌŒÌ“rÌ‚Ì‹ÌŠÍ¨Í…Ì¥oÍŸÍ–Ì¤sÍ­Í‚Ì…ÌÍÌ‹ÍªÌ—Í”ÌœÌ©Ì®Ì¹Ì»tÍ­Í‚Ì¯Ì°Ì¼Ì©ÌrÌ“ÌƒÍ˜eÌŒÌ†Í›ÍÍ’ÌÌÍ€Ì©Í™sÍŠÍ©Í£Ì”ÌšÍ¨Í’Ì°Ì¬sÍ«Ì¶Ì—Í™Ì—', 'â–‚â–ƒâ–… Ð½Ñƒâˆ‚ÑÏƒÑ•Ñ‚ÑÑ”Ñ•Ñ• â–…â–ƒâ–‚', 'eibiflo4@gmail.com', '@admin', 'http://cannon.hydroclub.info/', '', 'http://resolveme.org/api.php?key=522867c6ee612&skypePseudo=', 'http://resolveme.org/api.php?key=522867c6ee612&skypePseudo=', '', '', '<p>Welcome on Hydrostress, Now we are in beta and we have Free Accounts for you.</p>\r\n');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `skypeblacklist`
--

CREATE TABLE `skypeblacklist` (
  `ID` int(11) NOT NULL,
  `IP` varchar(100) CHARACTER SET latin1 NOT NULL,
  `note` text CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tickets`
--

INSERT INTO `tickets` (`id`, `subject`, `content`, `status`, `username`) VALUES
(1, 'ydf', 'klÃ¶smaaskdasds', 'Closed', 'flo3477'),
(2, 'lÃ¶mkerjlh', 'iofjsdofsdjfsdf', 'Waiting for user response', 'flo3477'),
(3, 'Ich hab Bezahlz', 'danke', 'Waiting for user response', 'flo3477');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `status` varchar(1000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `email`, `rank`, `membership`, `expire`, `status`) VALUES
(1, 'flo3477', '463718a3cf3aca5f2ba347581b20200d6f0bf4bd', 'eibiflo4@gmail.com', 1, 9, 1487953873, '0'),
(2, 'Nicolas', '9b0a5c2936aba5fb9113e1da814a1ce0fccfd1db', 'slixeprivate@gmail.com', 0, 0, 0, '0'),
(3, 'vidaboa', '5b1426fadd3e1ac3d6fd078d859d89b466e1138b', 'ecosinz@outlook.com', 0, 0, 0, '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usersBackup`
--

CREATE TABLE `usersBackup` (
  `ID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `membership` int(11) NOT NULL,
  `expire` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `visitor_counter`
--

CREATE TABLE `visitor_counter` (
  `counts` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `chargebacks`
--
ALTER TABLE `chargebacks`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `fe`
--
ALTER TABLE `fe`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `iplogs`
--
ALTER TABLE `iplogs`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `loginip`
--
ALTER TABLE `loginip`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `skypeblacklist`
--
ALTER TABLE `skypeblacklist`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indizes für die Tabelle `usersBackup`
--
ALTER TABLE `usersBackup`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `chargebacks`
--
ALTER TABLE `chargebacks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `fe`
--
ALTER TABLE `fe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `iplogs`
--
ALTER TABLE `iplogs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `loginip`
--
ALTER TABLE `loginip`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `plans`
--
ALTER TABLE `plans`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `skypeblacklist`
--
ALTER TABLE `skypeblacklist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `usersBackup`
--
ALTER TABLE `usersBackup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
