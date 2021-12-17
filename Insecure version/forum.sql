CREATE DATABASE forum;

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
('What is Object-Oriented Programming (OOP)?', 'federica', 'Object-oriented programming is a programming paradigm based on the concept of \"objects\", which can contain data and code: data in the form of fields, and code, in the form of procedures.'),
('What is the best IDE to use for Java?', 'luigi22', 'The three IDEs most often chosen for server-side Java development are IntelliJ IDEA, Eclipse, and NetBeans'),
('What is the best programming language for a beginner?', 'federica', 'I started with Java, but I suggest starting with Python. Much easier for a beginner who is new to programming'),
('I had an ArrayIndexOutOfBounds Exception. How can I solve?', 'hacker', 'It means that you tried to access an element that is out of the bound of the array. For example: you run the while/for loop 5 times but the array just has 4 elements. Here is a screen of the corrected code to avoid the exception:\r\n<img src=\"xyz\" width=\"200\" height=\"200\" onerror=\"alert(\'Hacked\');\">');

-- --------------------------------------------------------

--
-- Struttura della tabella `authentication`
--

CREATE TABLE `authentication` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `authentication`
--

INSERT INTO `authentication` (`username`, `password`) VALUES
('admin', 'mnjibhuv45@r32f'),
('federica', 'password'),
('francesca', 'ciao'),
('luigi22', 'Java74'),
('prova', 'prova');

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
('I had an ArrayIndexOutOfBounds Exception. How can I solve?', 'luigi22'),
('What is Object-Oriented Programming (OOP)?', 'francesca'),
('What is the best IDE to use for Java?', 'federica'),
('What is the best programming language for a beginner?', 'prova');

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
