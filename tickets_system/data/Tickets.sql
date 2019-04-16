-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2019 at 02:34 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(45) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `order_date`) VALUES
(1, 'Vova', 'vova@gmail.com', '2019-04-02'),
(2, 'Vova2', 'vova2@gmail.com', '2019-04-21'),
(3, 'Poli', 'poli@hotmail.com', '2019-02-01'),
(4, 'Erik', 'erik@hotmail.com', '2019-03-18'),
(5, 'Test', 'test@gmail.com', '2019-04-08'),
(6, 'vova', 'vova@gmail.com', '2019-04-12'),
(39, 'Kalle', 'child@hotmail.com', '2019-04-15'),
(40, 'Best Worker', 'best.worker@gmail.com', '2019-04-15'),
(41, 'Martin ', 'martin@g.com', '2019-04-15'),
(42, 'vova', 'vova@gmail.com', '2019-04-15'),
(43, 'vova2', 'vova2@gmail.com', '2019-04-15'),
(44, 'sss', 'james@ff.se', '2019-04-15'),
(45, 'sss', 'james@ff.se', '2019-04-15'),
(50, 'array', 'array@g.com', '2019-04-15'),
(51, 'edit', 'edit@g.com', '2019-04-15'),
(52, 'newItem', 'dasfa@fa.com', '2019-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `valid_date` date NOT NULL,
  `used_ticket` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `ticket_id`, `valid_date`, `used_ticket`) VALUES
(1, 1, 1, '2019-05-01', 'no'),
(2, 2, 3, '2019-05-20', 'yes'),
(3, 2, 1, '2019-05-20', 'no'),
(4, 2, 1, '2019-05-20', 'yes'),
(5, 3, 4, '2019-03-01', 'no'),
(6, 4, 9, '2019-04-17', 'yes'),
(7, 5, 2, '2019-05-08', 'no'),
(10, 39, 3, '2019-05-15', 'no'),
(11, 40, 28, '2019-05-15', 'yes'),
(12, 41, 1, '2019-05-15', 'no'),
(13, 42, 1, '2019-05-15', 'no'),
(14, 43, 2, '2019-05-15', 'no'),
(15, 44, 2, '2019-05-15', 'no'),
(16, 45, 2, '2019-05-15', 'no'),
(17, 50, 1, '2019-05-15', 'no'),
(18, 50, 2, '2019-05-15', 'no'),
(19, 51, 1, '2019-05-15', 'no'),
(20, 52, 2, '2019-05-15', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `name_ticket` varchar(45) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `name_ticket`, `price`, `image`, `description`) VALUES
(1, 'Adult', 100, 'images/adult_ticket.png', 'Age from 18  to 64 years'),
(2, 'Student', 75, 'images/student_ticket.png', 'Presence Student card'),
(3, 'Child', 60, 'images/child_ticket.png', 'Age from 2 to 7 years'),
(4, 'Pensioner', 80, 'images/ticket.png', 'Age from 65 years'),
(9, 'VIP_Ticket', 150, 'images/ticket.png', 'Priority pass'),
(28, 'Employee', 65, 'images/ticket.png', 'For employees'),
(30, 'test2', 222, 'images/ticket.png', 'New Test'),
(33, 'Dog/cat', 40, 'images/ticket.png', 'Only for your pets!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_idx` (`order_id`),
  ADD KEY `id_idx1` (`ticket_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_ticket_UNIQUE` (`name_ticket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
