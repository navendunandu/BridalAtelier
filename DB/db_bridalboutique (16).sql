-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2024 at 11:51 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bridalboutique`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminreg`
--

CREATE TABLE `tbl_adminreg` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_contact` varchar(10) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_adminreg`
--

INSERT INTO `tbl_adminreg` (`admin_id`, `admin_name`, `admin_contact`, `admin_email`, `admin_password`) VALUES
(1, 'Aleena', '9876543210', 'aleenareji002@gmail.com', 'Admin@11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` varchar(10) NOT NULL,
  `booking_amount` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_foredate` varchar(10) NOT NULL,
  `booking_returningdate` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_amount`, `booking_status`, `booking_foredate`, `booking_returningdate`, `user_id`) VALUES
(1, '2024-11-01', 25000, 2, '2024-11-02', '2024-11-05', 3),
(2, '', 0, 0, '', '', 0),
(3, '2024-11-01', 3900, 2, '2024-11-02', '2024-11-06', 3),
(4, '', 0, 0, '', '', 3),
(5, '2024-11-01', 10000, 2, '2024-11-04', '2024-11-09', 6),
(6, '', 0, 0, '', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_quantity`, `cart_status`, `product_id`, `booking_id`) VALUES
(1, 1, 6, 52, 1),
(2, 0, 0, 79, 2),
(3, 1, 6, 79, 3),
(4, 1, 0, 31, 4),
(5, 2, 6, 39, 5),
(6, 2, 0, 31, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `mcategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `mcategory_id`) VALUES
(15, 'saree', 4),
(16, 'lehanga', 4),
(17, 'Gown', 4),
(21, 'Mang Tikka', 5),
(22, 'Earrings', 5),
(23, 'Neck Accessories', 5),
(24, 'Hand Accessories', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(500) NOT NULL,
  `complaint_date` varchar(10) NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `complaint_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_content`, `complaint_date`, `complaint_status`, `complaint_reply`, `user_id`, `product_id`, `complaint_file`) VALUES
(4, 'Fabric Damage', 'The fabric of the product is ripped and damaged. ', '2024-10-07', 0, '', 6, 46, 'ripped.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Idukki'),
(2, 'Ernakulam'),
(3, 'Kottayam'),
(6, 'Palakkad'),
(7, 'Kozhikode');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_image` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`gallery_id`, `gallery_image`, `product_id`) VALUES
(1, 'lehanga1.jpg.avif', 0),
(2, 'gown1.jpg.jpg', 0),
(3, 'gown1.jpg.jpg', 0),
(4, 'gown1.jpg.jpg', 0),
(5, 'gown1.jpg.jpg', 0),
(6, 'gown1.jpg.jpg', 0),
(7, 'gown1.jpg.jpg', 0),
(10, 'Emeraldisla_2.png', 0),
(11, 'Emeraldisla_3.png', 0),
(18, 'NavyKeylaZirconiaMaangTikka_2.png', 30),
(25, 'Aline1.png', 31),
(26, 'Aline1.1.png', 31),
(27, 'Aline1.2.png', 31),
(28, 'Aline1.3.png', 31),
(29, 'Aline2.png', 34),
(30, 'Aline2.2.png', 34),
(31, 'Aline2.3.png', 34),
(32, 'Aline2.4.png', 34),
(33, 'Trumpet1.png', 35),
(34, 'Trumpet1.1.png', 35),
(36, 'Trumpet1.3.png', 35),
(38, 'Ballgown1.png', 36),
(39, 'Ballgown1.1.png', 36),
(40, 'Ballgown1.3.png', 36),
(41, 'Ballgown1.4.png', 36),
(42, 'Mermaid1.png', 37),
(43, 'Mermaid1.1.png', 37),
(44, 'Mermaid1.2.png', 37),
(45, 'Mermaid2.png', 38),
(46, 'Mermaid2.1.png', 38),
(47, 'Mermaid2.2.png', 38),
(48, 'Sheath1.png', 39),
(49, 'Sheath1.1.png', 39),
(50, 'Sheath2.png', 40),
(51, 'Sheath2.1.png', 40),
(52, 'Sheath2.2.png', 40),
(53, 'Sheath2.3.png', 40),
(54, 'Ballgown2.png', 41),
(55, 'Ballgown2.1.png', 41),
(56, 'Ballgown2.3.png', 41),
(57, 'Ballgown2.4.png', 41),
(58, 'Ballgown2.2.png', 41),
(59, 'Ballgown2.5.png', 41),
(60, 'Alinele.jpg', 42),
(61, 'Alinele1.1.png', 42),
(62, 'Alinele1.2.png', 42),
(63, 'Alinele1.3.png', 42),
(64, 'Umbrellale1.1.png', 43),
(65, 'Umbrellale1.2.png', 43),
(66, 'Umbrellale1.3.png', 43),
(67, 'Umbrellale1.4.png', 43),
(68, 'golddayra.png', 49),
(69, 'golddayra1.png', 49),
(70, 'golddayra2.png', 49),
(71, 'golddayra3.png', 49),
(72, 'lilac.png', 50),
(73, 'lilac1.png', 50),
(74, 'lilac2.png', 50),
(75, 'Freya.png', 51),
(76, 'Freya1.png', 51),
(77, 'Freya2.png', 51),
(78, 'raza1.png', 52),
(79, 'raza2.png', 52),
(80, 'raza3.png', 52),
(81, 'raza4.png', 52),
(86, 'brida1.png', 45),
(87, 'brida2.png', 45),
(88, 'brida3.png', 45),
(89, 'brida4.png', 45),
(90, 'goldenbanarasi.png', 48),
(91, 'goldenbanarasi1.png', 48),
(92, 'goldenbanarasi2.png', 48),
(93, 'goldenbanarasi3.png', 48),
(94, 'classicpeach1.png', 46),
(95, 'classicpeach2.png', 46),
(101, 'silkpeach1.png', 47),
(102, 'silkpeach2.png', 47),
(103, 'silkpeach3.png', 47),
(107, 'Emeraldisla_1.png', 28),
(108, 'Emeraldisla_2.png', 28),
(109, 'Emeraldisla_3.png', 28),
(110, 'GoldenKirthikaMaangTikka_1.png', 29),
(111, 'GoldenKirthikaMaangTikka_2.png', 29),
(112, 'NavyKeylaZirconiaMaangTikka_1.png', 30),
(113, 'RoseGoldEsmeeZirconiaStuds_1.png', 54),
(114, 'RoseGoldEsmeeZirconiaStuds_2.png', 54),
(115, 'RoseGoldEsmeeZirconiaStuds_3.png', 54),
(116, 'SilverBeloraZirconiaStuds_1.png', 55),
(117, 'SilverBeloraZirconiaStuds_2.png', 55),
(118, 'SilverBeloraZirconiaStuds_3.png', 55),
(119, 'SilverMartheStuds_1.png', 56),
(120, 'SilverMartheStuds_2.png', 56),
(121, 'SilverMartheStuds_3.png', 56),
(122, 'IVORYMALKASAHARAJHUMKIS1.png', 57),
(123, 'IVORYMALKASAHARAJHUMKIS_.png', 57),
(124, 'IVORYMALKASAHARAJHUMKIS2.png', 57),
(125, 'EmeraldTiggerZirconiaHoops_1.png', 58),
(126, 'EmeraldTiggerZirconiaHoops_2.png', 58),
(127, 'EmeraldTiggerZirconiaHoops_3.png', 58),
(131, 'EMERALDYANINZIRCONIAHOOPS1.png', 59),
(132, 'EmeraldYaninZirconiaHoops_1.png', 59),
(133, 'EmeraldYaninZirconiaHoops_2.png', 59),
(134, 'EmeraldYaninZirconiaHoops_3.png', 59),
(135, 'GoldenKarnamDesignerEarrings_2.png', 61),
(136, 'GoldenKarnamDesignerEarrings_1.png', 61),
(137, 'GoldenKarnamDesignerEarrings_3.png', 61),
(138, 'EmeraldGunitaTempleDanglers_3.png', 62),
(139, 'EmeraldGunitaTempleDanglers_1.png', 62),
(140, 'EmeraldGunitaTempleDanglers_2.png', 62),
(141, 'IvorySunitaChandbalis_4.png', 63),
(142, 'IvorySunitaChandbalis_2.png', 63),
(143, 'IvorySunitaChandbalis_3.png', 63),
(144, 'IVORYLAYEREDCHANDBALIS_1.png', 64),
(145, 'Golden_Layered_Chaandbali_Earrings_2.png', 64),
(146, 'IVORYLAYEREDCHANDBALIS2_3.png', 64),
(147, 'JetMirayaChandbalis_4.png', 65),
(148, 'JetMirayaChandbalis_3.png', 65),
(149, 'JetMirayaChandbalis_2.png', 65),
(150, '35_c13f88a4-6da1.png', 66),
(151, '35-1_2741118b-e530-42.png', 66),
(152, 'MulticolorAdaraZirconiaBracelet_1.png', 67),
(153, 'MulticolorAdaraZirconiaBracelet_2.png', 67),
(154, 'EmeraldBaisakhiAdjustableBracelet_2.png', 68),
(155, 'EmeraldBaisakhiAdjustableBracelet_1.png', 68),
(156, 'EmeraldBaramZirconiaBracelet_2.png', 69),
(157, 'EmeraldBaramZirconiaBracelet_1.png', 69),
(158, 'RosegoldCruzBangles_1.png', 70),
(159, 'RosegoldCruzBangles_2.png', 70),
(160, 'RosegoldCruzBangles_3.png', 70),
(161, '5-1-PhotoRoom_1.png', 71),
(162, '5-1_5651bf66-a134-4955-a470-77371f4eb3.png', 71),
(163, '5_dae89af9-3261-40cc-8016-d7e70300282.png', 71),
(164, 'GoldenEtonZirconiaRing_1.png', 72),
(165, 'GoldenEtonZirconiaRing_2.png', 72),
(166, 'GoldenEtonZirconiaRing_3.png', 72),
(167, 'GoldenGunjanZirconiaRing_1.png', 73),
(168, 'GoldenGunjanZirconiaRing_2.png', 73),
(169, 'GoldenGunjanZirconiaRing_3.png', 73),
(170, 'GoldenNupoorZirconiaRing_1.png', 74),
(171, 'GoldenNupoorZirconiaRing_2.png', 74),
(172, 'GoldenNupoorZirconiaRing_3.png', 74),
(173, 'GoldenVishramZirconiaRing_1.png', 75),
(174, 'GoldenVishramZirconiaRing_2.png', 75),
(175, 'GoldenVishramZirconiaRing_3.png', 75),
(176, 'RoseGoldAmritaZirconiaRing_1.png', 76),
(177, 'RoseGoldAmritaZirconiaRing_2.png', 76),
(178, 'RoseGoldAmritaZirconiaRing_3.png', 76),
(179, 'IvoryTiyaJewellerySet_1_1800x1800.png', 77),
(180, 'IvoryTiyaJewellerySet_2_1800x1800.png', 77),
(181, 'IvoryTiyaJewellerySet_3_1800x1800.png', 77),
(182, 'IvoryTiyaJewellerySet_4_1800x1800.png', 77),
(183, 'RaniFreenaVictorianJewellerySet-NewArrival_1_1800x1800.png', 78),
(184, 'RaniFreenaVictorianJewellerySet-NewArrival_3_1800x1800.png', 78),
(185, 'RaniFreenaVictorianJewellerySet-NewArrival_4_1800x1800.png', 78),
(186, 'GoldenLizaVictorianJewellerySet-NewArrival_1_1800x1800.png', 79),
(187, 'GoldenLizaVictorianJewellerySet-NewArrival_3_1800x1800.png', 79),
(188, 'GoldenLizaVictorianJewellerySet-NewArrival_4_1800x1800.png', 79),
(189, 'GoldenGingerPendantSet_3_1800x1800.png', 80),
(190, 'GoldenGingerPendantSet_2_1800x1800.png', 80),
(191, 'GoldenGingerPendantSet_4_1800x1800.png', 80);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_maincategory`
--

CREATE TABLE `tbl_maincategory` (
  `mcategory_id` int(11) NOT NULL,
  `mcategory_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_maincategory`
--

INSERT INTO `tbl_maincategory` (`mcategory_id`, `mcategory_name`) VALUES
(4, 'Dresses'),
(5, 'Ornaments'),
(6, 'nhh');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`material_id`, `material_name`) VALUES
(1, 'Cotton'),
(2, 'Silk'),
(3, 'Georgette'),
(4, 'Organza'),
(5, 'Satin'),
(7, 'Chiffon'),
(8, 'Net'),
(9, 'Rose Gold'),
(10, 'American Diamond'),
(11, 'Pearl'),
(12, 'Tulle'),
(13, 'lace'),
(14, 'Crystal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'Cheruthoni', 1),
(2, 'Kothamangalam', 2),
(3, 'Perambra', 7),
(4, 'Muvattupuzha', 2),
(5, 'kochi', 2),
(6, 'Vandiperiyar', 1),
(7, 'Kuttikanam', 1),
(8, 'Edapally', 2),
(9, 'Pala', 3),
(10, 'Thodupuzha', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(600) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_photo` varchar(100) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `product_vstatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_price`, `product_photo`, `subcategory_id`, `shop_id`, `material_id`, `product_vstatus`) VALUES
(28, 'Emerald Isla Maang Tikka', 'This gorgeous ethnic maang tikka is a reflection of the traditions and aura of our festivals!\r\n', 520, 'Emeraldisla_1.png', 28, 3, 10, 1),
(29, 'Golden Kirthika Maang Tikka', 'This gorgeous ethnic maang tikka is a reflection of the traditions and aura of our festivals!', 430, 'GoldenKirthikaMaangTikka_1.png', 29, 3, 11, 1),
(30, 'Navy Keyla Zirconia Maang Tikka', 'This gorgeous ethnic maang tikka is a reflection of the traditions and aura of our festivals!\r\n', 1050, 'NavyKeylaZirconiaMaangTikka_2.png', 30, 3, 10, 0),
(31, 'Robe Remi', 'Corset Floral Wedding Dress A-line Bridal Gown Sheer Structure Sweetheart Bodice Modern Vintage Bride. Let the flowers adorn and compliment your look at the wedding.', 2500, 'Aline1.png', 22, 2, 12, 1),
(34, 'Teresa', ' Soft bodice with illusion V-neckline, illusion side panels and stunning off-the-shoulder tulle straps is embellished with threaded 3D floral lace with transparent sequins. The lace cascades in rows down the waist creating a beautiful unity with the pleats on the skirt.', 3000, 'Aline2.png', 22, 2, 12, 1),
(35, 'Miata', 'Breathtaking Miata gown feels straight off the red carpet. Tailored in intricate lace with transparent sequins, ivory beading and small pearls, the dress mesmerizes at first glance. The highlight of the style is its deep straight neckline with off-the-shoulder straps that expose boning. ', 3500, 'Trumpet1.1.png', 34, 2, 13, 1),
(36, 'Karmen', 'Two-toned glitter fabric adorned with royal floral embroidery creates a true princess-inspired ballgown. Deeply plunged pointed strapless corset with exposed boning is embellished with showstopping sheer balloon sleeves that are detachable. Scattered hand-embroidered floral appliques trickle down the voluminous full skirt that ends with an extra-long royal train.', 3000, 'Ballgown1.png', 21, 2, 13, 1),
(37, 'Sonata', 'A super-fitted mermaid wedding gown embellished with the sweetheart top with off-the-shoulder regal straps. Two-toned silk Tulle and scattered hand-embroidered floral appliques make this dress look even more elegant with soft cathedral-length Tulle train.', 2500, 'Mermaid1.png', 20, 2, 12, 1),
(38, 'Atlanta', 'The draped fabric corset beautifully accentuates your figure, while the off-shoulder design and sweetheart neckline exude timeless elegance. The skirt, crafted with dazzling sequined fabric, adds a touch of glamour and sparkle to your every step. For added versatility, a detachable off-shoulder sleeve is included, allowing you to transform your look effortlessly. ', 2500, 'Mermaid2.png', 20, 2, 12, 1),
(39, 'Genevieve', 'The Genevieve gown speaks confidence and sophistication. The breathtaking floral-patterned 3D lace with transparent sequins and pearls on the sheath silhouette creates a truly unique look. A tender V-neckline with thin spaghetti straps make the corset look even more feminine. The Chantilly lace enriches the style. Detachable Mikado cape creates gorgeous off-shoulder wrap sleeves and a bow train on the back that adds a touch of royalty to the final look.', 5000, 'Sheath1.png', 32, 2, 13, 1),
(40, 'Pretty', 'Pretty is a really special transformer wedding dress with unique design. The sheath dress is made of glossy satin and is of mermaid silhouette. A strapless bodice with asymmetric neckline is decorated with a falbala that highlights a decollete. Extra-low bodice bares a bride’s back and has pointed angles at the back of the dress. The skirt has a straight cut and a small train. The fantastic overskirt with a fabulous long train is made of transparent tulle with volumetric decoration and is attached on the waistline.', 4500, 'Sheath2.png', 32, 2, 5, 1),
(41, 'Mary', 'Mary is a fantastic medieval-styled gown. Mary is made if glossy satin and has a detachable bolero. The sheath dress is of ball gown silhouette with fitted corset decorated with square neckline and wide straps. The volumentic skirt passes into a long luxurious train. The bolero is made of the same satin with loose scrunched up sleeves and a tie on the front.', 4000, 'Ballgown2.png', 21, 2, 5, 1),
(42, 'Floral Green Lehanga', 'Dazzle and captivate everyone at your wedding celebrations with our stunning Green Net Embroidered A-Line Lehenga Wedding Wear. The lightweight net fabric adds an ethereal touch, making you feel like a princess on your special day.', 1500, 'Alinele.jpg', 23, 1, 8, 1),
(43, 'Pastel Navy Lehanga', 'Flaunt your brilliant fashion with this Teal Blue soft silk umbrella lehenga skirt to be stunning plastic mirror work over the lehenga with thread embroidered n stones work. This lehenga comes with navy blue soft silk thread embroidery choli.', 5500, 'Umbrellale.png', 24, 1, 2, 1),
(45, 'Pink Bridal Banarasi Saree', 'Featuring a banarasi saree in dual shades of pink and orange with hand embroidered borders. The saree is paired with a vibrant yellow silk blouse with tulle sleeves and an elegant sculpted neckline.', 12000, 'brida.png', 12, 1, 2, 1),
(46, 'Classic Peach Kanjivaram Saree', 'In the softest shade of peach, the delicate folds whisper tales of grace, accompanied by a crystal hand embroidered blouse and a matching waist belt and a hand embroidered veil completing a vison of sheer elegance.', 12000, 'classicpeach5.png', 13, 1, 2, 1),
(47, 'Silk Peach Kanjivaram Saree', 'Elevate your elegance with this tissue Kancheevaram saree in peach. Handcrafted with utmost precision and care, this saree seamlessly feels like royalty when paired with the stunning patchwork blouse in lilac.', 14500, 'silkpeach.png', 13, 1, 2, 1),
(48, 'Golden Banarasi Saree', 'A symphony in Banares adorned with signature blouse details, this saree is an ode to Indian craftsmanship at its most elegant best.', 11500, 'goldenbanarasi.png', 12, 1, 2, 1),
(49, 'Gold Dayra Lehanga', 'Mermaid lehenga in gold with hand done timeless sequin embroidery teamed up with a stylish crosscut choli and an enigmatic dupatta.', 9000, 'golddayra.png', 35, 1, 8, 1),
(50, 'Lilac Lehanga', 'A 3-piece mermaid cut lehenga in lilac embroidered with silver metal embellishments, precious crystals, 3D flower and glass cut beads. This lehenga is completed with a waist side-cut covered with tulle and silver embroidered tassles Paired with a  butterfly full sleeved blouse appliqued in lilac silks. This look is completed with a tissue organza embroidered dupatta in lilac.', 18500, 'lilac.png', 35, 1, 12, 1),
(51, 'Freya Lehanga', 'Step into the spotlight with our Golden Glamour Lehenga - an extraordinary mermaid lehenga adorned with resplendent golden metals, glitzy sequins, and cascading chains. The tube blouse showcases intricate jhaali work adorned with elegant latkans, paired flawlessly with a hand-draped jacket.', 15750, 'Freya.png', 35, 1, 4, 1),
(52, 'Raza Lehanga', 'Our floral-embroidered lehenga in delicate tulle fabric is highlighted with crystals, cut dana, Swarovski crystals, and sitara. It is paired with a heavy bejewelled blouse uplifted with shell embellishments, along with a floral-embroidered dupatta.', 25000, 'raza.png', 24, 1, 12, 1),
(54, 'Esmee Zirconia', 'Sparkling elegance meets affordability with these exquisite American diamond earrings. Crafted with precision and adorned with dazzling simulated diamonds, these earrings effortlessly elevate any ensemble. The perfect accessory for adding a touch of glamour and sophistication to your look.\r\n', 1200, 'RoseGoldEsmeeZirconiaStuds_1.png', 31, 3, 10, 0),
(55, 'Silver Belora', 'Crafted with precision and adorned with dazzling simulated diamonds, these earrings effortlessly elevate any ensemble. The perfect accessory for adding a touch of glamour and sophistication to your look.', 750, 'SilverBeloraZirconiaStuds_1.png', 31, 3, 10, 0),
(56, 'Silver Marthe', 'Sparkling elegance meets affordability with these exquisite American diamond earrings. Crafted with precision and adorned with dazzling simulated diamonds, these earrings effortlessly elevate any ensemble.', 2850, 'SilverMartheStuds_1.png', 31, 3, 10, 0),
(57, 'Malka Sahara', 'Ivory Malka Sahara Jhumkis\r\n', 1500, 'IVORYMALKASAHARAJHUMKIS1.png', 38, 3, 11, 0),
(58, 'Emerald Tigger', 'Sparkling elegance meets affordability with these exquisite American diamond earrings. Crafted with precision and adorned with dazzling simulated diamonds, these earrings effortlessly elevate any ensemble. The perfect accessory for adding a touch of glamour and sophistication to your look.', 3200, 'EmeraldTiggerZirconiaHoops_1.png', 37, 3, 10, 0),
(59, 'Emerald Yanin', 'Sparkling elegance meets affordability with these exquisite American diamond earrings. Crafted with precision and adorned with dazzling simulated diamonds, these earrings effortlessly elevate any ensemble.', 4800, 'EMERALDYANINZIRCONIAHOOPS1.png', 37, 3, 10, 0),
(61, 'Golden Karnam ', 'These earrings will steal your heart with its gorgeous color tone and elegant design. It is a latest hot favorite this festive season. Do not give this stylish piece a miss.', 1900, 'GoldenKarnamDesignerEarrings_2.png', 39, 3, 11, 0),
(62, 'Gunita Temple', 'Fulfill your desire to style the most classic and pure form of ethnic jewellery with these Gold Plated rustic looking pair of earrings that have the impression of Godliness all over it!', 950, 'EmeraldGunitaTempleDanglers_3.png', 39, 3, 11, 0),
(63, 'Ivory Sunita', 'Fulfill your desire to style the most classic and pure form of ethnic jewellery with these Gold Plated rustic looking pair of earrings that have the impression of Godliness all over it!\r\n', 1950, 'IvorySunitaChandbalis_4.png', 40, 3, 11, 0),
(64, 'Ivory Layered', 'Ivory Layered Chaandbali Earrings', 1250, 'IVORYLAYEREDCHANDBALIS_1.png', 40, 3, 11, 0),
(65, 'Jet Miraya ', 'Fulfill your desire to style the most classic and pure form of ethnic jewellery with these Gold Plated rustic looking pair of earrings that have the impression of Godliness all over it!\r\n', 1600, 'JetMirayaChandbalis_4.png', 40, 3, 11, 0),
(66, 'Vanessa Zirconia', 'Rose Gold Vanessa Zirconia Bracelet', 350, '35_c13f88a4-6da1.png', 41, 3, 14, 0),
(67, 'Multicolor Adara', 'The bracelet is specially designed to look versatile and accompany almost any outfit, the glow and shine of the pearls makes it the perfect buy for this festive season.', 4500, 'MulticolorAdaraZirconiaBracelet_1.png', 41, 3, 14, 0),
(68, 'Emerald Baisakhi', 'These bracelet will provide a festive glow to your look. The bracelet is specially designed to look versatile and accompany almost any outfit, the glow and shine of the pearls makes it the perfect.', 2000, 'EmeraldBaisakhiAdjustableBracelet_2.png', 41, 3, 11, 0),
(69, 'Baram Zirconia', 'These bracelet will provide a festive glow to your look. The bracelet is specially designed to look versatile and accompany almost any outfit, the glow and shine of the pearls makes it the perfect buy for this festive season.\r\n', 9000, 'EmeraldBaramZirconiaBracelet_2.png', 41, 3, 14, 0),
(70, 'Rose Gold Cruz', 'These American Diamond Bangles are unique and versatile. Made with high-quality American Diamonds, they are long lasting and ready to make your wrists sparkle!\r\n', 3450, 'RosegoldCruzBangles_1.png', 42, 3, 10, 0),
(71, 'Rose Gold Nagini', 'These bangles will provide a festive glow to your look. The bangles are specially designed to look versatile and accompany almost any outfit, the glow and shine of the studded American diamonds makes it the perfect buy for this festive season\r\n', 3300, '5-1-PhotoRoom_1.png', 42, 3, 10, 0),
(72, 'Golden Eton', 'Golden Eton Zirconia Ring.', 1500, 'GoldenEtonZirconiaRing_1.png', 43, 3, 14, 0),
(73, 'Golden Gunjan', 'Golden Gunjan Zirconia Ring', 2500, 'GoldenGunjanZirconiaRing_1.png', 43, 3, 14, 0),
(74, 'Golden Nupoor', 'Golden Nupoor Zirconia Ring', 500, 'GoldenNupoorZirconiaRing_1.png', 43, 3, 14, 0),
(75, 'Golden Vishram', 'Golden Vishram Zirconia Ring', 1200, 'GoldenVishramZirconiaRing_1.png', 43, 3, 14, 0),
(76, 'Amrita Zirconia', 'Rose Gold Amrita Zirconia Ring', 6500, 'RoseGoldAmritaZirconiaRing_1.png', 43, 3, 14, 0),
(77, 'Ivory Tiya', 'This necklace is the ultimate accessory option for the festive season. This set has the most gorgeous circular floral pattern. The necklace has vibrant pearl detailing all over. The set also has a bright element of kundan detailing in its structure.\r\n', 12000, 'IvoryTiyaJewellerySet_1_1800x1800.png', 44, 3, 11, 0),
(78, 'Rani Victorian', 'Premium quality American Diamond set with superb gemstones crafted for festive weddings and your upcoming special occasions. ', 8500, 'RaniFreenaVictorianJewellerySet-NewArrival_1_1800x1800.png', 44, 3, 10, 0),
(79, 'Liza Victorian ', 'Premium quality American Diamond set with superb gemstones crafted for festive weddings and your upcoming special occasions.', 3900, 'GoldenLizaVictorianJewellerySet-NewArrival_1_1800x1800.png', 44, 3, 10, 0),
(80, 'Golden Ginger ', '\r\nThis auspicious thread is nothing like an ordinary one! Ready to wear and an attention grabber for sure, this is a unique design with American Diamonds studded in it to make it look like a fashion piece with the traditional elements!\r\n', 3950, 'GoldenGingerPendantSet_3_1800x1800.png', 45, 3, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `rating_content` varchar(30) NOT NULL,
  `rating_datetime` varchar(15) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `rating_value`, `rating_content`, `rating_datetime`, `product_id`, `user_id`) VALUES
(1, 3, 'Good', '2024-09-27 11:2', 22, 1),
(2, 4, 'Good product', '2024-10-07 09:0', 46, 6),
(3, 4, 'Nice Product', '2024-11-01 15:2', 52, 0),
(4, 4, 'Good', '2024-11-01 15:2', 52, 3),
(5, 5, 'Excellent work', '2024-11-01 15:2', 79, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop`
--

CREATE TABLE `tbl_shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(30) NOT NULL,
  `shop_vstatus` int(11) NOT NULL DEFAULT 0,
  `shop_email` varchar(30) NOT NULL,
  `shop_password` varchar(8) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shop_logo` varchar(100) NOT NULL,
  `shop_proof` varchar(100) NOT NULL,
  `shop_doj` varchar(10) NOT NULL,
  `shop_contact` varchar(10) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shop`
--

INSERT INTO `tbl_shop` (`shop_id`, `shop_name`, `shop_vstatus`, `shop_email`, `shop_password`, `shop_address`, `shop_logo`, `shop_proof`, `shop_doj`, `shop_contact`, `place_id`) VALUES
(1, 'Bridal Glitz stores', 1, 'bridalglitzz11@gmai.com', 'Bg1111', 'College Rd\r\nKothamangalam, Kerala 686691', 'Bridalglitz.png', 'proof2.png', '2024-05-21', '9876543233', 10),
(2, 'Wonder Veil', 1, 'hridyarnair04@gmail.com', 'Hridya@1', 'Kumily Rd, opp.EB office\r\nVandiperiyar', 'gownstore.png', 'proof3.png', '2024-05-21', '9191919191', 6),
(3, 'Mangalsutra Jewellers', 1, 'mangalsutra@gmail.com', 'Ms1111', 'Idukki Rd,Cheruthoni', 'mangalsutra.png', 'proof1.png', '2024-09-27', '9693265412', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `stock_date` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_quantity`, `stock_date`, `product_id`) VALUES
(5, 15, '2024-05-28', 12),
(6, 50, '2024-07-16', 15),
(7, 100, '2024-07-16', 18),
(8, 65, '2024-07-16', 24),
(9, 75, '2024-07-16', 22),
(10, 1, '2024-07-27', 24),
(11, 1, '2024-07-27', 17),
(12, 1, '2024-07-27', 16),
(13, 1, '2024-07-27', 20),
(14, 1, '2024-07-27', 25),
(15, 1, '2024-07-27', 23),
(16, 1, '2024-07-27', 19),
(17, 1, '2024-08-02', 17),
(18, 1, '2024-08-02', 20),
(19, 1, '2024-08-02', 17),
(20, 1, '2024-08-02', 20),
(21, 15, '2024-10-07', 42),
(22, 10, '2024-10-07', 43),
(23, 8, '2024-10-07', 45),
(24, 18, '2024-10-07', 46),
(25, 3, '2024-10-07', 47),
(26, 13, '2024-10-07', 49),
(27, 2, '2024-10-07', 50),
(28, 1, '2024-10-07', 52),
(29, 16, '2024-10-07', 53),
(30, 10, '2024-10-07', 31),
(31, 15, '2024-10-07', 35),
(32, 3, '2024-10-07', 38),
(33, 5, '2024-10-07', 39),
(34, 2, '2024-10-07', 40),
(36, 29, '2024-10-25', 31),
(38, 5, '2024-10-25', 55),
(39, 5, '2024-11-01', 57),
(40, 10, '2024-11-01', 62),
(41, 3, '2024-11-01', 79),
(42, 3, '2024-11-01', 79);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(12, 'Banarasi saree', 15),
(13, 'Kanjivaram Saree', 15),
(15, 'Chanderi Saree', 15),
(16, 'Bandhani Saree', 15),
(20, 'Mermaid gown', 17),
(21, 'Ball Gown', 17),
(22, 'A-Line gown', 17),
(23, 'A-Line Lehanga', 16),
(24, 'Umbrella Lehanga', 16),
(25, 'Choli Lehanga', 0),
(28, 'Emerald Isla', 21),
(29, 'Golden Kirthika', 21),
(30, 'Navy Keyla ', 21),
(31, 'Studs', 22),
(32, 'Sheath Gown', 17),
(33, 'Fit-and-Flare Gown', 17),
(34, 'Trumpet Gown', 17),
(35, 'Mermaid Lehenga', 16),
(36, 'Straight Cut Lehenga', 16),
(37, 'Hoops', 22),
(38, 'Jhumka', 22),
(39, 'Danglers', 22),
(40, 'Chandbal', 22),
(41, 'Bracelets', 24),
(42, 'Bangles', 24),
(43, 'Rings', 24),
(44, 'Necklace sets', 23),
(45, 'Pendant sets', 23),
(46, 'Chains', 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_contact` varchar(10) NOT NULL,
  `user_address` varchar(50) NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `place_id`, `user_photo`, `user_password`) VALUES
(3, 'Sreeshna', 'sree4102004@gmail.com', '9238834461', 'Thuruthel (H)\r\nNeendapara P.O\r\nNeendapara', 2, 'demo-women-user-650x800-2.jpg.webp', 'Sree@111'),
(6, 'Jane Elizabeth', 'jananiharini4551@gmail.com', '9238832641', 'Townville (H)\r\nKadathy, Muvattupuzha', 4, 'sara.png', 'Janani@1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminreg`
--
ALTER TABLE `tbl_adminreg`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `tbl_maincategory`
--
ALTER TABLE `tbl_maincategory`
  ADD PRIMARY KEY (`mcategory_id`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminreg`
--
ALTER TABLE `tbl_adminreg`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `tbl_maincategory`
--
ALTER TABLE `tbl_maincategory`
  MODIFY `mcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
