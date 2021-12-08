-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 20 2021 г., 19:03
-- Версия сервера: 5.7.25
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `olimpus`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(0, 'Все'),
(1, 'Математика'),
(2, 'Физика'),
(3, 'Литература'),
(4, 'Информатика'),
(5, 'Русский');

-- --------------------------------------------------------

--
-- Структура таблицы `institutions`
--

CREATE TABLE `institutions` (
  `id_institution` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `institutions`
--

INSERT INTO `institutions` (`id_institution`, `name`) VALUES
(0, 'Нет заведения'),
(1, 'ГПАО СО \"Екатеринбургский монтажный колледж\"'),
(2, 'Уральский колледж строительства, архитектуры и предпринимательства'),
(3, 'Уральский Федеральный Университет'),
(4, 'Уральский государственный экономический университет'),
(5, 'Уральский Государственный Горный Университет.'),
(6, 'Екатеринбургский Технику Химического Машиностроения');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id_new` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `data_publisher` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id_new`, `title`, `image`, `text`, `data_publisher`) VALUES
(1, 'Поможем полюбить английский с детства', 'news1112.png', 'Пока ребёнок учится контролировать внимание, ему нужна частая смена занятий. Наши преподаватели учитывают нейрофизиологические особенности детей и дают новые упражнения каждые 5–7 минут, а ещё регулярно устраивают разминку.', '2021-11-05 13:10:57'),
(2, 'Индивидуальные занятия с логопедом', 'logopend.png', 'Для кого:\r\nДля детей от 4 лет\r\nПодходит для любых целей:\r\nРазвитие устной и письменной речи. Коррекция звукопроизношения. Развитие фонематического слуха, звукового анализа и синтеза. Активизация и накопление словаря. Помощь при дисграфии и дислексии.\r\nКак проходят занятия:\r\nЗанятия проходят на нашей платформе с использованием интерактивных заданий и игр. ⠀', '2021-11-05 13:11:53'),
(3, 'Комплексная подготовка детей к школе', 'saxa.png', 'На занятиях ребёнок получит знания, необходимые при поступлении и в обычную школу, и в гимназию, и в лицей.', '2021-11-05 13:15:13'),
(4, 'Олимпиада «Ломоносов»', 'sssa.jpg', 'Факультет психологии федерального государственного бюджетного образовательного учреждения высшего образования «Московский государственный университет имени М.В.Ломоносова» приглашает школьников, обучающихся по программам основного общего и среднего общего образования, принять участие в Олимпиаде «Ломоносов» по психологии.\r\nОлимпиада входит в Перечень олимпиад школьников 2021/2022 учебного года и представляет собой междисциплинарный конкурс, задания которого предполагают проверку знаний из области биологии, математики, литературы и обществознания.\r\nОлимпиада состоит из отборочного и заключительного этапов. Победители и призеры Олимпиады получат льготу в виде зачисления без экзаменов на факультет психологии МГУ имени М.В.Ломоносова.\r\nРегистрация для участия в Олимпиаде доступна с 15 октября по 19 ноября 2021 года.', '2021-11-05 13:16:05');

-- --------------------------------------------------------

--
-- Структура таблицы `olimps`
--

CREATE TABLE `olimps` (
  `id_olimp` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'def.png',
  `text` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `status` varchar(3) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `olimps`
--

INSERT INTO `olimps` (`id_olimp`, `title`, `image`, `text`, `id_category`, `date_start`, `status`) VALUES
(1, 'Русский медвеженок', 'medved_olimp.jpg', '«Русский медвежонок — языкознание для всех» — международный конкурс по языкознанию среди школьников. Проводится с 2000 года. Организаторами конкурса выступают Центр дополнительного образования одарённых школьников, ООО «Слово», ООО «Игра». Научное руководство осуществляет Институт лингвистики', 5, '2021-11-09', 'end'),
(2, 'Я — ПРОФЕССИОНАЛ', 'math.jpg', 'Всероссийская олимпиада для студентов разных направлений подготовки: технических, гуманитарных, социально-экономических, естественно-научных, педагогических, аграрных и медицинских', 1, '2021-11-13', 'end'),
(3, 'Открытая олимпиада «Будущее Сибири»', 'awdwa.jpg', 'Кроме того, к участию во 2-м этапе олимпиады (без участия в 1-м) приглашаются победители и призеры заключительного этапа олимпиады «Будущее Сибири» 2020-2021 года.\r\n\r\n2. При поступлении в вуз в зависимости от общеобразовательного предмета, соответствующего профилю олимпиады и профилю секции конкурса, победителям и призерам олимпиады школьников «Будущее Сибири» (Химия, Физика) (до 25% участников заключительного этапа)предоставляются следующие льготы: при условии получения на ЕГЭ по образовательному предмету соответствующего профиля олимпиады не менее 75 баллов быть зачисленными в вуз без вступительных испытаний на направления подготовки, соответствующие профилю олимпиады,  или зачет 100 баллов по предмету (вместо результата ЕГЭ), соответствующему профилю олимпиады (в зависимости от правил приема в вуз, в который предоставляются результаты).', 2, '2021-11-30', 'new'),
(4, 'Олимпиада школьников «Ломоносов» по физике', 'daaw.jpg', 'Олимпиада «Ломоносов» по физике – это интеллектуальное состязание, основная цель которого состоит в том, чтобы пробудить у участников интерес к этому предмету, показать, как реально «работают» физические законы при описании конкретных явлений в окружающем мире, при их объяснении и предсказании.\n\nДля участия в олимпиаде приглашаются ученики 7–11-х классов средних школ, колледжей и гимназий. Обращаем ваше внимание на то, что предлагаемые на олимпиаде задачи зачастую внешне не похожи на типовые задачи из школьных задачников, поскольку содержат олимпиадную «изюминку». Однако для решения этих задач не требуется знания материала, выходящего за пределы школьных программ по физике и математике. Для победы на олимпиаде по физике нужно уметь строить физические модели, глубоко понимать физические законы и самостоятельно применять их при решении и анализе задач, свободно владеть школьным математическим аппаратом.', 2, '2021-12-31', 'new'),
(5, 'Январские школы «Летово»', 'dawdas.jpg', 'уникальная возможность погрузиться в атмосферу жизни, общения и учебы на кампусе «Летово»\n\nзанятия с учителями «Летово» — уникальными специалистами в своих областях и в олимпиадной подготовке\n\nприоритетное поступление в 9 класс «Летово» в 2022 году', 2, '2021-11-27', 'new');

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

CREATE TABLE `results` (
  `id_result` int(11) NOT NULL,
  `id_olimpus` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_records` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(30) NOT NULL DEFAULT 'Участие'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`id_result`, `id_olimpus`, `id_user`, `date_records`, `position`) VALUES
(1, 1, 1, '2021-11-13 09:19:19', 'Третье'),
(2, 2, 1, '2021-11-13 09:19:37', 'Первое'),
(3, 1, 2, '2021-11-13 09:19:59', 'Участник'),
(4, 2, 2, '2021-11-13 09:20:05', 'Второе'),
(5, 1, 12, '2021-11-13 09:20:51', 'Первое'),
(6, 2, 12, '2021-11-13 09:20:54', 'Участник'),
(7, 1, 14, '2021-11-13 09:21:17', 'Второе'),
(8, 2, 14, '2021-11-13 09:21:21', 'Третье'),
(9, 4, 1, '2021-11-13 10:29:02', 'Участие'),
(10, 5, 17, '2021-11-13 18:22:39', 'Участие'),
(11, 5, 2, '2021-11-16 08:41:22', 'Участие'),
(12, 4, 3, '2021-11-16 12:42:15', 'Участие');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'standart.png',
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'user',
  `id_institution` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `surname`, `patronymic`, `image`, `login`, `password`, `type`, `id_institution`) VALUES
(1, 'Тимофей', 'Кудряшов', 'Робертович', '11.png', 'user1', 'user1', 'user', 2),
(2, 'Евгения', 'Агапова ', 'Владиславовна', '11.png', 'user2', 'user2', 'user', 5),
(3, 'Владислав', 'Рудковский', 'Вадимович', '11.png', 'admin1', 'admin2', 'admin', 2),
(11, 'ssa', 'ssd', 'ssf', 'standart.png', 'user12', 'pass', 'user', 0),
(12, 'Роман', 'Зигурхат', 'Заирович', 'standart.png', 'user4', 'user4', 'user', 5),
(13, 'Гена', 'Буерков', 'Романович', 'standart.png', 'genaNa', 'ural', 'user', 4),
(14, 'Евгений', 'Жуйкин', 'Петров', 'standart.png', 'evgen', 'pup', 'user', 3),
(15, 'Риана', 'Гранде', 'Томаровна', 'standart.png', 'righana', 'rigo', 'user', 2),
(16, 'Дмитрий', 'Рукин', 'Панайотов', 'standart.png', 'dimooooon', 'pass2', 'user', 2),
(17, 'Юля', 'Лукина', 'Петровна', '11.png', 'user14', 'user14', 'user', 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id_institution`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_new`);

--
-- Индексы таблицы `olimps`
--
ALTER TABLE `olimps`
  ADD PRIMARY KEY (`id_olimp`);

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id_result`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id_institution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id_new` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `olimps`
--
ALTER TABLE `olimps`
  MODIFY `id_olimp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
