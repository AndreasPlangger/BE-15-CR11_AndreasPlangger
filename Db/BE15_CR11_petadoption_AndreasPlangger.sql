-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2022 at 05:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BE15_CR11_petadoption_AndreasPlangger`
--
CREATE DATABASE IF NOT EXISTS `BE15_CR11_petadoption_AndreasPlangger` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `BE15_CR11_petadoption_AndreasPlangger`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `petID` int(11) NOT NULL,
  `pet_name` varchar(65) NOT NULL,
  `breed` varchar(65) NOT NULL,
  `size` enum('very small','small','medium','large','very large') NOT NULL,
  `age` int(11) NOT NULL,
  `pet_description` varchar(260) NOT NULL,
  `hobbies` varchar(65) NOT NULL,
  `pet_address` varchar(65) NOT NULL,
  `picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`petID`, `pet_name`, `breed`, `size`, `age`, `pet_description`, `hobbies`, `pet_address`, `picture`) VALUES
(5000000, 'Donnashello', 'turtle', 'small', 67, 'Easy going fellow, that takes life in a relaxed manner, never rushes and always keeps a straight face, no matter what life throws at him, he has got a thick skin.', 'eating salad, sleeping', 'Turtleweg 78', 'turtle_640.jpg'),
(5000001, 'Rabbit DeNiro', 'rabbit', 'small', 5, 'Always energetic, he ll jump on any adventure life has to offer. He s also very affectionate and loves nothing more than digging for love and attention.', 'carrots, digging holes', 'Rabbitstrasse 31', 'rabbit_640.jpg'),
(5000002, 'Marty McFly', 'bird', 'small', 12, 'Marty is a sweet natured and sensitive dude who\'s had quite a singing career. Now retired, he just wants to chill. He s still got the voice but sometimes can be timid around cats. ', 'flying, singing', 'Birdroad 44', 'parrott_640.jpg'),
(5000003, 'Fidel Catstro', 'cat', 'small', 6, 'Once settled Fidel is a very gentle and sweet natured boy who will also need a cat flap fitted regardless of working hours so he can have the security to come and go to a nice little garden of his own.', 'sleeping, eating', 'Catweg 98', 'cat_russian_blue.jpg'),
(5000004, 'Cleocatra', 'cat', 'small', 7, 'Cleocatra is an independent lady who will appreciate someone that gives her the time to find her paws. She is pretty comfortable in her own fur, and while she is a little aloof it doesnt mean she won’t love you.', 'cleaning, hunting', 'Catgasse 25', 'cat_birman.jpg'),
(5000005, 'Cat Stevens', 'cat', 'small', 9, 'Cat Stevens is a very handsome and inquisitive boy who likes to be part of all the action. He loves his fuss and often pops up on your lap for some extra cuddles and a better view of the world.', 'strolling, hiding', 'Catweg 68', 'cat_scotish.jpg'),
(5000006, 'Dogstoyevsky', 'dog', 'medium', 8, 'Beautiful, bouncy Dogstoyevsky is an active and excitable male who wants to say HELLO to everyone he meets! Hes confident, outgoing and super playful. Full of energy and always up to something. ', 'barking', 'Hundehaufen 75', 'dog_640.jpg'),
(5000007, 'Karl Barx', 'dog', 'large', 4, 'Karl is a sensitive chap who is wary of strangers and will sometimes bark at strangers who approach him. Hes a clever chap, too. ', 'reading, contemplating', 'Marxstrasse 41', 'dog_terrier.jpg'),
(5000008, 'Woofi Goldberg', 'dog', 'large', 7, 'Woofi is a very friendly and outgoing girl who is super affectionate and very people orientated. Shes responsive to commands but being a typical Frenchie she can need a bit more motivation at times. ', 'running, eating', 'Huskyweg 33', 'dog2_640.jpg'),
(5000009, 'Tiny', 'elephant', 'very large', 37, 'Tiny is a handsome lad who wants to get to know you first. As soon as he trusts you he is more than happy to be king of the castle and enjoys hanging out. He loves to play and even fishes! ', 'rumbling, weight lifting', 'Elephantroad 83', 'elephant_640.jpg'),
(5000010, 'Hamilton', 'hamster', 'very small', 14, 'Hamilton is a friendly little fluff ball who will need a chilled out home. He would love to be the centre of attention and really get to know you. He is sweet and enjoys his fuss especially a good head and cheek rub is always welcome.', 'celebrating', 'Hamsterhaus 38', 'hamster_640.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `fk_userID` int(11) NOT NULL,
  `fk_petID` int(11) NOT NULL,
  `adoption_date` int(11) NOT NULL,
  `adoption_certificate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `address` varchar(65) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `status` enum('user','adm') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `address`, `phone`, `email`, `password`, `picture`, `status`) VALUES
(1000017, 'Thomas', 'Fink', 'Finkweg 13', '06768254778', 'thomas_fink@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000018, 'Colin', 'Crouch', 'Crouchweg 56', '06768254442', 'colin_crouch@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000019, 'Alan', 'Weisman', 'Weismanstrasse 156', '06768254443', 'alan_weisman@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000020, 'Georg', 'Foster', 'Fosterweg 22', '0537589562', 'georg_foster@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000021, 'Daniel', 'Defoe', 'Defoegasse 97', '06998463257', 'daniel_defoe@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000022, 'Jon', 'Krakauer', 'Krakauerstrasse 32', '0655672227', 'jon_krakauer@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000023, 'Manon', 'Lescault', 'Lescaultweg 132', '0855672227', 'manon_lescault@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000024, 'Diana', 'Rosenstein', 'Rosenstein 89', '0835672277', 'diana_rosenstein@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000025, 'Amanda', 'Hintanda', 'Hintandaweg 9', '0238672277', 'amanda_hintanda@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000026, 'Lea', 'Endell', 'Endellstrasse 79', '0871672277', 'lea_endell@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'user'),
(1000027, 'Adi', 'Admin', 'Adminstrasse 99', '0671672477', 'adi_admin@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'avatar.png', 'adm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_certificate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5000011;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_certificate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9005010;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000028;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
