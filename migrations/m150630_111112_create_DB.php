<?php

class m150630_111112_create_DB extends \yii\db\Migration
{
    public function up()
    {
      $sql = <<<SQL
CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `firstname`, `lastname`) VALUES
(1, 'Михаил', 'Булгаков'),
(2, 'Стивен', 'Кинг');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  `preview` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `name`, `date_create`, `date_update`, `preview`, `date`, `author_id`) VALUES
(32, 'Лангольеры212ssadsa', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(33, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(34, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(35, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(36, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(37, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(38, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(39, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(40, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2),
(41, 'Лангольеры', '2015-06-25', '2015-06-12', '1.jpg', '2015-05-05', 2);
SQL;
      $this->execute($sql);
    }

    public function down()
    {
        echo "m141123_1192403_create_DB cannot be reverted.\n";
        return false;
    }
}