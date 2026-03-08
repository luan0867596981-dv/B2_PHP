-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for techzone
CREATE DATABASE IF NOT EXISTS `techzone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `techzone`;

-- Dumping structure for table techzone.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table techzone.categories: ~0 rows (approximately)
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Laptop'),
	(2, 'PC - Máy tính để bàn'),
	(3, 'Chuột'),
	(4, 'Bàn phím'),
	(5, 'Màn hình'),
	(6, 'Tai nghe'),
	(7, 'Loa'),
	(8, 'Webcam'),
	(9, 'Ổ cứng HDD'),
	(10, 'Ổ cứng SSD'),
	(11, 'RAM'),
	(12, 'Card đồ họa'),
	(13, 'Bo mạch chủ'),
	(14, 'Nguồn máy tính'),
	(15, 'Tản nhiệt CPU'),
	(16, 'Case máy tính'),
	(17, 'Laptop Gaming'),
	(18, 'Laptop Văn phòng'),
	(19, 'Phụ kiện laptop'),
	(20, 'Bàn di chuột'),
	(21, 'USB'),
	(22, 'Thẻ nhớ'),
	(23, 'Router Wifi'),
	(24, 'Thiết bị mạng'),
	(25, 'Micro'),
	(26, 'Camera'),
	(27, 'Ghế gaming');

-- Dumping structure for table techzone.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table techzone.orders: ~0 rows (approximately)

-- Dumping structure for table techzone.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table techzone.order_items: ~0 rows (approximately)

-- Dumping structure for table techzone.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(12,2) DEFAULT NULL,
  `discount` int DEFAULT '0',
  `image` text,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_products_category` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table techzone.products: ~11 rows (approximately)
INSERT INTO `products` (`id`, `name`, `description`, `price`, `discount`, `image`, `category_id`, `created_at`) VALUES
	(1, 'Chuột Bluetooth Gaming Logitech Pro X Superlight 2C', 'Chuột gaming không dây Logitech', 4335000.00, 8, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/86/356831/chuot-bluetooth-gaming-logitech-pro-x-superlight-2c-den-1-638947438105562248-750x500.jpg', 3, '2026-03-06 10:14:03'),
	(2, 'Miếng lót chuột Razer Firefly V2 Hard Surface Mat', 'Miếng lót chuột gaming RGB', 1390000.00, 5, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/6858/357841/mieng-lot-chuot-razer-firefly-v2-hard-surface-mat-1-638962274566688518-750x500.jpg', 6, '2026-03-06 10:14:03'),
	(3, 'Giá treo màn hình HyperWork Alpha Pro HPW-GMA02 Đen', 'Giá treo màn hình cao cấp', 850000.00, 0, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/13658/336826/gia-treo-man-hinh-hyperwork-alpha-pro-hpw-gma02-den-1-638801708277599999-750x500.jpg', 6, '2026-03-06 10:14:03'),
	(4, 'Màn hình Samsung ViewFinity S5 34 inch', 'Màn hình 3K 100Hz', 6290000.00, 0, 'https://cdn.tgdd.vn/Products/Images/5697/322529/samsung-viewfinity-s5-s50gc-ls34c500gaexxv-34-inch-3k-den-1-1-750x500.jpg', 5, '2026-03-06 10:14:03'),
	(5, 'Bàn phím cơ Bluetooth Razer BlackWidow V4', 'Bàn phím cơ gaming', 3390000.00, 0, 'https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/4547/357645/ban-phim-co-bluetooth-razer-blackwidow-v4-tenkeyless-hyperspeed-orange-tactile-switch-01-638956073717751775-750x500.jpg', 4, '2026-03-06 10:14:03'),
	(6, 'Lenovo Legion Y9000P 2025', 'Laptop gaming RTX 5070Ti', 75990000.00, 0, 'https://ttcenter.com.vn/uploads/product/uonlusl5-2057-lenovo-legion-y9000p-2025-ultra-9-275hx-32gb-1tb-rtx-5070ti-12gb-16-2-5k-240hz-new.jpg', 1, '2026-03-06 10:14:03'),
	(7, 'Lenovo Legion 5 15AHP10', 'Laptop gaming Ryzen 7', 32990000.00, 0, 'https://ttcenter.com.vn/uploads/product/yjmz0ahh-2427-lenovo-legion-5-15ahp10-ryzen-7-260-16gb-512gb-rtx-5060-15-wqxga-oled-new.jpg', 1, '2026-03-06 10:14:03'),
	(8, 'Lenovo Legion R9000P 2025', 'Laptop gaming Ryzen 9', 41990000.00, 0, 'https://ttcenter.com.vn/uploads/photos/1748418836_3998_cb8a737caebc81e662b5df6bf08720a5.jpg', 1, '2026-03-06 10:14:03'),
	(9, 'ASUS ROG Strix G16', 'Laptop gaming cao cấp', 47990000.00, 0, 'https://ttcenter.com.vn/uploads/product/00cnn2j7-2123-asus-rog-strix-g16-g615jpr-s5107w-intel-core-i7-14650hx-32gb-1tb-rtx-5070-8gb-16-inch-2-5k-ips-240hz-new.jpg', 1, '2026-03-06 10:14:03'),
	(10, 'Chuột gaming Attack Shark R1', 'Chuột gaming giá rẻ', 499000.00, 0, 'https://ttcenter.com.vn/uploads/product/vivrl7vo-2523-chuot-gaming-attack-shark-r1-new.jpg', 3, '2026-03-06 10:14:03'),
	(11, 'PC CPS Quantum Blaze 5070', 'Dung lượng RAM 32GB\r\n\r\nCPU Intel Core i7 14700KF\r\n\r\nVGA MSI GeForce RTX 5070 12GB VENTUS 2X OC\r\n\r\nRam PC Kingston Fury DDR5 5600MHz 32GB (2*16) KF556C40BBK2-32WP\r\n\r\nỔ cứng SSD Kingston NV3 PCIe 4.0 NVMe 1TB\r\n\r\nMainboard MSI Z790 Gaming Plus WF DDR5\r\n\r\nTản nhiệt nước MSI Mag Coreliquid A13 360\r\nBộ 3 quạt Xigmatek Starlink Ultra A-RGB\r\n\r\nChipset (PC lắp ráp) Z790', 54000000.00, 0, 'https://cdn2.cellphones.com.vn/x/media/catalog/product/1/-/1-96_1_4.png?_gl=1*1lpa3r0*_gcl_au*NjQ1Mzg5ODgzLjE3NzI3OTczMTY.*_ga*NjY1MjM4NzEwLjE3NTkyMzc5MTE.*_ga_QLK8WFHNK9*czE3NzI3OTczMTYkbzQkZzEkdDE3NzI3OTc0MTkkajM2JGwwJGg5ODczODc5Mg..', 2, '2026-03-06 11:52:53');

-- Dumping structure for table techzone.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table techzone.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'Admin', 'admin@techzone.com', '123456', 'admin', '2026-03-06 10:17:08'),
	(2, 'user1', 'user1@gmail.com', '123456', 'user', '2026-03-06 10:17:08'),
	(3, 'user2', 'user2@gmail.com', '123456', 'user', '2026-03-06 10:17:08');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
