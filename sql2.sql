-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.11-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица yii2rabota.schedule
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.schedule: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
REPLACE INTO `schedule` (`id`, `name`) VALUES
	(1, 'Полный день'),
	(2, 'Сменный график'),
	(3, 'Гибкий график'),
	(4, 'Удалённая работа'),
	(5, 'Вахтовый метод'),
	(6, 'По часу вечерами');
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.migration: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1605879298),
	('m201120_133356_create_user_table', 1605879402);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.experience
DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `date1` date NOT NULL,
  `date2` date NOT NULL,
  `organization` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `duties` text DEFAULT NULL,
  `month1` int(11) NOT NULL DEFAULT 0,
  `year1` int(11) NOT NULL DEFAULT 0,
  `month2` int(11) NOT NULL DEFAULT 0,
  `year2` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `resume_id` (`resume_id`),
  CONSTRAINT `FK_experience_resume` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.experience: ~13 rows (приблизительно)
/*!40000 ALTER TABLE `experience` DISABLE KEYS */;
REPLACE INTO `experience` (`id`, `resume_id`, `date1`, `date2`, `organization`, `position`, `duties`, `month1`, `year1`, `month2`, `year2`) VALUES
	(20, 2, '2003-02-01', '2009-03-01', 'ООО Бунгалопешт', 'фракер', 'Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа соответствующий условий активизации. С другой стороны реализация намеченных плановых заданий позволяет оценить значение дальнейших направлений развития. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет оценить значение форм развития. С другой стороны постоянный количественный рост и сфера нашей активности требуют от нас анализа модели развития. Идейные соображения высшего порядка, а также сложившаяся структура организации способствует подготовки и реализации соответствующий условий активизации. Равным образом новая модель организационной деятельности позволяет выполнять важные задания по разработке систем массового участия.', 1, 2003, 3, 2009),
	(21, 5, '2009-04-01', '2020-07-01', 'ООО ГазпромНефть', 'Собиратель бутылок', 'Бутылировал Воду, для офисных крыс', 4, 2009, 7, 2020),
	(31, 11, '2008-02-01', '2009-04-01', 'КГБ', 'Женщина на проходной', 'Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа соответствующий условий активизации. С другой стороны реализация намеченных плановых заданий позволяет оценить значение дальнейших направлений развития. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет оценить значение форм развития. С другой стороны постоянный количественный рост и сфера нашей активности требуют от нас анализа модели развития. Идейные соображения высшего порядка, а также сложившаяся структура организации способствует подготовки и реализации соответствующий условий активизации. Равным образом новая модель организационной деятельности позволяет выполнять важные задания по разработке систем массового участия.', 2, 2008, 4, 2009),
	(47, 8, '2008-03-01', '2009-02-01', 'Стройка у дома', 'Строитель', 'Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа соответствующий условий активизации. С другой стороны реализация намеченных плановых заданий позволяет оценить значение дальнейших направлений развития. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет оценить значение форм развития. С другой стороны постоянный количественный рост и сфера нашей активности требуют от нас анализа модели развития. Идейные соображения высшего порядка, а также сложившаяся структура организации способствует подготовки и реализации соответствующий условий активизации. Равным образом новая модель организационной деятельности позволяет выполнять важные задания по разработке систем массового участия.', 3, 2008, 2, 2009),
	(48, 8, '2009-02-01', '2012-02-01', 'Магазин "Косынка"', 'грузчик', 'Равным образом новая модель организационной деятельности позволяет выполнять важные задания по разработке систем массового участия.', 2, 2009, 2, 2001),
	(53, 3, '2008-01-01', '2009-04-01', 'Кгб', 'принт', 'ываыва', 1, 2008, 4, 2009),
	(56, 1, '2001-01-01', '2020-03-01', 'ООО Инфософт', 'Программист', 'In case you use an yii\\db\\Expression object as in the example above, the attribute will not hold the timestamp value, but the Expression object itself after the record has been saved. If you need the value from DB afterwards you should call the refresh() method of the record.\r\n\r\nTimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,', 1, 2001, 3, 2020),
	(57, 9, '2003-01-01', '2009-03-01', 'ООО Бунгалопешт', 'Фракер', 'Задача организации, в особенности же рамки и место обучения кадров требуют от нас анализа дальнейших направлений развития. Повседневная практика показывает, что новая модель организационной деятельности в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что сложившаяся структура организации позволяет оценить значение модели развития. Разнообразный и богатый опыт рамки и место обучения кадров играет важную роль в формировании дальнейших направлений развития. Равным образом укрепление и развитие структуры представляет собой интересный эксперимент проверки модели развития. Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий позволяет оценить значение дальнейших направлений развития.\r\n\r\n', 1, 2003, 3, 2009),
	(58, 9, '2009-04-01', '2020-07-01', 'AO Кладбище через дорогу', 'Кладбищенская девка', 'Задача организации, в особенности же рамки и место обучения кадров требуют от нас анализа дальнейших направлений развития. Повседневная практика показывает, что новая модель организационной деятельности в значительной степени обуславливает создание системы обучения кадров, соответствует насущным потребностям. Не следует, однако забывать, что сложившаяся структура организации позволяет оценить значение модели развития. Разнообразный и богатый опыт рамки и место обучения кадров играет важную роль в формировании дальнейших направлений развития. Равным образом укрепление и развитие структуры представляет собой интересный эксперимент проверки модели развития. Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий позволяет оценить значение дальнейших направлений развития.\r\n\r\n', 4, 2009, 7, 2020),
	(65, 14, '2001-03-01', '2008-01-01', 'СТО 12', 'Шиномонтажница', 'Могу делать такие работы  2.1. разбортовка колес; 2.2. забортовка колес; 2.3. балансировка колес; 2.4. финишная балансировка колес; 2.5. установка и замена камеры; 2.6. снятие и установка колес; 2.7. накачка колес азотом; 2.8. технологическая мойка колес; 2.9. проверка колес на герметичность; 2.10. герметизация борта шины; 2.11. подкачка колес; 2.12. подкачка колес азотом; 2.13. диагностика колес; 2.14. регулировка развал-схождение колес; 2.15. ремонт колес: - установка жгута; - установка камерной заплаты; - установка грибка; - установка пластыря; 2.16. замена масла; 2.17. замена тормозных колодок; 2.18. замена амортизаторов; 2.19. ремонт подвески; 2.20. ремонт сцепления; 2.21. обслуживание кондиционеров; 2.22. правка дисков; 2.23. замена тормозной жидкости; 2.24. замена охлаждающей жидкости; 2.25. замена масла в автоматической коробке передач; 2.26. очистка инжекторов (форсунок); 2.27. диагностика двигателя; 2.28. замена ремней ГРМ, ГУР, генераторов.\r\nИсточник: http://prom-nadzor.ru/content/dolzhnostnaya-instrukciya-rabotnika-shinomontazha', 3, 2001, 1, 2008),
	(66, 14, '2003-02-01', '2009-04-01', 'Бунгалопешт', 'подстилка', '', 2, 2003, 4, 2009),
	(69, 13, '2008-04-01', '2003-03-01', 'Свойская организация', 'Секретарша', 'Ой, все...', 4, 2008, 3, 2003),
	(70, 13, '2003-01-01', '2001-06-01', 'Магазин "Косынка"', 'Продавщица', 'Продавала капусту', 1, 2003, 6, 2001);
/*!40000 ALTER TABLE `experience` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.resume
DROP TABLE IF EXISTS `resume`;
CREATE TABLE IF NOT EXISTS `resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `about` text DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `zp` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `specialization_id` (`specialization_id`),
  CONSTRAINT `FK_resume_specializations` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_resume_user` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.resume: ~13 rows (приблизительно)
/*!40000 ALTER TABLE `resume` DISABLE KEYS */;
REPLACE INTO `resume` (`id`, `author_id`, `first_name`, `middle_name`, `last_name`, `birthdate`, `sex`, `city`, `mail`, `phone`, `specialization_id`, `about`, `foto`, `zp`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Геннадий', 'Кульбитович', 'Кирпичев ', '1988-11-03', '1', 'Иркутск', 'hjklhjkl@sdf.df', '+798444444444', 4, 'Усидчивый, и стройный. Есть спининг, наволочка и кот.', 'uploads/6631025eb6e96b2ac8be12c72460d6e6.jpg', 16900, 1606157105, 1606376402),
	(2, 2, 'Рудик', 'Файлихович', 'Горин', '1984-08-04', '1', 'Томск', 'rudik@sdf.df', '+798444444444', 7, 'Поддержка пользователей по электронной почте и телефону. Поиск, локализация и решение проблем. Инсталляция решений на базе CommuniGate Pro, обеспечение миграции.\r\nОконченное высшее техническое образование в ВУЗе. Опыт поддержки решений IP телефонии любого производителя (Microsoft Lync Server, Asterisk и др).', 'uploads/20d12f38343bc7345bf85e272361921e.jpg', 35000, 1606157105, 1606157105),
	(3, 1, 'Павел', 'Александрович', 'Захаров', '1985-01-07', '1', 'Москва', 'p.a.zakharov@gmail.com', '+79149406648', 3, 'Скромный опыт в коммерческой веб разработке компенсирую огромным желанием работать и отличным багажом знаний. Всегда интересовался (само практиковался ) именно web инжинирингом , но почему то выбирал смежную занятость. Приходилось и руководить отделами в интернет-магазине, и свой магазин развивать. Успешного опыта много, но понял, что мне нужна именно разработка.\r\nОчень надеюсь надеюсь на ответ из вашей компании.\r\nЧто могу предложить как специалист? На данный момент совершенствую свои знания в области веб разработки просто пушечными темпами, отлично помогает знание английского языка. С закрытыми глазами могу развернуть рабочее окружение, использую редактор phpStorm и много его плюшек. LAMP server или Docer неважно.\r\nВерстаю HTML уверенно быстро , использую SASS, но чаще SCSS для препроцессинга CSS3, пишу на Laravel логику сайтов, достаточно неплохо получается. Запросы к базе ORM и прямые. Стараюсь придерживаться SOLID. Так же всегда пользуюсь контролем версий, раньше пользовался SVN, теперь конечно Git().\r\nИщу удаленную работу, с возможен будущий переезд и работа в офисе. Готов выполнить тестовое задание.', 'uploads/57bc0aa58fa55c282a88a64f16d14fca.jpg', 35000, 1606157105, 1606302522),
	(4, 1, 'Мхаил', 'Людвигович', 'Крыжановский', '1992-10-10', '1', 'Казань', 'hjklhjkl@sdf.df', '+798444444444', 4, 'Обработка писем от пользователей «Электричек»: написание ответа, уточнение деталей, пересылка при необходимости, передача обратной связи руководителю продукта и разработчикам.\r\nОбязательно грамотное письмо. Понимание общих принципов работы пригородного железнодорожного транспорта. Опыт взаимодействия с «Электрички Туту» или «Яндекс.Расписания». Понимание потенциальных болей...', 'uploads/9d4be97bb3bde6cc45f66570ae8cfe42.jpg', 16500, 1606157105, 1606385141),
	(5, 1, 'Егор', 'Александрович', 'Митин', '1981-08-05', '1', 'Казань', 'mitin@sdf.df', '+791496565458', 8, 'Образование высшее профильное, знание программ: Adobe (InDesign, Photoshop, Illustrator, Acrobat) CorelDraw, Microsoft Word, Excel, Outlook.\r\nПлатформа -РС.\r\nЗнание типографики, владение основными приемами управления ею.\r\nЗнание технических требований для предпечатной подготовки разных видов полиграфической продукции (упаковки, этикетки, рекламных листовок и буклетов, макетов в прессу, наружной рекламы, выставочных стендов, оформления торговых точек).\r\nУмение работать в сети Интернет, в.ч. с поисковыми машинами и фотобанками.\r\nАнглийский со словарем.', 'uploads/48f904538e7d458f065a40132d6be01e.jpg', 12500, 1606157105, 1606157105),
	(6, 1, 'Жора', 'Дмитриевич', 'Кирпичев ', '1975-11-22', '1', 'Ханты-Мансийск', 'jora@sdf.df', '+798444444444', 13, 'Подключение абонентов физических и юридических лиц. Диагностика и устранение неисправностей. Установка сетевого оборудования, подключение роутеров, ТВ-приставок.\r\n', 'uploads/e5fc7630a1b72902bb6243c4df27583c.jpg', 25000, 1606157105, 1606302935),
	(7, 1, 'Солнцев', 'Артурович', 'Гаген', '1989-02-28', '1', 'Братск', 'p.a.zakharov@gmail.com', '+798444444444', 1, 'Грамотное изложение своих мыслей устно и письменно. Знание ПК на уровне уверенного пользователя. Логическое мышление, структурность. Готовность к интенсивному обучению.', 'uploads/71c82889bf2dc50b5ac35c070d209ead.jpg', 150000, 1606157105, 1606303027),
	(8, 1, 'Кузя', 'Рубинович', 'Финоров', '1988-12-11', '1', 'Алматы', 'jora@sdf.df', '+79149406648', 14, 'По присланному логу понять, что вообще произошло на сервере и что теперь с этим делать. Проконтролировать, что проблема решена, и...\r\nУмеете находить общий язык с разработчиками и заказчиками. Ответственно относитесь к срокам, которые сами озвучили. Пишете правильно по-русски, и...', 'uploads/1ee74df241c77f727a49da4650692c36.jpg', 11400, 1606157105, 1606198875),
	(9, 1, 'Вера ', 'Петровна', 'Царева', '1996-11-23', '2', 'Кострома', 'vera@s2df.df', '+79149406648', 14, 'Оказание удалённой помощи клиентам компании. Приём и исполнение заявок по устранению неисправностей в работе компьютеров, орг. техники, смартфонам и любым...\r\nЗнание VPN (Cisco, PaloAlto, OpenVPN). Работы в AD, RDP. Знание конфигурирования маршрутизаторов Cisco\\Huawei. Знание монтажа сетевого оборудования.', 'uploads/d167bb832e30d6d79b9008932ac3874b.jpg', 50000, 1606157105, 1606382134),
	(10, 1, 'Василий', 'Николаевич', 'Джонов', '1975-11-11', '1', 'Ладога', 'jo@sdf.df', '+798444444444', 13, 'С другой стороны сложившаяся структура организации влечет за собой процесс внедрения и модернизации систем массового участия. Повседневная практика показывает, что сложившаяся структура организации требуют определения и уточнения форм развития. Разнообразный и богатый опыт сложившаяся структура организации обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития. Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки новых предложений. С другой стороны новая модель организационной деятельности требуют от нас анализа направлений прогрессивного развития. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание форм развития.\r\n\r\n', 'uploads/52991f046672ca51bbbd76b95d357cbe.jpg', 35000, 1606157105, 1606157105),
	(11, 1, 'Василий', 'Николаевич', 'Джонов', '2000-11-03', '1', 'Ладога', 'jo@sdf.df', '+798444444444', 13, 'С другой стороны сложившаяся структура организации влечет за собой процесс внедрения и модернизации систем массового участия. Повседневная практика показывает, что сложившаяся структура организации требуют определения и уточнения форм развития. Разнообразный и богатый опыт сложившаяся структура организации обеспечивает широкому кругу (специалистов) участие в формировании дальнейших направлений развития. Значимость этих проблем настолько очевидна, что постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки новых предложений. С другой стороны новая модель организационной деятельности требуют от нас анализа направлений прогрессивного развития. Задача организации, в особенности же постоянный количественный рост и сфера нашей активности в значительной степени обуславливает создание форм развития.\r\n\r\n', 'uploads/25c022909cc725aee9eb90a6a5ac5991.jpg', 35000, 1606157105, 1606157105),
	(12, 3, 'Жора', 'Николаевич', 'Финоров', '1987-11-03', '1', 'Барнаул', 'p.a.zakharov@gmail.com', '+798444444444', 5, '', 'uploads/70c0face6b54d13ca050f16a949eb2de.jpg', 12500, 1606303162, 1606303162),
	(13, 1, 'Екатерина', 'Петровна', 'Зубова', '1987-11-26', '2', 'Стамбул', 'jora@sdf.df', '+798444444444', 4, 'Усидчивая', 'uploads/dc640af831fb68876de8d9378628c81c.jpg', 12500, 1606394006, 1606408175),
	(14, 1, 'Надежда', 'Валентиновна', 'Дурова', '2000-11-17', '2', 'Москва', 'jo22ra@sdf.df', '+79149406648', 19, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget.', '\r\nuploads/cff5711bacc771ac0eeb871878426efe.jpg', 16500, 1606407413, 1606407540);
/*!40000 ALTER TABLE `resume` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.resumeschedule
DROP TABLE IF EXISTS `resumeschedule`;
CREATE TABLE IF NOT EXISTS `resumeschedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resume_id` (`resume_id`),
  KEY `schedule_id` (`schedule_id`),
  CONSTRAINT `FK_resumeschedule_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`),
  CONSTRAINT `FK_resumeschedule_resume` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=442 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.resumeschedule: ~42 rows (приблизительно)
/*!40000 ALTER TABLE `resumeschedule` DISABLE KEYS */;
REPLACE INTO `resumeschedule` (`id`, `resume_id`, `schedule_id`) VALUES
	(21, 2, 1),
	(22, 2, 3),
	(23, 2, 4),
	(52, 5, 1),
	(53, 5, 5),
	(54, 5, 6),
	(315, 10, 2),
	(316, 10, 5),
	(321, 11, 2),
	(322, 11, 5),
	(356, 8, 1),
	(357, 8, 3),
	(358, 8, 5),
	(370, 3, 2),
	(371, 3, 6),
	(384, 6, 2),
	(385, 6, 3),
	(386, 6, 6),
	(391, 7, 2),
	(392, 7, 3),
	(393, 7, 5),
	(394, 7, 6),
	(395, 12, 4),
	(396, 12, 5),
	(403, 1, 2),
	(404, 1, 3),
	(405, 1, 6),
	(406, 9, 1),
	(407, 9, 2),
	(408, 9, 3),
	(409, 9, 4),
	(410, 9, 6),
	(413, 4, 3),
	(414, 4, 6),
	(431, 14, 1),
	(432, 14, 2),
	(433, 14, 3),
	(434, 14, 4),
	(435, 14, 6),
	(439, 13, 2),
	(440, 13, 4),
	(441, 13, 6);
/*!40000 ALTER TABLE `resumeschedule` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.ResumeEmployment
DROP TABLE IF EXISTS `ResumeEmployment`;
CREATE TABLE IF NOT EXISTS `ResumeEmployment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resume_id` int(11) NOT NULL,
  `employment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `resume_id` (`resume_id`),
  KEY `employment_id` (`employment_id`),
  CONSTRAINT `FK_ResumeEmployment_resume` FOREIGN KEY (`resume_id`) REFERENCES `resume` (`id`),
  CONSTRAINT `FK_ResumeEmployment_employments` FOREIGN KEY (`employment_id`) REFERENCES `employments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.ResumeEmployment: ~35 rows (приблизительно)
/*!40000 ALTER TABLE `ResumeEmployment` DISABLE KEYS */;
REPLACE INTO `ResumeEmployment` (`id`, `resume_id`, `employment_id`) VALUES
	(33, 5, 1),
	(34, 5, 2),
	(35, 5, 3),
	(36, 5, 4),
	(37, 5, 5),
	(128, 10, 1),
	(129, 10, 3),
	(130, 10, 5),
	(137, 11, 1),
	(138, 11, 3),
	(139, 11, 5),
	(158, 8, 2),
	(159, 8, 3),
	(171, 3, 1),
	(172, 3, 3),
	(181, 6, 3),
	(182, 6, 5),
	(185, 7, 2),
	(186, 7, 3),
	(187, 12, 2),
	(188, 12, 3),
	(195, 1, 1),
	(196, 1, 3),
	(197, 1, 5),
	(198, 9, 1),
	(199, 9, 4),
	(202, 4, 1),
	(203, 4, 4),
	(218, 14, 1),
	(219, 14, 2),
	(220, 14, 4),
	(221, 14, 5),
	(225, 13, 2),
	(226, 13, 4),
	(227, 13, 5);
/*!40000 ALTER TABLE `ResumeEmployment` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.specializations
DROP TABLE IF EXISTS `specializations`;
CREATE TABLE IF NOT EXISTS `specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.specializations: ~26 rows (приблизительно)
/*!40000 ALTER TABLE `specializations` DISABLE KEYS */;
REPLACE INTO `specializations` (`id`, `name`) VALUES
	(1, 'Администратор баз данных'),
	(2, 'Аналитик'),
	(3, 'Арт-директор'),
	(4, 'Инженер'),
	(5, 'Компьютерная безопасность'),
	(6, 'Контент'),
	(7, 'Маркетинг'),
	(8, 'Мультимедиа'),
	(9, 'Оптимизация сайта (SEO)'),
	(10, 'Передача данных и доступ в интернет'),
	(11, 'Программирование, Разработка'),
	(12, 'Продажи'),
	(13, 'Продюсер'),
	(14, 'Развитие бизнеса'),
	(15, 'Системный администратор'),
	(16, 'Системы управления предприятием (ERP)'),
	(17, 'Сотовые, Беспроводные технологии'),
	(18, 'Стартапы'),
	(19, 'Телекоммуникации'),
	(20, 'Тестирование'),
	(21, 'Технический писатель'),
	(22, 'Управление проектами'),
	(23, 'Электронная коммерция'),
	(24, 'CRM системы'),
	(25, 'Web инженер'),
	(26, 'Web мастер');
/*!40000 ALTER TABLE `specializations` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `is_admin` smallint(6) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы yii2rabota.user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `created_at`, `updated_at`, `is_admin`) VALUES
	(1, 'admin', 'gw-4mKP72HlppdMO-hZEGr2dfguznxF3', '$2y$13$RLa85B08aDJczyGhoJMgP.Ul6DCjxZfupvKdW33Yigwrkn0IU9Yte', NULL, 'admin@45dd6456.ey', 1605880337, 1605880337, 1),
	(2, 'Кувалда', '4TE1OtiIm2tNP0x6pM4GOEegCOmNrr8K', '$2y$13$6sYtjzIpnhln3/9PpmLAo.j1QHHtwMd6NpK.aYIbIPZx8xeefJFFW', NULL, 'kuva@kjdf.sd', 1605886483, 1605886483, 0),
	(3, 'Сачек', 'JuI9xVZl1t_keFqIuTU38fw_Ne_eYebN', '$2y$13$QC1MitQutGNAasepTdjN8.t1C7sGju2uXvFTrVURBthtrvm84gxUm', NULL, 'ewr@klmsd.sdf', 1606303070, 1606303070, 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Дамп структуры для таблица yii2rabota.employments
DROP TABLE IF EXISTS `employments`;
CREATE TABLE IF NOT EXISTS `employments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yii2rabota.employments: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `employments` DISABLE KEYS */;
REPLACE INTO `employments` (`id`, `name`) VALUES
	(1, 'Полная занятость'),
	(2, 'Частичная занятость'),
	(3, 'Проектная/Временная работа'),
	(4, 'Волонтёрство'),
	(5, 'Стажировка');
/*!40000 ALTER TABLE `employments` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
