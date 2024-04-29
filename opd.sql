-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: apr. 28, 2024 la 04:58 PM
-- Versiune server: 10.4.32-MariaDB
-- Versiune PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `opd`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `categorieName` varchar(255) NOT NULL,
  `categorieDesc` text NOT NULL,
  `categorieCreateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`categorieId`, `categorieName`, `categorieDesc`, `categorieCreateDate`) VALUES
(22, 'PARFUMURI DE ZI/OFFICE', 'Aceste parfumuri emanÄƒ prospeÈ›ime È™i rafinament discret, adÄƒugÃ¢nd un aer plÄƒcut È™i curat, fÄƒrÄƒ sÄƒ fie copleÈ™itoare sau prea puternice.', '2023-12-18 21:05:43'),
(23, 'PARFUMURI PENTRU SEARÄ‚ / EVENIMENTE SPECIALE', 'Aceste parfumuri sunt ideale pentru a accentua eleganÈ›a È™i a atrage atenÈ›ia Ã®n serile speciale sau la evenimente importante.', '2023-12-18 21:06:11'),
(24, 'PARFUMURI PENTRU SEZONUL RECE/IARNÄ‚', 'Aceste parfumuri sunt ideale pentru sezonul rece, emanÃ¢nd o cÄƒldurÄƒ reconfortantÄƒ È™i o aurÄƒ rafinatÄƒ, potrivitÄƒ pentru a adÄƒuga un plus de confort Ã®n timpul iernii.', '2023-12-18 21:06:43');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `contact`
--

CREATE TABLE `contact` (
  `contactId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `orderId` int(21) NOT NULL DEFAULT 0 COMMENT 'If problem is not related to the order then order id = 0',
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `contact`
--

INSERT INTO `contact` (`contactId`, `userId`, `email`, `phoneNo`, `orderId`, `message`, `time`) VALUES
(1, 2, 'tudor@gmail.com', 789657328, 1, 'Hello!', '2023-12-18 21:44:25');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `contactreply`
--

CREATE TABLE `contactreply` (
  `id` int(21) NOT NULL,
  `contactId` int(21) NOT NULL,
  `userId` int(23) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryBoyName` varchar(35) NOT NULL,
  `deliveryBoyPhoneNo` bigint(25) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `pizzaId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `pizzaId`, `itemQuantity`) VALUES
(1, 1, 74, 2),
(2, 2, 73, 2),
(3, 2, 74, 1),
(4, 3, 70, 1),
(5, 3, 71, 1),
(6, 4, 71, 1),
(7, 5, 73, 1),
(8, 5, 74, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` int(21) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES
(1, 2, 'ASDFG, RTYU', 123456, 789675622, 830, '0', '1', '2023-12-18 21:41:30'),
(2, 2, 'aaaddada, datdtsyfssfsfsf', 123466, 1234567892, 1699, '0', '0', '2023-12-19 12:27:01'),
(3, 20, 'facultate, Oradea', 123456, 789657356, 1035, '0', '0', '2024-01-15 20:44:21'),
(4, 21, 'facultate, Oradea', 123456, 789657356, 553, '0', '0', '2024-01-16 11:16:36'),
(5, 22, 'yrethethheg, shfsbfdubfdufbd', 123456, 715658278, 1057, '0', '1', '2024-01-16 12:14:13');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `pizza`
--

CREATE TABLE `pizza` (
  `pizzaId` int(12) NOT NULL,
  `pizzaName` varchar(255) NOT NULL,
  `pizzaPrice` int(12) NOT NULL,
  `pizzaDesc` text NOT NULL,
  `pizzaCategorieId` int(12) NOT NULL,
  `pizzaPubDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `pizza`
--

INSERT INTO `pizza` (`pizzaId`, `pizzaName`, `pizzaPrice`, `pizzaDesc`, `pizzaCategorieId`, `pizzaPubDate`) VALUES
(69, 'Paco Rabanne 1 Million', 381, 'Un parfum proaspÄƒt cu note de bergamotÄƒ È™i iasomie, ideal pentru zilele de birou, emanÃ¢nd eleganÈ›Äƒ È™i vitalitate.', 22, '2023-12-18 21:07:36'),
(70, 'Calvin Klein Eternity for Men', 482, 'Note subtile de lavandÄƒ È™i lemn de cedru, oferind o senzaÈ›ie rafinatÄƒ È™i reconfortantÄƒ potrivitÄƒ pentru mediul office.', 22, '2023-12-18 21:08:49'),
(71, 'Giorgio Armani Acqua di Gio Pour Homme', 553, 'O combinaÈ›ie echilibratÄƒ de bergamotÄƒ È™i lemn de cedru, conferind prospeÈ›ime È™i eleganÈ›Äƒ pentru utilizarea zilnicÄƒ.', 22, '2023-12-18 21:09:51'),
(72, 'Tom Ford Noir Extreme', 476, 'Arome de lemn de santal È™i condimente, emanÃ¢nd un aer misterios È™i sofisticat, perfect pentru serile speciale.', 23, '2023-12-18 21:10:43'),
(73, 'Chanel Bleu de Chanel', 642, 'O combinaÈ›ie de lemn de cedru È™i note citrice, transmitÃ¢nd un caracter sofisticat È™i elegant pentru serile deosebite.', 23, '2023-12-18 21:15:33'),
(74, 'Hugo Boss Bottled Intense ', 415, 'O combinaÈ›ie Ã®ncÃ¢ntÄƒtoare de ambroxan È™i paciuli, creÃ¢nd un parfum cald È™i revigorant pentru zilele friguroase.', 23, '2023-12-18 21:17:12'),
(75, 'Hugo Boss Bottled Intense', 577, 'Arome de scorÈ›iÈ™oarÄƒ È™i mÄƒr, oferind cÄƒldurÄƒ È™i confort Ã®n sezonul rece.', 24, '2023-12-18 21:18:16'),
(76, 'Versace Eros', 723, 'Note lemnoase È™i de vanilie, aducÃ¢nd Ã®n minte aerul rÄƒcoros al sezonului rece Ã®ntr-un mod seducÄƒtor.', 24, '2023-12-18 21:19:00'),
(77, 'Prada Luna Rossa Black', 669, 'O combinaÈ›ie Ã®ncÃ¢ntÄƒtoare de ambroxan È™i paciuli, creÃ¢nd un parfum cald È™i revigorant pentru zilele friguroase.', 24, '2023-12-18 21:19:58');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact1` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Optional',
  `address` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact1`, `contact2`, `address`, `dateTime`) VALUES
(1, 'Cologne Crafters', 'cologne_crafters@gmail.com', 786789546, 767892245, 'Piata Unirii,Timisoara', '2021-03-23 19:56:25');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT current_timestamp(),
  `isEmailVerified` tinyint(1) DEFAULT 0,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`, `isEmailVerified`, `token`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 1111111111, '1', '$2y$10$AAfxRFOYbl7FdN17rN3fgeiPu/xQrx6MnvRGzqjVHlGqHAM4d9T1i', '2021-04-11 11:40:58', 0, NULL),
(2, 'Tudor', 'Tudor', 'Cernei', 'tudor@gmail.com', 789657328, '0', '$2y$10$EMzaiG9O3f2CpasI39LaPeUxYe8s1Gu2HV2lKcNMOgCio6s7x6NXe', '2023-12-18 21:21:44', 0, NULL),
(3, 'test', 'testName', 'testLast', 'tudorcernei@gmail.com', 725728267, '0', '$2y$10$mptlOqL88bd9MNWbpPeV7eQMifZJkLiAw3zn2gtb3jjIPilrPwU5i', '2024-01-14 20:01:37', 0, 'b92fc0341581d32426f05c7886103470f2db956cd8df38ab2fea5d591ed4017f314b74477df5af574859d69238149e202799'),
(5, 'test2', 'testName2', 'testLast2', 'tudorcernei@gmail.com', 725828269, '0', '$2y$10$Bd6.uCZyDgamxww9A81kIOv5OLTxAk/anT2/FDRCpP8BPRHqDbFWu', '2024-01-14 20:08:33', 0, '0179b7b940d16e63c647eeef89eddfab4984b2a30c316a7b98e2896286a23906f3fd62091c9fb2eb6c3b62832c7fb418c3c4'),
(7, 'test3', 'testName3', 'testLast3', 'tudorcernei@gmail.com', 725858278, '0', '$2y$10$P7TbuCSMxq4qH6uXT7FkNeC74CjRLzC412aAOiv.T.qU6tNoXH4yu', '2024-01-14 20:17:19', 0, 'e5029c777b728413d089fd4ed6f15e864994fab6d751b71d8d70347b943fcea68ea366fb421b5b8fae38e72227630b6c6ea5'),
(8, 'test4', 'testName4', 'testLast4', 'tudorcernei@gmail.com', 725858278, '0', '$2y$10$aHQ0bAjKMMvjbYrYQhPqnuEL8hSfUYD55toCSOq1RLkx/WHv4e9hi', '2024-01-14 20:22:48', 0, '32d41c5afffa6961cc242f2fd8525efa8084a0166036a86df362d407b1b93659bc97c98201def2394739453c097a26e586f4'),
(10, 'test5', 'testName5', 'testLast5', 'tudorcernei@gmail.com', 724858278, '0', '$2y$10$wIVVGwIsuqIUF9YzyMa.w.fZWIHZK70UJpx/yPcCilsitAPIkOn/6', '2024-01-14 21:00:00', 0, '9c3190edbe7d279cd57ed66f02aa34c18087dc917e12bd2fe47014f1f789808ab98913eefe9390c6e501bebd05b007294703'),
(11, 'test6', 'testName6', 'testLast6', 'tudorcernei@gmail.com', 724858278, '0', '$2y$10$gnxN4P0eeMmsTETOAmDGee1KlaIvYdYgRKOw19sdv6Gk7YNUA3JNy', '2024-01-14 21:03:29', 0, '9d9b7ba49ce61b2041eb549bd7601d4f64de6f32c76ee1b64338b2e9bf1716abfc8327612f72e7d0fef6502751290cf7e490'),
(12, 'test7', 'testName7', 'testLast7', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$uvKCgrAvo/7l80U/.MMpJOocgYIDDtZNXZVmviKByMT8lLdpPomUe', '2024-01-14 21:07:13', 0, '23416fd1615a85e2cd5378997552365509369571bc354274e11e4ef4f3728d2cf1d626b311d9676083dc3fa87506f16ff7a9'),
(13, 'test8', 'testName8', 'testLast8', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$Ul3rBEkzkUXsNi/gPmo3V.K9/o10s994X52xbc/R0a73uPT4noH0C', '2024-01-14 21:10:01', 0, '0124641ff90e4f3fb046d1f340f3dad58d2c6ff8fe9c2747038c21ca5deb980ebadbc6aa3c24fb82703ea75a56cb98313466'),
(14, 'test9', 'testName9', 'testLast9', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$a1JseJ/PnjpKWTMAkXZwtOdg2s1.JWhQBhjzLpeBAUKPyshk9lL0a', '2024-01-14 22:09:21', 0, '9ac6e3304acb934ced6333adea8d7489dd86032fbde927098497d3326f1f746f2f510d6632f1d99cd77dd4d33d9da31591f6'),
(15, 'test10', 'testName10', 'testLast10', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$3n5weCpM8fVs6SfmY2X.hubIm2VhscvO9dBhMmKbQAAcTnPOPW5Ze', '2024-01-14 22:10:35', 0, '8892a3a1cef7d0d5ac085324a85c4fda2fc7c6e87835045dd15fde0f0b8162f73a43748904340d38256e9a603fd8f5533d44'),
(17, 'test11', 'testName11', 'testLast11', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$1YFfvMJzfw8fnrWaQZ.OYeF4RTM4Yy/dKTHdrUEFCvJ5M5SZsmQ4u', '2024-01-14 22:14:21', 0, '043b4a4c315ab2289a956acfc8625152c5c33c2eb4e876e1008c1300daed4fe35587d8aab0c0b1b5f5c666408c609d9cb720'),
(18, 'test12', 'testName12', 'testLast12', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$2IktI3LP3DZy8RcGXTPxYOA6A/wJYTptnDHvWz2L9ktb1iXRIDpWS', '2024-01-14 22:16:03', 0, 'bbdc4b9e10416ebbe246ae959c708cfee73051cf77e46ce2e94bfc7dfe75576999f91523049d39f7324ae6c915fafcf1b4b7'),
(20, 'test14', 'testName14', 'testLast14', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$9Kia9JroNlizHU4inzyj6egg0vvxvrpKgRFP5/9P.3HDqyCpnG0ye', '2024-01-14 22:18:13', 0, '48da473a528ec805d75437e4b69130715ded6eb2986388ad94e0752ab2b8a9b2f10dd98a41b6dfd6a80a4204ba4459f01443'),
(21, 'test15', 'Andrei', 'testLast15', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$YIVHFZLrh5HQRxWmj8EJmealifCbU8clFKr7CHWpk7vLHrt8I4BZO', '2024-01-16 11:14:24', 0, '5b573ef66a3a89085d5fd47efee0af5a1855baa5e83a98ba0024a80153e97ce270e055023ed1ef7b48abad98d68cd88f4e48'),
(22, 'test16', 'George', 'testLast16', 'tudorcernei@gmail.com', 715658278, '0', '$2y$10$flOcZzGq0ul.Ml5w1QV/CeeIKGn.VL6vZ4lIb9reOxP1JtBMfunU.', '2024-01-16 12:11:49', 0, 'bd3271e24528e5f55aaa6100f42f0e55d8406b6b58523a6c218ab1a34714c31520e3b62527d8b4e7dd1c611469d58ddac23e');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `pizzaId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categorieName` (`categorieName`,`categorieDesc`);

--
-- Indexuri pentru tabele `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indexuri pentru tabele `contactreply`
--
ALTER TABLE `contactreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indexuri pentru tabele `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexuri pentru tabele `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pizzaId`);
ALTER TABLE `pizza` ADD FULLTEXT KEY `pizzaName` (`pizzaName`,`pizzaDesc`);

--
-- Indexuri pentru tabele `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexuri pentru tabele `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pentru tabele `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `contactreply`
--
ALTER TABLE `contactreply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pentru tabele `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `pizza`
--
ALTER TABLE `pizza`
  MODIFY `pizzaId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pentru tabele `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pentru tabele `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
