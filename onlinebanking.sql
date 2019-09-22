-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2019 at 04:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebanking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `account_balance` int(11) NOT NULL,
  `currency` varchar(12) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `home_address` varchar(100) DEFAULT NULL,
  `acct_pin` int(4) NOT NULL,
  `sort_code` varchar(6) NOT NULL,
  `tcc_code` varchar(6) NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `csc_code` varchar(4) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `names`, `account_number`, `account_type`, `account_balance`, `currency`, `occupation`, `phone`, `birthdate`, `home_address`, `acct_pin`, `sort_code`, `tcc_code`, `otp_code`, `csc_code`, `image`) VALUES
(1, 'peter parker', '104836417', 'savings', 175000, 'us dollar', 'civil engineer', '+21476876468', '1993-05-21', '12 cambrige street, london', 4421, '422718', '547863', '987686', '21b9', 'profilepics/profile1.jpg'),
(2, 'sandra curie', '214947353', 'savings', 120000, 'us dollar', 'fashionist', '+13762476879', '1997-03-25', '24 curie perie avenue, newyork. usa', 2198, '746293', '387459', '048524', '9874', 'profilepics/sandra.jpg'),
(3, 'john joe', '23342785', 'savings', 400000, 'us dollar', 'software developer', '+585943896', '1992-12-25', 'west ford avenue ,canada', 6748, '453126', '374689', '987685', '2371', 'profilepics/profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(1, 'a60282ee6a87434b8057961c5902ac973a8e7e66', 1),
(4, '6474cc11cbd9962dbcfb06a6c9c3e6d837927304', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `details` varchar(250) NOT NULL,
  `amount` float NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `date`, `details`, `amount`, `account_id`) VALUES
(1, '2019-09-02', '$20,000 deposited by scott martins, for payment of goods', 20000, 1),
(2, '2019-09-08', 'debit of $5,000 with POS of cythnia james', 5000, 1),
(3, '2019-02-19', 'payment of electrical bills', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transferfunds`
--

CREATE TABLE `transferfunds` (
  `id` int(11) NOT NULL,
  `receiver_bank` varchar(100) NOT NULL,
  `receiver_name` varchar(100) NOT NULL,
  `receiver_num` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `receiver_acct_type` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `dateposted` datetime NOT NULL,
  `status` varchar(200) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transferfunds`
--

INSERT INTO `transferfunds` (`id`, `receiver_bank`, `receiver_name`, `receiver_num`, `amount`, `receiver_acct_type`, `description`, `dateposted`, `status`, `account_id`) VALUES
(1, 'unite bank plc', 'james frank', '0923746789', 20000, '3', 'payment for rent', '2019-09-13 17:17:37', 'pending', 1),
(2, 'carlofionia community bank', 'joyous andrew', '2347560987', 5000, '3', 'for payment of goods supply to the church', '2019-09-13 23:19:57', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `account_id`) VALUES
(1, 'andrew123', 'andrew20@company.com', '$2y$10$SzsglQ7kcAnuifWh3C7LM.J/sLMVeIsdeRGhZ8ah54iGnh1zKhJ9K', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tcc_code` (`tcc_code`),
  ADD UNIQUE KEY `sort_code` (`sort_code`),
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD UNIQUE KEY `csc_code` (`csc_code`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `transferfunds`
--
ALTER TABLE `transferfunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ibfk_1` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transferfunds`
--
ALTER TABLE `transferfunds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `transferfunds`
--
ALTER TABLE `transferfunds`
  ADD CONSTRAINT `transferfunds_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
