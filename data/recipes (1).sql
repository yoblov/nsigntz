-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 03 2017 г., 08:56
-- Версия сервера: 5.7.13
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nsign`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `status`) VALUES
(1, 'Сахар', 1),
(2, 'Молоко', 0),
(3, 'Свинина', 0),
(4, 'Говядина', 0),
(5, 'Баранина', 0),
(6, 'Рис', 0),
(7, 'Картофель', 0),
(8, 'Морковь', 0),
(9, 'Лук', 0),
(10, 'Барбарис', 0),
(11, 'Чеснок', 0),
(12, 'Сыр', 0),
(13, 'Майонез', 0),
(14, 'Соль', 0),
(15, 'Перец', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1498772897),
('m130524_201442_init', 1498772900),
('m170629_222415_create_table_ingredients', 1498776427),
('m170629_222424_create_table_recipes', 1498776427),
('m170629_222438_create_table_recipes_ingredients_rel', 1498785216),
('m170703_051753_admin_user', 1499059248);

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `short_description` text COLLATE utf8_unicode_ci,
  `full_description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `status`, `short_description`, `full_description`) VALUES
(3, 'Плов', 1, 'Узбекский', 'Жарить и варить'),
(4, 'Мясо по-французски', 1, 'Вкусная штука', 'Запекать'),
(5, 'Молочный коктейль', 1, 'Коктейль', 'Взбивать'),
(6, 'Шашлык', 1, 'Нужен ещё уголь и маринад', 'Жарить на природе под пивко'),
(7, 'Рис со свининой', 1, 'Сварить рис', 'Пожарить свинину'),
(8, 'Бутерброд с чесноком сыром и майонезом', 1, 'натереть сыр', 'всё смешать, намазать на хлеб');

-- --------------------------------------------------------

--
-- Структура таблицы `recipes_ingredients_rel`
--

CREATE TABLE IF NOT EXISTS `recipes_ingredients_rel` (
  `rel_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `recipes_ingredients_rel`
--

INSERT INTO `recipes_ingredients_rel` (`rel_id`, `recipe_id`, `ingredient_id`) VALUES
(14, 3, 4),
(15, 3, 6),
(16, 3, 8),
(17, 3, 9),
(18, 4, 4),
(19, 4, 7),
(20, 4, 12),
(21, 4, 13),
(22, 5, 1),
(23, 5, 2),
(24, 6, 3),
(25, 6, 9),
(26, 7, 3),
(27, 7, 6),
(28, 8, 11),
(29, 8, 12),
(30, 8, 13);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` tinyint(1) DEFAULT '0' COMMENT 'user-0,admin-1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `role`) VALUES
(1, 'fintroll', 'zLlAH9eRzsTw8YJvphpcVhyWSF47lpKp', '$2y$13$XXEl.JPnUgCoPZy8X96sJergJfLEK9d.eR/08Y9zqVFK0kMHTzm7i', NULL, 'fintroll66692@gmail.com', 10, 1498774610, 1498774610, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `recipes_ingredients_rel`
--
ALTER TABLE `recipes_ingredients_rel`
  ADD PRIMARY KEY (`rel_id`),
  ADD KEY `fk_recipe_id` (`recipe_id`),
  ADD KEY `fk_ingredient_id` (`ingredient_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `recipes_ingredients_rel`
--
ALTER TABLE `recipes_ingredients_rel`
  MODIFY `rel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `recipes_ingredients_rel`
--
ALTER TABLE `recipes_ingredients_rel`
  ADD CONSTRAINT `fk_ingredient_id` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `fk_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
