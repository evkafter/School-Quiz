-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1:3306
-- Χρόνος δημιουργίας: 14 Ιουλ 2019 στις 22:12:55
-- Έκδοση διακομιστή: 5.7.23
-- Έκδοση PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `school_quiz`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `admins`
--

INSERT INTO `admins` (`email`) VALUES
('admin@ad.min');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `courses`
--

INSERT INTO `courses` (`course_id`, `name`) VALUES
(1, 'Μαθηματικά'),
(2, 'Φυσική'),
(3, 'Χημεία'),
(4, 'Λογοτεχνία');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` varchar(5000) NOT NULL,
  `answers` varchar(1000) NOT NULL,
  `course_id` int(20) NOT NULL,
  `source` varchar(1000) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `QUESTIONS_COURSES_FK` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `questions`
--

INSERT INTO `questions` (`question_id`, `title`, `text`, `answers`, `course_id`, `source`) VALUES
(1, 'Τύπος Υπερβολής', 'Ποια από τις παρακάτω συναρτήσεις ανήκει σε υπερβολή;', 'y = a / x# y = a + x#x = a + y# y = a * x + b', 1, 'Β\' Γυμνασίου, Κεφάλαιο Α.3.5'),
(2, 'Ευκλείδεια Διαίρεση', 'Ποιος είναι ο ορισμός της Ευκλείδειας Διαίρεσης;', 'Δ = δ * π + υ#Δ = δ * π#Δ = π + υ#Δ = δ * θ', 1, 'Α\' Γυμνασίου, Κεφάλαιο Α.1.4'),
(3, 'Μονάδες Μέτρησης', 'Πώς αλλιώς ονομάζεται το δεκατόμετρο;', 'Παλάμη#Δάχτυλο#Μάτι#Πόδι', 1, 'Α\' Γυμνασίου, Κεφάλαιο Α.3.5'),
(4, 'Πυθαγόρειο Θεώρημα', 'Με τι ισούται το άθροισμα των τετραγώνων των δύο κάθετων πλευρών σε κάθε ορθογώνιο τρίγωνο;', 'Το τετράγωνο της υποτείνουσας#Το διπλάσιο της υποτείνουσας#Το μισό της υποτείνουσας#Την υποτείνουσα', 1, 'Β\' Γυμνασίου, Κεφάλαιο Β.1.4'),
(5, 'Εξίωσωση', 'Ποια είναι η λύση της εξίσωσης 2(x - 1) - x = x - 2', 'Ταυτότητα#Αδύνατη#3#6', 1, 'Γ\' Γυμνασίου, Κεφάλαιο Α.2.1'),
(6, 'Θερμοκρασία', 'Με ποιο όργανο μετράμε τη θερμοκρασία;', 'Θερμόμετρο#Ταχύμετρο#Ζυγαριά#Πολύμετρο', 2, 'Α\' Γυμνασίου, Φύλλο Εργασίας 5'),
(7, 'Φαινόμενο Θερμοκηπίου', 'Από ποιο αέριο προκαλείται το φαινόμενο του Θερμοκηπίου;', 'Διοξείδιο του Άνθρακα#Μονοξείδιο του Άνθρακα#Οξυγόνο#Άζωτο', 2, 'Α\' Γυμνασίου, Φύλλο Εργασίας 9'),
(8, 'Ταχύτητα', 'Το μέγεθος της ταχύτητας ορίζει το ρυθμό μεταβολής της...', 'Απόστασης#Θερμοκρασίας#Επιτάχυνσης#Επιβράδυνσης', 2, 'Β\' Γυμνασίου, Κεφάλαιο 2.2'),
(9, 'Δράση - Αντίδραση', 'Ποιος νόμος του Νεύτωνα ορίζει της έννοιας της δράσης και της αντίδρασης;', '3ος#1ος#2ος#Κανένας', 2, 'Β\' Γυμνασίου, Κεφάλαιο 3.7'),
(10, 'Διαλύματα', 'Πώς ονομάζεται το συστατικό που έχει την ίδια φυσική κατάσταση με το διάλυμα;', 'Διαλύτης#Διαλυμένη ουσία#Νερό#Οξυγόνο', 3, 'Β\' Γυμνασίου, Κεφάλαιο 2.2.2'),
(11, 'Ατμόσφαιρα', 'Τι από τα παρακάτω δεν είναι τμήμα της ατμόσφαιρας;', 'Πεντόσφαιρα#Τροπόσφαιρα#Στρατόσφαιρα#Ιονόσφαιρα', 3, 'Β\' Γυμνασίου, Κεφάλαιο 3.1'),
(12, 'Ρύπανση του εδάφους', 'Τι από τα παρακάτω δεν προκαλεί ρύπανση του εδάφους;', 'Κοπριά#Φυτοφάρμακα#Σκουπίδια#Ατυχήματα', 3, 'Β\' Γυμνασίου, Κεφάλαιο 4.2'),
(13, 'Περιοδικός Πίνακας', 'Με βάση ποια ιδιότητα των στοιχείων έγινε η ταξινόμησή τους στον περιοδικό πίνακα;', 'Περιοδικότητα#Μέγεθος#Αλφαβητικά#Τυχαία', 3, 'Γ\' Γυμνασίου, Κεφάλαιο 2.1'),
(14, 'Κλασματική απόσταξη', 'Πώς λέγεται η μέθοδος διαχωρισμού του πετρελαίου στα προϊόντα του;', 'Κλασματική απόσταξη#Διάθλαση#Εξάχνωση#Διάβρωση', 3, 'Γ\' Γυμνασίου, Κεφάλαιο 3.2'),
(15, 'Ημερολόγιο της Άννα Φρανκ', 'Πώς λεγόταν η φανταστική φίλη στην οποία απευθυνόταν στο ημερολόγιό της η Άννα Φρανκ;', 'Κίτυ#Άννα#Μπέτυ#Νόρα', 4, 'Β\' Γυμνασίου, Ενότητα 3, Από το ημερολόγιο της Άννας Φρανκ'),
(16, 'Για τον όρο «μετανάστες»', 'Ποιος έγραψε το ποίημα Για τον όρο «μετανάστες»;', 'Μπέρτολτ Μπρεχτ#Αλέξανδρος Παπαδιαμάντης#Άντον Τσέχοφ#Ηλίας Βενέζης', 4, 'Β\' Γυμνασίου, Ενότητα 8, Για τον όρο «μετανάστες»');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(20) NOT NULL,
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `STUDENTS_USERS_FK` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `students`
--

INSERT INTO `students` (`student_id`, `first`, `last`, `email`) VALUES
(1, 'Κώστας', 'Δημητρίου', 'kosdim@mail.com'),
(2, 'Μένιος', 'Μένιου', 'menmen@mail.com'),
(3, 'Γιώργος', 'Γεωργίου', 'geogeo@mail.gr');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`email`, `password`) VALUES
('admin@ad.min', '$2y$10$5dde03k8GXuoMOW8wFTIye6wNZfSicBQ6eVHL0D79pPzZL13WNHa.'),
('geogeo@mail.gr', '$2y$10$zi72Xx7D.xlufS.VsoIPBeMH/ynXZdHbdeWqxCEHSEessOibguW2O'),
('kosdim@mail.com', '$2y$10$0fE1WfrnUe8e50DOC399k.1ssroPeWLBOgXER728ih.kjGMkHU1I6'),
('menmen@mail.com', '$2y$10$Tx/Y.Re49ssRoLAcxFikDu6rMH3jr2MZfJZZp2uvisaL8WUrhRup.');

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `ADMINS_USERS_FK` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `QUESTIONS_COURSES_FK` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `STUDENTS_USERS_FK` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
