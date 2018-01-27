-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.30-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.category: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `category_name`, `parent_id`) VALUES
	(29, 'Бумага', 0),
	(30, 'Бумага', 29),
	(31, 'Категория 1  3уровень', 30),
	(32, 'Категория 1 4 уровень', 31),
	(33, 'Офисная техника', 0),
	(34, 'Принтеры', 33);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.density
CREATE TABLE IF NOT EXISTS `density` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.density: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `density` DISABLE KEYS */;
INSERT INTO `density` (`id`, `value`) VALUES
	(1, 90),
	(2, 100),
	(3, 120),
	(4, 135),
	(5, 160),
	(6, 170),
	(7, 200),
	(8, 220),
	(9, 250);
/*!40000 ALTER TABLE `density` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.format
CREATE TABLE IF NOT EXISTS `format` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` char(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.format: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `format` DISABLE KEYS */;
INSERT INTO `format` (`id`, `value`) VALUES
	(1, 'A3'),
	(2, 'A4'),
	(3, 'A5');
/*!40000 ALTER TABLE `format` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` char(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `format` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `white` int(11) NOT NULL,
  `density` int(11) NOT NULL,
  `price_basic` decimal(10,2) NOT NULL,
  `price_moscow` decimal(10,2) NOT NULL,
  `code` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.product: ~14 rows (приблизительно)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `product_name`, `category_id`, `format`, `type`, `white`, `density`, `price_basic`, `price_moscow`, `code`, `parent_id`) VALUES
	(16, 'продукт 1 -1', 29, 0, 0, 100, 1, 100.00, 150.00, 35, 30),
	(17, 'продукт 1- 2', 29, 0, 0, 0, 2, 500.00, 22.00, 36, 30),
	(18, 'продукт 2-1', 30, 0, 0, 0, 3, 250.00, 5.00, 37, 30),
	(19, 'продукт 2-2', 30, 0, 0, 200, 1, 131.00, 6.00, 38, 30),
	(20, 'продукт 3-1', 31, 0, 0, 0, 2, 10000.00, 7.00, 56, 31),
	(21, 'продукт 3-2', 31, 0, 0, 0, 3, 25000.00, 4.00, 123, 31),
	(22, 'продукт4-1', 32, 0, 0, 150, 1, 2500.00, 3.00, 34, 32),
	(23, 'продукт4-2', 32, 0, 0, 0, 0, 999.00, 2.00, 45, 32),
	(24, 'продукт 111', 33, 1, 1, 0, 0, 15000.00, 1.00, 23, 34),
	(25, 'продукт 222', 34, 1, 1, 0, 0, 15000.00, 10.00, 44, 34),
	(34, 'Бумага А4', 0, 0, 0, 150, 2, 11.50, 12.50, 201, 30),
	(35, 'Бумага А3', 0, 0, 0, 100, 1, 18.50, 22.50, 202, 30),
	(36, 'Принтер Canon', 0, 2, 1, 0, 0, 3010.00, 3500.00, 302, 34),
	(37, 'Принтер HP', 0, 1, 1, 0, 0, 3310.00, 2999.00, 305, 34);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Дамп структуры для таблица test_rubric.type
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы test_rubric.type: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`id`, `value`) VALUES
	(1, 'Лазерный'),
	(2, 'Струйный'),
	(3, 'Матричный');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
