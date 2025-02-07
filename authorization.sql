-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Фев 07 2025 г., 21:38
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `authorization`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `created_task_user_id` int NOT NULL,
  `send_task_user_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL,
  `created_data` date NOT NULL,
  `end_data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `created_task_user_id`, `send_task_user_id`, `title`, `description`, `status`, `created_data`, `end_data`) VALUES
(3, 12, 7, '123', '123', 0, '2025-02-07', '2025-02-23'),
(4, 12, 7, '456', '456', 0, '2025-02-07', '2025-03-23'),
(5, 12, 7, '678', '678', 0, '2025-02-07', '2025-03-12');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `password`) VALUES
(7, 'furzik', 'tom666336@gmail.com', 'uploads/avatar_1738358397.jpg', '$2y$10$mkCwxgZxmhD8N/SXKkkc0Oy89gWBQ8crhDSpwwawL8IXeIi.QNK7u'),
(8, 'test', 'test@gmail.com', 'uploads/avatar_1738364792.jpg', '$2y$10$XsQECHI9WhROZhdaKkuQoOX2ZcveVziL8NnYTbImSNXtqb56xuMti'),
(12, 'sfdvgsdvxc xcvxcvxcvxc', 'superadmin@qwerty.qwerty', 'uploads/avatar_1738924709.png', '$2y$10$UD4GiQZTuYX6ZxYp.NHhJu63e91BR.mk0LNq5Z.4vdFpq7hwrvjxG');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
