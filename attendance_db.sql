-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 09:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_id` int(200) NOT NULL,
  `registration_number` varchar(20) NOT NULL,
  `attendance_time` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_name`, `student_id`, `registration_number`, `attendance_time`) VALUES
(14, 'mkono', 0, 'RU/BCS/2020/021', '2023-07-13'),
(15, 'mkono', 0, 'RU/BCS/2020/021', '2023-07-13'),
(16, 'mkono', 0, 'RU/BCS/2020/021', '2023-07-13'),
(17, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(18, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(19, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(20, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(21, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(22, 'SHABAN KITOKO', 26, 'RU/BCS/2022/0222', '2023-07-13'),
(23, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(24, 'mkono', 25, 'RU/BCS/2020/021', '2023-07-13'),
(25, 'SHABAN KITOKO', 26, 'RU/BCS/2022/0222', '2023-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(200) NOT NULL,
  `class_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(15, 'LINEAR ALGEBRA'),
(16, 'PROJECT MANAGEMENT'),
(17, 'ARTIFICIAL INTELIGENCE'),
(18, 'gym'),
(19, 'DATA  WERE');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(200) NOT NULL,
  `class_name` varchar(200) NOT NULL,
  `class_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_code`) VALUES
(3, 'lax', ''),
(4, 'lax', ''),
(5, 'lax', ''),
(6, 'lax', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE `class_student` (
  `class_student_id` int(200) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_student_id`, `class_id`, `student_id`) VALUES
(2, 0, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0),
(18, 0, 0),
(19, 0, 0),
(20, 0, 0),
(21, 0, 0),
(22, 0, 0),
(23, 0, 0),
(24, 0, 0),
(25, 0, 0),
(26, 0, 0),
(27, 0, 0),
(28, 0, 0),
(29, 0, 0),
(30, 0, 0),
(31, 0, 0),
(32, 0, 0),
(33, 0, 0),
(34, 0, 0),
(35, 0, 0),
(36, 0, 0),
(37, 0, 0),
(38, 0, 0),
(39, 0, 0),
(40, 0, 0),
(41, 0, 0),
(42, 0, 0),
(43, 0, 0),
(44, 0, 0),
(45, 0, 0),
(46, 18, 25),
(47, 18, 26),
(48, 18, 27),
(49, 18, 29),
(50, 18, 32),
(51, 19, 25),
(52, 19, 26),
(53, 19, 28),
(54, 19, 29),
(55, 19, 30),
(56, 19, 32);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(200) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `registration_number` varchar(200) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `fingerprint_template` blob NOT NULL,
  `textarea_data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `registration_number`, `phone_number`, `gender`, `fingerprint_template`, `textarea_data`) VALUES
(25, 'mkono', 'RU/BCS/2020/021', '', '', '', 0x526b3153414341794d414141414144324141414250414669414d5541785145414141416f4a45436a414c714e4145446d414b763241454274414c495a4145422f414a476441494342414873574145442b4151787841494339414649474145454641536e6141454545414637324145432f41566d7841454352415636654145433441444f5041494357414c594d4145446641506e794149435841495951414944494152377a4145426941493267414542654148595a4145444e41554b2f414543334155326a41494259415471664145454f414746324145443541456d42414544614144554341494336414f67484149444941516e384149434a41516b58414943644153415441494258414a7368414543794154384741454436415337524149434141554d66414543434156615a4149426441464d5a4145434a414459524145454a4145723241414141),
(26, 'SHABAN KITOKO', 'RU/BCS/2022/0222', '', '', '', 0x526b3153414341794d414141414144534141414250414669414d5541785145414141416f486b4371415041424145444a4151667441454370415272784145434b4152734e4145426f41516764414544454153725641494269414a41554149426e41486956414543794146734a4149446d41477038414944414150373241454468414c62304145444741493241414543794153614341454472414a742f41454350415373484145425741516b6b4149445441476a38414543454147515341494450414667434145434c414a38484149437541496f4141494477414c7435414942304152515841494362414873494145424c414e455a414543714154752f4145426f415441684149443141537a564145446d4155334541414141),
(27, 'amza', 'RU.BCS.2020.022', '', '', '', 0x526b3153414341794d414141414144594141414250414669414d5541785145414141416f483043544148313641494274414e463841454254414b36434145445541484e324145424c4145393841494375414335354149437641527a7a4145417a414576384149446441446431414541324152494741454558415250794145426c4149523741454364414f482b4145436f4147483441494237414531344149425a4151474541454437414e7830414544564151357941454430414566324145416741466a354145423341546945414543714148463241494370414e754141454261414d7a3441454436414a6e324145416c414c6f454145447441507a7a4149426a41437832414941304150344541454561414a6c314145426f4141747241414141),
(28, 'AMINA MDOE', 'RU/BCS/2020/0209', '', '', '', 0x526b3153414341794d414141414144594141414250414669414d5541785145414141416f48304332414e7566414944504149794641454541414b376a41494332415067524149454b414c7068414944794148683641494447415253774149446d415276424145443541465630414942354145676a414943494143756b41494441414f454a41494445414f763441494374414838494149434e414e7766414544444151716e4145445841476d444149445941524c434145454741517646414942314152496c414942664146557141494362414c77584145446e414a50774149436b414f386741494543414b5a774149444841477639414944704151526241494279414973664149455641516e4b4149446d415464424149435a4143384d41414141),
(29, 'AMINA MDOE', 'RU/BCS/2020/0209', '', '', '', 0x526b3153414341794d414141414144594141414250414669414d5541785145414141416f48304332414e7566414944504149794641454541414b376a41494332415067524149454b414c7068414944794148683641494447415253774149446d415276424145443541465630414942354145676a414943494143756b41494441414f454a41494445414f763441494374414838494149434e414e7766414544444151716e4145445841476d444149445941524c434145454741517646414942314152496c414942664146557141494362414c77584145446e414a50774149436b414f386741494543414b5a774149444841477639414944704151526241494279414973664149455641516e4b4149446d415464424149435a4143384d41414141),
(30, 'AMINA MDOE', 'RU/BCS/2020/0209', '', '', '', 0x526b3153414341794d414141414144594141414250414669414d5541785145414141416f48304332414e7566414944504149794641454541414b376a41494332415067524149454b414c7068414944794148683641494447415253774149446d415276424145443541465630414942354145676a414943494143756b41494441414f454a41494445414f763441494374414838494149434e414e7766414544444151716e4145445841476d444149445941524c434145454741517646414942314152496c414942664146557141494362414c77584145446e414a50774149436b414f386741494543414b5a774149444841477639414944704151526241494279414973664149455641516e4b4149446d415464424149435a4143384d41414141),
(31, 'AMINA MDOE', 'RU/BCS/2020/0209', '', '', '', 0x526b3153414341794d414141414144594141414250414669414d5541785145414141416f48304332414e7566414944504149794641454541414b376a41494332415067524149454b414c7068414944794148683641494447415253774149446d415276424145443541465630414942354145676a414943494143756b41494441414f454a41494445414f763441494374414838494149434e414e7766414544444151716e4145445841476d444149445941524c434145454741517646414942314152496c414942664146557141494362414c77584145446e414a50774149436b414f386741494543414b5a774149444841477639414944704151526241494279414973664149455641516e4b4149446d415464424149435a4143384d41414141),
(32, 'IDDI OTHUMANI', 'RU/BCS/2020/0289', '', '', '', 0x526b3153414341794d414141414144324141414250414669414d5541785145414141416f4a454352414e4a76414542774150423341454376414a4a714145444d414a6a784145444d4150787041494176414b514541454277414746704145424841526e3841494249415347494145426a414564794145437241556c72414543634156726941454353414c467441494268414a5a374149444a415044704145437a41486c6e4145417a414a75494149424c41524b45414542674147527841454278415335364145426e4146626f4145444a41464c714145434e4156427841454346414374714145434841506a7141494446414d42704145412b414e373941454176414e61444145436241475a7341454372415235714145447a414e715941454473414a78794145433141464a6f414542434146547941494176415432644145446241564a6c41414141);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'LAX MRANGE', '12345'),
(2, 'makolo', 'kolo'),
(3, 'ezekia', 'loi'),
(4, 'ezekia', 'asease');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `id` (`attendance_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`class_student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class_student`
--
ALTER TABLE `class_student`
  MODIFY `class_student_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`attendance_id`) REFERENCES `attendance` (`attendance_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
