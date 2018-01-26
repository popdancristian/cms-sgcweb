-- phpMyAdmin SQL Dump
-- version 3.3.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2013 at 02:50 AM
-- Server version: 5.1.44
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rims`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_adsense`
--

CREATE TABLE IF NOT EXISTS `cms_adsense` (
  `adsenseid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  `content` text NOT NULL,
  `channel` varchar(128) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  `ordon` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adsenseid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_adsense`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_article`
--

CREATE TABLE IF NOT EXISTS `cms_article` (
  `articleid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text,
  `script` text NOT NULL,
  `swffile` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `swfwidth` int(4) DEFAULT '0',
  `swfheight` int(4) DEFAULT '0',
  `tag` text NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datemodified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `new` int(11) NOT NULL DEFAULT '0',
  `directory` varchar(255) DEFAULT NULL,
  `number` int(3) DEFAULT NULL,
  PRIMARY KEY (`articleid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_article`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_article_comment`
--

CREATE TABLE IF NOT EXISTS `cms_article_comment` (
  `article_commentid` int(11) NOT NULL AUTO_INCREMENT,
  `articleid` int(11) NOT NULL DEFAULT '0',
  `domainid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `dateadd` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(64) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_commentid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_article_comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_banner`
--

CREATE TABLE IF NOT EXISTS `cms_banner` (
  `bannerid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  `ordon` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL DEFAULT '',
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bannerid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_category`
--

CREATE TABLE IF NOT EXISTS `cms_category` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `tag` text NOT NULL,
  `directory` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL,
  `footer` text,
  `header` text,
  PRIMARY KEY (`categoryid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_config`
--

CREATE TABLE IF NOT EXISTS `cms_config` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `config_name` varchar(64) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  PRIMARY KEY (`domainid`,`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_config`
--

INSERT INTO `cms_config` (`domainid`, `config_name`, `config_value`) VALUES
(1, 'adsense_ignore', 'ON'),
(1, 'adsense_ignore_ip', ''),
(1, 'article_auto_publish', 'ON'),
(1, 'article_best_limit', '4'),
(1, 'article_best_rated_limit', '4'),
(1, 'article_home_limit', '4'),
(1, 'article_last_limit', '4'),
(1, 'article_most_rated_limit', '4'),
(1, 'article_news_limit', '8'),
(1, 'article_ordon', 'ordon'),
(1, 'article_page_limit', '10'),
(1, 'article_prefix', ''),
(1, 'article_publish_date', '2013-02-05 01:10:22'),
(1, 'article_publish_interval', '240'),
(1, 'article_sufix', ''),
(1, 'category_auto_publish', 'ON'),
(1, 'category_ordon', 'ordon'),
(1, 'category_prefix', ''),
(1, 'category_publish_count', '100'),
(1, 'category_publish_date', '2013-02-05 01:10:22'),
(1, 'category_publish_interval', '5000'),
(1, 'category_sufix', 'Cluj'),
(1, 'description', 'Suntem o echipa tanara, deja afirmata pe piata in domeniu, prin serviciile prompte si de calitate. Oferim servicii de distributie in domeniul jaluzelelor, rulourilor si usilor armonice.'),
(1, 'email', 'office@lexundros.ro'),
(1, 'google_email', ''),
(1, 'google_password', ''),
(1, 'google_profile_id', ''),
(1, 'google_verify', ''),
(1, 'keyword', 'jaluzele, cluj'),
(1, 'keyword_auto_publish', 'ON'),
(1, 'keyword_limit', '20'),
(1, 'keyword_publish_count', '10'),
(1, 'keyword_publish_date', '2011-07-09 09:37:38'),
(1, 'keyword_publish_interval', '100'),
(1, 'motto', 'Distributie si montaj jaluzele verticale, jaluzele personalizate in Cluj'),
(1, 'rewrite_engine', 'ON'),
(1, 'rewrite_engine_method', '1'),
(1, 'rewrite_engine_string', '_'),
(1, 'sitemap_dir', ''),
(1, 'site_keyword', 'jaluzele'),
(1, 'site_style', 'rims.ro'),
(1, 'site_template', 'articles-1'),
(1, 'tag_limit', '20'),
(1, 'tag_total', '0'),
(1, 'title', 'rims.ro'),
(1, 'title_prefix', ''),
(1, 'title_separator', '-'),
(1, 'title_sufix', 'jaluzele-cluj.com'),
(1, 'yahoo_verify', ''),
(1, 'categoryid', '0'),
(1, 'phone', '0742-486093');

-- --------------------------------------------------------

--
-- Table structure for table `cms_dbform`
--

CREATE TABLE IF NOT EXISTS `cms_dbform` (
  `dbformid` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(64) NOT NULL,
  `fieldname` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fieldtype` varchar(64) DEFAULT NULL,
  `fieldlength` int(11) DEFAULT NULL,
  `formtype` varchar(64) DEFAULT NULL,
  `defaultvalue` varchar(255) DEFAULT NULL,
  `ordon` int(11) NOT NULL,
  PRIMARY KEY (`dbformid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `cms_dbform`
--

INSERT INTO `cms_dbform` (`dbformid`, `tablename`, `fieldname`, `title`, `fieldtype`, `fieldlength`, `formtype`, `defaultvalue`, `ordon`) VALUES
(26, 'page', 'footer', 'Footer', 'text', 0, 'textarea', '', 2),
(20, 'category', 'footer', 'Footer', 'text', 0, 'textarea', '', 2),
(27, 'article', 'directory', 'Directory', 'varchar', 255, 'textbox', '', 1),
(24, 'category', 'header', 'Header', 'text', 0, 'editor', '', 1),
(25, 'page', 'header', 'Header', 'text', 0, 'editor', '', 1),
(28, 'article', 'number', 'Number', 'int', 3, 'textbox', '0', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cms_domain`
--

CREATE TABLE IF NOT EXISTS `cms_domain` (
  `domainid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `ordon` int(11) NOT NULL DEFAULT '0',
  `google` int(1) NOT NULL DEFAULT '0',
  `cache` int(1) DEFAULT '0',
  PRIMARY KEY (`domainid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_domain`
--

INSERT INTO `cms_domain` (`domainid`, `name`, `url`, `path`, `ordon`, `google`, `cache`) VALUES
(1, 'rims.ro', 'http://localhost:5050/rims.ro', 'I:\\USBWebserver\\root\\rims.ro', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_domain_article`
--

CREATE TABLE IF NOT EXISTS `cms_domain_article` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `articleid` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `publish` int(1) NOT NULL DEFAULT '0',
  `ordon` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `totalraty` int(11) NOT NULL,
  `raty` double(10,2) NOT NULL,
  `datepublished` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatetag` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`domainid`,`articleid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_domain_article`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_domain_category`
--

CREATE TABLE IF NOT EXISTS `cms_domain_category` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `home` int(1) NOT NULL DEFAULT '0',
  `ordon` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `google` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`domainid`,`categoryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_domain_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_domain_faq`
--

CREATE TABLE IF NOT EXISTS `cms_domain_faq` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `faqid` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `total` int(11) NOT NULL DEFAULT '0',
  `home` int(1) NOT NULL DEFAULT '0',
  `ordon` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`domainid`,`faqid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_domain_faq`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_domain_gallery`
--

CREATE TABLE IF NOT EXISTS `cms_domain_gallery` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `galleryid` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `home` int(1) NOT NULL DEFAULT '0',
  `ordon` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  PRIMARY KEY (`domainid`,`galleryid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_domain_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_domain_page`
--

CREATE TABLE IF NOT EXISTS `cms_domain_page` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `pageid` int(11) NOT NULL DEFAULT '0',
  `menus` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `home` int(1) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `ordon` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_domain_page`
--

INSERT INTO `cms_domain_page` (`domainid`, `pageid`, `menus`, `active`, `home`, `total`, `link`, `ordon`) VALUES
(1, 9, 'bottom', 1, 0, 0, '', 9),
(1, 6, 'top', 1, 0, 0, '', 2),
(1, 5, 'top', 1, 0, 0, '', 3),
(1, 4, 'bottom', 1, 0, 0, '', 8),
(1, 3, 'bottom', 1, 0, 0, '', 5),
(1, 2, 'top|bottom', 1, 0, 0, '', 6),
(1, 1, 'top|bottom', 1, 1, 0, '', 1),
(1, 11, 'top', 1, 0, 0, '', 11),
(1, 10, '', 1, 0, 0, '', 10),
(1, 17, 'bottom', 1, 0, 0, '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cms_faq`
--

CREATE TABLE IF NOT EXISTS `cms_faq` (
  `faqid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `content` text NOT NULL,
  `tag` text NOT NULL,
  PRIMARY KEY (`faqid`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_faq`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_gallery`
--

CREATE TABLE IF NOT EXISTS `cms_gallery` (
  `galleryid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `dateadded` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `datemodified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`galleryid`),
  UNIQUE KEY `categoryid` (`categoryid`,`image`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_keyword`
--

CREATE TABLE IF NOT EXISTS `cms_keyword` (
  `keywordid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `completed` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `total` int(1) NOT NULL DEFAULT '0',
  `result` int(1) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`keywordid`),
  UNIQUE KEY `name` (`name`,`domainid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_keyword`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_lang`
--

CREATE TABLE IF NOT EXISTS `cms_lang` (
  `domainid` int(11) NOT NULL DEFAULT '0',
  `lang_name` varchar(128) NOT NULL DEFAULT '',
  `lang_value` text NOT NULL,
  PRIMARY KEY (`domainid`,`lang_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_lang`
--

INSERT INTO `cms_lang` (`domainid`, `lang_name`, `lang_value`) VALUES
(1, 'browsebytag', 'Etichete'),
(1, 'browsebykeyword', 'Cautari'),
(1, 'categoriesarticles', 'Produse & Articole'),
(1, 'page', 'Pagina'),
(1, 'tagbest', 'Best tags'),
(1, 'tagcloud', 'Tag Cloud'),
(1, 'searches', 'Cautari'),
(1, 'lastarticles', 'Noutati'),
(1, 'categories', 'Produse'),
(1, 'category', 'Categorie'),
(1, 'bestkeywords', 'Cautari'),
(1, 'lastkeywords', 'Latest Searches'),
(1, 'partners', 'Parteneri'),
(1, 'keywords', 'Keywords'),
(1, 'sponsors', 'Sponsors'),
(1, 'tags', 'Tags'),
(1, 'search', 'Cauta'),
(1, 'latest', 'Utimele adaugate'),
(1, 'popular', 'Cele mai vizitate'),
(1, 'articleoftheday', 'Game of the day'),
(1, 'rating', 'Rating'),
(1, 'views', 'Plays'),
(1, 'launched', 'Launched'),
(1, 'title', 'Title'),
(1, 'content', 'Continut'),
(1, 'description', 'Descriere'),
(1, 'lastcategories', 'New Categories'),
(1, 'bestcategories', 'Best Categories'),
(1, 'aboutus', 'About Us'),
(1, 'bestratedarticles', 'Best Rated Games'),
(1, 'mostratedarticles', 'Most Rated Games'),
(1, 'bestarticles', 'Best Games'),
(1, 'gallery', 'Galerie foto'),
(1, 'faq', 'Intrebari frecvente');

-- --------------------------------------------------------

--
-- Table structure for table `cms_link`
--

CREATE TABLE IF NOT EXISTS `cms_link` (
  `linkid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  `ordon` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL DEFAULT '',
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`linkid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_link`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_log`
--

CREATE TABLE IF NOT EXISTS `cms_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `dateadd` datetime NOT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE IF NOT EXISTS `cms_page` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `template` varchar(255) NOT NULL DEFAULT 'default',
  `menu` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `tag` varchar(255) NOT NULL,
  `header` text,
  `footer` text,
  PRIMARY KEY (`pageid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageid`, `name`, `template`, `menu`, `title`, `description`, `content`, `tag`, `header`, `footer`) VALUES
(1, 'home', 'home', 'Acasa', 'Distributie si montaj jaluzele, rulouri, rolete, perdele in Cluj', '[config_title] va ofera larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p><strong>[config_title] </strong>va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul <strong>Cluj</strong>. Livram prin curier rapid in toata tara.</p>', 'cluj, cluj-napoca', '', 'Transport si montaj in judetul Cluj. Garantia acordata este de 4 ani, cu posibilitate de prelungire. Montajul se poate face atat pe perete cat si pe tavan, se poate monta chiar si pe ferestre de mansarda in unghiuri inclinate. Se pot achizitiona si pangliciile separat de sina.'),
(2, 'hartasite', 'sitemap', 'Harta site', 'Harta site', 'Pentru un plus de originalitate adus casei dvs va recomandam sa inlocuiti vechile peerdele, care cu siguranta nu-si mai gasesc rostul in casa dvs cu jaluzele orizontale. Aceasta recomandare vine ca urmare a calitatilor incontestabile pe care aceste jaluzele orizontale le au. Printre aceste calitati putem enumera faptul ca puteti alege dintr-o paleta larga de culori cam 180, evident alegere care va fi facuta in functie de cum doriti sa fie casa luminata prin intermediul jaluzele.', '<p>Pentru un plus de originalitate adus casei dvs va recomandam sa inlocuiti vechile peerdele, care cu siguranta nu-si mai gasesc rostul in casa dvs cu <strong>jaluzele</strong>. Aceasta recomandare vine ca urmare a calitatilor incontestabile pe care aceste <strong>jaluzele </strong>le au. Printre aceste calitati putem enumera faptul ca puteti alege dintr-o paleta larga de culori cam 300, evident alegere care va fi facuta in functie de cum doriti sa fie casa luminata prin intermediul jaluzelelor.</p>', 'jaluzele', '', ''),
(3, 'toateprodusele', 'all', 'Toate produsele', 'Toate produsele', 'Toate produsele si articolele oferite de [config_title]. [config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p>Toate produsele si articolele oferite de <strong>[config_title]</strong>. <strong>[config_title]</strong> va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.</p>', 'produse', '', ''),
(4, 'cautari', 'keyword', 'Cautari', 'Cautari', '[config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p><strong>[config_title]</strong> va ofera o diversitate larga de produse  prin gama variata de nuante si materiale ce cu siguranta vor intregi  atmosfera locuintei dumneavoastra. Firma noastra este localizata in  orasul Cluj-Napoca, judetul Cluj.</p>', '', '', ''),
(5, 'celemaibuneproduse', 'best', 'Cele mai bune', 'Cele mai bune produse', 'Cele mai bune produse si articole oferite de [config_title]. [config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p>Cele mai bune produse si articole oferite de <strong>[config_title]</strong>. <strong>[config_title] </strong>va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.</p>', 'produse bune', '', ''),
(17, 'intrebarifrecvente', 'faq', 'Intrebari frecvente', 'Intrebari frecvente', 'Intrebari frecvente despre jaluzele verticale, jaluzele personalizate, rulouri, plase insecte si tantari.', '<p>Intrebari frecvente despre <strong>jaluzele verticale</strong>, <strong>jaluzele personalizate</strong>, <strong>rulouri</strong>, <strong>plase </strong>insecte si tantari.</p>', 'jaluzele, intrebari', '', ''),
(6, 'produsenoi', 'new', 'Produse noi', 'Produse & Articole Noi', 'Cele mai noi produse si articole oferite de [config_title]. [config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p>Cele mai noi produse si articole oferite de <strong>[config_title]</strong>. <strong>[config_title] </strong>va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.</p>', 'produse', '', ''),
(9, 'etichete', 'tag', 'Etichete', 'Etichete', '[config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.', '<p><strong>[config_title]</strong> va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul Cluj.</p>', '', '', ''),
(10, 'search', 'search', 'Cauta', 'Cauta', '[config_title] va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. [config_title] este localizata in orasul Cluj-Napoca, judetul Cluj. [category_title]', '<p><strong>[config_title]</strong> va ofera o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. <strong>[config_title]</strong> este localizata in orasul Cluj-Napoca, judetul Cluj. <strong>[category_title]</strong></p>', '', '<p>Daca ati schimbat deja vechea tamplarie cu termopane, astfel incat sa asigurati un plus de confort casei dvs, va recomandam sa indepartati si perdele si draperii, iar in locul lor sa puneti [config_title] <strong>[category_title]</strong>. Motivul pentru care noi va recomandam [config_title] <strong>[category_title]</strong> este acela ca in primul rand veti aduga o nota de eleganta casei dvs. Pe de alta parte, in functie de materialul din care sunt facute, dvs puteti alege orice culoare pentru [config_title] <strong>[category_title]</strong>, astfel incat sa se asorteze cu mobila pe care o aveti in casa.</p>', ''),
(11, 'contact', 'default', 'Contact', 'Contact', 'Oferim o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Lexundros design, Strada Patriciu Barbu (fosta Petrila), nr 62, Cluj-Napoca, Cluj, luni-vineri 9:30-17:30, 0742-486093 office@lexundros.ro', '<p>Oferim o diversitate larga de produse prin gama variata de nuante si materiale ce cu siguranta vor intregi atmosfera locuintei dumneavoastra. Firma noastra este localizata in orasul Cluj-Napoca, judetul <strong>Cluj</strong>.</p>', 'contact, lexundros', '<h2>Lexundros design</h2>\r\n<h3>Adresa: Strada Patriciu Barbu (fosta Petrila), nr 62, Cluj-Napoca, Cluj<br />\r\nOrar: luni-vineri 9:30-17:30 	<br />\r\nTelefon: <b>0742-486093</b> 	<br />\r\nFax: 0364-118468 	<br />\r\nEmail: <b>office@lexundros.ro</b></h3>', '<iframe width="610" height="328" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&hl=en&msa=0&msid=208095792978601754017.000489a2db8f5f2f11f3d&source=embed&ll=46.78293,23.601723&spn=0.007347,0.014977&output=embed"></iframe><br /><small><a target="_blank" href="http://maps.google.com/maps/ms?ie=UTF8&hl=en&msa=0&msid=208095792978601754017.000489a2db8f5f2f11f3d&source=embed&ll=46.78293,23.601723&spn=0.007347,0.014977" style="color:#0000FF;text-align:left">Vezi harta mare</a></small>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_script`
--

CREATE TABLE IF NOT EXISTS `cms_script` (
  `scriptid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `position` varchar(255) NOT NULL DEFAULT '',
  `ordon` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`scriptid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_script`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_session`
--

CREATE TABLE IF NOT EXISTS `cms_session` (
  `sessionid` varchar(128) NOT NULL DEFAULT '',
  `userid` int(11) NOT NULL DEFAULT '0',
  `timelogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sessionid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms_session`
--

INSERT INTO `cms_session` (`sessionid`, `userid`, `timelogin`) VALUES
('32082511055f5a4087', 1, '2013-02-05 02:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tag`
--

CREATE TABLE IF NOT EXISTS `cms_tag` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `domainid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `total` int(11) NOT NULL DEFAULT '0',
  `categoryid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  UNIQUE KEY `domainid` (`domainid`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cms_tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `cms_url`
--

CREATE TABLE IF NOT EXISTS `cms_url` (
  `urlid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`urlid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_url`
--

INSERT INTO `cms_url` (`urlid`, `name`, `active`) VALUES
(1, 'http://localhost:5050/jaluzele-cluj.com/articles/_file', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_user`
--

CREATE TABLE IF NOT EXISTS `cms_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(128) NOT NULL DEFAULT '',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_user`
--

INSERT INTO `cms_user` (`userid`, `username`, `password`, `active`) VALUES
(1, 'games', '48813054b835cc39703e0cfc438457db', 1),
(2, 'cristi', 'a1e05ee2564dbf16b04f09a23d482d06', 1);
