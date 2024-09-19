-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2024 at 02:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'modo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `token`, `role`) VALUES
(1, 'Administrateur', 'admin@localhost', '70ccd9007338d6d81dd3b6271621b9cf9a97ea00', 'FantZ2s6G4UXRRX9rvOl', 'admin'),
(4, 'Leo', 'toto.rez.21@gmail.com', '123', '4233b41fbc2b2d0331ef303b85538852', 'admin'),
(5, 'To', 'toto.rez.21@gmail.com', '123', 'bc76cb5a12066a06d5187dc8e3520667', 'admin'),
(6, 'Steph', 'toto.rez.21@gmail.com', '123', '36b97d5cbf1c894b72f18ec1fbc30ee4', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `name`) VALUES
(1, 'Venom'),
(2, 'FCK');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `post_id`, `date`) VALUES
(2, 'iuyk', 'kik@gmail.com', 'feffef', 3, '2024-09-16 12:33:08'),
(3, 'ntftn', 'horus.i@hotmail.fr', 'hnftjhft', 3, '2024-09-16 19:43:51'),
(4, 'Leo', 'toto.rez.21@gmail.com', 'JFGekfizeeqz', 20, '2024-09-19 11:54:27'),
(5, 'Leo', 'toto.rez.21@gmail.com', 'JFGekfizeeqz', 20, '2024-09-19 11:54:31'),
(6, 'dqzdqzd', 'toto.rez.21@gmail.com', 'qdqdzqzdzq', 20, '2024-09-19 11:55:10'),
(7, 'dqzdqzd', 'toto.rez.21@gmail.com', 'qdqdzqzdzq', 20, '2024-09-19 11:55:14'),
(8, 'Leo', 'toto.rez.21@gmail.com', 'JE turre', 21, '2024-09-19 14:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `liaisons`
--

CREATE TABLE `liaisons` (
  `id_post` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `writer` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'post.png',
  `date` datetime NOT NULL,
  `posted` tinyint(1) NOT NULL DEFAULT '0',
  `categorie_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `writer`, `image`, `date`, `posted`, `categorie_id`) VALUES
(3, 'Le framework MaterializeCSS', 'Material Design\r\nCréé et conçu par Google, le Material Design est un langage de conception qui combine les principes classiques d\'un design réussi ainsi que l\'innovation et la technologie. Le but de Google et de développer une technique de conception pour une expérience utilisateur unifiée au travers de leurs produits sur n\'importe quelle plateforme.\r\n\r\nMaterial est la métaphore\r\nLa métaphore du Material Design définie la relation entre l\'espace et le mouvement. L\'idée est que la technologie est inspirée du papier et de l\'encre et est utilisée afin de faciliter la création et l\'innovation. Surfaces et bords fournissent des repères visuels familiers qui permettent aux utilisateurs de comprendre rapidement la technologie au-delà du monde physique.\r\n\r\nFranc, animé, voulu\r\nLes éléments et les composants tels que grilles, typographie, couleurs et médias ne sont pas seulement plaisants à voir, il créent aussi un sens de la hiérarchie, du sens et de l\'attention.\r\n\r\nLe mouvement donne du sens\r\nLe mouvement permet à l\'utilisateur de faire la parallèle entre ce qu\'il voit à l\'écran et la vie réelle. En fournissant à la fois un retour et de la familiarité, ceci permet à l\'utilisateur de s’immerger aisément dans une technologie nouvelle. Le mouvement est cohérent et continu en plus de donner à l\'utilisateur des informations supplémentaires sur les élements et trasnformations.', 'Leo', 'img.jpg', '2016-01-08 20:55:14', 1, 1),
(20, 'Article avec image d\'un bureau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet magna eget iaculis sollicitudin. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mi nisi, aliquet non viverra eget, hendrerit eleifend enim. Praesent finibus tortor at scelerisque varius. Etiam malesuada eros lobortis neque ullamcorper, quis aliquet arcu ornare. Nam vulputate quam turpis, eget varius massa lacinia ut. Phasellus laoreet maximus consectetur. Nam pulvinar arcu massa, in aliquam diam tempus at. Ut ac quam cursus elit porttitor aliquam pharetra sed ligula. Nam eleifend eleifend erat, a congue nisi. Duis dapibus facilisis nulla, a gravida velit posuere vel. Suspendisse ac iaculis lacus. Integer ornare velit sapien, ac vulputate arcu ultricies nec. Suspendisse id felis sagittis, eleifend neque tempor, egestas ligula. Cras quis diam consectetur, pharetra justo facilisis, dictum ipsum. Suspendisse nec mauris a nibh iaculis convallis in sit amet justo.\r\n\r\nPhasellus purus nunc, pharetra at neque nec, semper placerat eros. Maecenas vel commodo nunc. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed ultrices mauris vel dapibus dignissim. Duis porttitor a augue at blandit. Nulla facilisi. Quisque iaculis, eros vitae egestas pulvinar, dolor sapien ultricies massa, eget imperdiet erat mi id dui. Pellentesque et pretium purus. Aenean lacinia turpis quis orci fringilla pellentesque. Praesent at dapibus justo, eget interdum nulla.\r\n\r\nPhasellus in sapien laoreet, ullamcorper orci vitae, congue erat. Donec nec pharetra mi, eu accumsan risus. Mauris vestibulum justo ultrices venenatis semper. Donec rhoncus, justo a ullamcorper tempus, leo felis varius ex, quis hendrerit velit purus et dui. Suspendisse sed nibh risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus eros elit, tempus id lacus sit amet, vulputate porta enim. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum commodo felis lacus, vel aliquet ligula ultricies sed.\r\n\r\nEtiam condimentum felis eu nisl vestibulum suscipit. In mollis sodales leo, vitae pretium odio faucibus vel. Nulla porttitor accumsan nunc, vitae ornare tortor dignissim ac. Etiam pretium, ipsum non ultrices pharetra, tellus arcu porta nulla, ut scelerisque nunc tortor vel ligula. Quisque mi diam, fringilla nec sapien gravida, viverra cursus libero. Proin tristique lobortis enim, vel blandit sem. Donec posuere est vitae nibh suscipit, ut porttitor sem malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris at mauris at turpis egestas egestas. Aenean congue ullamcorper dolor sed varius. Integer nec malesuada est. Integer viverra mattis orci, at aliquet enim dictum nec.', 'Leo', 'post.png', '2016-01-08 20:54:46', 1, 0),
(21, 'Gazo au bout du rouleau', 'Le gazo qui va juste éclater son pc de merde car il en peut plus depuis hier matin 8h il code sans cesse', 'Leo', 'post.png', '2024-09-16 13:18:46', 1, 0),
(37, 'Fred', 'fred', 'Leo', 'post.png', '2024-09-19 15:29:25', 1, 1),
(42, 'Bite', 'Au', 'KUL', 'uploads/66ec29308d7f8.jpg', '2024-09-19 15:37:52', 1, 1),
(43, 'juts', 'biotku', 'Leo', 'uploads/66ec29545049a.jpg', '2024-09-19 15:38:28', 1, 0),
(44, 'Jeuskk', 'fesesf', 'Leo', 'uploads/66ec29a28e00e.png', '2024-09-19 15:39:46', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `liaisons`
--
ALTER TABLE `liaisons`
  ADD PRIMARY KEY (`id_post`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `liaisons`
--
ALTER TABLE `liaisons`
  ADD CONSTRAINT `id_post` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `admins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
