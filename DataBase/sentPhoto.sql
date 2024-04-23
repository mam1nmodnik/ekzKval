-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 23 2024 г., 09:51
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `q91782vs_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sentPhoto`
--
-- Создание: Апр 18 2024 г., 18:23
-- Последнее обновление: Апр 23 2024 г., 06:51
--

DROP TABLE IF EXISTS `sentPhoto`;
CREATE TABLE `sentPhoto` (
  `id` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `sentUserName` varchar(255) DEFAULT NULL,
  `linkPhoto` varchar(255) DEFAULT NULL,
  `namePhoto` varchar(255) DEFAULT NULL,
  `sentUserId` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sentPhoto`
--
ALTER TABLE `sentPhoto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sentPhoto`
--
ALTER TABLE `sentPhoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
