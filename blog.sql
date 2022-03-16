-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 04 2022 г., 14:41
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Путешествия-1', 'puteshestviya', '2019-01-30 05:54:59', '2019-01-30 06:24:09'),
(2, 'Работа', 'rabota', '2019-01-30 05:55:10', '2019-01-30 05:55:10'),
(3, 'sed', 'sed', '2019-02-14 10:10:41', '2019-02-14 10:10:41'),
(4, 'quia', 'quia', '2019-02-14 10:13:52', '2019-02-14 10:13:52'),
(5, 'amet', 'amet', '2019-02-14 10:13:52', '2019-02-14 10:13:52'),
(6, 'qui', 'qui', '2019-02-14 10:13:52', '2019-02-14 10:13:52'),
(7, 'quae', 'quae', '2019-02-14 10:13:52', '2019-02-14 10:13:52');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `post_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'пробный комментарий', 2, 1, 0, '2019-02-19 05:14:51', '2019-03-03 13:07:53');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_resets_table', 1),
(12, '2017_08_21_060600_create_categories_table', 1),
(13, '2017_08_21_061754_create_tags_table', 1),
(14, '2017_08_21_061848_create_comments_table', 1),
(15, '2017_08_21_061901_create_posts_table', 1),
(16, '2017_08_21_061916_create_subscriptions_table', 1),
(17, '2017_08_21_071211_create_posts_tags_table', 1),
(18, '2017_09_06_091248_add_avatar_column_to_users', 1),
(19, '2017_09_06_105030_make_password_nullable', 1),
(20, '2017_09_11_074000_add_date_to_posts', 1),
(21, '2017_09_11_075734_add_image_to_posts', 1),
(22, '2017_09_11_123410_add_description_to_posts', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `category_id`, `user_id`, `status`, `views`, `is_featured`, `created_at`, `updated_at`, `date`, `image`, `description`) VALUES
(1, 'proba1', 'proba1', '<p>dfhfdh</p>', 2, 1, 0, 0, 1, '2019-02-12 11:57:03', '2019-02-12 12:54:23', '2019-02-10', 'ULcF40dUyy.gif', '<p><img alt=\"\" src=\"/ckfinder/userfiles/files/DSC01491.JPG\" style=\"height:1200px; width:1600px\" />xdfdhfdh</p>'),
(2, 'Iusto voluptatem autem sed quas est aut.', 'iusto-voluptatem-autem-sed-quas-est-aut', 'Et ea porro repudiandae eos sunt.', 1, 1, 1, 2439, 0, '2019-02-14 10:16:39', '2019-02-14 10:16:39', '2017-09-08', 'photo1.png', NULL),
(3, 'Aperiam nemo eum consequatur laborum quibusdam occaecati.', 'aperiam-nemo-eum-consequatur-laborum-quibusdam-occaecati', 'Sint ut tenetur sed officiis vitae.', 1, 1, 1, 4145, 0, '2019-02-14 10:16:39', '2019-02-14 10:16:39', '2017-09-08', 'photo1.png', NULL),
(4, 'Doloribus explicabo quis aut aliquid sunt.', 'doloribus-explicabo-quis-aut-aliquid-sunt', 'Itaque laborum dolor laborum ut natus.', 1, 1, 1, 3316, 0, '2019-02-14 10:16:39', '2019-02-14 10:16:39', '2017-09-08', 'photo1.png', NULL),
(5, 'Est aut ipsa voluptatem aut.', 'est-aut-ipsa-voluptatem-aut', '<p>Eaque aut corporis voluptate ex.</p>', 1, 1, 1, 3314, 0, '2019-02-14 10:16:39', '2019-03-08 18:53:45', '2017-09-08', 'photo1.png', '<p>dghdfgh</p>'),
(7, 'мой первый пост', 'moy-pervyy-post', '<p>asdfasdfas</p>', 1, 1, 1, 0, 1, '2019-03-08 19:02:26', '2019-03-08 19:02:26', '2019-03-08', 'cbUVzCLoC8.jpeg', '<p>sadgsd</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 7, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'тег 1', 'teg-1', '2019-02-12 11:22:27', '2019-02-12 11:22:27'),
(2, 'тег 2', 'teg-2', '2019-02-12 11:22:37', '2019-02-12 11:22:37'),
(3, 'тег 3', 'teg-3', '2019-02-12 11:22:48', '2019-02-12 11:22:48'),
(4, 'culpa', 'culpa', '2019-02-14 10:16:00', '2019-02-14 10:16:00'),
(5, 'quis', 'quis', '2019-02-14 10:16:00', '2019-02-14 10:16:00'),
(6, 'repudiandae', 'repudiandae', '2019-02-14 10:16:00', '2019-02-14 10:16:00'),
(7, 'quis', 'quis-1', '2019-02-14 10:16:00', '2019-02-14 10:16:00'),
(8, 'eligendi', 'eligendi', '2019-02-14 10:16:00', '2019-02-14 10:16:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `status`, `remember_token`, `created_at`, `updated_at`, `avatar`) VALUES
(1, 'user1', 'example@rambler.ru', '$2y$10$mikK9sIOhgcLtAVu80tKQu0EIde998iLfJxN.gB5cpf6WrzrGFA.C', 1, 0, 'Po8SlGC8XfnCV1LONjCWJrprAowmN65rRJTqiAByPearHLimb1MyYm53825f', NULL, NULL, NULL),
(2, 'user2', 'example@gmail.com', '$2y$10$cY1ZC0d2MjnDSNJfOnLF6O.wWywGa0dXBXiggHdkQlmyHRZx2IIwO', 0, 0, 'iX52tFUVxwJGOduS5bFQ6E548cEiVp0ivpyKWguewZ6Hq6PyhdFPgamfbNCF', '2019-02-18 04:53:07', '2019-02-18 04:53:07', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
