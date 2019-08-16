-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.6-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных test_rubric
CREATE DATABASE IF NOT EXISTS `test_rubric` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `test_rubric`;

-- Дамп структуры для таблица test_rubric.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` char(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.category: ~11 rows (приблизительно)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `category_name`, `parent_id`) VALUES
	(42, 'Телефоны', 0),
	(43, 'Телевизоры', 0),
	(44, 'Компьютеры', 0),
	(45, 'Мебель', 0),
	(46, 'Сотовые телефоны', 42),
	(47, 'Смартфоны', 42),
	(48, 'Ламповые телевизоры', 43),
	(49, 'Черно-белые телевизоры', 43),
	(50, 'Ноутбуки', 44),
	(51, 'Настольные компьютеры', 44),
	(52, 'Игровые компьютеры', 51),
	(53, 'Игровые ТОП', 52);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.price
CREATE TABLE IF NOT EXISTS `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `type` char(50) NOT NULL DEFAULT '0.00',
  `price_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.price: ~0 rows (приблизительно)
DELETE FROM `price`;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
/*!40000 ALTER TABLE `price` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` char(50) NOT NULL,
  `code` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.product: ~0 rows (приблизительно)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.product_to_category
CREATE TABLE IF NOT EXISTS `product_to_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.product_to_category: ~0 rows (приблизительно)
DELETE FROM `product_to_category`;
/*!40000 ALTER TABLE `product_to_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_to_category` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.properties
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `properties_name` char(50) NOT NULL,
  `properties_value` char(50) NOT NULL,
  `units` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.properties: ~0 rows (приблизительно)
DELETE FROM `properties`;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
