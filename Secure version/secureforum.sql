CREATE DATABASE secureforum;

--
-- Struttura della tabella `answers`
--

CREATE TABLE `answers` (
  `question` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `answer` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `answers`
--

INSERT INTO `answers` (`question`, `username`, `answer`) VALUES
('What is the best IDE to use for Java?', 'francesca', 'The three IDEs most often chosen for server-side Java development are IntelliJ IDEA, Eclipse, and NetBeans'),
('What is the best programming language for a beginner?', 'luigi22', 'I started with Java, but I suggest starting with Python. Much easier for a beginner who is new to programming'),
('What is Object-Oriented Programming (OOP)?', 'luigi22', 'Object-oriented programming is a programming paradigm based on the concept of \"objects\", which can contain data and code: data in the form of fields, and code, in the form of procedures.');

-- --------------------------------------------------------

--
-- Struttura della tabella `authentication`
--

CREATE TABLE `authentication` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `authentication`
--

INSERT INTO `authentication` (`username`, `password`) VALUES
('federica', 'c91a67abf43e44038e6951c932664018'),
('francesca', 'c4ce45e8cd2257ec324087869a0646b0'),
('luigi22', '7345c696298c283e2b3a4f4ac4287967'),
('prova', '189bbbb00c5f1fb7fba9ad9285f193d1');

-- --------------------------------------------------------

--
-- Struttura della tabella `questions`
--

CREATE TABLE `questions` (
  `question` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dump dei dati per la tabella `questions`
--

INSERT INTO `questions` (`question`, `username`) VALUES
('What is Object-Oriented Programming (OOP)?', 'francesca'),
('What is the best IDE to use for Java?', 'prova'),
('What is the best programming language for a beginner?', 'federica');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `answers`
--
ALTER TABLE `answers`
  ADD KEY `constr` (`question`);

--
-- Indici per le tabelle `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indici per le tabelle `questions`
--
ALTER TABLE `questions`
  ADD UNIQUE KEY `question` (`question`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `constr` FOREIGN KEY (`question`) REFERENCES `questions` (`question`) ON DELETE CASCADE;