-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shop_db
CREATE DATABASE IF NOT EXISTS `shop_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `shop_db`;

-- Dumping structure for table shop_db.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.admins: ~0 rows (approximately)
INSERT INTO `admins` (`id`, `name`, `password`, `contact`) VALUES
	(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '');

-- Dumping structure for table shop_db.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.cart: ~6 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
	(77, 18, 5206, 'Liquid Dishwashing', 290, 1, '132842781_236886414513662_14972331034014.webp'),
	(78, 18, 5205, 'Liquid Hand Soap with Antibac', 132, 1, '132871751_236199177863706_54298847955627.webp'),
	(79, 18, 5211, 'Chlorine Granules', 128, 1, '287704315_404612814926163_4338534693503362088_n.webp'),
	(80, 18, 5217, 'Helios Wax', 870, 1, '275978301_442821954264413_5389748305084901754_n.webp'),
	(81, 18, 5231, 'Furniture Polish', 615, 1, '161717765_274982420874049_5989901269014873023_n.webp'),
	(88, 19, 5194, 'Lobby Dust Pan (Wind Proof 2)', 350, 1, 'CU_ Dustpan Lobby1.webp');

-- Dumping structure for table shop_db.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `message_status` varchar(100) NOT NULL,
  `dates` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1090 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.messages: ~1 rows (approximately)
INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`, `message_status`, `dates`) VALUES
	(1087, 1, 'vincent ', 'vbgayotayan2020@plm.edu.ph', '09272757748', 'helo!', 'HELLLOOOOOO!', '2023-07-02 16:29:36');

-- Dumping structure for table shop_db.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `request` varchar(200) DEFAULT 'None',
  `order_tracking` varchar(20) DEFAULT '-',
  `courier_type` varchar(20) DEFAULT '-',
  `ref_num` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.orders: ~23 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `request`, `order_tracking`, `courier_type`, `ref_num`) VALUES
	(51, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, asdasd, asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Pending', NULL, ' ', ' ', 0),
	(52, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', '', 'Completed', 'Own', 0),
	(53, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, asdasd, asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', NULL, 'Completed', 'Third-party', 0),
	(54, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', 'with 10k', 'Packed', 'Own', 0),
	(57, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', '', 'Completed', 'Third-party', 0),
	(58, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-25 00:00:00', 'Completed', 'canton with hotdog', 'Packed', 'Own', 0),
	(59, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-25 00:00:00', 'Completed', '', 'To Receive', 'Own', 0),
	(60, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-26 00:00:00', 'Pending', '', ' ', ' ', 0),
	(62, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Lysol Liquid Disinfectant (2500 x 1) - Lysol Disinfectant Multi-Action Cleaner (272 x 1) - Oxivir Five 16 Concentrate (16348 x 1) - Lysol Disinfectant Spray (486 x 1) - Mat with Tray and Drying Mat (1500 x 1) - ', 21106, '2023-05-08 13:44:38', 'Completed', 'none', 'Completed', 'Third-party', 0),
	(63, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'sampleuli (222 x 1) - ', 222, '2023-05-13 09:57:51', 'Pending', 'secret', ' ', ' ', 0),
	(64, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Plastic Broom (Nylon Bristle; Steel Handle) (90 x 5) - sampleuli (222 x 1) - ', 672, '2023-05-13 10:33:58', 'Completed', 'may poging kasama', 'Completed', 'Own', 0),
	(65, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Lobby Dust Pan (Wind Proof 2) (350 x 12) - sampleuli (222 x 1) - ', 4422, '2023-05-13 21:21:56', 'Completed', '', 'Own', 'Own', 0),
	(66, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'sampleuli (222 x 1) - ', 222, '2023-05-13 23:19:15', 'Completed', '', 'Packed', 'Own', 0),
	(67, 17, 'Rei Sebastian', '0995766025', 'princessrei@gmail.com', 'cash on delivery', 'Batangas St. Blumentritt, , Manila, Philippines', 'sampleuli (222 x 1) - ', 222, '2023-05-14 01:31:34', 'Pending', '', '-', 'Own', 0),
	(69, 19, 'Vencio', '0920255487', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 1) ', 100, '2023-05-23 08:34:57', 'Pending', '', '-', 'Own', 0),
	(70, 1, 'vincent', '0', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Ceiling Broom (100 x 1) ', 100, '2023-05-23 10:20:07', 'Completed', '', ' ', ' ', 0),
	(71, 21, 'VincentG', '0920255476', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Rubber Gloves (Nova 45) (95 x 1) Lobby Dust Pan (Wind Proof 2) (350 x 1) Push Brush (Steel) (250 x 1) Fabric Softener (342 x 1) Stick Broom (50 x 1) Hand Brush (Light Duty) (35 x 1) ', 1122, '2023-05-23 11:01:45', 'Pending', '', '-', 'Own', 0),
	(72, 21, 'VincentG', '0920255476', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 12) ', 1200, '2023-05-23 11:19:52', 'Pending', '', '-', 'Own', 0),
	(75, 1, 'vincent', '0', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 1) Plastic Broom (Nylon Bristle; Steel Handle) (90 x 1) Stick Broom (50 x 1) Soft Broom/Walis Tambo (Baguio) (110 x 1) ', 350, '2023-06-28 00:34:15', 'Pending', '', '-', 'Own', 0),
	(76, 1, 'vincent', '0', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Ceiling Broom (100 x 1) Plastic Broom (Nylon Bristle; Steel Handle) (90 x 1) ', 190, '2023-07-02 15:54:45', 'Pending', '', '-', 'Own', 0),
	(77, 1, 'vincent', '0', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Ceiling Broom (100 x 1) ', 100, '2023-07-02 15:55:37', 'Pending', '', '-', 'Own', 0),
	(78, 1, 'vincent', '0', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 1) ', 100, '2023-07-02 16:04:22', 'Completed', '', 'Completed', 'Third-party', 0),
	(79, 1, 'vincent', '0', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Stick Broom (50 x 1) ', 50, '2023-07-02 16:25:26', 'Pending', '', '-', 'Own', 0);

-- Dumping structure for table shop_db.productline
CREATE TABLE IF NOT EXISTS `productline` (
  `Productline_ID` int(11) NOT NULL,
  `ProductlineName` varchar(255) NOT NULL DEFAULT '',
  `ProductlineDescription` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.productline: ~21 rows (approximately)
INSERT INTO `productline` (`Productline_ID`, `ProductlineName`, `ProductlineDescription`) VALUES
	(4381, 'Brooms & Dust Pan', ' Brooms feature bristles that clear away dust, dirt, and debris from indoor and outdoor floors. Dust pans pick up dirt and debris for disposal without getting hands dirty.'),
	(4382, 'Brush', ' A brush is a common tool with bristles, wire or other filaments.'),
	(4383, 'Cleaning Chemicals', 'Cleaning agents or hard-surface cleaners are substances (usually liquids, powders, sprays, or granules) used to remove dirt, including dust, stains, foul odors, and clutter on surfaces.'),
	(4384, 'Dispenser', 'A dispenser is a machine or container designed so that you can get an item or quantity of something from it in an easy and convenient way.'),
	(4385, 'Equipments', ' '),
	(4386, 'Floor Polisher Accessories', 'A floor polisher is a great tool for helping to clean hard floors in the home. Quickly buff floors to bring back to life with the microfibre pads. '),
	(4387, 'Floor & Window Squeegee', 'A squeegee is a tool with a blade that removes or controls liquids across surfaces.'),
	(4388, 'Gloves', 'A glove is a garment covering the hand, with separate sheaths or openings for each finger and the thumb.'),
	(4389, 'Housekeeping Products', ' These machines are used to restore the surface appearance of carpets, upholstery and curtains. '),
	(4390, 'Mats & Rugs', 'Rug is a thick and heavy floor covering that does not extend over the entire floor. Conversely, mat is a piece of coarse material placed on a floor for people to wipe their feet on.'),
	(4391, 'Mop Head & Handle', 'Mop handles with frames have attachments that connect the pole to the mop head that is used for cleaning.'),
	(4392, 'Pails & Dipper', 'These are tools that are used to clean the bathroom floor. Pails are used to hold and carry water. '),
	(4393, 'Tissue Products', 'Tissue products are soft, thin, pliable, and absorbent paper made from wood or recycled paper.'),
	(4394, 'Trash Bags', 'A trash bag, also called garbage bag, bin bag, or bin liner, is a disposable bag used for collection and disposal of waste materials (solid or wet).'),
	(4395, 'Trash Bins', 'A waste container, also known as a dustbin, garbage can, and trash can is a type of container that is usually made out of metal or plastic.'),
	(4396, 'Other Custodials', ' '),
	(4397, 'Disinfectant Chemicals', 'Chemical disinfectants are applied to non-living objects and materials, such as surfaces and instruments to control and prevent infection.'),
	(4398, 'Footmat', 'Foot is a mat placed before or inside a door for wiping dirt from the shoes'),
	(4399, 'Machines & Equipment', ' '),
	(4400, 'PPE', 'Personal Protective Equipment (PPE) is specialized clothing or equipment worn by an employee for protection against infectious materials.'),
	(48390, 'Branded Products', 'bcrjvcrlmc');

-- Dumping structure for table shop_db.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Productline_ID` int(11) NOT NULL,
  `ProductlineName` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `product_stock` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5451 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.products: ~255 rows (approximately)
INSERT INTO `products` (`id`, `Productline_ID`, `ProductlineName`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `product_stock`) VALUES
	(5187, 4381, 'Brooms & Dust Pan', 'Soft Broom/Walis Tambo (Baguio)', ' SAMPLE', 110, 'broom.jpg', 'Baguio_Soft_Broom_Regular.jpg', '956687635958ce00677822284a9a59b3.jpg', 297),
	(5188, 4381, 'Brooms & Dust Pan', 'Plastic Broom (Nylon Bristle; Steel Handle)', ' ', 90, 'CU_ Broom Nylon.webp', 'nylon.jpg', 'B.jpg', 295),
	(5189, 4381, 'Brooms & Dust Pan', 'Ceiling Broom', ' ', 100, 'CU_ Broom Ceiling.webp', '3463.jpg', 'C.jpg', 282),
	(5190, 4381, 'Brooms & Dust Pan', 'Stick Broom', ' ', 50, 'CU_ Broom Stick.webp', '3464.jpg', 'D.jpg', 296),
	(5191, 4381, 'Brooms & Dust Pan', 'Dust Pan (Plastic)', ' ', 55, 'CU_ Dustpan Plastic.webp', '3465.jpg', 'E.jpg', 300),
	(5192, 4381, 'Brooms & Dust Pan', 'Dust Pan (Stainless)', ' ', 100, 'CU_ Dustpan stainless.webp', '3466.jpg', 'F.jpg', 299),
	(5193, 4381, 'Brooms & Dust Pan', 'Lobby Dust Pan (Wind Proof 1)', ' ', 300, 'CU_ Dustpan Lobby.webp', '3467.jpg', 'G.jpg', 299),
	(5194, 4381, 'Brooms & Dust Pan', 'Lobby Dust Pan (Wind Proof 2)', ' ', 350, 'CU_ Dustpan Lobby1.webp', '3468.jpg', 'H..jpg', 298),
	(5195, 4382, 'Brush', 'Hand Brush (Light Duty)', ' ', 35, '249025916_237555871770289_2986901901892900509_n.webp', '3469.jpg', 'I.jpg', 299),
	(5196, 4382, 'Brush', 'Hand Brush (Wood)', ' ', 35, '248410522_1079931102546708_8250657466331102931_n.webp', '3470.jpg', 'J.jpg', 300),
	(5197, 4382, 'Brush', 'Hand Brush (Heavy Duty)', ' ', 45, '249873971_402388641482889_4782739926547625488_n.webp', 's-l1600.jpg', 'K.jpg', 300),
	(5198, 4382, 'Brush', 'Steel Brush', ' ', 85, '255390694_1024699304765156_4859902121899734573_n.webp', 'C2076920-01.webp', 'L.jpg', 300),
	(5199, 4382, 'Brush', 'Push Brush (Steel)', ' ', 250, '255161910_608920756901454_8556169964486788099_n.webp', 'bd6e7f10890985f62bd71ea7e7aa53f4.jpg_720x720q80.jpg_.webp', 'M.jpg', 299),
	(5200, 4382, 'Brush', 'Push Brush (Aluminum)', ' ', 295, '255161910_608920756901454_8556169964486788099_n.webp', '1f2338bde8964095de1e06c5165142de.jpg', 'N.jpg', 300),
	(5201, 4382, 'Brush', 'Floor & Wall Brush (Steel)', ' ', 290, 'Floor _ Wall Steel.webp', 'UNIVERSAL+-+Brush+with+Steel+Handle+-+Close+Up-9small.jpg', 'O.jpg', 300),
	(5202, 4382, 'Brush', 'Floor & Wall Brush (Aluminum)', ' ', 412, 'Floor _ Wall Aluminum.webp', 'UNIVERSAL+-FLoor+and+Wall+Deck+Brush+with+Aluminum+Handle+-+Close+Up-2small.jpg', 'P.webp', 300),
	(5203, 4382, 'Brush', 'Push Brush (Wood)', ' ', 295, '205712338_523611715450185_5380211845663349111_n.webp', '24028c088d6ad7ec6aa57ae4783f8152.jpg', 'Q.jpg', 300),
	(5204, 4383, 'Cleaning Chemicals', 'Liquid Hand Soap with Antibac', 'Scent: Orange & Green Tea Packing: 3.78 liters/gallon', 528, '131934675_1315557855462663_2029304515074.webp', 'Hand-Soap-Gallon-LYSODEX-2.png', 'R.webp', 300),
	(5205, 4383, 'Cleaning Chemicals', 'Liquid Hand Soap with Antibac', 'Scent: Orange & Green Tea Packing: 1 liter/ pump bottle', 132, '132871751_236199177863706_54298847955627.webp', '1-l-liquid-soap-oil-500x500.webp', 'R.webp', 299),
	(5206, 4383, 'Cleaning Chemicals', 'Liquid Dishwashing', 'Scent: Orange & Green Tea Packing: 3.78 liters/gallon', 290, '132842781_236886414513662_14972331034014.webp', 'dishwashing_liquid_1_liter__1__1643258615_1cf7fb37_progressive.jpg', 'R.jpg', 300),
	(5207, 4383, 'Cleaning Chemicals', 'Liquid Dishwashing', 'Scent: Orange & Green Tea Packing: 1 liter/ pump bottle', 150, '132702859_465453921521157_29853787239442.webp', 'cb81a03ae32516244c274e5b85efdcae.jpg', 'R.jpg', 300),
	(5208, 4383, 'Cleaning Chemicals', 'Powder Soap', 'Packing: 1kg/pack', 200, '131894894_177045160820158_16663711683467.webp', '6fc0ad89928e7aa2937a40e63ff27274.jpg', 'S.webp', 300),
	(5209, 4383, 'Cleaning Chemicals', 'Fabric Softener', 'Scent: Downy Packing: 3.78liters/gallon', 342, 'Fabric Softener2.webp', '0659fecfe9e2334e0544bbbb88bf6266.jpg', 'T.webp', 299),
	(5210, 4383, 'Cleaning Chemicals', 'Liquid Bleach', 'Scent: Downy Packing: 3.78liters/gallon', 135, '170118468_2848233535494543_6536059141715582692_n.webp', 'Ecobudget-Premium-Liquid-Bleach.jpg', 'S.jpg', 300),
	(5211, 4383, 'Cleaning Chemicals', 'Chlorine Granules', 'Packing: 1kg/pack', 128, '287704315_404612814926163_4338534693503362088_n.webp', 'de3acf2e91be23d9fcebf4884566f7db.jpg_720x720q80.jpg_.webp', 'T.jpg', 300),
	(5212, 4383, 'Cleaning Chemicals', 'All Purpose Cleaner', 'Packing: 3.78liters/gallon', 250, '276096805_1006082133640432_7626118361281630174_n.webp', '51pcTz41hQL._AC_UF1000,1000_QL80_.jpg', 'U.jpg', 300),
	(5213, 4383, 'Cleaning Chemicals', 'Toilet Bowl Cleaner', 'Packing: 3.78liters/gallon', 283, '276060628_721410452548763_1462893865873180535_n.webp', 'Natural-Toilet-Bowl-Cleaner.jpg', 'V.jpg', 300),
	(5214, 4383, 'Cleaning Chemicals', 'Disinfectant Cleaner', 'Packing: 3.78liters/gallon', 390, '276150414_3348702042025229_2283179727823722453_n.webp', '1-gallon-disinfectant-solution-non-toxic.jpg', 'W.jpg', 300),
	(5215, 4383, 'Cleaning Chemicals', 'Glass Cleaner', 'Packing: 3.78liters/gallon', 400, '150605078_5360852860622923_8826041304419846929_n.webp', 'Ecobudget-Window-Glass-Cleaner.jpg', 'X.jpg', 300),
	(5216, 4383, 'Cleaning Chemicals', 'Brillios Wax', 'Packing: 3.78liters/gallon', 1400, '275931053_508407990906449_5094203536331440700_n.webp', 'sg-11134201-22110-ezmh95pviikvcf.jpg', 'Y.jpg', 300),
	(5217, 4383, 'Cleaning Chemicals', 'Helios Wax', 'Packing: 3.78liters/gallon', 870, '275978301_442821954264413_5389748305084901754_n.webp', 'WX-FG_Forbes_Wax_Gallon_HWC_600x600_264a531c-4e7a-41be-9e80-80488936eca8_600x600.webp', 'Z.jpg', 300),
	(5218, 4383, 'Cleaning Chemicals', 'Emulsion Wax', 'Packing: 3.78liters/gallon', 450, '151473692_471587203839544_6977709026186598472_n.webp', 'f554d15bf19fdef428214156093fe736.jpg', 'A1.jpg', 300),
	(5219, 4383, 'Cleaning Chemicals', 'Marble Polishing Powder', 'Packing: 1kg/bottle', 160, '131973327_180767073747976_2732074390090218320_n.webp', 'noble-marble-polish-1000x1000.webp', 'A2.jpg', 300),
	(5220, 4383, 'Cleaning Chemicals', 'Isoprophyl Alcohol Solution 70%', 'Packing: 3.78liters/gallon', 438, '131978547_1676069079239391_6839226648544.webp', 'Isopropyl-Alcohol-70-Solution-Guardian-Gallon.png', 'A3.jpg', 300),
	(5221, 4383, 'Cleaning Chemicals', 'Isoprophyl Alcohol Solution 70%', 'Packing: 1 liter/pump bottle', 150, '131908485_187675656349110_49465717036344.webp', '7ab610ac53eaaf003dd041d57f4d62b9_1024x.webp', 'A4.jpg', 300),
	(5222, 4383, 'Cleaning Chemicals', 'Isoprophyl Alcohol Solution 70%', 'Packing: 500ml/pump bottle', 80, '151312093_150088540276323_1882724636779075832_n.webp', 'ii_10967_0634fcc8020281491de33f9471eaad23.webp', 'A5.jpg', 300),
	(5223, 4383, 'Cleaning Chemicals', 'Ethyl Alcohol Solution 70%', 'Packing: 3.78liters/gallon', 390, '169976454_468028647733969_8298935568385061107_n.webp', '5b4907fd840b3116651f9e6239794552.jpg', 'A6.jpg', 300),
	(5224, 4383, 'Cleaning Chemicals', 'Air Freshener', 'Scent: Green Tea, Island Kiss, Victoria, Lavender Packing: 3.78 liters/gallon', 495, '132494150_783986912329792_69598731671231.webp', 'Ecobudget-Air-Freshener-Eco-Green.jpg', 'A7.jpg', 300),
	(5225, 4383, 'Cleaning Chemicals', 'Air Freshener', 'Scent: Crytalline , Light Blue Packing: 3.78 liters/gallon', 495, '132494150_783986912329792_69598731671231 (1).webp', 'AirFreshener1Gallon.webp', 'A8.jpg', 300),
	(5226, 4383, 'Cleaning Chemicals', 'Air Freshener', 'Scent: Ocean Wave Packing: 3.78 liters/gallon', 495, '132626203_146337270350142_24299271464561.webp', '3bddd06859c1de854337a3baba82f6ed.jpg', 'A9.jpg', 300),
	(5227, 4383, 'Cleaning Chemicals', 'Disinfectant Solution', 'Packing: 3.78liters/gallon', 295, '271476791_414957093746319_4667601432535149140_n.webp', 'Web-HaloMist-01.png', 'A10.jpg', 300),
	(5228, 4383, 'Cleaning Chemicals', 'Muriatic Acid (Concentrate)', 'Packing: 3.78liters/gallon', 450, '173599967_1174890926298250_7478044423727572424_n.webp', '1919112083.png', 'A11.jpg', 300),
	(5229, 4383, 'Cleaning Chemicals', 'Muriatic Acid (Ready to Use)', 'Packing: 3.78liters/gallon', 500, '275449574_295339569347619_5079426110774541758_n.webp', 'f691605f17c75ac914541eefb11f9180.jpg_720x720q80.jpg_.webp', 'A12.jpg', 300),
	(5230, 4383, 'Cleaning Chemicals', 'Degreaser', 'Packing: 3.78liters/gallon', 269, '275949477_1164370034307870_6117976511437876325_n.webp', '09cf79cfc24b5f2720e9d353f2f14443.jpg_720x720q80.jpg_.webp', 'A13.jpg', 300),
	(5231, 4383, 'Cleaning Chemicals', 'Furniture Polish', 'Packing: 3.78liters/gallon', 615, '161717765_274982420874049_5989901269014873023_n.webp', '340022dc28fa110ebfc61b1c88983cd2.jpg', 'A14.jpg', 300),
	(5232, 4383, 'Cleaning Chemicals', 'Wax Stripper (Ready to Use)', 'Packing: 3.78liters/gallon', 487, '192629469_211893380594714_4164719648765969794_n.webp', 'wax-strip-reg-gal-1.png', 'A15.jpg', 300),
	(5233, 4383, 'Cleaning Chemicals', 'Deodorant Cake', 'Packing: 12pcs/pack', 840, '170138268_453350979330535_6339562262856364409_n.webp', 'c4566cdc6fc015f8320b6e2ba95fa6e4.jpg', 'A16.jpg', 300),
	(5234, 4384, 'Dispenser', 'Bottle Pump', ' ', 59, '138795607_1037410826752245_899341190035570413_n.webp', '8bfc4625b51a4256407b0e845ada9a33.jpg', 'A17.jpg', 300),
	(5235, 4384, 'Dispenser', 'Bottle Pump', ' ', 42, '137611557_1083547985483339_5460106031261524169_n.webp', 's-l400.png', 'A17.jpg', 300),
	(5236, 4384, 'Dispenser', 'Automatic Dispenser', ' ', 410, 'D_ Automatic Dispenser.webp', 'Euromax-Auto-Soap-Dipsenser-4.jpg', 'A18.jpg', 300),
	(5237, 4384, 'Dispenser', 'Automatic Dispenser with Portable Floor Stand', 'Feature: Foam Soap Dispenser, Double Soap Dispenser, Liquid Dispenser Capacity: 1000ml Installation: Wall mounted Installation Product Size: 158*116*286mm Material: ABS Plastic Voltage: 4*1.5v ( C size battery) / pluggable DC power supply', 1725, 'D_ Dispenser w stand.webp', 'download.jpg', 'A19.jpg', 300),
	(5238, 4385, 'Equipments', 'Victor Floor Polisher 16"', 'Model: Low speed HP Motor: 1.5HP Watts: 1125 RPM Brush: 190 RPM Warranty: 6 months/motor parts only', 460, 'b34117_f95b169314394259860c18f0ab54fa6a~mv2.webp', 'VICTOR.jpg', 'A20.jpg', 300),
	(5239, 4385, 'Equipments', 'Victor Floor Polisher 20"', 'Model: Low speed HP Motor: 1.5HP Watts: 1125 RPM Brush: 190 RPM Warranty: 6 months/motor parts only', 650, 'Victor-Floor-Polisher_1.webp', 'b98f397ec97993f19ba1c99c361b3ea4.jpg_720x720q80.jpg_.webp', 'A21.jpg', 300),
	(5240, 4385, 'Equipments', 'Wilson Floor Polisher 8"(203)', 'Net Weight: 15kgs Handle Size: 1m Adjustable Stainless Tube HP Motor: 1.5 HP Royal Cord: 9m Watts: 149 RPM Brush: 205RPM Warranty 1 year motor parts only', 1200, '14216.jpg', '14216.jpg', 'A22.jpg', 300),
	(5241, 4385, 'Equipments', 'Wilson Floor Polisher 10"(254)', 'Net Weight: 18kgs Handle Size: 1m Adjustable Stainless Tube HP Motor: 1.4 HP Royal Cord: 11.5m Watts: 186 RPM Brush: 190RPM Warranty 1 year motor parts only', 1390, 'd396a47df6e4bc5c412b6719420122bd.jpg_720x720q80.jpg_.webp', '14247.jpg', 'A22.jpg', 300),
	(5242, 4385, 'Equipments', 'Wilson Floor Polisher 13"(330)', 'Net Weight: 21kgs Handle Size: 1m Adjustable Stainless Tube HP Motor: 1.3 HP Royal Cord: 13.5m Watts: 248 RPM Brush: 190RPM Warranty 1 year motor parts only', 1770, 'd396a47df6e4bc5c412b6719420122bd.jpg_720x720q80.jpg_ (1).webp', '14252.jpg', 'A22.jpg', 300),
	(5243, 4385, 'Equipments', 'Wilson Floor Polisher 16"(406)', 'Net Weight: 30kgs Handle Size: 1m Adjustable Stainless Tube HP Motor: 3.5 HP Royal Cord: 13.5m Watts: 559 RPM Brush: 175RPM Warranty 1 year motor parts only', 2400, '14260_1_1.jpg', '14260_1_1.jpg', 'A22.jpg', 300),
	(5244, 4385, 'Equipments', 'Black Panther Floor Polisher 17"', 'Voltage: 220V 50/60hz Rated Power: 1.5HP Brush Pad Size: 430mm RPM Brush: 175RPM RPM Motor: 1400RPM Weight: 36kg Length: 12.5m Warranty 6month/motor parts only', 38850, 'b34117_cc5292f7ad524bb78f176b1e60b7a836~mv2.png', 'b34117_cc5292f7ad524bb78f176b1e60b7a836~mv2.png', 'A23.jpg', 300),
	(5245, 4385, 'Equipments', 'Black Panther Floor Polisher 20"', 'Voltage: 220V 50/60hz Rated Power: 2.0HP RPM Brush: 175RPM RPM Motor: 1500RPM Cable Length: 12.5m Warranty 6month/motor parts only', 43950, 'b34117_cc5292f7ad524bb78f176b1e60b7a836~mv2 (1).png', 'nrs450_500x500.webp', 'A24.jpg', 300),
	(5246, 4385, 'Equipments', 'Vacuum Cleaner Wet & Dry (Black Panther) 30L', '30L Stainless or Polythylene Tank Complete with standard accessories Comes also with polyester/washable filter 1000W, 220V, 60 cycle Warranty: 6 months against factory defect', 45990, 'Black Panther 30L_PNG.webp', 'Black Panther 30L_PNG.webp', 'A25.jpg', 300),
	(5247, 4385, 'Equipments', 'Vacuum Cleaner Wet & Dry (Black Panther) 15L', '15L Stainless or Polythylene Tank Complete with standard accessories Comes also with polyester/washable filter 1000W, 220V, 60 cycle Warranty: 6 months against factory defect', 39900, '11.webp', 'BDWD15_1.webp', 'A26.jpg', 300),
	(5248, 4385, 'Equipments', 'Black Panther 3-in-1 Cleaning Machine 40L', '40L Stainless Tank/Approx. 9L Chemical Tank 1050W, 220V, 60 cycle Filter: Washable Cloth Comes with Standard Wet & amp: Dry Accessories, Carpet Wand with Spraying Nozzle Built in with Hose Drain Valve Optional Tool: Upholstery with Spraying Nozzle', 26890, '7f818046-adc2-4837-9645-e2b81ddd7f1f.c946cbee93b31f376b28b8ad41847f63.webp', '61W1q4GFWQL.jpg', 'A27.jpg', 300),
	(5249, 4385, 'Equipments', 'Black Panther 3-in-1 Cleaning Machine 65L', '65L Stainless Tank/Approx. 20L Chemical Tank 2 Vacuum Motor with Separate Power Switch 1050W x 2, 220V, 60 cycle Filter: Washable Cloth Comes with Standard Wet & amp: Dry Accessories, Carpet Wand with Spraying Nozzle Built in with Hose Drain Valve Optiona', 33840, 'carpet extractor.webp', 'carpet extractor.webp', 'A28.jpg', 300),
	(5250, 4385, 'Equipments', 'Carpet Air Blower (Black Panther)', '220V/50hz Power: 900W Rotation Speed: High/Medium/Low Air Flow Rate: 160/130/110m3/min Power Line Length: 7m  6 months warranty Color: Blue', 17500, 'Carpet Blower.webp', 'download (1).jpg', 'A29.jpg', 300),
	(5251, 4386, 'Floor Polisher Accessories', 'Polishing Pad', 'Color: White', 794, 'white pad.webp', 'download (2).jpg', 'A30.jpg', 300),
	(5252, 4386, 'Floor Polisher Accessories', 'Scrubbing Pad', 'Color: Green', 757, 'pad_edited.webp', 'imec-pad-new-productt.jpg', 'A31.jpg', 300),
	(5253, 4386, 'Floor Polisher Accessories', 'Buffing Pad', 'Color: Red', 716, 'pad_edited (1).webp', 'download (3).jpg', 'A32.jpg', 300),
	(5254, 4386, 'Floor Polisher Accessories', 'Stripping Pad', 'Color: Black', 794, 'pad_edited (2).webp', 'Stripping Pad', 'A33.jpg', 300),
	(5255, 4386, 'Floor Polisher Accessories', '3m Polishing Pad', 'Color: White 16" and 20"', 707, '186506396_2926637237618206_1199540849187467561_n.webp', '3mtm-perfect-ittm-foam-polishing-pad-05707.jpg', 'A34.jpg', 300),
	(5256, 4386, 'Floor Polisher Accessories', '3m Buffing Pad', 'Color: Red 16" and 20"', 716, '187536011_236495904902049_6946137099360453836_n.webp', '3m-red-buffer-pad-5100.webp', 'A35.jpg', 300),
	(5257, 4386, 'Floor Polisher Accessories', '3m Scrubbing Pad', 'Color: Blue 16" and 20"', 757, '186496949_952688678824210_3540992556032875927_n.webp', 'green-economy-floor-pad.jpg', 'A36.jpg', 300),
	(5258, 4386, 'Floor Polisher Accessories', '3m Stripping Pad', 'Color: Black 16" and 20"', 794, '186551545_859549411296496_1139662786585699377_n.webp', 'download (4).jpg', 'A37.jpg', 300),
	(5259, 4386, 'Floor Polisher Accessories', '3m Diamond Pad', 'Color: Purple 16" and 20"', 750, 'purple pad.webp', 'scotch-britetm-sienna-diamond-floor-pad-side-b.jpg', 'A38.jpg', 300),
	(5260, 4386, 'Floor Polisher Accessories', '3m Diamond Pad', 'Color: Sienna 16" and 20"', 750, 'sienna pad.webp', 'c89fb13c057b82f8e036bf92ba0a1641.jpg', 'A39.jpg', 300),
	(5261, 4386, 'Floor Polisher Accessories', 'Cabo Negro Brush Original (Wilson)', 'Size: 8" (code 203)', 1200, '189220715_1868774226631687_1102015988390485332_n.webp', 'b34117_19145581247b4f039bec55caab824e94~mv2.jpg', 'A40.jpg', 300),
	(5262, 4386, 'Floor Polisher Accessories', 'Cabo Negro Brush Original (Wilson)', 'Size: 10" (code 254)', 1390, '242041861_654010368897581_5643081402920462278_n.webp', 'a9436b68f88adcdaf14fdd1387226f4e.jpg', 'A41.jpg', 300),
	(5263, 4386, 'Floor Polisher Accessories', 'Cabo Negro Brush Original (Wilson)', 'Size: 13" (code 330)', 1770, '188643183_1673425516180635_7317835716572959590_n.webp', '5ebd60160c4672c9bf6997c8915d8555.jpg', 'A42.jpg', 300),
	(5264, 4386, 'Floor Polisher Accessories', 'Cabo Negro Brush Original (Wilson)', 'Size: 16" (code 406)', 2440, '218393438_512650306676288_2205643586280076123_n.webp', 'brand_new_polisher_accessories__cabonegro_brush_nylon_brush_polisher_pads_bonnet_pad_bracket_1578022', 'A43.jpg', 300),
	(5265, 4386, 'Floor Polisher Accessories', 'Cabo Negro Brush Replacement (Victor)', 'Size: 16"', 1500, '188757597_922146985293143_2769675529963744251_n.webp', '52c31c20adf8995e2cf8e2d90c1fc601.jpg', 'A44.jpg', 300),
	(5266, 4386, 'Floor Polisher Accessories', 'Nylon Brush (Wilson)', 'Size: 8" (code 203)', 1200, '187609663_2816541388676083_2908754551532020397_n.webp', '14e8fec2d7d490c5ef6cd2b07963f480.jpg', 'A45.jpg', 300),
	(5267, 4386, 'Floor Polisher Accessories', 'Nylon Brush (Wilson)', 'Size: 10" (code 254)', 1390, '187557141_313137013703907_280633103930811098_n.webp', 'f43b6b24dd4ee23b3a0ccdb1332baf61.jpg', 'A46.jpg', 300),
	(5268, 4386, 'Floor Polisher Accessories', 'Nylon Brush (Wilson)', 'Size: 13" (code 330)', 1770, '189495035_955101488653785_8449153287990525999_n.webp', 'cf0ab409e48f0fedb3793004dfb724f7.jpg', 'A47.jpg', 300),
	(5269, 4386, 'Floor Polisher Accessories', 'Nylon Brush (Wilson)', 'Size: 16" (code 406)', 2335, '188225914_1117229055431529_6148898485705437812_n.webp', '6498e382c54f22aa628227b42369d3ae.jpg_2200x2200q80.jpg_.webp', 'A48.jpg', 300),
	(5270, 4386, 'Floor Polisher Accessories', 'Nylon Brush (Victor)', 'Size: 13" & 16"', 2150, '242683960_435142991513559_7748863570164744832_n.webp', 'fdc335290dcbf3578264493237098a8f.jpg', 'A49.jpg', 300),
	(5271, 4386, 'Floor Polisher Accessories', 'Pad Holder (Wilson)', 'Size: 8" (code 203)', 800, '245929903_403079194530255_231251671151313646_n.webp', '92398_2020.jpg', 'A50.jpg', 300),
	(5272, 4386, 'Floor Polisher Accessories', 'Pad Holder (Wilson)', 'Size: 10" (code 254)', 1390, '245661131_1029769161147781_7494889664156644219_n.webp', '549e212ab49c06bdca54d104ccdb70b3.jpg', 'A51.jpg', 300),
	(5273, 4386, 'Floor Polisher Accessories', 'Pad Holder (Wilson)', 'Size: 13" (code 330)', 1770, '246242272_1041630109923698_484979269339495723_n.webp', '44312960a56c3ee63cc7f18d8190a2eb.jpg', 'A52.jpg', 300),
	(5274, 4386, 'Floor Polisher Accessories', 'Pad Holder (Wilson)', 'Size: 16" (code 406)', 2400, '245880740_1520285035001037_7851551081969500744_n.webp', '91d6c2df768b07581d3081ca6e88cd00.jpg', 'A53.jpg', 300),
	(5275, 4386, 'Floor Polisher Accessories', 'Pad Holder (Victor)', 'Size: 13" & 16"', 820, '245880740_1520285035001037_7851551081969500744_n.webp', '18ae30c7735632863c6c916cd22b0c9b.jpg_720x720q80.jpg_.webp', 'A54.jpg', 300),
	(5276, 4386, 'Floor Polisher Accessories', 'Wilson Bracket Original', 'Fit to Size: 8" (code 203)', 550, '189185972_504204097485783_8456859025919812307_n.webp', '464d42f9e4440b0e1adae3de35ccb321.jpg', 'A55.jpg', 300),
	(5277, 4386, 'Floor Polisher Accessories', 'Wilson Bracket Original', 'Fit to size: 10", 13" & 16"', 1500, '189004885_319403622931304_2652971205150456012_n.webp', '983fe4ef2e607d3e825bf218a12f867e.png', 'A56.jpg', 300),
	(5278, 4386, 'Floor Polisher Accessories', 'Wilson Bracket Replacement', 'Fit to size: 10", 13" & 16"', 650, '189291586_1345219309182620_5748008824455214019_n.webp', '189004885_319403622931304_2652971205150456012_n.webp', 'A57.jpg', 300),
	(5279, 4386, 'Floor Polisher Accessories', 'Victor Bracket Original', 'Fit to size: 13" & 16"', 1200, '158924637_284137336438471_8600380047861364501_n.webp', '9af625748ecd626947117599a96f8725.png', '158924637_284137336438471_8600380047861364501_n.webp', 300),
	(5280, 4386, 'Floor Polisher Accessories', 'Floormate Bracket Replacement', 'Fit to size: 12"', 1100, '160190034_214633873777749_5533008846999008147_n.webp', 'S7bdc538e274e43a8a0740ec4984b5f13s.jpg_720x720q80.jpg_.webp', 'A58.jpg', 300),
	(5281, 4386, 'Floor Polisher Accessories', 'Black Panther Bracket', 'Fit to size: 17"', 952, '141333826_4933720280035713_7813519589801292119_n.webp', 'https://static.wixstatic.com/media/b34117_d349d2e6f0544ab49cc0618348a02e1c~mv2.jpg/v1/fill/w_223,h_2', '141333826_4933720280035713_7813519589801292119_n.webp', 300),
	(5282, 4387, 'Floor & Window Squeegee', 'Window Squeegee 10" (Stainless)', ' ', 401, 'Window Squeegee 10.webp', 's-l400.jpg', 'A59.jpg', 300),
	(5283, 4387, 'Floor & Window Squeegee', 'Window Squeegee 14" (Stainless)', ' ', 436, 'Window Squeegee 14.webp', 'download (5).jpg', 'A60.jpg', 300),
	(5284, 4387, 'Floor & Window Squeegee', 'Window Squeegee 18" (Stainless)', ' ', 531, 'Window Squeegee 18.webp', 's-l400 (1).jpg', 'A61.jpg', 300),
	(5285, 4387, 'Floor & Window Squeegee', 'Window Squeegee 10" (Plastic)', ' ', 158, 'Window Squeegee plastic.webp', '6913130__55868__73113.png', 'A62.jpg', 300),
	(5286, 4387, 'Floor & Window Squeegee', 'Window Squeegee with Foam 10" (Blade & Steel Handle)', ' ', 230, 'Window Squeegee w foam 10.webp', 'window-squeegee.jpg', 'A63.jpg', 300),
	(5287, 4387, 'Floor & Window Squeegee', 'Window Squeegee with Foam 15" (Blade & Steel Handle)', ' ', 510, 'Window Squeegee w foam 14.webp', 'window-squeegee (1).jpg', 'A64.jpg', 300),
	(5288, 4387, 'Floor & Window Squeegee', 'Ettore Window Squeegee (Stainless)', ' ', 1336, 'Ettore Squeegee.webp', '0062006_1.jpg', 'A65.jpg', 300),
	(5289, 4387, 'Floor & Window Squeegee', 'Ettore Window Squeegee (Plastic)', ' ', 1200, 'Ettore Scrubber.webp', 'download (6).jpg', 'A66.jpg', 300),
	(5290, 4387, 'Floor & Window Squeegee', 'Ettore Backflip Scrubber & Squeegee (Plastic)', ' ', 1300, 'Ettore Backflip.webp', '31pP-y21hiL._AC_UL750_SR750,750_.jpg', 'A67.jpg', 300),
	(5291, 4387, 'Floor & Window Squeegee', 'Floor Squeegee', '22" Foam Blade; 5ft Plastic Handle', 569, 'ipad shots 2 083_edited.webp', 'EVA-Foam-Floor-Squeegee-1.jpg', 'A68.jpg', 300),
	(5292, 4387, 'Floor & Window Squeegee', 'Floor Squeegee', '30" Rubber Blade; 4ft Metal Handle', 699, 'P_20170809_174544_edited.webp', 's-l1600 (1).jpg', 'A68.png', 300),
	(5293, 4387, 'Floor & Window Squeegee', 'Floor Squeegee', '30" Foam Blade; 4ft Metal Handle', 699, 'P_20170809_174842_edited.webp', 'libman-floor-squeegees-191-64_600.webp', 'A69.jpg', 300),
	(5294, 4388, 'Gloves', 'Rubber Gloves (Household)', ' ', 75, '141660329_810992453106217_4723897723493033614_n.webp', '423e95aa7102f6855fdcc57f53a82a8b.jpg', 'A70.jpg', 300),
	(5295, 4388, 'Gloves', 'Rubber Gloves (Premium)', ' ', 126, '141472967_418411969214694_3489340623265624118_n.webp', '51Wz2SwxB1S._AC_UL1200_.jpg', 'A71.jpg', 300),
	(5296, 4388, 'Gloves', 'Cotton Gloves with Rubberized Orange Palm', ' ', 71, '189185978_3536678523104844_4816651267897566745_n.webp', '17be33e208cf8967528fdf93c6b07e34.jpg_720x720q80.jpg_.webp', 'A72.jpg', 300),
	(5297, 4388, 'Gloves', 'Rubber Gloves (Nova 38)', ' ', 85, '131904638_419869132474607_8146940532910150243_n.webp', '1d05fe366712bbeabbbca56eaf4d2ab7.png_720x720q80.png_.webp', 'A73.jpg', 300),
	(5298, 4388, 'Gloves', 'Rubber Gloves (Nova 45)', ' ', 95, '140874311_365365294887544_7194903204065844849_n.webp', 'Nova-45-2-copy-700x700.jpg', 'A74.jpg', 299),
	(5299, 4388, 'Gloves', 'Rubber Gloves (Nova Super 75)', ' ', 79, '151705462_758457284785452_7404459996599913096_n.webp', 'Nova-super-75-copy.jpg', 'A75.jpg', 300),
	(5300, 4388, 'Gloves', 'Disposable Gloves (Vinyl)', ' ', 55, '141786380_2378894718932898_9043211484201691179_n.webp', 'Disposable-Vinyl-Gloves-Medium-100pcs-50016671.webp', 'A76.jpg', 300),
	(5301, 4388, 'Gloves', 'Disposable Gloves (Nitrile)', ' ', 60, '260922709_921360825424596_6230006724423884793_n.webp', '61jppFwvrwS._SL1500_.jpg', 'A77.jpg', 300),
	(5302, 4388, 'Gloves', 'Disposable Gloves (Latex)', ' ', 65, '260922709_921360825424596_6230006724423884793_n (1).webp', 'bc6119ead4888269437f00fdd2624005.jpg', 'A78.jpg', 300),
	(5303, 4389, 'Housekeeping Products', 'Mop Squeezer Side Press', '32 Liters & 36 Liters', 3600, 'mop squuezer.webp', 'rubbermaid_mop_squeezer_side_p_1651772782_26709846_progressive.jpg', 'A79.jpg', 300),
	(5304, 4389, 'Housekeeping Products', 'Caution Size (Folded)', ' ', 350, 'caution sign.webp', 'folding-caution-sign-stands-6-pack-caution-watch-your-step-24-inch-height-11-inch-wide-6-pcs-safety-', 'A80.jpg', 300),
	(5305, 4389, 'Housekeeping Products', 'Caution Size (Cone Type)', ' ', 1800, 'Caution sign2.webp', 'e4ba946c8aca6b37f96d62f742fe0bb2.jpg', 'A81.jpg', 300),
	(5306, 4389, 'Housekeeping Products', 'Janitorial Cart', ' ', 6900, 'Janitorial Cart.webp', '17_FE8800_1200x1200 (1).webp', 'A82.jpg', 300),
	(5307, 4389, 'Housekeeping Products', 'Cleaning Caddy', ' ', 550, 'caddy.webp', '1571312538_2_3403.jpg', 'A83.jpg', 300),
	(5308, 4389, 'Housekeeping Products', 'Utility Cart', ' ', 4000, 'housekeeping cart.webp', 'Ha5fdc7d0dbf74dec97589252a3e2a203t.jpg', 'A84.jpg', 300),
	(5309, 4390, 'Mats & Rugs', 'Pranela with Edging', 'Size: 17" x 10.8"', 22, 'Pranela pc.webp', '63944736e933d671f1a51b6a9f96d246.jpg', 'A85.jpg', 300),
	(5310, 4390, 'Mats & Rugs', 'Pranela Yard', 'Size: 36" X 36"', 50, 'Pranela yard.webp', 'b34117_d9286842135140199095fdfb1f37e162~mv2.png', 'A86.jpg', 300),
	(5311, 4390, 'Mats & Rugs', 'Microfiber Cloth', '30 cm x 30 cm 40 cm x 40 cm', 100, 'Microfiber.webp', '194972084_max.jpg', 'A87.jpg', 300),
	(5312, 4390, 'Mats & Rugs', 'Round Rugs White', '36 pcs / bundle', 82, 'Round Rugs White.webp', '863f14806b4952df6a262723c535668d.jpg', 'A88.jpg', 300),
	(5313, 4390, 'Mats & Rugs', 'Round Rugs Colored', '36 pcs / bundle', 82, 'Round Rugs Colored2.webp', 'a410c122487c742f7dcb90867439c2c8.jpg_720x720q80.jpg_.webp', 'A89.jpg', 300),
	(5314, 4390, 'Mats & Rugs', 'Chamois Cloth', ' ', 195, '191339316_207593537851920_7710294856391570852_n.webp', '2e712c791627a40d65f7accca76be0ab.jpg', 'A90.jpg', 300),
	(5315, 4390, 'Mats & Rugs', 'Doormat (Sala-sala)', ' ', 45, 'Doormat.webp', 'a521466839f666bdd8489fa695690870.jpg', 'A91.jpg', 300),
	(5316, 4391, 'Mop Head & Handle', 'Mop Handle Wood 5ft (Steel Frame)', ' ', 305, '134746.jpg', 'UNS609.jpg', 'download (7).jpg', 300),
	(5317, 4391, 'Mop Head & Handle', 'Mop Handle Wood 5ft (Plastic Frame)', ' ', 235, 'Mop Handle Wood; Plastic Frame.webp', 'https://static.wixstatic.com/media/b34117_7224cee50d0f4400a9559c354866d731~mv2.png/v1/fill/w_249,h_2', 'wooden-mop-stick-500x500.webp', 300),
	(5318, 4391, 'Mop Head & Handle', 'Mop Handle Steel 5ft (Plastic Frame)', ' ', 246, 'mop handle steel.webp', 'https://static.wixstatic.com/media/b34117_7224cee50d0f4400a9559c354866d731~mv2.png/v1/fill/w_249,h_2', '81276-all-plastic-5-ft-alim-handle.jpg', 300),
	(5319, 4391, 'Mop Head & Handle', 'Mop Handle Aluminum Corrugated Light Duty 5ft (Plastic Frame)', ' ', 328, 'Mop Handle Corrugated Light Duty.webp', 'https://static.wixstatic.com/media/b76c96_41363eb24549411f9a12d3408a1b0fc5~mv2.jpg/v1/fill/w_686,h_4', '41p9vn4KHNL._SL250_.jpg', 300),
	(5320, 4391, 'Mop Head & Handle', 'Mop Handle Alumnum Corrugated 5ft (Plastic Frame)', ' ', 312, 'Mop Handle Corrugated.webp', '51vNEP158eL._SX342_.jpg', '41p9vn4KHNL._SL250_.jpg', 300),
	(5321, 4391, 'Mop Head & Handle', 'Mop Handle Aluminum HD (Plastic Frame)', ' ', 328, 'Mop Handle Aluminum.webp', 'https://static.wixstatic.com/media/b76c96_41363eb24549411f9a12d3408a1b0fc5~mv2.jpg/v1/fill/w_686,h_4', 'Mop Handle Aluminum.webp', 300),
	(5322, 4391, 'Mop Head & Handle', 'Mop Handle Fiber Glass 4ft (Plastic Frame)', ' ', 312, 'Mop Handle Fiberglass.webp', 'https://images.thdstatic.com/productImages/2b0ddc3d-79b7-4ac6-ba37-8fa6ddd67e86/svn/rubbermaid-comme', '1030264420-2000.webp', 300),
	(5323, 4391, 'Mop Head & Handle', 'Mop Head 350g', ' ', 94, '242076379_3095065200722113_7025227337978.webp', 'CMPW-square.png', 'download (8).jpg', 300),
	(5324, 4391, 'Mop Head & Handle', 'Mop Head 400g', ' ', 120, '241964482_2624544614514063_1096091002255.webp', 'https://www.corecatering.co.za/wp-content/uploads/2020/04/400g_colour_coded_fan_mop_head_38mm_webbin', 'b34117_10020cbaf26e426f92ee306f476c5514~mv2.png', 300),
	(5325, 4391, 'Mop Head & Handle', 'Mop Head 500g', ' ', 140, '242080593_380265540352903_45913849799744.webp', '264250781a555bcf66bd2345bf472c2b.jpg', '200601+UNIVERSAL+-+Standard+Mop+Head+Refill-1.jpg', 300),
	(5326, 4391, 'Mop Head & Handle', 'Mop Head Looped-End 14oz. (Anti-Microbial)', ' ', 383, 'CU_ Mop Head looped end.webp', '122712B_xl__15080.jpg', 'eab529fa70c3c39419714e4f8273a73e.jpg_200x200q80.jpg_.webp', 300),
	(5327, 4391, 'Mop Head & Handle', 'Mop Head Looped-End 16oz.', ' ', 542, 'CU_ Mop Head looped end1.webp', '2082776.webp', 'rubbermaid-commercial-products-mop-heads-rcpd252whi-64_1000.webp', 300),
	(5328, 4391, 'Mop Head & Handle', 'Mop Head Infinity 12oz.', ' ', 265, 'CU_ Mop Head 12oz.webp', 'abda041deb19117937e47eccf8a9015d.jpg_720x720q80.jpg_.webp', 'rubbermaid-commercial-products-mop-heads-rcpf11612-64_1000.webp', 300),
	(5329, 4391, 'Mop Head & Handle', 'Dust Mop Set (Luxury)', '36" & 24"', 683, 'ipad shots 2 203.webp', 'f3aaf8461e0015f01dcf125794a285c9.jpg', 'dust_mop_2-600x600.jpg', 300),
	(5330, 4391, 'Mop Head & Handle', 'Dust Mop Set (Deluxe)', '36" & 24"', 576, 'ipad3 152.webp', 'https://static.wixstatic.com/media/b34117_255b7728584043c88812b51bf5e36424~mv2_d_2592_1936_s_2.jpg/v', 'download (9).jpg', 300),
	(5331, 4391, 'Mop Head & Handle', 'Dust Mop Refill (Luxury)', '36" & 24"', 980, '122127577_817775248973359_54162026495019.webp', '889cab31c0acc2a099062261bfb9314b.jpg', '3d204c523dafce2a75d0372f885d6312.jpg', 299),
	(5332, 4391, 'Mop Head & Handle', 'Dust Mop Refill (Deluxe)', '36" & 24"', 850, '122252000_1078789315870798_8946182463091.webp', 'e713ad42cc5642a3671de1ffbac8d7b4.jpg', 'S-7119BLU.webp', 300),
	(5333, 4392, 'Pails & Dipper', 'Orocan Plastic Pail 10L', 'Diameter: 27cm , Height: 26cm', 124, 'Orocan 10L.webp', '5715d5c78c30a5b31aa6363496ad77f1.jpg', '854ed3b1744d707890f8b1a014a9a33c.jpg', 300),
	(5334, 4392, 'Pails & Dipper', 'Orocan Plastic Pail 12L', 'Diameter: 29cm , Height: 27cm', 174, 'Orocan 12L.webp', 'OrocanUtilityPail12L_1200x1200.webp', 'ARD0023_1.webp', 300),
	(5335, 4392, 'Pails & Dipper', 'Orocan Plastic Pail 16L', 'Diameter: 30cm , Height: 30cm', 212, 'Orocan 16L.webp', '13a5d88e85fc36cfa9cf4c99a58b9b72.jpg_720x720q80.jpg_.webp', '4ebc6c348abf293d0a9022d31b0d06ce.jpg', 300),
	(5336, 4392, 'Pails & Dipper', 'Orocan Plastic Pail 24L', 'Diameter: 35cm , Height: 35cm', 250, 'Orocan 24L.webp', 'OrocanUtilityPailRed24L_1200x1200.webp', '356ba793017570bc90bfa1ab09a54808.jpg', 300),
	(5337, 4392, 'Pails & Dipper', 'Dipper/Tabo (Orocan)', ' ', 39, '257909369_993337687911306_4443782514259717963_n.webp', 'b8f63cd9a82463fd849ff19454b05a65.jpg', 'a72d5fc3d3c628a4c397fd573616251f (2).jpg', 300),
	(5338, 4392, 'Pails & Dipper', 'Dipper/Tabo', ' ', 20, 'Dipper generic.webp', 'a72d5fc3d3c628a4c397fd573616251f (1).jpg', 'Dv6XrSeWkAA1dPl.jpg', 300),
	(5339, 4393, 'Tissue Products', 'Tissue Roll 2PLY', '48 rolls/bag', 412, '260407888_3086143088299684_7371844865328539585_n.webp', '6437bc1a652126d4afb88c1759469593.jpg', '894710acfa8a1bc3fecca7d98307c72e.png', 300),
	(5340, 4393, 'Tissue Products', 'Jumbo Roll Tissue 2PLY', '850 sheets x 12 rolls/ case', 620, 'JRT1.webp', 'fd127a350d0d5cae4b82343d9221ce0f.jpg', 'Jumbo-Roll-Tissue-Paper-840x840.jpg', 300),
	(5341, 4393, 'Tissue Products', 'Interleave Bathroom Tissue', '400 sheets x 48 packs/ case', 46, 'interleave.webp', '701e70059b099706a2bfc5e825c7a0c2.jpg', 'bulk-pack-tp.webp', 300),
	(5342, 4393, 'Tissue Products', 'Pre-Cut Tissue', '1000 sheets x 5 packs / bag', 50, 'precut.webp', 'tissue-paper.webp', 'tissue-paper.webp', 300),
	(5343, 4393, 'Tissue Products', 'Quarterfold Tissue', '350 sheets x 8 packs / bag', 80, 'quarterfold.webp', 'Ecobudget-Quarterfold-Table-Napkin-Virgin-Fiber-1-PLY-350S-8P-scaled.jpg', 'quarterfold.webp', 300),
	(5344, 4393, 'Tissue Products', 'Interfolded Paper Towel LIVI', '175 sheets x 30 packs/ case', 55, '159337880_194341622487180_5865993254758415433_n.webp', '5554c854ce8c4a34657a17e0048524d7.jpg', '011c36957234bc3f1448aeb8876dd140.jpg', 300),
	(5345, 4393, 'Tissue Products', 'Hand Roll Paper Towel', '180 meters x 6 rolls/ case', 40, '134101848_193415649173203_5797676417023180046_n.webp', '5533e5f57568824a4a6afa569791c7a9.jpg', '86222_S03.jpg', 300),
	(5346, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: Small (9x9x18x0.0012)', 115, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande.webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5347, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: Medium (11x11x24x0.0012)', 188, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande (1).webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5348, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: Large (13x13x32x0.0012)', 280, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande (2).webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5349, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: X-Large (15x15x37x0.0012)', 410, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande (3).webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5350, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: XXL (18.5x18.5x40x0.0012)', 480, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande (4).webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5351, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Black Size: XXXL (20x20x50x0.0012)', 500, 'P_20170418_153257_edited.webp', '619-EjGzj7L._AC_SX522_2f7c8c88-fdb0-4112-9878-0655739beec0_grande (5).webp', 'caa3cf957cf84df819a7cac6ed75be31.jpg', 300),
	(5352, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: Small (9x9x18x0.0012)', 115, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1.jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5353, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: Medium (11x11x24x0.0012)', 188, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1 (1).jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5354, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: Large (13x13x32x0.0012)', 280, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1 (2).jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5355, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: X-Large (15x15x37x0.0012)', 410, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1 (3).jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5356, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: XXL (18.5x18.5x40x0.0012)', 480, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1 (4).jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5357, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Clear Size: XXXL (20x20x50x0.0012)', 500, 'Clear Trash bag.webp', 'Ecobudget-Trash-Bag-Clear-Medium-1 (5).jpg', 'ea95d0444417567106fd030a4d180a47.jpg', 300),
	(5358, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: Small (9x9x18x0.0012)', 115, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52.jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5359, 4381, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: Medium (11x11x24x0.0012)', 188, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52 (1).jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5360, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: Large (13x13x32x0.0012)', 280, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52 (2).jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5361, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: X-Large (15x15x37x0.0012)', 410, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52 (3).jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5362, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: XXL (18.5x18.5x40x0.0012)', 480, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52 (4).jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5363, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Green Size: XXXL (20x20x50x0.0012)', 500, 'trashbag green.webp', '363e074cf4b10325fc64f91b19b73d52 (5).jpg', '31fd5efecaff23c7fa5452a5d29ff3cc.jpg', 300),
	(5364, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: Small (9x9x18x0.0012)', 115, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270.jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5365, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: Medium (11x11x24x0.0012)', 188, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270 (1).jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5366, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: Large (13x13x32x0.0012)', 280, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270 (2).jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5367, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: X-Large (15x15x37x0.0012)', 410, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270 (3).jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5368, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: XXL (18.5x18.5x40x0.0012)', 480, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270 (4).jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5369, 4394, 'Trash Bags', 'Trash Bags 100pcs/pack', 'Color: Yellow Size: XXXL (20x20x50x0.0012)', 500, 'trashbag yellow.webp', '3519476061c2856b506748f11a38b270 (5).jpg', 'Yellow-Trash-Bags-840x840.jpg', 300),
	(5370, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 5 liters L: 21cm x W: 21cm x H: 30cm', 125, '104110416_1566661273508010_5984668752931.webp', '40eca5ff2aff60fd6e51d7ace2ca1943.jpg', '4800429880100.jpg', 300),
	(5371, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 8 liters L: 21cm x W: 21cm x H: 30cm', 150, 'TB_ Orocan 8L.webp', '9eb35e63a3e74c7b74c01b27667a6cf1.jpg_720x720q80.jpg_.webp', 'b741c7ad1e72f52d8c7ee4d97258d3bb.jpg', 300),
	(5372, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 11 liters L: 26cm x W: 26cm x H: 43cm', 175, 'TB_ Orocan 11L.webp', '2eb41fc04d5bce50f9e79d53ac05cf65.jpg', 'b34117_feedac46781141b19c3c09b0f01cc598~mv2.png', 300),
	(5373, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 15 liters L: 28cm x W: 28cm x H: 30cm', 200, 'TB_ Orocan 15L.webp', 'b96e6880afdd500527fd150b35c2898d.jpg', '2167668e9f8dc5bf4cbbbf6be4b4255d.jpg', 300),
	(5374, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 25 liters L: 35cm x W: 28cm x H: 58cm', 225, 'TB_ Orocan 25L.webp', '4d77e15846774a38304080234941ff45.jpg', '85e2fee400a19d2b7f6bb641af7939eb.jpg', 300),
	(5375, 4395, 'Trash Bins', 'Trash Bin (Orocan) Swing Type', 'Capacity: 50 liters L: 43cm x W: 28cm x H: 66cm', 250, 'TB_ Orocan 50L.webp', 'b34117_4402dfad196f41a2a31e6e39c6156576~mv2.png', '19557d79145ab7f418b85dada7769196.png', 300),
	(5376, 4395, 'Trash Bins', 'Rolling Bin (Orocan)', 'Capacity: 80 liters L:56.64cm x W:43.18cm x H:78.74cm', 670, 'TB_ Orocan 80L.webp', '3e94ef4ed15759b4eccce6a4bc3a8e86.jpg', '5d16c74b644680b49b8afe8759061dcc.jpg', 300),
	(5377, 4395, 'Trash Bins', 'Trash Bin Swing Type', 'Capacity: 18 liters L: 11.75" x W: 8.5" x H: 18"', 320, '18 liters.webp', '708ddb4dc583b68b0e94fabd48b5c085.png', 'cdbf76dad87df44b53cf3dc36910e670.jpg_720x720q80.jpg_.webp', 300),
	(5378, 4395, 'Trash Bins', 'Trash Bin Swing Type', 'Capacity: 30 liters L: 13.75" x W: 11" x H: 25"', 550, '30 liters.webp', '708ddb4dc583b68b0e94fabd48b5c085 (1).png', 'c49e011cf3505df8ab33caeed2feaceb.jpg', 300),
	(5379, 4395, 'Trash Bins', 'Trash Bin', 'Capacity: 7 liters L: 29cm x W: 22cm x H: 26cm', 125, 'TB_ 7L.webp', '3028g2-700x700.png', '688661f4a9146817276d67db51678537.jpg', 300),
	(5380, 4395, 'Trash Bins', 'Wire Mesh Trash Can', 'Capacity: liters L: 30cm x W: 22cm x H: 30cm', 212, 'TB_ Wiremesh.webp', '959500007808-1.jpg', '5e61dd30ecebae98e1c85f0938af5d45.png', 300),
	(5381, 4395, 'Trash Bins', 'Trash Bin Pedal Type', 'Capacity: 68 liters L: 48cm x W: 43cm x H: 63.5cm', 889, 'garbagebin.webp', 'Untitled-1.jpg-parameters_1200x1200.webp', 'PGM-BIN-45Y_1024x1024.webp', 300),
	(5382, 4395, 'Trash Bins', 'Neutralist Step Bin', 'Capacity: 16 liters L: 39.4cm x W: 24.1cm x H: 43.9cm', 800, 'neutralist stone gray 16l.webp', '047434_10b70962293746b3bffed2df7f3274d7~mv2.jpg', 'MG-711_20-_20NEUTRALIST_20SLIM_20STEP_20BIN_2016L_20-_2010427938-1_350x500.webp', 300),
	(5383, 4395, 'Trash Bins', 'Neutralist Step Bin', 'Capacity: 22 liters L: 44.8cm x W: 32.6cm x H: 55.5cm', 929, 'neutralist beige 22l.webp', '047434_10b70962293746b3bffed2df7f3274d7~mv2 (1).jpg', 'Sa954582b1e0b45af8a0717a19c4f572fn.jpg', 300),
	(5384, 4395, 'Trash Bins', 'Neutralist Step Bin', 'Capacity: 34 liters L: 43.4cm x W: 25.7cm x H: 55.5cm', 1151, 'neutralist stone gray 34l.webp', '047434_10b70962293746b3bffed2df7f3274d7~mv2 (2).jpg', 'MG-712_20-_20NEUTRALIST_20SLIM_20STEP_20BIN_2034L_20-_2010427940-1_fab69ad2-3cc5-4883-a829-d803c7471', 300),
	(5385, 4395, 'Trash Bins', 'Trash Can Pedal Type (Stainless Steel)', '7L Diameter: 21cm Height: 32cm', 800, 'pedaltype.webp', 'b8407ba8b78a4af5e847f4fa1988eb9b.jpg', '94538105_grande.webp', 300),
	(5386, 4395, 'Trash Bins', 'Trash Can Pedal Type (Stainless Steel)', '12L Diameter: 25cm Height: 39cm', 1300, 'pedaltype.webp', 'b8407ba8b78a4af5e847f4fa1988eb9b (1).jpg', 'a00a3c17278cf1481f9f7ed546ae9063.jpg_720x720q80.jpg_.webp', 300),
	(5387, 4395, 'Trash Bins', 'Trash Can Pedal Type (Stainless Steel)', '30L Diameter: 30cm Height: 60cm', 2300, 'pedaltype.webp', 'b8407ba8b78a4af5e847f4fa1988eb9b (2).jpg', '30L-no-logo.jpg', 300),
	(5388, 4395, 'Trash Bins', 'Trash Can with Ash Tray (Stainless Steel)', '18L Diamteter: 25cm Height: 61cm', 1950, 'ash2.webp', '1c6d17c40a364137f79486bba76f6353.jpg', '9172affe3f76ccb6565ae01a53e76d65.jpg', 300),
	(5389, 4395, 'Trash Bins', 'Medical Waste Bin', 'Capacity: 30 liters L: 42.8cm x W: 40.2cm x H: 43.6cm', 1188, 'Medical Waste Bin 30L.webp', '17ee956df9e06056a9b509c1847a2eed.jpg', '357149f95de04a5420682911de60f7e5.jpg', 300),
	(5390, 4395, 'Trash Bins', 'Medical Waste Bin', 'Capacity: 50 liters L: 43cm x W: 40.2cm x H: 60cm', 1532, 'Medical Waste Bin 50L.webp', '17ee956df9e06056a9b509c1847a2eed (1).jpg', '45L-Medical-Waste-Pedal-Trash-Can-Plastic-Medical-Container-Yellow-Thick-Waste-Bin.jpg', 300),
	(5391, 4395, 'Trash Bins', 'Medical Waste Bin', 'Capacity: 80 liters L: 49.3cm x W: 43cm x H: 71cm', 1942, 'Medical Waste Bin 80L.webp', '17ee956df9e06056a9b509c1847a2eed (2).jpg', 'edff95ad2717ecde3ffcab5de61d6459.jpg_720x720q80.jpg_.webp', 300),
	(5392, 4395, 'Trash Bins', 'Segragation Bin (Pedal Type)', '25 liters - L: 37cm x W: 29.5cm x H: 46.5cm', 419, 'pedal type.webp', 'H86ecaeb8cdd5488eae1b9608fdc12290s.jpg_300x300.webp', 'S2fe5e5302c6143ea898bd7d6cbf7736aJ.jpg', 300),
	(5393, 4395, 'Trash Bins', 'Segragation Bin (Pedal Type)', '60 liters - L: 48.5cm x W: 41cm x H: 65.5cm', 919, 'pedal type.webp', 'H86ecaeb8cdd5488eae1b9608fdc12290s.jpg_300x300 (1).webp', 'S2fe5e5302c6143ea898bd7d6cbf7736aJ.jpg', 300),
	(5394, 4395, 'Trash Bins', 'Rollin Bin (Pedal Type)', 'Capacity: 240 liters L: 58cm x W: 76cm x H: 104cm', 10500, 'STEKI rolling pedal.webp', 'rolling_trash_bin_with_pedal_1664935812_9725fb71.jpg', 'HDPE-240-Litre-Plastic-Waste-Bin-Rolling-Garbage-Collector-Big-Size-Foot-Pedal-Dustbin-Outdoor-Indus', 300),
	(5395, 4395, 'Trash Bins', 'Rollin Bin (China)', '120 liters - L: 47cm x W: 55.5cm x H: 93cm', 5500, 'STEKI rolling.webp', 'H16fa961feea64b9ab28b89a156565cc7f.webp', '6.webp', 300),
	(5396, 4395, 'Trash Bins', 'Rollin Bin (China)', '240 liters - L: 57.5cm x W: 72cm x H: 104cm', 10500, 'STEKI rolling.webp', 'H16fa961feea64b9ab28b89a156565cc7f (1).webp', 'BLUE-Lid.jpg', 300),
	(5397, 4395, 'Trash Bins', 'Rollin Bin (China)', '360 liters - L: 58.7 x W: 86.8cm x H: 106.3cm', 11500, 'STEKI rolling.webp', 'H16fa961feea64b9ab28b89a156565cc7f (2).webp', 'plastic-dustbin-with-wheels-and-lid-35414278055.webp', 300),
	(5398, 4395, 'Trash Bins', 'Rollin Bin (Germany)', '120 liters - L: 55cm x W: 48cm x H: 94cm', 13500, 'Rolling Bin (Germany).webp', 'STEKI rolling pedal.webp', 'FL-143-240-Y7.jpg', 300),
	(5399, 4395, 'Trash Bins', 'Rollin Bin (Germany)', '240 liters - L: 73cm x W: 58cm x H: 108cm', 15500, 'Rolling Bin (Germany).webp', 'STEKI rolling pedal (1).webp', 'GREENan-with-Lid.jpg', 300),
	(5400, 4395, 'Trash Bins', 'Rolling Bin/Industrial Garbage Bin', '660 liters - L: 136cm x W: 77cm x H: 105cm', 18500, 'bin 1100l.webp', 'H6707382d22ea4d9bb9f5f2d1b49829fdv.jpg', 'da1e8520eb68ed7af22be1e8d65c2ad6.jpg', 300),
	(5401, 4395, 'Trash Bins', 'Rolling Bin/Industrial Garbage Bin', '1100 liters - L: 147cm x W: 107cm x H: 139cm', 33500, 'bin 1100l.webp', 'H6707382d22ea4d9bb9f5f2d1b49829fdv (1).jpg', 'HTB1ICKAaPihSKJjy0Fiq6AuiFXau.jpg', 300),
	(5402, 4396, 'Other Custodials', 'Spray Bottle', 'Capacity: 500 ml', 74, 'SG 500ml.webp', 'ce87246f8e35638c2acd8c8c39e4fbbe.jpg', 'ada9b593b652d27d1c5bef33a20cac6f.jpg', 300),
	(5403, 4396, 'Other Custodials', 'Spray Bottle', 'Capacity: 1L', 100, 'SG 1l.webp', 'f6ab650065f495dc29e490ea3946ecb8.jpg', 'spray_bottle.jpg', 300),
	(5404, 4396, 'Other Custodials', 'Belt Bag 3 Pockets', ' ', 155, 'Belt Bag.webp', 'bfeb2baa34fd158eec3125b8219dd950.jpg', 'S8964988a4f10475d944f8cbd83df4d76a.jpg_720x720q80.jpg_.webp', 300),
	(5405, 4396, 'Other Custodials', 'Toilet Bowl Pump (Wood)', ' ', 35, 'Toilet Pump2.webp', '9293cc40f792c9a3d0ec4d5dee3ab27d.jpg', 'e2219d83433c4a784f030d7a2b506ffa.jpg', 300),
	(5406, 4396, 'Other Custodials', 'Toilet Bowl Pump (Heavy Duty)', ' ', 120, 'Toilet Pump2.webp', '91e54193c6c43c0ae4d42d9621100b7a.jpg_2200x2200q80.jpg_.webp', 'b9ec3cf324dc09927da2f328d3c272c6.jpg', 300),
	(5407, 4396, 'Other Custodials', 'Feather Duster', ' ', 295, 'Feather Duster.webp', '26f63a3fc90640d13e05add00b0b9e90.jpg_720x720q80.jpg_.webp', 'native-feather-duster-1.jpg', 300),
	(5408, 4396, 'Other Custodials', 'Spatula', ' ', 65, '131989081_391258311957340_22503352848247.webp', '71hbD8tkuHL._SL1500_.jpg', 'Pannas skr__pis 12.5cm 5.jpg', 300),
	(5409, 4396, 'Other Custodials', 'Extension Pole', '1.3m &  7ft.', 2500, 'Extension pole.webp', '610HymUmUwL._AC_SL1500_.jpg', '35168.webp', 300),
	(5410, 4396, 'Other Custodials', 'Extension Pole', '13ft. & 20ft.', 8000, 'Extension pole blue.webp', '610HymUmUwL._AC_SL1500_ (1).jpg', 'images.png', 300),
	(5411, 4396, 'Other Custodials', 'Garbage Clamp', ' ', 118, 'Garbage Clamp.webp', 'd3c7bdefb03337bbda005fc95f434e32.jpg', '29f37ed468dd05472799c3343ca9f3a6.jpg_720x720q80.jpg_.webp', 300),
	(5412, 4397, 'Disinfectant Chemicals', 'Forward', 'Disinfectant Cleaner Capacity: 5L', 1664, 'Forward.webp', '19e74854ec0952012d381b109e35aa9e.jpg', 'Virex__II_256__2.9L_SmartDose_RGB_2000x2000px__2_.jpg', 300),
	(5413, 4397, 'Disinfectant Chemicals', 'Suma J-512', 'No Rinse Sanitizer For Food Contact Surfaces Capacity: 5L', 2471, '131904886_313058829895695_7590777646989977927_n.webp', 'SUMA_J-512_D4_4x2L-10110268029-2000x2000px-RGB.jpg', 'nz9knctilxdgx1dgz5l5.jpg', 300),
	(5414, 4397, 'Disinfectant Chemicals', 'Virex 256', 'One Step Disinfectant Cleaner & Deodorant Capacity: 5L', 4570, 'viber_image_2021-08-31_11-52-54-225.webp', 'zc84cr5q8m0hwwrdiqtq.jpg', 'Virex_II_256_4x5L-10110418828F%29-2000x2000px-RGB.jpg', 300),
	(5415, 4397, 'Disinfectant Chemicals', 'Oxivir Five 16 Concentrate', 'Broad Spectrum Environmental Cleaner & Disinfectant Capacity: 5L', 16348, '131888238_215927380040776_2492690792832361086_n.webp', 'ovkohwrwy0fodduvvt2h.jpg', 'ienbxumffcn5b2oq1ahi.jpg', 300),
	(5416, 4397, 'Disinfectant Chemicals', 'Lysol Liquid Disinfectant', 'Disinfectant Concentrate Capacity: 5 liters', 2500, 'Lysol 5L.webp', 'd25b04d01ebe8b19f2a8f863e9f1df63.jpg', '10411f8a88a96bfabae7bd3262d35eef.jpg', 300),
	(5417, 4397, 'Disinfectant Chemicals', 'Lysol Liquid Disinfectant', 'Disinfectant Concentrate Capacity: 500ml', 650, 'lysol 500ml.webp', 'RE_Pine.jpg', 'IMG_4496-700x700_0.jpg', 300),
	(5418, 4397, 'Disinfectant Chemicals', 'Lysol Disinfectant Spray', 'Capacity: 340g & 510g', 486, 'lysol spray.webp', '1d1257ac957025a0648a3df2a1f1cc21.jpg', 'b1b2cce9303aaa49669378ce15dbd6ed.jpg', 300),
	(5419, 4397, 'Disinfectant Chemicals', 'Lysol Disinfectant Multi-Action Cleaner', 'Capacity: 900 ml', 272, 'lysol.webp', 'prd-front-50026832.webp', 'lysolmultiaction450mlfront_1200x1200.webp', 300),
	(5420, 4397, 'Disinfectant Chemicals', 'Novasan', 'Multi-purpose Disinfectant Cleaner Capacity:3.8 liters', 924, '136156520_713549319298189_4053299260601292913_n.webp', 'Novasan_10L.jpg', 'nanoblasterpro-new.png', 300),
	(5421, 4397, 'Disinfectant Chemicals', 'CIF Pro Disinfectant Cleaner', 'Capacity:5 liters', 789, 'CIF Disinfectant.webp', 'floor-cleaner-cif-pro-disinfect-5l.jpg', '89d557cbe42282033e869134fa508f19.jpg', 300),
	(5422, 4398, 'Footmat', 'Mat with Tray', 'Size: 2ft x 2ft / 24" x 24" Inclusion of 1 gallon Disinfectant Solution', 1000, 'Carpet-Mat-with-Tray.jpg', 'Carpet-Mat-with-Tray.jpg', '101944967_3405067946205265_6507103474302803795_n.jpg', 300),
	(5423, 4398, 'Footmat', 'Mat with Tray', 'Size: 2ft x 3ft / 24" x 36" Inclusion of 1 gallon Disinfectant Solution', 1250, 'Carpet-Mat-with-Tray.jpg', 'Carpet-Mat-with-Tray (2).jpg', '101944967_3405067946205265_6507103474302803795_n.jpg', 300),
	(5424, 4398, 'Footmat', 'Mat with Tray', 'Size: 2ft x 3ft / 24" x 36" Inclusion of 1 gallon Disinfectant Solution', 1400, 'Carpet-Mat-with-Tray.jpg', 'Carpet-Mat-with-Tray (1).jpg', '101944967_3405067946205265_6507103474302803795_n.jpg', 300),
	(5425, 4398, 'Footmat', 'Mat with Tray and Drying Mat', '2ft x 2ft (24" x 24") with inclusion of 1 gallon Disinfectant Cleaner RTU', 1100, 'Foot Mat Combo 1.webp', 'https://i5.walmartimages.com/asr/e3e63b4d-46fd-43b7-9a49-a728e31fe78d.a632cea58f46fca2d9046b23c74423', '161051-04.png', 300),
	(5426, 4398, 'Footmat', 'Mat with Tray and Drying Mat', '2ft x 3ft (24" x 36") with inclusion of 1 gallon Disinfectant Cleaner RTU', 1350, 'Foot Mat Combo 2.webp', 'https://i5.walmartimages.com/asr/e3e63b4d-46fd-43b7-9a49-a728e31fe78d.a632cea58f46fca2d9046b23c74423', '161051-04.png', 300),
	(5427, 4398, 'Footmat', 'Mat with Tray and Drying Mat', '2ft x 3ft (24" x 36") with inclusion of 1 gallon Disinfectant Cleaner RTU', 1500, 'Foot Mat Combo 3.webp', 'https://i5.walmartimages.com/asr/e3e63b4d-46fd-43b7-9a49-a728e31fe78d.a632cea58f46fca2d9046b23c74423', '161051-04.png', 300),
	(5428, 4398, 'Footmat', 'Coil Mat', '2ft x 2ft (24" x 24")', 695, '108025112_281320186439626_54506083378922.webp', '53c4b442ad83020db6bcd9d9f13087fd.jpg', 'spaghetti_matting_coil_mat_out_1594865175_30bb8891.jpg', 300),
	(5429, 4398, 'Footmat', 'Coil Mat', '2ft x 3ft (24" x 36")', 770, '108025112_281320186439626_54506083378922.webp', '53c4b442ad83020db6bcd9d9f13087fd (1).jpg', 'spaghetti_matting_coil_mat_out_1594865175_30bb8891.jpg', 300),
	(5430, 4398, 'Footmat', 'Coil Mat', '2ft x 3ft (24" x 36")', 980, '108025112_281320186439626_54506083378922.webp', '53c4b442ad83020db6bcd9d9f13087fd (2).jpg', 'spaghetti_matting_coil_mat_out_1594865175_30bb8891.jpg', 300),
	(5431, 4398, 'Footmat', 'Ribbed Mat/ Carpet Mat', 'Color: Red Size: 2ft x 3ft', 960, 'besq-tw-440-carpet-door-mat-with-pvc-backing-ribbed-mats-red.jpg', 'C01-Dark-Red-RS.jpg', 'ribbed-entrance-mat.png', 300),
	(5432, 4399, 'Machines & Equipment', 'Non-Contact Infrared Thermometer', 'One click usage LCD Screen Beeping Warning Long Standby Time Highly Sensitive Infrared Controller Three color backlighting Response Time :  2 seconds Measurement Distance : 1-3 cm Measurement Position: Forehead Center Size : 149 x 90 x 45 mm ( L x W x H )', 819, 'infrared.webp', '4985996e98c69789a19affbccc6e3be7.jpg', 'IRPIC_1200x1200.webp', 300),
	(5433, 4399, 'Machines & Equipment', 'K3 Plus Mini Thermal Scanner', 'Mini version of K3 PLUS Voice-activated Hands-free, Smart, Non-contact Forehead Thermometer, Avoid Cross-Infection Ideal for high foot traffic locations  HD Digital Display Quick and Accurate measurement High Temperature Alarm beeps at temp above 37.2 deg', 950, 'k3 plus mini.webp', '9bc7cbf6566f5ce48b9c3ed4ba03721b.jpg', '698acb65398068eb39c207d0fce926ce.jpg', 300),
	(5434, 4399, 'Machines & Equipment', 'K3 Plus Mini Thermal Scanner with Stand', 'Mini version of K3 PLUS Voice-activated Hands-free, Smart, Non-contact Forehead Thermometer, Avoid Cross-Infection Ideal for high foot traffic locations  HD Digital Display Quick and Accurate measurement High Temperature Alarm beeps at temp above 37.2 deg', 900, 'k3 plus mini with stand.webp', '3ad64644bf90f923d40959802083c5b8.jpg', '90721bb2b3da9963dc932b87d93c7b2f.jpg', 300),
	(5435, 4399, 'Machines & Equipment', 'Automatic Dispenser (Wall Mounted)', 'Feature: Foam Soap Dispenser, Double Soap Dispenser, Alcohol Dispenser Capacity: 1000ml Installation: Wall mounted Product Size: 158*116*286mm Material: ABS Plastic', 1250, 'D_ Automatic Dispenser (1).webp', 'FYA102D.webp', 'a480a3464b62812ff7247549f60c9415.jpg', 300),
	(5436, 4399, 'Machines & Equipment', 'Automatic Dispenser (with Stand)', 'Feature: Foam Soap Dispenser, Double Soap Dispenser, Alcohol Dispenser Capacity: 1000ml Installation: Wall mounted Product Size: 158*116*286mm Material: ABS Plastic Tripod stand: 3-4ft', 1699, 'D_ Dispenser w stand (1).webp', '3b535d4fe1b2aa22ca141c5c459f56fc.jpg', '554b2d2dd41d501eeb47e0aa9071b40d.jpg', 300),
	(5437, 4399, 'Machines & Equipment', 'Automatic Dispenser & K3 Plus Mini Scanner (with Stand)', 'Feature: Foam Soap Dispenser, Double Soap Dispenser, Alcohol Dispenser Capacity: 1000ml Installation: Wall mounted Product Size: 158*116*286mm Material: ABS Plastic Tripod stand: 3-4ft', 2799, 'D_ Dispenser combo.webp', '9bc7cbf6566f5ce48b9c3ed4ba03721b (1).jpg', '81a0dca425d4e3a1885dae46acbe8f41.jpg', 300),
	(5438, 4400, 'PPE', 'Disposable Facemask 3PLY (Indoplas)', '50pcs/box', 140, 'Facemask Indoplas.webp', 'Indoplas-Face-Masks.jpg', 'e83fd162-3669-519c-199e-1f225f0afb32.jpg', 300),
	(5439, 4400, 'PPE', 'Washable Face Mask (St. Patrick)', '', 35, '82d085ce4c4bbd716f76073d46c69727.jpg', 'resize.webp', 'Y2098417-01.webp', 300);

-- Dumping structure for table shop_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `flat` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `number` char(50) NOT NULL DEFAULT '',
  `exp_date` varchar(50) NOT NULL,
  `reset_link_token` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.users: ~19 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `flat`, `city`, `state`, `number`, `exp_date`, `reset_link_token`) VALUES
	(1, 'vincent', 'vbgayotayan2020@plm.edu.ph', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '', '', '', '09272757748', '2023-05-23 19:25:14', '1df8baf53c55a5f8a7ef8c86a2c9f8662623'),
	(3, 'asdasdsadasdd', 'sadasdasd', '8cb2237d0679ca88db6464eac60da96345513964', '', '', '', '0', '', ''),
	(4, 'sdkasndkan', 'vbaskdjlkas@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', '', '', '', '0', '', ''),
	(5, 'dasdasd', 'asdasasd@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', '', '', '', '0', '', ''),
	(6, 'asdas', 'jsdhakja@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', '', '', '', '0', '', ''),
	(7, 'fghj', 'fghj@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', '', '', '', '0', '', ''),
	(8, 'kdjlaskdj', 'sdasd@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', '733d316a8acc36c7993fc5330030c806f3a9a5f2', '', '', '733', '', ''),
	(9, 'ksadmkasdm', 'askdmkasdm@gmail.com', '6f718512a12eb00b3d4328668f01bc867ecbe7a5', 'f1a52dc40e71346b3c2bf2d5f903a1e3b951a50b', '', '', 'f1a52dc40e71346b3c2bf2d5f903a1e3b951a50b', '', ''),
	(10, 'askldnkjas', 'saldkas@gmail.com', '6f718512a12eb00b3d4328668f01bc867ecbe7a5', 'skdmsakdmd', '', '', '09258584578', '', ''),
	(11, 'ksadklasjd', 'asdas@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', 'klsjdlaksdjalsijdaiks', '', '', '09242455541', '', ''),
	(12, 'asldkasldk', 'vjahsdjas@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', 'skljdklasjdkl', '', '', '09151653215', '', ''),
	(13, 'vince', 'vince@gmail.com', '52184786051456f44a5648d4e5e4806976e8337d', 'ksdajsdkajk', '', '', '09351543215', '', ''),
	(14, 'hello', 'hello@gmail.com', '020c2943c94463499f714e3495176dba4d495daf', '235 Area C Parola, , NCR', '', '', '09228654321', '', ''),
	(15, 'Hi', 'Hi@gmail.com', '2c6b74058fd29b4d3f61fe63fcb9789f2bf4c570', '235 Area C Parola, Binondo, Manila, NCR', '', '', '09564212397', '', ''),
	(17, 'princessrei', 'princessrei@gmail.com', 'd2d62b41298e7d3dd8815b2ec69a7249658dc043', 'Batangas St. Blumentritt', 'Manila', 'Philippines', '09957660251', '', ''),
	(18, 'aubrey', 'buzztinbieber415@gmail.com', '7428764a5ae7ef81fc2625bacbb6dc0fca194228', 'malete', 'manila', 'ph', '09202665833', '', ''),
	(20, 'vincentqtie', 'bins@gmail.com', '661ae469261814a6bb2dd25247e4a7cf17b73c02', '2007 Anakbayan, Malate', 'Manila', 'NCR', '09584651254', '', ''),
	(21, 'VincentG', 'vgayotayan@gmail.com', '7428764a5ae7ef81fc2625bacbb6dc0fca194228', 'area c gate 54', 'manila', 'ph', '09202554766', '', ''),
	(24, 'VincentBG', 'vbg2020@gmail.com', '29d66c0162b6560e6d6869284aa7107361d51b7b', '235 Area C Parola, Binondo', 'Manila', 'NCR', '09272757748', '', '');

-- Dumping structure for table shop_db.user_orders
CREATE TABLE IF NOT EXISTS `user_orders` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `request` varchar(200) DEFAULT 'None',
  `order_tracking` varchar(20) DEFAULT '-',
  `courier_type` varchar(20) DEFAULT '-',
  `ref_num` int(50) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table shop_db.user_orders: ~18 rows (approximately)
INSERT INTO `user_orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `request`, `order_tracking`, `courier_type`, `ref_num`) VALUES
	(51, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, asdasd, asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Pending', NULL, ' ', ' ', 0),
	(53, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, asdasd, asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', NULL, 'Completed', 'Third-party', 0),
	(54, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', 'with 10k', 'Packed', 'Own', 0),
	(57, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-24 00:00:00', 'Completed', '', 'Completed', 'Third-party', 0),
	(58, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-25 00:00:00', 'Completed', 'canton with hotdog', 'Packed', 'Own', 0),
	(59, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-25 00:00:00', 'Completed', '', 'To Receive', 'Own', 0),
	(60, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'dustpan (12 x 1) - ', 12, '2023-04-26 00:00:00', 'Pending', '', ' ', ' ', 0),
	(62, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Lysol Liquid Disinfectant (2500 x 1) - Lysol Disinfectant Multi-Action Cleaner (272 x 1) - Oxivir Five 16 Concentrate (16348 x 1) - Lysol Disinfectant Spray (486 x 1) - Mat with Tray and Drying Mat (1500 x 1) - ', 21106, '2023-05-08 13:44:38', 'Completed', 'none', 'Completed', 'Third-party', 0),
	(63, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'sampleuli (222 x 1) - ', 222, '2023-05-13 09:57:51', 'Pending', 'secret', ' ', ' ', 0),
	(64, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Plastic Broom (Nylon Bristle; Steel Handle) (90 x 5) - sampleuli (222 x 1) - ', 672, '2023-05-13 10:33:58', 'Completed', 'may poging kasama', 'Completed', 'Own', 0),
	(65, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'Lobby Dust Pan (Wind Proof 2) (350 x 12) - sampleuli (222 x 1) - ', 4422, '2023-05-13 21:21:56', 'Completed', '', 'Own', 'Own', 0),
	(66, 1, 'asdasd', '931323123', 'vbgayotayan2020@plm.edu.ph', 'cash on delivery', 'asdasd, , asda, asdas', 'sampleuli (222 x 1) - ', 222, '2023-05-13 23:19:15', 'Completed', '', 'Packed', 'Own', 0),
	(67, 17, 'Rei Sebastian', '0995766025', 'princessrei@gmail.com', 'cash on delivery', 'Batangas St. Blumentritt, , Manila, Philippines', 'sampleuli (222 x 1) - ', 222, '2023-05-14 01:31:34', 'Pending', '', '-', 'Own', 0),
	(69, 19, 'Vencio', '0920255487', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 1) ', 100, '2023-05-23 08:34:57', 'Pending', '', '-', 'Own', 0),
	(70, 1, 'vincent', '0', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Ceiling Broom (100 x 1) ', 100, '2023-05-23 10:20:07', 'Completed', '', ' ', ' ', 0),
	(71, 21, 'VincentG', '0920255476', 'malapitnamagchristmas@gmail.co', 'cash on delivery', '2007 Anakbayan, Malate, , Manila, NCR', 'Rubber Gloves (Nova 45) (95 x 1) Lobby Dust Pan (Wind Proof 2) (350 x 1) Push Brush (Steel) (250 x 1) Fabric Softener (342 x 1) Stick Broom (50 x 1) Hand Brush (Light Duty) (35 x 1) ', 1122, '2023-05-23 11:01:45', 'Pending', '', '-', 'Own', 0),
	(72, 21, 'VincentG', '0920255476', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 12) ', 1200, '2023-05-23 11:19:52', 'Pending', '', '-', 'Own', 0),
	(75, 1, 'asdasd', '0', 'vgayotayan@gmail.com', 'cash on delivery', 'area c gate 54, , manila, ph', 'Ceiling Broom (100 x 1) Plastic Broom (Nylon Bristle; Steel Handle) (90 x 1) Stick Broom (50 x 1) Soft Broom/Walis Tambo (Baguio) (110 x 1) ', 350, '2023-06-28 00:34:15', 'Pending', '', '-', 'Own', 0);

-- Dumping structure for table shop_db.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.wishlist: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
