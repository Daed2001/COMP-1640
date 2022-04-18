-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2022 at 09:13 PM
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
(13, 'Teaching-Quality', '2022-03-29 15:51:30', '2022-04-16 15:29:55'),
(14, 'Soft Skills', '2022-03-29 15:51:38', '2022-04-16 15:38:37'),
(35, 'Technical Skill', '2022-04-17 18:36:29', '2022-04-17 18:36:29');

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
(167, 'That is amazing', 1, 195, 19, '2022-04-15 12:45:15'),
(170, 'Survey Discussion', 1, 197, 4, '2022-04-16 10:58:01'),
(175, 'Survey Discussion', 1, 197, 4, '2022-04-16 11:56:55'),
(180, 'Very good idea to train soft skills', 1, 207, 4, '2022-04-17 07:57:44'),
(181, 'Actually Good', 1, 209, 4, '2022-04-17 08:20:17'),
(184, 'I have some question, would you mind answering ?', 1, 210, 4, '2022-04-17 13:39:19'),
(185, 'nice', 1, 209, 4, '2022-04-17 13:41:16'),
(190, 'amazing', 1, 207, 4, '2022-04-17 17:00:29'),
(191, 'Would you mind if I ask you a few question ?', 1, 211, 4, '2022-04-17 18:24:18'),
(192, 'I have some question, would you mind answering ?', 1, 211, 4, '2022-04-17 18:27:50'),
(196, 'Very good idea', 1, 208, 4, '2022-04-17 18:37:02'),
(197, 'Actually Good', 0, 208, 4, '2022-04-17 18:37:33'),
(198, 'Actually Good', 1, 207, 4, '2022-04-17 18:37:54'),
(199, 'Hello', 1, 211, 4, '2022-04-17 18:37:56'),
(200, 'Very good idea to train soft skills', 1, 208, 4, '2022-04-17 18:38:17');

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
(87, 'Graphic Design', '2022-04-04 22:50:10', '2022-04-12 15:44:33'),
(90, 'IT', '2022-04-17 18:38:55', '2022-04-17 18:38:55');

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
(197, 'Teaching Quality and Student Success', 'A high quality education is the key to success and happiness, and we believe it starts with the students themselves. That’s why our #mission is to provide access to a quality education for everyone.⁣\r\n\r\nWe don’t just want to give you a degree, but also empower you with skills, so that you can succeed in whatever endeavor you choose. It doesn’t matter if its STEM or', 'TeachingProjectLN-videoSixteenByNineJumbo1600.jpg', NULL, 1, 19, 33, 13, '2022-04-15 11:22:59', '2022-04-15 11:22:59'),
(207, 'Soft Skills for the Modern Day Professional', 'The best way to learn #softskills is through experience, so start working today!\r\n\r\nThe best way to learn soft skills is through experience, which you can get by starting a job today. So don&#39;t wait any longer to get started on your career journey.⁣\r\n\r\nIf you&#39;re not sure where to start, don&#39;t worry. We have job listings for every profession and skill set across America right here on #', 'shutterstock_164393432.jpg', NULL, 1, 23, 34, 14, '2022-04-17 01:02:22', '2022-04-17 01:02:22'),
(208, 'How to Become a Better Team Member', 'A good team is a group of people who work together to achieve their goals. But what’s a good team?\r\n\r\nA team is more than just the sum of its members - it’s the way those members interact with each other. It’s the relationships and trust that form between them.⁣\r\n\r\nThis is why we always emphasize that a successful team is one where every single person feels', NULL, NULL, 1, 23, 34, 14, '2022-04-17 01:03:21', '2022-04-17 01:03:21'),
(209, 'Teaching Quality - What is it and how to improve', 'After all, it&#39;s all about quality.\r\n\r\nQuality is in both the design and the execution. Quality is a defining character of our brand, and it&#39;s what sets us apart from the pack.⁣⁣\r\n\r\nIt starts with the raw materials we use to make our product and end with how we care for them afterwards. We&#39;re committed to making our products last longer than any other company out there by using high', NULL, 'Quality teaching.zip', 1, 23, 34, 13, '2022-04-17 01:04:39', '2022-04-17 01:04:39'),
(210, 'The Technical Skill', 'Do something different', NULL, NULL, 0, 4, 34, 13, '2022-04-17 13:33:51', '2022-04-17 13:33:51'),
(211, 'The SoftSkill Technique', 'Do something different', NULL, NULL, 1, 4, 34, 13, '2022-04-17 18:23:05', '2022-04-17 18:23:05'),
(221, 'Teaching Quality Matters', 'Quality is defined by how something stands over time. It’s not just about where you start, but more importantly, where you end. We believe that quality is everything. And while it might take a little more time and effort to ensure quality, in the end, it will be worth it.⁣⁣ So we make sure we always provide the best customer service possible, so that our members are', NULL, NULL, 1, 4, 34, 14, '2022-04-18 20:12:39', '2022-04-18 20:12:39'),
(222, '5 Ways to Teach Quality', 'Every lesson should be a fresh opportunity to learn and grow. #teachingquality is a practice that’s important for both teachers and students alike. 1. Understanding the content 2. Creating your own method of teaching 3. Maintaining an open dialogue with your students 4. Adapting your teaching methods according to the lesson you’re teaching 5. Teaching the quality', NULL, NULL, 1, 4, 34, 13, '2022-04-18 20:15:20', '2022-04-18 20:15:20'),
(223, 'How To Teach Quality', 'We all have a duty to teach the next generation the qualities that make us great. To do so, we must focus on teaching them quality. From start to finish.⁣⁣ The #quality of what we teach, the quality of how we teach, and the quality of our intent when we teach. Quality is important in everything. And not just for our children’s sake either', NULL, NULL, 1, 4, 34, 14, '2022-04-18 20:17:39', '2022-04-18 20:17:39'),
(224, 'How To Teach Quality', 'We all have a duty to teach the next generation the qualities that make us great. To do so, we must focus on teaching them quality. From start to finish.⁣⁣ The #quality of what we teach, the quality of how we teach, and the quality of our intent when we teach. Quality is important in everything. And not just for our children’s sake either', NULL, NULL, 1, 4, 34, 13, '2022-04-18 20:22:52', '2022-04-18 20:22:52'),
(225, 'How To Teach Quality', 'We all have a duty to teach the next generation the qualities that make us great. To do so, we must focus on teaching them quality. From start to finish.⁣⁣ The #quality of what we teach, the quality of how we teach, and the quality of our intent when we teach. Quality is important in everything. And not just for our children’s sake either', NULL, NULL, 1, 4, 34, 13, '2022-04-18 20:23:54', '2022-04-18 20:23:54'),
(226, '5 Ways to Teach Quality', 'Every lesson should be a fresh opportunity to learn and grow. #teachingquality is a practice that’s important for both teachers and students alike. 1. Understanding the content 2. Creating your own method of teaching 3. Maintaining an open dialogue with your students 4. Adapting your teaching methods according to the lesson you’re teaching 5. Teaching the quality', NULL, NULL, 1, 4, 34, 13, '2022-04-18 20:27:52', '2022-04-18 20:27:52'),
(227, '5 Ways to Teach Quality', 'Every lesson should be a fresh opportunity to learn and grow. #teachingquality is a practice that’s important for both teachers and students alike. 1. Understanding the content 2. Creating your own method of teaching 3. Maintaining an open dialogue with your students 4. Adapting your teaching methods according to the lesson you’re teaching 5. Teaching the quality', NULL, NULL, 1, 4, 34, 13, '2022-04-18 20:29:32', '2022-04-18 20:29:32');

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
(1037, 1, 194, 4, '2022-04-15 19:45:38'),
(1039, 1, 197, 4, '2022-04-16 10:47:51'),
(1052, 1, 209, 4, '2022-04-17 13:21:17'),
(1055, 1, 207, 22, '2022-04-17 17:16:27'),
(1056, 1, 189, 22, '2022-04-17 17:16:36'),
(1057, 1, 188, 22, '2022-04-17 17:16:38');

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
(32, 'FALL-TERM-22', 'FALL-TERM-22', '2022-03-31 09:50:00', '2022-04-01 09:50:00', '2022-04-14 11:38:25', '2022-04-16 10:50:07'),
(33, 'SUMMER-TERM-22', 'SUMMER-TERM-22', '1970-01-01 08:00:00', '1970-01-01 08:00:00', '2022-04-14 11:38:52', '2022-04-16 15:27:42'),
(34, 'SPRING-TERM-23', 'SPRING-TERM-23', '2022-11-25 11:06:00', '2022-12-25 11:06:00', '2022-04-14 11:39:20', '2022-04-14 12:06:49'),
(35, 'WINTER -TERM-23', 'WINTER - TERM - 23', '1970-01-01 08:00:00', '1970-01-01 08:00:00', '2022-04-17 18:43:27', '2022-04-17 18:43:27'),
(36, 'WINTER -TERM-21', 'WINTER - TERM - 23', '2022-04-20 17:46:00', '2022-03-29 17:46:00', '2022-04-18 18:44:31', '2022-04-18 18:44:31');

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
(4, 'admin', '$2y$10$TWcvMTJR4quOWbTDWej57.knbSyR7GkF1TQZSKSrGhlVDYwsu/GY.', 'hngokimhuy@gmail.com', 'Ngo kim huy', '2022-03-15 16:57:54', '2022-04-17 18:27:28', 1, 83),
(18, 'staffbusiness', '$2y$10$q.vXb1b0k7RG6fP9CMtTee/XxESrNejC/9VEucohynsNFfG9vs2M.', 'staff23213@gmail.com', 'Nguyen van staff', '2022-04-14 11:27:57', '2022-04-17 00:43:12', 4, 75),
(19, 'stafftech', '$2y$10$dqhxDthEqdYaTu4rKzf2XO2.x5o2SXwmFdcc5PZvIWTaWqZQPjZ2.', 'stafftech@gmail.com', 'Nguyễn thị ngọc stafftech', '2022-04-14 11:28:54', '2022-04-14 11:28:54', 4, 83),
(20, 'staffgraphic', '$2y$10$n.CovLWrMxkPLhQMdyKTy./FsPJNNL90s.SilfAaU7Gm.s/HLxCKe', 'staffgraphic@gmail.com', 'Nguyen van staffgraphic', '2022-04-14 11:29:25', '2022-04-14 11:29:25', 4, 87),
(22, 'qamanager', '$2y$10$3Hfs3kzNx7KWlFoG8QiPHunXydQx7IlumTYu9RwvYu7uXjBFjiF.e', 'khoattgcs190463@fpt.edu.vn', 'Tran Tan Khoa', '2022-04-16 10:52:39', '2022-04-17 16:57:25', 3, 75),
(23, 'stafftechsupport', '$2y$10$96z6mXBQRpn/6pO2TE0oAOCidoi/55L4hnoLJcj2bP3ctJA8uYy5y', 'stafftechsupport@gmail.com', 'Michale staff', '2022-04-17 00:44:05', '2022-04-17 00:44:05', 4, 83),
(24, 'qacoordinator', '$2y$10$iA/EKjS0Sf4wDm8FED.WwuSlD5qoP2T7CoSlKQQ4YQN7M3W0/fPd2', 'khoazvn1@gmail.com', 'Tran Tan khoaa', '2022-04-17 17:08:26', '2022-04-17 17:08:26', 2, 75),
(25, 'admin3', '$2y$10$P8nZKoOqNYvV4cqexX970eVidw4mZZ4dTfMk08dAi648/vJetBPT6', 'nguyenvansta@gmail.com', 'Ngo kim huy', '2022-04-17 18:16:17', '2022-04-17 18:27:13', 1, 75);

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
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `ideaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `reactionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1058;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `submissionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
