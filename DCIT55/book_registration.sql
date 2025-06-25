-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 03:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_books`
--

CREATE TABLE `tb_books` (
  `id` varchar(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `publisher` varchar(250) NOT NULL,
  `quan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_books`
--

INSERT INTO `tb_books` (`id`, `book_name`, `author`, `publisher`, `quan`) VALUES
('001', 'Test Book', 'Test Author', 'Test Publisher', 7),
('002', 'Diary of a Wimpy Kid', 'Som E. One', 'Diary Publishing', 2),
('003', 'Super Long Book Title That Should Overflow', 'Super Long Name of the Book Author', 'Super Long Publishing Name of the Book', 6),
('004', 'Book Name', 'Book Author', 'Book Publisher', 3),
('005', 'Filler', 'Filler', 'Filler', 5),
('006', 'Test Book With Long Name', 'Test Author Jr.', 'Test Publishing', 2),
('007', 'AiScream', 'Hen', 'Hen Publishing', 6),
('008', 'Introduction to CSS', 'CSS Author', 'CSS Publishing Corp.', 3),
('009', 'Danny\'s Book of Wonder', 'Danny Danny', 'Danny\'s Publishing Studio', 3),
('010', 'John Paul\'s Awesome Adventures', 'John Paul', 'Naic Publishing', 1),
('019', 'Test Input', 'John Ichiro', 'Ichi\'s Publishing Corporation', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_books`
--
ALTER TABLE `tb_books`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
