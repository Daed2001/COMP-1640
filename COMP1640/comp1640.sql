-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2022 at 10:35 AM
-- Server version: 5.7.34-log
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comp1640`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL,
  `createAt` timestamp NOT NULL,
  `updateAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryname`, `createAt`, `updateAt`) VALUES
(13, 'Teaching Quality', '2022-03-29 15:51:30', '2022-04-14 12:30:43'),
(14, 'Soft Skills', '2022-03-29 15:51:38', '2022-04-14 12:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Anonymous` tinyint(1) NOT NULL,
  `ideaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `Content`, `Anonymous`, `ideaId`, `userId`, `createAt`) VALUES
(167, 'That is amazing', 1, 195, 19, '2022-04-15 12:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentId` int(11) NOT NULL,
  `departmentname` varchar(50) NOT NULL,
  `createAt` timestamp NOT NULL,
  `updateAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentId`, `departmentname`, `createAt`, `updateAt`) VALUES
(75, 'Business', '2022-03-25 00:05:14', '2022-04-14 12:55:00'),
(83, 'Technology', '2022-03-26 22:20:57', '2022-04-14 12:37:24'),
(87, 'Graphic Design', '2022-04-04 22:50:10', '2022-04-12 15:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `idea`
--

CREATE TABLE `idea` (
  `ideaId` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `File` longtext,
  `Package` longtext,
  `Anonymous` tinyint(1) NOT NULL,
  `userId` int(11) NOT NULL,
  `submissionId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `idea`
--

INSERT INTO `idea` (`ideaId`, `Title`, `Content`, `File`, `Package`, `Anonymous`, `userId`, `submissionId`, `categoryId`, `createAt`, `updateAt`) VALUES
(188, 'How To Teach Quality', 'We all have a duty to teach the next generation the qualities that make us great. To do so, we must focus on teaching them quality. From start to finish.⁣⁣\r\n\r\nThe #quality of what we teach, the quality of how we teach, and the quality of our intent when we teach. Quality is important in everything. And not just for our children’s sake either', NULL, NULL, 1, 18, 34, 13, '2022-04-14 14:17:59', '2022-04-14 14:17:59'),
(189, '5 Ways to Teach Quality', 'Every lesson should be a fresh opportunity to learn and grow. #teachingquality is a practice that’s important for both teachers and students alike.\r\n\r\n1. Understanding the content\r\n\r\n2. Creating your own method of teaching\r\n\r\n3. Maintaining an open dialogue with your students\r\n\r\n4. Adapting your teaching methods according to the lesson you’re teaching\r\n\r\n5. Teaching the quality', 'tải xuống.jpg', NULL, 0, 18, 34, 13, '2022-04-14 14:24:20', '2022-04-14 14:24:20'),
(191, 'How to Develop Soft Skills', 'Develop skills that will make you an invaluable asset to your employer or your industry\r\n\r\nWant to be successful in the working world? Let’s prepare ourselves for the future by developing skills that will make us an indispensable asset.⁣\r\n\r\nDeveloping these soft skills might not be essential to survive, but they are essential to thrive.⁣\r\n\r\nThese skills include communication, relationship-building, negotiation and networking', NULL, 'Netch.7z', 1, 18, 33, 14, '2022-04-14 14:59:28', '2022-04-14 14:59:28'),
(192, 'Teaching Quality Matters', 'Quality is defined by how something stands over time. It’s not just about where you start, but more importantly, where you end.\r\n\r\nWe believe that quality is everything. And while it might take a little more time and effort to ensure quality, in the end, it will be worth it.⁣⁣\r\n\r\nSo we make sure we always provide the best customer service possible, so that our members are', NULL, 'OneDrive_1_4-1-2022.zip', 0, 20, 33, 13, '2022-04-15 10:56:30', '2022-04-15 10:56:30'),
(193, 'The Importance of Teaching Quality', 'Education starts from the ground up. The foundation for a quality education begins with a strong early childhood education.\r\n\r\nSo we’ve got your back on that one. Our early childhood program is designed to provide children and families with the resources, support, and tools to take charge of their own learning, boosting their developmental growth.\r\n\r\nBut we can’t do it alone. Which is why we’', 'file-teaching-skills-1605625101.jpg', NULL, 0, 20, 32, 13, '2022-04-15 11:00:46', '2022-04-15 11:00:46'),
(194, 'Soft Skills Make or Break Your Career', 'The #SoftSkills revolution has begun.\r\n\r\nThe #skills you need to compete in the current economy are not just hard, they’re soft too.\r\n\r\nSoft skills are often the most important skills. You can have all the technical skills in the world, but if you don’t have empathy, people will find your ideas useless and hard to implement. What use is a brilliant idea if nobody is going', NULL, NULL, 1, 20, 33, 14, '2022-04-15 11:05:14', '2022-04-15 11:05:14'),
(195, 'Solf Skills: The Definitive Guide to the Solf Technique', 'The art of hearing the world’s vibrations\r\n\r\nThe science of the mind-body connection\r\n\r\nAn ancient technique for healing the body, mind, and soul\r\n\r\nAnd a personal journey to wholeness.⁣⁣\r\n\r\nSo what is Solf? It’s a way of listening to and feeling the ground with your feet. With every step, you learn to hear more clearly and actively engage with', 'Soft-Skills.jpg', NULL, 1, 19, 34, 14, '2022-04-15 11:20:16', '2022-04-15 11:20:16'),
(196, 'Solve Problems with Solf Skills', 'Solving problems with solf skills since forever\r\n\r\nSolve problems with solf skills. Solving crimes, solving puzzles; you name it. solve your insoluble problems with our solutions.⁣⁣\r\n\r\nYou don’t even need a PhD in hard-boiled eggs to solve these difficulties and mysteries.⁣\r\n\r\n⁣#solversofthedozen-eggs', NULL, NULL, 1, 19, 33, 14, '2022-04-15 11:22:08', '2022-04-15 11:22:08'),
(197, 'Teaching Quality and Student Success', 'A high quality education is the key to success and happiness, and we believe it starts with the students themselves. That’s why our #mission is to provide access to a quality education for everyone.⁣\r\n\r\nWe don’t just want to give you a degree, but also empower you with skills, so that you can succeed in whatever endeavor you choose. It doesn’t matter if its STEM or', 'TeachingProjectLN-videoSixteenByNineJumbo1600.jpg', NULL, 1, 19, 33, 13, '2022-04-15 11:22:59', '2022-04-15 11:22:59');

-- --------------------------------------------------------

--
-- Table structure for table `idealtest`
--

CREATE TABLE `idealtest` (
  `Title_id` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` mediumtext NOT NULL,
  `File` longtext NOT NULL,
  `Anonymous` tinyint(1) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `createAt` datetime NOT NULL,
  `updateAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `idealtest`
--

INSERT INTO `idealtest` (`Title_id`, `Title`, `Content`, `File`, `Anonymous`, `categoryId`, `createAt`, `updateAt`) VALUES
(40, 'Hellooo guy', 'dsadsadsad', 'cafe.png', 1, 13, '2022-03-29 17:45:32', '2022-03-29 17:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `reactionId` int(11) NOT NULL,
  `reaction` tinyint(1) NOT NULL,
  `ideaId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createAt` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`reactionId`, `reaction`, `ideaId`, `userId`, `createAt`) VALUES
(1030, 1, 189, 4, '2022-04-14 14:28:12'),
(1031, 1, 188, 4, '2022-04-14 14:28:13'),
(1032, 1, 189, 18, '2022-04-14 14:45:46'),
(1033, 1, 188, 18, '2022-04-14 14:45:47'),
(1034, 1, 191, 4, '2022-04-15 01:54:44'),
(1035, 1, 189, 19, '2022-04-15 12:42:26'),
(1036, 1, 196, 4, '2022-04-15 19:45:37'),
(1037, 1, 194, 4, '2022-04-15 19:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleId` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleId`, `rolename`) VALUES
(1, 'Admin'),
(2, 'QA Coordinator'),
(3, 'QA Manager '),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `submissionId` int(11) NOT NULL,
  `submissionname` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `closure_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_closure_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`submissionId`, `submissionname`, `content`, `closure_date`, `final_closure_date`, `createAt`, `updateAt`) VALUES
(32, 'FALL-TERM-22', 'FALL-TERM-22', '2023-03-08 08:00:00', '2023-04-08 08:00:00', '2022-04-14 11:38:25', '2022-04-14 12:55:16'),
(33, 'SUMMER-TERM-22', 'SUMMER-TERM-22', '2022-11-08 10:43:00', '2022-12-08 10:43:00', '2022-04-14 11:38:52', '2022-04-14 11:44:02'),
(34, 'SPRING-TERM-23', 'SPRING-TERM-23', '2022-11-25 11:06:00', '2022-12-25 11:06:00', '2022-04-14 11:39:20', '2022-04-14 12:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateAt` timestamp NULL DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  `departmentId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `email`, `fullname`, `createAt`, `updateAt`, `roleId`, `departmentId`) VALUES
(4, 'admin', '$2y$10$kd55MvbOvdE2u6fsMufJO.WWKZ3e6h0/0BFkt.Vqh0dBAo7tuwJ2.', 'trantankhoa112@gmail.com', 'Tran Tan Khoa', '2022-03-15 16:57:54', '2022-04-15 19:46:18', 1, 83),
(18, 'staffbusiness', '$2y$10$q.vXb1b0k7RG6fP9CMtTee/XxESrNejC/9VEucohynsNFfG9vs2M.', 'staff1@gmail.com', 'Nguyen van staff', '2022-04-14 11:27:57', '2022-04-14 11:27:57', 4, 75),
(19, 'stafftech', '$2y$10$dqhxDthEqdYaTu4rKzf2XO2.x5o2SXwmFdcc5PZvIWTaWqZQPjZ2.', 'stafftech@gmail.com', 'Nguyễn thị ngọc stafftech', '2022-04-14 11:28:54', '2022-04-14 11:28:54', 4, 83),
(20, 'staffgraphic', '$2y$10$n.CovLWrMxkPLhQMdyKTy./FsPJNNL90s.SilfAaU7Gm.s/HLxCKe', 'staffgraphic@gmail.com', 'Nguyen van staffgraphic', '2022-04-14 11:29:25', '2022-04-14 11:29:25', 4, 87),
(21, 'admin2', '$2y$10$FjNU/b2V0Lfbf88ZuD/baeQTUZBwYeI6Zqhd4oXTVNbXrDULgUely', 'staffadmin@gmail.com', '', '2022-04-16 09:03:53', '2022-04-16 09:03:53', 4, 75);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `ideacomment_fk` (`ideaId`),
  ADD KEY `usercomment_fk` (`userId`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentId`);

--
-- Indexes for table `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`ideaId`),
  ADD KEY `submission_fk` (`submissionId`),
  ADD KEY `category_fk` (`categoryId`),
  ADD KEY `user_fk` (`userId`);

--
-- Indexes for table `idealtest`
--
ALTER TABLE `idealtest`
  ADD PRIMARY KEY (`Title_id`),
  ADD KEY `categoryid_fk` (`categoryId`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`reactionId`),
  ADD KEY `ideareaction_fk` (`ideaId`),
  ADD KEY `userreaction_fk` (`userId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`submissionId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `department_fk` (`departmentId`),
  ADD KEY `role_fk` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `ideaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `idealtest`
--
ALTER TABLE `idealtest`
  MODIFY `Title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `reactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `ideacomment_fk` FOREIGN KEY (`ideaId`) REFERENCES `idea` (`ideaId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercomment_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idea`
--
ALTER TABLE `idea`
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `submission_fk` FOREIGN KEY (`submissionId`) REFERENCES `submission` (`submissionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idealtest`
--
ALTER TABLE `idealtest`
  ADD CONSTRAINT `categoryid_fk` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `ideareaction_fk` FOREIGN KEY (`ideaId`) REFERENCES `idea` (`ideaId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userreaction_fk` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `department_fk` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
