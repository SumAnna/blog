-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 07:36 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `comment_text` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `author`, `comment_text`, `ip`, `created_at`) VALUES
(1, 1, 'Клубни_Клубника', 'Я такая КЛаССнАя))0)', '58.162.229.173', '2020-08-06 10:34:01'),
(2, 2, 'Слива Садовая', 'Можно!', '210.56.244.178', '2020-08-06 10:34:04'),
(3, 2, 'Аффтор', 'Нельзя!!!!', '77.244.46.250', '2020-08-06 10:35:15'),
(4, 5, 'Коля', 'Круть', '', '2020-08-06 10:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Текст о себе', 'Текст о себе — то, что кажется таким простым, многим дается лишь с болью и страданиями от «как же уместить в одном тексте всю мою многогранную нестандартную личность и весь жизненный опыт» до «мне совершенно нечего о себе написать».', '2020-08-06 10:25:00'),
(2, 'Можно ли вырастить клубнику на подоконнике', 'Многие считают, что выращивание клубники в домашних условиях — заведомо безнадёжное дело. Разобравшись в особенностях культуры, вы перестанете так думать. Да, растение очень чувствительно к длине светового дня. Однако яркость света мало влияет на урожайность. Опыт Калифорнийского университета доказал это: весь сезон растения содержали в условиях 60% затенения, но урожай при этом уменьшился всего на 20-45%. Поэтому, клубника в горшке на подоконнике растет даже без дополнительной подсветки. Но это не всё. Большое значение имеет тип растения. Именно правильно выбранный тип культуры влияет на успех в этом деле. ', '2020-08-06 10:25:00'),
(3, 'Лотос: восточная святыня в вашем пруду', 'Выбирая себе растение – человек выбирает себе спутника. А спутников не выбирают абы как! Он может быть полезным – и тогда будет выбрано плодовое растение, растение-специя или даже лекарственное растение. Спутник может служить украшением ваших будней – вот и роль для чудесных цветов и душистых листьев! А иногда люди придают растениям глубокий смысл. За их свойства, внешний вид, другие особенности – это не столь важно, важно философское наполнение. И некоторые деревья да цветы преуспели в подобных делах. Какие? Да возьмите хотя бы лотос. Лотос (Nelumbo) – небольшой род растений, представляющий лишь собой целое древнее семейство Лотосовые. На слуху у многих, и это неспроста: лотос играет большую роль в культуре и религиях Востока, таких как индуизм и буддизм. Согласитесь, жизнеутверждающая аналогия так и напрашивается: растущий в мутной воде стоячих водоёмов, лотос всё равно раскрывается прекрасными цветами!.. Символизм неизбежен. Лотос отпечатался в изобразительном искусстве, из его семян делают чётки, его упоминают в мантрах.', '2020-08-06 10:26:49'),
(4, 'Ремонтантная малина и её особенности', 'При выборе саженца малины, большинство продавцов задают такой вопрос — «Вам какую, обычную или ремонтантною?». И тут в голове дачника возникает множество вопросов. Что такое ремонтантность? Это способность растений повторно (или несколько раз) плодоносить во время вегетации. В этом и есть главное отличие. Обычная малина плодоносит один раз на двухлетних побегах, а ремонтантная – несколько раз за сезон, как на однолетних, так и на двухлетних.  Первое описание сортов ремонтантной малины было известно еще 200 лет назад, но их минусом было минимальное количество ягод во вторую волну плодоношения, а в нашем регионе второй урожай совсем не созревал. Долгое время отечественные селекционеры не выводили непрерывно плодоносящие сорта, а зарубежные – плохо росли в наших условиях. Только спустя годы работа началась, теперь современная ремонтантная малина имеет большую отдачу урожая, повышенную зимостойкость и менее подвержены болезням и вредителям в сравнении с обычной малиной.', '2020-08-06 10:28:22'),
(5, 'Лабиринт в ландшафтном дизайне сада', 'В древности и средние века лабиринт имел сакральное значение и символизировал путь очищения. Позже европейская знать стала использовать лабиринт как украшение своих садов и парков. В эпоху Возрождения к нему добавилась развлекательная функция, которую лабиринт продолжает выполнять и сейчас. Не обязательно иметь большой двор, чтобы создать лабиринт. Высокие стены живой изгороди и множество поворотов — классический, но не единственный способ создать головоломку на участке. Посмотрим, как сделать лабиринт, каким он может быть и какие растения лучше использовать.  ЧИТАТЬ ДАЛЕЕ', '2020-08-06 10:28:36'),
(6, 'Вишня войлочная: компактность и урожайность', 'Желая заняться плодовым садоводством, вполне естественно обратиться к классическим и проверенным временем видам и сортам, часто давно ставшим «местными» для нас. Однако для разнообразия или для любопытства – почему бы не обратить внимание на их родичей? Аналоги плодовых культур из разных уголков Евразии или Америки зачастую приурочены к очень похожему на наш климату у себя на родине, а стало быть – запросто уживутся в вашем саду! А ведь иногда такие «экзоты» обладают рядом свойств, выгодно подчёркивающих их. Взять, к примеру, войлочную вишню. Вишня войлочная (Prunus tomentosa) принадлежит к тому самому объединённому роду Слива (секция Microcerasus), что означает её родство с персиками, абрикосами, миндалём, черёмухой и, внезапно, обыкновенной вишней. Правда, стоит сказать, что с первыми войлочная вишня скрещивается чаще, чем с последней – причуды эволюции! В руки садоводов Европы вишня войлочная пришла с востока: из Китая, Монголии и Кореи; пришла – и пришлась по вкусу! А почему бы ей не прийтись? Мелкие плоды весьма напоминают обыкновенную вишню, только собирать их удобнее – куст (или небольшое многоствольное деревце) редко превышает 2,5-3 метра в высоту. Плоды («костянки», между прочим) плотно сидят на однолетних побегах, опушение на которых и дало название виду. Специфика плодоношения предполагает частую обрезку для стимулирования роста молодых ветвей. Листва у войлочной вишни тоже опушенная, гофрированная, с острым концом – а цветы некрупные, но зато красивые, розоватые. Растение однодомно. Живёт куст недолго – 10, при правильном уходе и обрезке все 15 лет.', '2020-08-06 10:30:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
