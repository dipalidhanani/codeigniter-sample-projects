-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: mariadb-149.wc1:3306
-- Generation Time: Mar 30, 2017 at 11:24 AM
-- Server version: 1.0.29
-- PHP Version: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `983002_brksask`
--

-- --------------------------------------------------------

--
-- Table structure for table `2web_admin`
--

CREATE TABLE IF NOT EXISTS `2web_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `full_name` tinytext NOT NULL,
  `user_name` varchar(200) NOT NULL DEFAULT '',
  `user_email` varchar(220) NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT '1',
  `pwd` varchar(220) NOT NULL DEFAULT '',
  `pwd_hint` varchar(200) NOT NULL,
  `domain_name` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `reset_pass` text NOT NULL,
  `last_login` date NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key1` (`user_email`),
  UNIQUE KEY `key2` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `2web_admin`
--

INSERT INTO `2web_admin` (`id`, `full_name`, `user_name`, `user_email`, `user_level`, `pwd`, `pwd_hint`, `domain_name`, `date`, `reset_pass`, `last_login`, `approved`, `deleted`) VALUES
(1, 'admin', 'admin', 'breakoutsask@gmail.com', 1, 'cdecabe1520a398e4e46deff9d55b19bed6d6457', 'admin', '', '2014-09-22', '', '2017-03-20', 1, 0),
(2, '2web Admin Test', '2webmin', 'admin@2webdesign.com', 2, '91297212022f5fad17aa9a74e91758cbd1593a05', '2web', '', '2014-09-22', '', '2017-03-30', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2web_admin_log`
--

CREATE TABLE IF NOT EXISTS `2web_admin_log` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `user_agent` text,
  `ref` text,
  `login_status` tinyint(1) NOT NULL DEFAULT '0',
  `dt` datetime NOT NULL,
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `2web_banner`
--

CREATE TABLE IF NOT EXISTS `2web_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(4) NOT NULL,
  `title` varchar(200) NOT NULL,
  `banner_content` text NOT NULL,
  `banner_photo` varchar(200) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int(11) NOT NULL,
  `banner_url` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `tag_line` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `2web_banner`
--

INSERT INTO `2web_banner` (`id`, `site_id`, `title`, `banner_content`, `banner_photo`, `is_active`, `display_order`, `banner_url`, `image_url`, `content`, `tag_line`) VALUES
(1, 1, 'Banner 1', '', '', 1, 0, '', NULL, '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `2web_calltoaction`
--

CREATE TABLE IF NOT EXISTS `2web_calltoaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `calltoaction_url` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `calltoaction_url_text` longtext NOT NULL,
  `type` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `display_order` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `2web_calltoaction`
--

INSERT INTO `2web_calltoaction` (`id`, `title`, `site_id`, `calltoaction_url`, `page_id`, `calltoaction_url_text`, `type`, `is_active`, `display_order`) VALUES
(1, 'Test Call To Action', 1, 'http://www.google.com', '~3~,~4~,~5~,~8~,', 'Test', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_category`
--

CREATE TABLE IF NOT EXISTS `2web_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `site_id` int(10) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `2web_category`
--

INSERT INTO `2web_category` (`id`, `site_id`, `title`, `is_active`) VALUES
(1, 1, 'Category1', 1),
(3, 1, 'category2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_cms_draft`
--

CREATE TABLE IF NOT EXISTS `2web_cms_draft` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `contents` longtext NOT NULL,
  `draft_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `2web_cms_pages`
--

CREATE TABLE IF NOT EXISTS `2web_cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(4) NOT NULL DEFAULT '1',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `title` varchar(255) DEFAULT NULL,
  `page_quote` varchar(255) NOT NULL,
  `banner_heading` text NOT NULL,
  `content` longtext,
  `display_order` int(11) NOT NULL DEFAULT '1',
  `page_link` varchar(255) DEFAULT NULL,
  `banner_photo` varchar(200) DEFAULT NULL,
  `page_heading_icon` varchar(255) NOT NULL,
  `background_image` varchar(200) DEFAULT NULL,
  `banner_text` longtext,
  `banner_url` varchar(200) DEFAULT NULL,
  `banner_link_title` varchar(255) DEFAULT NULL,
  `useful_link` longtext NOT NULL,
  `button_title` varchar(255) NOT NULL,
  `show_story` int(1) NOT NULL,
  `button_url` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `key1` (`page_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `2web_cms_pages`
--

INSERT INTO `2web_cms_pages` (`id`, `site_id`, `parent_id`, `meta_title`, `meta_keyword`, `meta_description`, `title`, `page_quote`, `banner_heading`, `content`, `display_order`, `page_link`, `banner_photo`, `page_heading_icon`, `background_image`, `banner_text`, `banner_url`, `banner_link_title`, `useful_link`, `button_title`, `show_story`, `button_url`, `video_url`, `is_active`, `deleted`) VALUES
(1, 1, 0, 'Breakout Room Escape in Saskatoon', '', 'BREAKOUT is a fun live action escape game in Saskatoon, designed for groups from 4-12 people. If you are looking for things to do in Saskatoon, you should check out Breakout Escape Room', 'Home', '', '', '', 1, 'home', '', '', '', '', NULL, NULL, '', '', 0, '', '', 1, 0),
(2, 1, 0, 'All about Breakout Escape games', '', 'Escape rooms, also known as puzzle rooms, puzzle games or mystery games have been sweeping the globe. It''s a fun live action game that is great for individual groups or team building activities.', 'About', '', '', '', 2, 'about', 'about_banner.jpg', '', '', '', NULL, NULL, '', '', 0, '', '', 1, 0),
(7, 1, 0, 'Escape room themes', '', 'Looking to try an room escape? We have three different themed rooms including a murder mystery room, mad scientist and a ticking bomb! Our games are not scary, just fun adventures!', 'Theme Rooms', '', '', '', 3, 'theme_rooms', 'theme_banner.jpg', '', '', '', NULL, NULL, '', '', 0, '', '', 1, 0),
(9, 1, 0, 'Keeping up with Breakout Escape Rooms', '', 'Check out our blog for news about Saskatoon Escape Room community, upcoming promotions, and all the fun at Breakout!', 'Blog', '', '', '', 5, 'blog', 'blog_banner.jpg', '', '', '', NULL, NULL, '', '', 0, '', '', 1, 0),
(10, 1, 0, 'BREAKOUT Escape Rooms in Saskatoon', '', 'Looking  for things to do in Saskatoon? Planning a family reunion or birthday party. Contact us at Breakout Escape rooms.', 'Contact', '', '', '&lt;h3&gt;We Would like to Hear From You&lt;/h3&gt;\r\n', 7, 'contact', 'contact_banner.jpg', '', '', '', NULL, NULL, '', '', 0, '', '', 1, 0),
(13, 1, 0, 'What is an escape game?', '', 'What is an escape room? Is it scary? Do you do team building? Do you have puzzle rooms? All your answers can be found in our faqs.', 'Faqs', '', '', '', 6, 'faq', 'faq_banner.jpg', '', NULL, '', NULL, NULL, '', '', 0, '', '', 1, 0),
(14, 1, 0, 'Privacy Policy', '', '', 'Privacy Policy', '', '', '&lt;p&gt;&lt;span style=&quot;font-size:20px;&quot;&gt;&lt;em&gt;&lt;strong&gt;Breakout Escape Room&#039;s Privacy Policy&lt;/strong&gt;&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;We are committed to protecting your privacy. Authorized employees within the company only use any information collected from individual customers. We constantly review our&nbsp;systems and data to ensure that the best possible service to our customers. We will investigate any&nbsp;unauthorized actions with a view to taking action against anyone caught using this information for other purposes.&lt;/p&gt;\r\n\r\n&lt;p&gt;We are the sole owners of&nbsp;the information collected on this site. We only have access to information that you voluntarily give us via email or other direct contact from you. We do not sell or rent this information to anyone.&lt;/p&gt;\r\n\r\n&lt;p&gt;We will use your information to contact you or respond to you regarding the reason you contacted us. We will not share your information with any third party outside of our organization, other than to fullfill your request ( such as to ship an item)&lt;/p&gt;\r\n\r\n&lt;p&gt;Unless you ask us not to, we may contact you via email in the future to tell you about specials, promotions or services, or changes to our privacy policy.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;em&gt;&lt;span style=&quot;font-size:20px;&quot;&gt;&lt;strong&gt;Security:&lt;/strong&gt;&lt;/span&gt;&lt;/em&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;We take precautions to protect your information. When you submit sensitve information via the website, you information is protected both online and offline. Whenever we collect sensitive information such as credit card information, that information is encrypted and sent to us in a secure way. All transactions are processed through a payment gateway and are not stored or processed on our servers.&lt;/p&gt;\r\n\r\n&lt;p&gt;If you have any questions about our privacy policy, please contact us directly at www.breakoutsask@gmail.com&lt;/p&gt;\r\n\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n', 0, 'privacy-policy', '', '', NULL, '', NULL, NULL, '', '', 0, '', '', 1, 0),
(16, 1, 2, 'Escapee Reviews', '', '', 'Escapee Reviews', '', '', '&lt;p&gt;&lt;iframe frameborder=&quot;0&quot; height=&quot;600&quot; src=&quot;https://bookeo.com/breakoutrooms/reviews?rows=50&amp;columns=4&quot; width=&quot;600&quot;&gt;&lt;/iframe&gt;&lt;/p&gt;\r\n', 1, 'escapee-reviews', 'about_banner1.jpg', '', NULL, '', NULL, NULL, '', '', 0, '', '', 1, 0),
(18, 1, 0, 'Student Learning', '', 'Breakout Escape offers powerful opportunites for student learning and engagement including using skills such as team work, critical thinking and communication among their peers.', 'Student Learning', '', '', '&lt;p&gt;Escape Rooms allow for different types of student engagement and student leadership that you don&#039;t normally see in the classroom. Escape rooms require team work, communication and delegation as well as critical thinking, attention to detail and lateral thinking. They are accessible to a wide range of players and so they do&nbsp;not favor any gender. In fact, the most successful teams are those made up of players with a variety of experiences, backgrounds and abilities.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-size:20px;&quot;&gt;&lt;span style=&quot;font-family:comic sans ms,cursive;&quot;&gt;&lt;var&gt;&lt;strong&gt;Games offer students the&nbsp;opportunity to be their&nbsp;best possible selves.&lt;/strong&gt;&lt;/var&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;span style=&quot;font-family:comic sans ms,cursive;&quot;&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;&lt;var&gt;&lt;span class=&quot;marker&quot;&gt;&lt;strong&gt;&lt;img alt=&quot;&quot; src=&quot;/ckfinder/userfiles/images/Infographic%20watermark.jpg&quot; style=&quot;width: 800px; height: 532px;&quot; /&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/var&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Escape games use mechanics that create an environment that allows students to use their collaborative learning in a simulated real life setting. It also allows for this collaboration to&nbsp;foster collective intellegence which strongly allows for the shift of knowledge and power from the individual to the collective.&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;It is important to also recognize the social benefits for students in an escape room. Escape games are powerful team bonding and team building activities. They will help students become a more cohesive group and create positive memories that will bond them together.&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Breakout offers experiences for students and staff of any age and grade level. We are able to host student groups at Breakout in our exisiting games, which are age appropriate, from grades 6 and up. We also offer the opportunity to bring a custom on-site game to you. This can be tailored to your current class size and cirriculum. We are also able to host your school staff for a team building activity.&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;Breakout Escape Rooms is a proud supporter of Saskatoon Public Schools as well as all the schools in the province. Please contact us directly to discuss your options for booking an escape game for your group.&lt;/p&gt;\r\n\r\n&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;color:#FFFFFF;&quot;&gt;&lt;span class=&quot;gold&quot;&gt;&lt;span style=&quot;font-size:26px;&quot;&gt;&lt;span style=&quot;font-family:comic sans ms,cursive;&quot;&gt;&lt;strong&gt;Learning and Fun .... all in one!&lt;/strong&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;&lt;/p&gt;\r\n', 4, 'student-learning', 'iStock_48721522_MEDIUM.jpg', '', NULL, '', NULL, NULL, '', '', 0, '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2web_commonbanner`
--

CREATE TABLE IF NOT EXISTS `2web_commonbanner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `page_id` varchar(255) NOT NULL,
  `banner_photo` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `2web_commonbanner`
--

INSERT INTO `2web_commonbanner` (`id`, `title`, `site_id`, `page_id`, `banner_photo`, `is_active`) VALUES
(2, 'Banner 1', 1, '~2~,~3~,~4~,~5~,~7~,~8~,~9~,~10~,', 'inner-header-pic.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_common_banner`
--

CREATE TABLE IF NOT EXISTS `2web_common_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `site_id` int(4) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `common_banner_photo` varchar(200) NOT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `2web_common_banner`
--

INSERT INTO `2web_common_banner` (`id`, `title`, `site_id`, `page_id`, `common_banner_photo`, `show_logo`, `is_active`, `display_order`) VALUES
(1, 'Banner 1', 1, '2,3,4,5,7,8,9,10,', 'inner-header-pic.jpg', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2web_contact`
--

CREATE TABLE IF NOT EXISTS `2web_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `display_order` int(1) NOT NULL DEFAULT '1',
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` float(12,8) NOT NULL,
  `longitude` float(12,8) NOT NULL,
  `is_shown_map` tinyint(1) NOT NULL DEFAULT '0',
  `marker` text NOT NULL,
  `map_marker` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `2web_contact`
--

INSERT INTO `2web_contact` (`id`, `site_id`, `title`, `display_order`, `fname`, `lname`, `address`, `phone`, `fax`, `email`, `latitude`, `longitude`, `is_shown_map`, `marker`, `map_marker`, `is_default`, `is_active`) VALUES
(2, 1, 'Breakout Escape Rooms', 0, 'BreakOut', 'Sask', '805 48th Street, Saskatoon', '306-384-0008, or after hours call 306-227-8171', '', 'breakoutsask@gmail.com', 52.17114639, -106.65626526, 1, 'BreakOut Escape Rooms\r\n805 48th Street,\r\nSaskatoon, Canada', 'unnamed.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_faq`
--

CREATE TABLE IF NOT EXISTS `2web_faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cat_id` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `display_order` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `2web_faq`
--

INSERT INTO `2web_faq` (`id`, `title`, `cat_id`, `is_active`, `display_order`, `content`) VALUES
(12, 'Are we really locked in?', 2, 'Active', 4, '<p>Yes and No! We can not legally (or safely) lock you in any of our rooms. Some of our rooms are locked but you can leave at any time through an unlocked escape door.&nbsp;(Our rooms are also monitored by CCTV and you will be in contact with us at all times).</p>\r\n'),
(22, 'Why can’t I take my phone and/or purse into the room?', 2, 'Active', 7, '<p>You will be given your own compartment to lock up your phone, purse or any other valuables that you brought with you. The only thing going into the room is you and your wits. The best part of a room escape is it forces you to disconnect from the outside world. If you need to be reached in the event of an emergency (such as a babysitter), they can call our main number and we will contact you in the game.</p>\r\n'),
(23, 'What if I can’t solve the puzzles in the game?', 2, 'Active', 8, '<p>The point of the game is to have fun! If you get stuck on a puzzle you will be given a limited number of &lsquo;hints&rsquo; so use them wisely.</p>\r\n'),
(16, 'Is this scary?', 2, 'Active', 5, '<p>Not at all. The games are designed to be challenging and fun. None of our games have total darkness, or things jumping out to startle or scare you.</p>\r\n'),
(3, 'Should I incorporate?', 1, 'Deleted', 3, '<p>The three most common business structures are: sole proprietorship, partnership and corporation. Corporations are closely regulated separate legal entities. The advantages of incorporation include limited liability, possible tax advantages, ease of raising capital, and transferable ownership. These advantages are off set by higher start-up costs, possible charter restrictions, yearly reporting and extensive record keeping requirements. It is highly recommended you obtain legal and professional advice before you decide if incorporation is right for you.</p>\n'),
(13, 'What time should I arrive?', 2, 'Active', 10, '<p>You should arrive 15-10 minutes before your scheduled game time. If you show up late, the time will be taken off your game time in the room. If you are more than 10 minutes past your scheduled start time you will not be allowed into the game. If the rest of your team has already started the game you will not be permitted to join the game. Once the door is locked it will not be reopened (except for emergencies). NO REFUNDS OR EXCHANGES WILL BE GIVEN</p>\r\n'),
(4, 'Do I need a GST/PST number?', 1, 'Deleted', 4, '<p>If your gross revenues over a 12 month period do&nbsp;not exceed $30,000, GST registration is optional. However, the decision to register for GST should not be based solely on revenues. Your customers may require you have a GST number to do business. Your local Revenue Canada office can help you determine if you should apply for a GST number.</p>\n\n<p>If you sell tangible goods, or operate as a contractor selling your services, you may be required to obtain a PST number. Contact the Saskatchewan Ministry of Finance at 1-800-667-6102 for more information.</p>\n'),
(5, 'I want to start a business, what do I do?', 3, 'Deleted', 5, '<p>The following steps will help you get started. (Note: The number of steps may vary depending on the nature of the business you want to start.) They do not necessarily have to be followed in the order they appear.</p>\n\n<ul>\n <li>Develop an idea you would like to investigate.</li>\n <li>Research your business idea. Conduct a feasibility study to determine whether or not this idea could turn into a viable business.</li>\n <li>Find out if there are any regulations which could prevent you from starting this business or hamper your success.</li>\n <li>Do a skills and lifestyle audit. Is this the right time to start the business or do you need to upgrade some of your skills before you get going?</li>\n <li>Write a business plan. Talk to a lawyer and accountant about protecting yourself and your assets.</li>\n <li>If you decide to go into business, decide on the most appropriate structure. Register your name if necessary.</li>\n <li>Identify a business location. Open your business bank account and arrange financing.</li>\n <li>Organize your office, your accounting, filing and your client contact systems.</li>\n <li>Develop promotional tools to set yourself up for effective selling.</li>\n <li>Enjoy the experience!</li>\n</ul>\n'),
(6, 'Do you have any business ideas I could use?', 1, 'Deleted', 6, '<p>Identifying a good business opportunity is an ongoing process and requires considerable thought and research. Business opportunities can be identified through a number of sources including your workplace, magazines and newspapers, tradeshows and the internet. A sound understanding of consumer trends and lifestyles may also lead to innovative business ideas.</p>\n'),
(7, 'What is a Live Action Escape Game?', 1, 'Active', 1, '<p>Also referred to as a puzzle room, this is a game where you and your friends are&nbsp;in a room and you have 60 minutes to solve the clues and puzzles to complete your mission and escape the room.&nbsp;</p>\r\n'),
(17, 'trst', 1, 'Deleted', 1, '<p>dsdhs</p>\r\n'),
(18, 'Do you have age restrictions for players?', 2, 'Active', 2, '<p>We recommend ages 12 and up.. Please note that all players under the age of 14 must have a parent or guardian accompany them in the room. We do not allow players under the age of 10 in any of our rooms (even with parent supervision).</p>\r\n'),
(19, 'test', 2, 'Deleted', 1, '<p>hfdhdfj</p>\r\n'),
(20, 'test', 1, 'Deleted', 1, ''),
(21, 'Are tickets refundable or transferable?', 2, 'Active', 6, '<p>This is a live event so once the booking has been confirmed no refunds or exchanges will be issued. However, tickets can be transferred to other players.</p>\r\n'),
(8, 'Can someone write my business plan?', 1, 'Deleted', 2, '<p>Writing a business plan will take time, discipline and a lot of research. W.E. will not write your plan for you and although you can hire someone to write your plan for you, it is vital you participate in the entire process - after all, this is your business. Knowledge is power and the more you know about your business, the greater your chance of success.</p>\n'),
(14, 'What are the Rules?', 3, 'Active', 1, '<h2>BreakOut Rules of the Game</h2>\r\n\r\n<ul>\r\n	<li>Players have 60 minutes to find their way out from the rooms, by solving puzzles, clues, finding keys and codes.</li>\r\n	<li>Players should arrive 15 minutes early before their reserved time. After 10 minutes of delay, the Game Master can refuse the game launch and money cannot be refunded.</li>\r\n	<li>Children under the age of 14 can only play with adult supervision. The theme of the room and the special lighting and sound effects may disturb younger players. <strong>We do NOT allow players under the age of 10 in our games</strong></li>\r\n	<li>DO NOT damage tools, accessories and furniture in the room. Please do not move large objects or furniture. You do not need physical force to solve any puzzle.</li>\r\n	<li>If you notice that one of the game elements (low battery, broken lock, etc) is not working properly, please notify the operator immediately.</li>\r\n	<li>Dangerous or hazardous materials, food, alcoholic beverages or any beverages may not be brought into the rooms.</li>\r\n	<li><strong>We may film, photograph, videotape, record or otherwise reproduce the image &nbsp;of any player who enters the building and use the same without payment.</strong></li>\r\n	<li>We are not responsible and do not assume any liability for any damage to or loss of property or belongings of any player, whether such damage or loss is caused by our negligence or otherwise.</li>\r\n	<li>Do not participate in the game if you have any health conditions or pre-existing conditions or injuries, or if you are too afraid to participate. BreakOut does not and cannot guarantee your health and you fully assume all risks of the activity in which you choose to participate.</li>\r\n	<li>You will not be allowed to participate in the game if you are under (or thought to be under) the influence of alcohol, drugs (whether legal medication or illegal substances) or other substances that may effect your health, senses, body reflexes or coordination. You will be refused entry into the game and no refunds will be issued.</li>\r\n	<li>The company reserves the right to change the conditions such as prices and schedule from time to time as it sees fit without notice. You are therefore encouraged to reread the game rules on a regular basis.</li>\r\n	<li>Participants fully understand that there are no refunds under any conditions once they have purchased their ticket.</li>\r\n	<li>Before starting the game, every participant must sign a&nbsp;waiver stating that they understand the rules, terms and conditions and the risks associated with them.</li>\r\n</ul>\r\n'),
(15, 'How many people can play the game?', 2, 'Active', 10, '<p>Our rooms are various sizes which dictates how many can comfortably participate in each room. We have recommended min and max group sizes for each room.</p>\r\n'),
(24, 'How much does it cost?', 1, 'Active', 3, '<p>The cost per person is $25.00 plus taxes. On Wednesdays we offer a 20% discount to help you get over those Hump-Day blues.</p>\r\n'),
(25, 'What makes Breakout Escape Games unique?', 2, 'Active', 1, '<p>Unlike most of the other Escape Games in Saskatoon, Breakout&#39;s game are truly unique. We actually create all of our own games instead of just buying a pre-made &#39;canned&#39; experience. This allows us to adapt our games to suit our customers and give them the best experience possible. We craft our games in such a way so that we have a variety of difficulty levels available as well as both puzzle orientated games and task orientated games. Truly something for every player!&nbsp;We also change our games on a regular basis so that you can continue to come back to Breakout and play a new experience every time.&nbsp;</p>\r\n\r\n<p>We are very passionate about what we do which is why Breakout often has an actual owner on site instead of just a manager. There is no place we would rather be than with our guests!</p>\r\n\r\n<p>Unlike other companies who claim to be local, we actually are. Everything in our games are either built locally or sourced locally. Playing at Breakout is supporting a locally owned business which in turn supports our community and economy ( as opposed to those with owners outside the province).&nbsp;</p>\r\n'),
(26, 'Are you Wheelchair accessible?', 2, 'Active', 9, '<p>We regret to say no. At this time we are not wheelchair accessible as we are on the second floor of an older building that does not have an elevator. Therefore there is no access for people in wheelchairs. We do welcome players with walkers and crutches as long as they are able to climb the stairs. Please note that if you have mobility issues, we recommend that you contact us to discuss which game would best fit your needs.</p>\r\n'),
(27, 'Will our group be paired with strangers?', 1, 'Active', 2, '<p>Heck no! Rest assured that when you play at Breakout, it will be a private booking every time and we won&#39;t even charge you for the spots that you aren&#39;t using!&nbsp;As soon as a booking is made it closes off and becomes private regardless of the number of people booked into the game.&nbsp;For this reason, if you wish to increase the number of people in your group, you must contact us by phone or email to do this.</p>\r\n\r\n<p>It is our motto that the Customer Experience Always Comes First!</p>\r\n\r\n<p>Beware, as we are the only escape room in town that offers this type of booking system. Other escape rooms will require you to purchase all the tickets in a game to prevent them from adding others to your game or they will require you to pay a minimum group fee to book or to close the room to others players.&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `2web_faqcategories`
--

CREATE TABLE IF NOT EXISTS `2web_faqcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faqcategories_title` varchar(255) NOT NULL,
  `is_active` enum('Active','Inactive','Deleted') NOT NULL DEFAULT 'Active',
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `2web_faqcategories`
--

INSERT INTO `2web_faqcategories` (`id`, `faqcategories_title`, `is_active`, `display_order`) VALUES
(1, 'Live Action Games', 'Active', 1),
(2, 'Playing BreakOut Sask', 'Active', 2),
(3, 'Rules', 'Active', 3),
(4, 'Test Category', 'Deleted', 9),
(5, 'new titel', 'Deleted', 22);

-- --------------------------------------------------------

--
-- Table structure for table `2web_featured_blocks`
--

CREATE TABLE IF NOT EXISTS `2web_featured_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `featured_excerpt` text NOT NULL,
  `featured_image_type` varchar(255) NOT NULL,
  `featured_block_image` text NOT NULL,
  `featured_block_background_image` text NOT NULL,
  `block_section_type` enum('About','Calltoaction') NOT NULL,
  `block_button_text` varchar(255) NOT NULL,
  `block_url_link` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `featured_block_status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `2web_featured_blocks`
--

INSERT INTO `2web_featured_blocks` (`id`, `title`, `description`, `featured_excerpt`, `featured_image_type`, `featured_block_image`, `featured_block_background_image`, `block_section_type`, `block_button_text`, `block_url_link`, `display_order`, `is_featured`, `featured_block_status`) VALUES
(1, 'TIME', '<p>You will have 60 minutes to complete your mission. Please be sure to arrive 10-15 minutes early to be sure your mission starts on time.</p>\r\n', '', 'icon', 'breakout_time_icon.png', '', 'About', '', '', 3, 1, 'Active'),
(3, 'PLAYERS', '<p>Teams of 4-12&nbsp;players depending on room theme, or groups of up to 30&nbsp;players</p>\r\n', '', 'icon', 'breakout_player_icon.png', '', 'About', '', '', 1, 1, 'Active'),
(4, 'RESULT', '<p>Beware! Our players have so much fun, they can&#39;t wait to come back and play again!</p>\r\n', '', 'icon', 'breakout_result_icon.png', '', 'About', '', '', 2, 1, 'Active'),
(5, 'THEME ROOMS', '<p>Each escape room has it&#39;s own unique theme, puzzles, missions and goals. It&#39;s an adventure within 4 walls.</p>\r\n', 'Each room has it''s own unique theme, puzzles and goals.It''s an adventure within four walls', 'image', 'iStock_11051505_MEDIUM.jpg', 'about_bg1.jpg', 'Calltoaction', 'View Theme Rooms', 'http://www.breakoutsask.com/theme_rooms', 1, 1, 'Active'),
(6, 'TEAM BUILDING', '<p>Praised as one of the best team building experiences around, escape rooms have become the go-to destination for&nbsp;corporations and organizations.</p>\r\n\r\n<p>There isn&rsquo;t a fun, intriguing, time sensitive exercise like it, where you really have true collaboration between colleagues and participants.</p>\r\n\r\n<p>Contact us for special pricing and booking information.</p>\r\n', 'Praised as one of the best team building experiences around, escape rooms have become the go-to destination from corporations and organizations.', 'image', 'shutterstock_402793846.jpg', '', 'Calltoaction', 'Book a Team Experience', 'http://www.breakoutsask.com/contact', 2, 1, 'Active'),
(7, 'SPECIAL EVENTS', '<p>If you would like to have a special event such as your birthday, reunion, or get together&nbsp;at BREAKOUT Escape Rooms, make sure to call us! We can help make your experience special and tailored to the amount of people you would like to have. We can accomodate groups up to 25 or more!</p>\r\n', 'If you would like to have a special event such as your birthday, stagette, or reunion activity at BREAKOUT, make sure to give us a call!', 'image', 'iStock_74531869_MEDIUM.jpg', 'about_bg2.jpg', 'Calltoaction', 'Host An Event', 'http://www.breakoutsask.com/contact', 3, 1, 'Active'),
(11, 'Student Learning', '<p><span style="font-size:18px;">Escape Rooms are a powerful tool to aid in&nbsp;student learning.</span></p>\r\n', 'Escape Rooms are a powerful tool to aid in student learning.', 'image', 'crop_copy.jpg', '', 'Calltoaction', 'More Information', 'https://www.breakoutsask.com/pages/student-learning', 4, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `2web_homepage_block_setting`
--

CREATE TABLE IF NOT EXISTS `2web_homepage_block_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `block_background_image` text NOT NULL,
  `block_section_no` varchar(255) NOT NULL,
  `about_read_more_link` text NOT NULL,
  `block_status` enum('Active','Inactive','','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `2web_homepage_block_setting`
--

INSERT INTO `2web_homepage_block_setting` (`id`, `title`, `description`, `block_background_image`, `block_section_no`, `about_read_more_link`, `block_status`) VALUES
(1, 'WHAT IS BREAKOUT?', '<p>BREAKOUT Escape Rooms is a live escape game in Saskatoon, Sk, designed for groups from 4-12&nbsp;people or more. In all our games you will work together to solve puzzles and clues that will eventually lead to your escape from the room. You will have 60 minutes to overcome a series of mind bending puzzles and challenges to complete your mission. No special skills are needed. Although these games are challenging, don&#39;t worry- you&#39;ll have fun whether you escape or not!</p>\r\n', 'breakout_bg.png', '1', 'http://www.breakoutsask.com/about', 'Active'),
(3, 'ARE YOU LOOKING TO TRY SOMETHING NEW?', '<p><span style="font-size:20px;">Check out Saskatoon&#39;s exciting&nbsp;live action escape game! Our escape rooms are the perfect activity to spend time with family or friends.&nbsp;</span></p>\r\n', 'something_new_bg.jpg', '2', '', 'Active'),
(4, 'Follow us on Social Media', '<p>test</p>\r\n', 'banner_img.jpg', '2', '', 'Inactive'),
(5, 'RECENT BLOG POSTS', '<p>Keep up with the lastest news from all of us at BREAKOUT Escape Rooms!</p>\r\n', 'home_blog_bg.png', '3', '', 'Active'),
(6, 'CONTACT US', '<p>Please contact us if you have any questions about our rooms or prices. We can arrange group bookings, special events and parties. Book online or call us direct! Want to play today? Contact us directly by email or phone for Availability.</p>\r\n\r\n<p>We are open&nbsp;Wednesday -&nbsp;Friday <span style="color: rgb(244, 180, 38);">4-11:30 pm</span>&nbsp;and&nbsp;Saturday <span style="color: rgb(244, 180, 38);">1-11:30 pm&nbsp;</span>and Sunday <span class="gold">1-7 pm</span></p>\r\n', '', '4', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `2web_homepage_slider`
--

CREATE TABLE IF NOT EXISTS `2web_homepage_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `heading_line1` text NOT NULL,
  `heading_line2` text NOT NULL,
  `url_link` text NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `select_image_or_video` enum('Image','Video','','') NOT NULL,
  `slider_image` text NOT NULL,
  `slider_video_url` text NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '1',
  `slider_status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `2web_homepage_slider`
--

INSERT INTO `2web_homepage_slider` (`id`, `title`, `heading_line1`, `heading_line2`, `url_link`, `button_text`, `select_image_or_video`, `slider_image`, `slider_video_url`, `sequence`, `slider_status`) VALUES
(1, 'Slide1', 'A Real Life Adventure Awaits :   For Same Day Bookings Call....', '306-384-0008', 'https://www.breakoutsask.com/theme_rooms.html', 'Get Started', 'Image', 'banner_img.jpg', '', 1, 'Active'),
(5, 'Video', 'One Team... One Room... One Hour...', 'Can you BreakOut?', '', '', 'Video', '', 'https://www.youtube.com/embed/O4MY2e5Pbrw', 2, 'Inactive'),
(6, 'test', 'test', 'test', '', '', 'Image', 'banner_img1.jpg', '', 0, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `2web_news_category`
--

CREATE TABLE IF NOT EXISTS `2web_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `title` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `page_link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `added_by` tinyint(1) NOT NULL DEFAULT '1',
  `center_id` int(11) NOT NULL,
  `synchronised` tinyint(1) NOT NULL DEFAULT '0',
  `add_dt` datetime NOT NULL,
  `edit_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key1` (`page_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `2web_news_category`
--

INSERT INTO `2web_news_category` (`id`, `parent_id`, `meta_title`, `meta_keyword`, `meta_description`, `title`, `display_order`, `content`, `page_link`, `is_active`, `added_by`, `center_id`, `synchronised`, `add_dt`, `edit_dt`) VALUES
(9, 0, NULL, NULL, NULL, 'Events', 1, '', 'category1', 1, 1, 0, 0, '0000-00-00 00:00:00', '2015-10-20 03:36:49'),
(10, 0, NULL, NULL, NULL, 'Announcements', 2, '', 'category2', 1, 1, 0, 0, '0000-00-00 00:00:00', '2015-10-20 03:39:50'),
(11, 0, NULL, NULL, NULL, 'Maintenance', 3, '', 'category3', 1, 1, 0, 0, '0000-00-00 00:00:00', '2015-10-20 03:40:00'),
(12, 0, NULL, NULL, NULL, 'Information', 4, '', 'information1', 1, 1, 0, 0, '0000-00-00 00:00:00', '2016-03-15 23:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `2web_news_post`
--

CREATE TABLE IF NOT EXISTS `2web_news_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(250) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `video_url` varchar(500) NOT NULL,
  `description` longtext NOT NULL,
  `excerpt` varchar(300) NOT NULL,
  `post_url` varchar(200) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `posted_by` varchar(100) DEFAULT NULL,
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `comment_count_active` int(25) NOT NULL DEFAULT '0',
  `create_dt` datetime NOT NULL,
  `edit_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `banner_photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key1` (`post_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `2web_news_post`
--

INSERT INTO `2web_news_post` (`id`, `meta_title`, `meta_keyword`, `meta_description`, `title`, `video_url`, `description`, `excerpt`, `post_url`, `is_active`, `is_featured`, `posted_by`, `comment_count`, `comment_count_active`, `create_dt`, `edit_dt`, `banner_photo`) VALUES
(15, '', '', '', 'New Room Under Construction!', '', '<p>BREAKOUT is thrilled&nbsp;to announce that we have our third escape room under construction. We are excited to share this room with our fans and customers. I promise that there is no other room like this in Saskatoon! I don&#39;t want to give away any secrets but I can share a few details....</p>\r\n\r\n<ul>\r\n	<li>This room will hold at least 8 people&nbsp;</li>\r\n	<li>This room will require at least 4 people to play!</li>\r\n	<li>This room will be a fun mix of both search and find as well as story line clues</li>\r\n	<li>You will be locked in the room (with an escape door available)</li>\r\n	<li>This room will have multiple missions so the more players in the room the more fun it will be</li>\r\n</ul>\r\n\r\n<p>Stay tuned as we&nbsp;will release more information as the room progresses!&nbsp;</p>\r\n', '', 'mauris-sagittis-mauris-id-interdum-consectetur', 1, 0, 'BreakOut Sask', 0, 0, '2016-01-15 00:00:00', '2016-01-15 06:00:00', 'chain-and-lock-psd42356.png'),
(18, '', '', '', 'Welcome to BREAKOUT', '', '<p>We are officially open and taking bookings for the Countdown to Detonation room as well as the Dead Professor&#39;s Society room. We are excited and looking forward to having you play with us!</p>\r\n', '', 'test-nulla-semper-enim-nec-dolor-vehicula-pulvinar', 1, 0, 'BreakOut Sask', 0, 0, '2016-01-01 00:00:00', '2016-01-01 06:00:00', ''),
(20, '', '', '', 'Winter is messy!', '', '<p>Good morning BREAKOUT fans! We had a fabulously fun week at BREAKOUT last week. During the winter months we are asking all of our player to remove their outdoor footwear to help save our floors. Please feel free to bring slippers or indoor shoes with you.&nbsp;</p>\r\n', '', 'winter-is-messy', 1, 0, 'anonymous', 0, 0, '2016-01-25 00:00:00', '2016-01-25 06:00:00', ''),
(21, '', '', '', 'It''s here....', '', '<p>It&#39;s official! We have launched our third escape room at BREAKOUT! Bookings are now available to play the MADD Laboratory. We are excited to bring you this room. We believe we have created the&nbsp;hardest escape room in Saskatoon for those who love puzzles and want a good challenge. You may need to play this room twice to get all the way to the end.&nbsp;It is unique to the city in that you will be separated from part of your group by means of a locked door. This room relies on strong team communication skills in order to help everyone escape the room. This room will require a minimum group of 6 players to play this room due to the configuration of the room and the difficulty of the puzzles.&nbsp;While this room is not scary, it does have disturbing content that is not appropriate for children under the age of 14.&nbsp;</p>\r\n\r\n<p>Do you consider yourself an escape room enthusiast? Do you think you are an expert? Have you only played one other escape room and are looking to do another one? This room is for everyone! Come and take on the challenge of the MADD Lab!</p>\r\n', '', 'new-room', 1, 0, 'Roberta', 0, 0, '2016-03-08 00:00:00', '2016-03-08 06:00:00', ''),
(22, '', '', '', 'Team Building', '', '<p>The secret to success for many businesses is having a team that works well together. In fact, the most successful organizations often engage in regular team building exercises. One of the best team building activities available today is the new global phenomenon, escape rooms.</p>\r\n\r\n<p>Escape rooms are the hottest global trend and are quickly climbing to the top of the entertainment ranks. An escape room is an immersive adventure game that takes place in a themed room. Your group must find hidden objects and clues, solve puzzles, think &#39;outside the box&#39;, and unravel mysteries in order of complete their adventure and finish their mission in less than 60 minutes.&nbsp;</p>\r\n\r\n<p>These games are starting to attract the attention of many businesses who are looking to provide an opportunity to their employees to work together &nbsp;and become more productive. Most escape rooms are designed that the more people participating the more successful your group will be. Every mind works a little differently so the more engaged everyone in the group is, the better your chances for success. Also, since each adventure is done under a time constraint, it creates a sense of urgency and excitement. It&#39;s very difficult to create a similar experience in an office setting.</p>\r\n\r\n<p>Escape rooms can be very beneficial to team members with low self esteem or who are struggling to fit into a group. Everyone in the group contributes in some way to the success of the group. Completing an escape room is a great way to boost a player&#39;s confidence, team moral, as well as help a team bond together. It creates an experience that they will talk about and relive, long after the experience is over.&nbsp;</p>\r\n\r\n<p>The urgency of the experience and&nbsp;the sheer volume and complexity of the puzzles encourage players to rely on each other, making this a great tool to strengthen a core team. This helps team learn to trust each other and work together in stressful situations.&nbsp;</p>\r\n\r\n<p>Escape rooms are the perfect venue for employees to work together, have fun, sharpen their skills, &nbsp;and return to work as better confident team members.&nbsp;</p>\r\n', '', 'using-escape-rooms-for-team-building', 1, 0, 'Roberta', 0, 0, '2016-03-15 00:00:00', '2016-03-15 05:00:00', ''),
(23, '', '', '', 'Saskatoon Escape Rooms', '', '<p>Saskatoon is a growing city! Unfortunately not everything has kept pace with the city&#39;s growth. Have you often been faced with another evening with only the &#39;same old&#39; options available for going out and spending time with friends. Let&#39;s be honest, many of us are past the age of going to the bar every weekend, or are just looking for something else to do with our friends. It becomes the same rotation of activities.... movies, dinner, drinks. Sometimes, you may even mix it up with a little golf (full sized or mini). Bored? Saskatoon&#39;s escape room scene is exploding right now. Saskatoon&nbsp;currently has&nbsp;three escape room businesses up and running with a total of 8&nbsp;rooms to play. It&#39;s great news for everybody! Each room is unique in it&#39;s own way with different themes, puzzles and storylines. We have three very different rooms here at BREAKOUT escape rooms. Our rooms vary in story, and difficulty. There is something for everyone! In fact, after you play one room, you will want to come back and play them all... and why not? I can&#39;t think of a better way to spend&nbsp;an evening with friends.&nbsp;</p>\r\n', '', 'saskatoon-escape-rooms', 1, 0, 'anonymous', 0, 0, '2016-04-01 00:00:00', '2016-04-01 05:00:00', ''),
(24, '', '', '', 'Date night at an room escape?', '', '<p>It&#39;s been a long couple of days/week/month and you finally have some down time available so you schedule a much needed date night. If only you could figure out what to do. You&#39;re tired of the same old routine of going to the movies. Dinner sounds good but then what? Looking for something fun and memorable to spice things up a bit? Do an escape room!&nbsp;</p>\r\n\r\n<p>Escape rooms are the perfect activity for a first date. No need to worry about making awkward conversation over dinner. The game is best played as a group of at least four people. This helps break the tension and puts everyone at ease with other players in the room. At first, you might think that being stuck in a room for an hour would make for terrible date idea but you can bet the bank that it will be the most fun you&#39;ve had.&nbsp;It&#39;s extremely fun and so unique that it&#39;s a date no one will ever forget!</p>\r\n\r\n<p>Escape rooms are inherently designed to encourage communication and team building. What better way to break the ice and get to know each other better? Perhaps you&#39;ve been in your relationship for years? This is a great opportunity to work on those communication skills with each other. The problem solving you experience in an escape room can be rewarding in boosting your self esteem and confidence, making you&nbsp;more self assured. Plus, it never hurts to be the one to save your enitre team from perishing in a bomb explosion!&nbsp;You may be surprised at how well you work as a team.</p>\r\n\r\n<p>An escape room takes a lot of the pressure off of a date by turning the focus of the date away from the participants and onto the game. It even allows for a little friendly competition between players. See who can figure out the puzzle, see who can find the hidden compartment... as long as you all work together to complete the room.&nbsp;</p>\r\n\r\n<p>Still want to head to dinner afterwards? No problem! You will spend the next hour or two talking about your adventure and how much fun it was. No more awkward pauses or silences as you rack your brain for something to talk about. In fact, you will most likely still be talking about it long after the night is over. Once it&#39;s time to head home, you&#39;ll marvel at how easy and relaxed the entire night was.</p>\r\n\r\n<p>The next time you find yourself planning a date night, try an escape room. Whether it is a first date or one of many, it will be a memorable one.</p>\r\n', '', 'date-night-at-an-escape-room', 1, 0, 'Roberta', 0, 0, '2016-04-05 00:00:00', '2016-04-05 05:00:00', ''),
(25, '', '', '', 'Escape Room Myths', '', '<p>For many of you who have accepted the challenge of puzzle escape rooms and succeeded, or came tantalizingly close to, you know that few activities offer the same level of fun and excitement. Puzzle escape rooms truly are one of the best unique attractions&nbsp;when you are looking for a fun night out with friends.</p>\r\n\r\n<p>We here at Breakout we noticed some very common myths about Escape Rooms&nbsp;and we are here to set things right once and for all.</p>\r\n\r\n<p>Puzzle escape rooms are scary - <strong>Wrong!</strong><br />\r\nRooms are themed to specific scenarios. There are rooms decorated to look like an ordinary office, others that look like a pirate ship, others look like a laboratory! Whilst there are a few rooms out there specically designed to scary the pants off of you, not all Escape Rooms will fit into this category.</p>\r\n\r\n<p>Puzzle rooms are claustrophobic - <b>Negative!</b><br />\r\nGenerally speaking all rooms have open spaces and fit up to 6 to 8 people comfortably. Some rooms have a few more items in them then others but every rooms should be designed for the number of occupants that is in it&#39;s description.&nbsp;</p>\r\n\r\n<p>Seen one escape room, seen them all - <strong>You got to be kidding?!</strong><br />\r\nPuzzle escape room operators prides themselves of creating unique and innovative puzzles, ciphers, assemblies and challenges. They represent some of the best and most creative escape rooms in the world. No two are ever quite the same, no matter where in the world you go.</p>\r\n\r\n<p>You need to be an Indiana Jones to win - <b>Nope!</b><br />\r\nPuzzle games make you the protagonist of your own mystery story. That being said, you don&#39;t need to be a detective mastermind to succeed. All you need is common sense, logic and intuition. The puzzles can get challenging and the stress of the countdown doesn&#39;t help, but if you stay calm and reason things out, no puzzle is impossible to solve.</p>\r\n\r\n<p>Hard to book online - <strong>NEVER!</strong><br />\r\nAs things stand it can be challenging to find the right escape room in the city. With three very exciting companies ready to take your bookings, however with our booking page we make sure things as as easy as a few clicks! Just hit that Book Online button at the top of our website and start your journey into the world of Escape Rooms!</p>\r\n\r\n<p>Now you have to ask yourself, is there anything keeping you from booking your very own Escape Room?!</p>\r\n', '', 'escape-room-myths', 1, 0, 'Robbie Scott', 0, 0, '2016-04-29 00:00:00', '2016-04-29 05:00:00', ''),
(26, '', '', '', 'Say It Ain''t Snow!', '', '<p>WINTER IS COMING! ... or perhaps it&#39;s already arrived. We are in the mist of our first snow fall and it appears to have caught many of us off guard, including Breakout. With the onslaught of messy weather, we will be once again be asking our customers to remove their shoes at the door. You are more than welcome to bring indoor shoes or slippers if that makes you more confortable, but not necessary. We work hard to keep our floors very clean at Breakout so sock feet are welcome.&nbsp;</p>\r\n\r\n<p>Don&#39;t let the return of winter get you down, Escape Games are the perfect excuse to get out of the house!&nbsp;</p>\r\n', '', 'say-it-aint-snow', 1, 0, 'Roberta', 0, 0, '2016-10-05 00:00:00', '2016-10-05 05:00:00', 'socks.jpg'),
(27, '', '', '', 'Christmas Parties at Breakout', '', '<p>Well, I can&#39;t believe it&#39;s time to talk about Christmas Parties already!</p>\r\n\r\n<p>The Christmas Season is fast approaching and that means PARTIES! There are only a handful of weekends before Christmas as we have started booking Christmas Parties for company staff parties, sports teams, friends, and even family get togethers. It&#39;s important for large group bookings, to make your booking as far in advance as possible so that we can accommodate you.</p>\r\n\r\n<h2><span style="font-family:georgia,serif;"><em><span style="font-size:18px;"><span class="gold">Here are some general guidelines to help you get through your holdiay parties:</span></span></em></span></h2>\r\n\r\n<ol>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Show Up! This is a great opportunity to mingle with your co-workers who will actually be in a good mood</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">DO NOT sit in the corner and ignore everybody. This is a PARTY!</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Dancing is a great idea. Be sure to show off those great moves you&#39;ve been working on.</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Have a casual conversation with your boss and be sure to wish him/her a Merry Christmas.</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Take time to get to know the people you don&#39;t usually interact with at work</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Dress up! Break out those awful Christmas sweaters and keep it fun.</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Take pictures! Looking at the photos is a great way to bond with your co-workers when you return to work</span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span class="gold"><span style="font-size:16px;">Know when to leave. Timing your departure is important. You don&#39;t want to leave too soon before the party is over but be sure to not overstay your welcome either.&nbsp;</span></span></p>\r\n	</li>\r\n</ol>\r\n', '', 'christmas-parties-at-breakout', 1, 0, 'Roberta', 0, 0, '2016-10-07 00:00:00', '2016-10-07 05:00:00', '4eaf49d074f63914a8000eac-1320110545.jpeg'),
(28, '', '', '', 'Cans for Clues', '', '<p>The Team at Breakout Escape Rooms gets to spend a lot of time together. Every day we sit in our little control room watching our teams play, laughing, joking and getting to know each other pretty well. Just the other day we were chatting and one of us came up with the awesome suggestion that we should find a way to get even more involved with our community ( there&#39;s always something more that can be done). After some thought and discussion we have finally come up with a plan. We are excited to announce that we will be participating in the Tree of Plenty campaign for the Saskatoon Food Bank. It is our wish that no one would have to go hungry in our city but until then, it&#39;s up to the rest of us to lend an helping hand. So we have come up with the Cans for Clues initiative</p>\r\n\r\n<p>Here&#39;s how it works:</p>\r\n\r\n<p>For every non-perishable you bring with you to Breakout Escape Rooms, you will get a hint to use in your game. What a great way to help and have fun at the same time.</p>\r\n\r\n<p>Here is a list of some of the Food Bank&#39;s most needed items:</p>\r\n\r\n<ul>\r\n	<li>Infant formula</li>\r\n	<li>Pasta and cereals</li>\r\n	<li>Canned Meats</li>\r\n	<li>Canned Fruits and Vegetables</li>\r\n	<li>Hearty soups and stews</li>\r\n</ul>\r\n\r\n<p>We will have a drop off chest in our briefing room for all donations. We are setting a goal of collecting 100 pounds of non perishable foods to donate to the food bank. &nbsp;</p>\r\n\r\n<p>We are looking forward to seeing you at Breakout</p>\r\n', '', 'cans-for-clues', 1, 0, 'Roberta ', 0, 0, '2016-11-19 00:00:00', '2016-11-19 06:00:00', 'Cans_for_Clues.jpg'),
(29, '', '', '', 'It''s a Party!', '', '<p>We did it! We&#39;ve reached our first anniversary.</p>\r\n\r\n<p>I can&#39;t believe how fast the time has gone! It&#39;s been a crazy fun adventure - designing, building and running escape games that people love and love to play. It&#39;s kept us hopping and constantly growing and evolving our games to bring the best to our customers.</p>\r\n\r\n<p>But more than anything, we have loved the friendships and connections we have made with so many of our customers.</p>\r\n\r\n<p>Allow me to give a shout out to some amazing members of our team:</p>\r\n\r\n<p>Robb&nbsp;is our resident&nbsp;puzzle and game design genius. Robb is responsible for some of your favorite puzzles at Breakout including the game, The Dead Professor Society. It&#39;s not often you will see Robb at Breakout as he works most of his magic behind the scenes.&nbsp;</p>\r\n\r\n<p>Kateyln is our longest running Game Master at Breakout. She has been with us from the beginning and we are excited to celebrate her upcoming one year anniversary with Breakout as well. Katelyn is highly recommended by our customers who love her enthusiasm and excitement for the game. When not working Katelyn can be found&nbsp;attending Centennial Collegiate, playing video games, watching Anime and drawing, in her free time.&nbsp;</p>\r\n\r\n<p>Sydney is another of our adorable rock star Game Masters. Always quick with a smile and a laugh, Sydney is a favorite of many of our teams. When she&#39;s not hanging out with us, she&#39;s attending school at St. Joseph High School, and creating and selling her&nbsp;bath bomb&nbsp;masterpieces through her own company, Fizz-tastic.</p>\r\n\r\n<p>Carlie is the newest member of our team with the great hair. Carlie loves interacting with her teams and using her enthusiam&nbsp;to get her teams excited about their adventure. She can be heard at least once a day, saying how much she LOVES her job! When not at work, Carlie can be found hanging out at home with her menangerie of pets and creating incredible works of art.</p>\r\n\r\n<p>Gordon is our set design &#39;specialist&#39;. Gordon is a gifted artist who has also had a long career of building and designing theatre sets. He brings those skills to Breakout to help build creative immersive environments.</p>\r\n\r\n<p>Richard and Andrew are our tech gurus! These two talented experts are responsible for building and implementing much of our technology in our games. Keep an eye on these two to bring you some amazing puzzles and games in the future!</p>\r\n\r\n<p>Last but never least, is our hard working Owner, Game Designer, and Game Master..... Roberta. She can often be found at Breakout working either&nbsp;behind the scenes and under a pile of paperwork or greeting teams and sharing her passion for escape games and puzzles. She is always ready and willing to talk about the games and the puzzles to anyone who asks but beware... once she starts it&#39;s hard to get her to quit. On those rare occasions she&#39;s not at Breakout, she likes to spend time with her husband, three daughters and two dogs.... whew.. no wonder she&#39;s tired!</p>\r\n\r\n<p>It&#39;s been a rollercoaster year as we can&#39;t wait to take on our next year with even bigger puzzles, better games and fabulous adventures! We love hearing from you, our customers about what we are doing right as well as what isn&#39;t working.&nbsp;</p>\r\n\r\n<p>Be sure to watch for our great contests, puzzles and prizes on our website and social media for our anniversary celebration and we look forward to seeing you at Breakout!</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', 'its-a-party', 1, 0, 'Staff', 0, 0, '2017-01-01 00:00:00', '2017-01-01 06:00:00', 'BreakOuts_1_Year_Celebration7th_of_July,_2019_@_Barkin_Cups_Cafe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `2web_news_post_cat`
--

CREATE TABLE IF NOT EXISTS `2web_news_post_cat` (
  `cat_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  UNIQUE KEY `key1` (`cat_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2web_news_post_cat`
--

INSERT INTO `2web_news_post_cat` (`cat_id`, `post_id`) VALUES
(9, 27),
(9, 28),
(9, 29),
(10, 15),
(10, 18),
(10, 20),
(10, 21),
(11, 20),
(12, 22),
(12, 23),
(12, 24),
(12, 25),
(12, 26);

-- --------------------------------------------------------

--
-- Table structure for table `2web_other_cms_draft`
--

CREATE TABLE IF NOT EXISTS `2web_other_cms_draft` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cms_id` int(11) NOT NULL,
  `contents` longtext NOT NULL,
  `draft_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `2web_other_cms_pages`
--

CREATE TABLE IF NOT EXISTS `2web_other_cms_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(4) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text,
  `meta_description` text,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '1',
  `page_link` varchar(255) DEFAULT NULL,
  `banner_photo` varchar(200) NOT NULL,
  `banner_text` varchar(200) NOT NULL,
  `banner_url` varchar(200) NOT NULL,
  `banner_link_title` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `key1` (`page_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `2web_other_cms_pages`
--

INSERT INTO `2web_other_cms_pages` (`id`, `site_id`, `parent_id`, `meta_title`, `meta_keyword`, `meta_description`, `title`, `content`, `display_order`, `page_link`, `banner_photo`, `banner_text`, `banner_url`, `banner_link_title`, `background_image`, `is_active`) VALUES
(2, 1, 0, 'Sub Test', '', 'Breakout Escape Rooms offers great family fun! Date Nights, Birthday Parties, Stagettes, Tourists, Youth activities.  All our games are for everyone, unlike Deadlock Escapes, which has scary themes.  Our games are one hour, unlike Escape City which are 45 minuted.', 'Sub Test', '', 0, 'sub-test', '', '', '', '', '', 1),
(5, 1, 0, 'Book a room escape', '', 'Book an escape game at Breakout Escape Rooms in Saskatoon.', 'Book Online', '&lt;p&gt;&lt;em&gt;&lt;span style=&quot;font-size:20px;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-family:comic sans ms,cursive;&quot;&gt;&lt;span style=&quot;color:#000000;&quot;&gt;Looking for the Perfect Gift? Try a Gift Voucher!&lt;/span&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/em&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;a href=&quot;http://bookeo.com/go/415534KHA6H15107E39485/buyvoucher&quot; style=&quot;margin: 0px; padding: 0px;&quot; target=&quot;_top&quot;&gt;&lt;img alt=&quot;book now&quot; border=&quot;0&quot; src=&quot;http://www.bookeo.com/buttons/book_buyvoucher_en.png&quot; style=&quot;margin: 0px; padding: 0px;&quot; /&gt;&lt;/a&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p class=&quot;small&quot;&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;Please contact us if you have any questions about our rooms or prices. We can arrange group bookings, special events and parties. Book online or call us direct! Want to play today? Contact us directly for avalibility.&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p class=&quot;small&quot;&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;We are open &lt;strong&gt;&lt;span style=&quot;color:#FFD700;&quot;&gt;Wednesday - Friday 4-11&nbsp;pm, Saturday 1-12&nbsp;and Sunday 1-7&nbsp;pm&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\r\n\r\n&lt;p class=&quot;small&quot;&gt;&nbsp;&lt;/p&gt;\r\n\r\n&lt;p class=&quot;small&quot;&gt;&lt;span style=&quot;font-size:18px;&quot;&gt;805 48 St E, Saskatoon, SK S7K 0X5 | 306-384-0008&lt;/span&gt;&lt;/p&gt;\r\n', 0, 'book-online', 'banner_img.jpg', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_service_component`
--

CREATE TABLE IF NOT EXISTS `2web_service_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `service_component_image` varchar(255) NOT NULL,
  `service_component_video` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_order` int(11) NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `2web_service_component`
--

INSERT INTO `2web_service_component` (`id`, `site_id`, `title`, `service_component_image`, `service_component_video`, `description`, `is_order`, `is_featured`, `is_active`) VALUES
(3, 1, 'GraphicDesign', 'ser-pic-3.jpg', 'www.google.com', '<p>Fusce lobortis suscipit sem id mattis eros mattis eu. Interdum et malesuada fames ac ante ipsum primis in faucibus donec in nibh massa etiam ut tempor ex nunc mi est, porta vel urna sagittis tincidunt scelerisque velit. Ut pharetra finibus neque in pulvinar sapien bibendum vel. Nullam ornare laoreet lacus et hendrerit turpis tincidunt.</p>\n\n<ul>\n <li>Proin venenatis maximus ante. Curabitur ut arcu lobortis</li>\n <li>Nam sapien erat rhoncus vitae leo at eleifend hendrerit nulla.</li>\n <li>Donec bibendum odio ut mauris dapibus interdum.</li>\n <li>Suspendisse pharetra tortor ac tellus eleifend.</li>\n <li>Nullam metus erat, gravida ut dui non, aliquam feugiat massa.</li>\n</ul>\n', 1, 1, 0),
(4, 1, 'Embroidery', 'ser-pic-1.jpg', 'player.vimeo.com/video/70974047', '<p>Fusce lobortis suscipit sem id mattis eros mattis eu. Interdum et malesuada fames ac ante ipsum primis in faucibus donec in nibh massa etiam ut tempor ex nunc mi est, porta vel urna sagittis tincidunt scelerisque velit. Ut pharetra finibus neque in pulvinar sapien bibendum vel. Nullam ornare laoreet lacus et hendrerit turpis tincidunt.</p>\n\n<ul class="num">\n <li><span>1.</span>Proin venenatis maximus ante. Curabitur ut arcu lobortis</li>\n <li><span>2.</span>Nam sapien erat rhoncus vitae leo at eleifend hendrerit nulla.</li>\n <li><span>3.</span>Donec bibendum odio ut mauris dapibus interdum.</li>\n <li><span>4.</span>Suspendisse pharetra tortor ac tellus eleifend.</li>\n <li><span>5.</span>Nullam metus erat, gravida ut dui non, aliquam feugiat massa.</li>\n</ul>\n', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2web_sessions`
--

CREATE TABLE IF NOT EXISTS `2web_sessions` (
  `id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(200) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  `start_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `2web_sessions`
--

INSERT INTO `2web_sessions` (`id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `start_dt`, `data`, `timestamp`) VALUES
('083dd60e297c424939af28e7071dd97e8bd2787a', '198.169.127.145', '', 0, '', '2017-03-30 16:19:40', '__ci_last_regenerate|i:1490890780;', '0000-00-00 00:00:00'),
('16af67b18350febde04cdfe982e4844404dc52f0', '207.228.78.87', '', 0, '', '2017-03-30 16:22:06', '__ci_last_regenerate|i:1490890926;', '0000-00-00 00:00:00'),
('2de332ca870a2b20c89469e9b210074c9491bba1', '70.64.40.199', '', 0, '', '2017-03-30 16:22:35', '__ci_last_regenerate|i:1490890954;', '0000-00-00 00:00:00'),
('5685ded6a417f0d4fe97658fba4aa53334c616ff', '207.195.86.204', '', 0, '', '2017-03-30 16:23:39', '__ci_last_regenerate|i:1490891019;', '0000-00-00 00:00:00'),
('7c656dad238a6da76c385528b1a7eaa9fdd88059', '207.228.78.87', '', 0, '', '2017-03-30 16:22:06', '__ci_last_regenerate|i:1490890926;', '0000-00-00 00:00:00'),
('8263e964f3e994b0084344b74cfba7813fa4e309', '54.174.114.150', '', 0, '', '2017-03-30 16:19:48', '__ci_last_regenerate|i:1490890788;', '0000-00-00 00:00:00'),
('8fa2a28abe636c576d44315ae5fcdec9ef5170a4', '174.2.181.197', '', 0, '', '2017-03-30 16:19:57', '__ci_last_regenerate|i:1490890797;', '0000-00-00 00:00:00'),
('d3d86cd46ce50188290ff97b83d6eac1dacb72cf', '52.90.121.46', '', 0, '', '2017-03-30 16:19:49', '__ci_last_regenerate|i:1490890789;', '0000-00-00 00:00:00'),
('d8230a47a4b053bde1e88c8c5e82b1c9e4007f5c', '71.17.4.59', '', 0, '', '2017-03-30 16:16:54', '__ci_last_regenerate|i:1490890614;', '0000-00-00 00:00:00'),
('edd92848b6fc28307ce5ebbde039b80bca46f4b9', '198.169.127.145', '', 0, '', '2017-03-30 16:21:49', '__ci_last_regenerate|i:1490890909;web_admin_user_name|s:7:"2webmin";web_admin_user_id|s:1:"2";SITE_ID|s:1:"2";web_admin_logged_in|b:1;', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `2web_site_settings`
--

CREATE TABLE IF NOT EXISTS `2web_site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `site_name` varchar(200) DEFAULT NULL,
  `request_quote_email` varchar(255) NOT NULL,
  `max_application` int(11) NOT NULL DEFAULT '3',
  `meta_title` varchar(200) NOT NULL,
  `meta_keyword` varchar(200) NOT NULL,
  `meta_description` varchar(200) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `copy_right` varchar(255) DEFAULT NULL,
  `book_online_link` text NOT NULL,
  `menu_level` tinyint(2) NOT NULL DEFAULT '1',
  `address` text NOT NULL,
  `footer_statement` text NOT NULL,
  `business_hours` varchar(200) NOT NULL,
  `fb_link` varchar(200) NOT NULL,
  `linkedin_link` varchar(200) NOT NULL,
  `twitter_link` varchar(200) NOT NULL,
  `google_link` varchar(200) NOT NULL,
  `youtube_link` varchar(100) NOT NULL,
  `instagram_link` varchar(100) NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `logo_photo` varchar(255) NOT NULL,
  `footer_logo` varchar(255) NOT NULL,
  `site_verification` text NOT NULL,
  `analytics_code` longtext NOT NULL,
  `tumblr_link` varchar(255) NOT NULL,
  `profile_id` varchar(255) NOT NULL,
  `comments_moderated` int(1) NOT NULL DEFAULT '0',
  `show_comment` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `2web_site_settings`
--

INSERT INTO `2web_site_settings` (`id`, `site_id`, `site_name`, `request_quote_email`, `max_application`, `meta_title`, `meta_keyword`, `meta_description`, `contact_name`, `contact_email`, `email`, `phone`, `fax`, `url`, `copy_right`, `book_online_link`, `menu_level`, `address`, `footer_statement`, `business_hours`, `fb_link`, `linkedin_link`, `twitter_link`, `google_link`, `youtube_link`, `instagram_link`, `video_url`, `logo_photo`, `footer_logo`, `site_verification`, `analytics_code`, `tumblr_link`, `profile_id`, `comments_moderated`, `show_comment`) VALUES
(1, 1, 'Breakout', 'bishweswar@2webdesign.com', 3, 'BREAKOUT ESCAPE ROOMS | Saskatoon', 'BREAKOUT ESCAPE ROOM SASKATOON ', 'BREAKOUT Escape Rooms is a fun live escape game in Saskatoon, designed for groups from 4-12 people and can even accommodate large groups up to 30 people for team building', '', NULL, '', '', '', 'https://www.breakoutsask.com/', 'BreakOut Live Entertainment', 'https://www.breakoutsask.com/book-online.html', 1, '', '', '', '', '', '', '', '', '', '0', 'breakout-escape-rooms.png', '', 'VryTuKP9m5xsA9w2ReJh7WUYweafuc3Wq14Yr5naLeM', '<script>\r\n  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\r\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n  })(window,document,''script'',''//www.google-analytics.com/analytics.js'',''ga'');\r\n\r\n  ga(''create'', ''UA-72781440-1'', ''auto'');\r\n  ga(''send'', ''pageview'');\r\n\r\n</script>', '', '115273163', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_social_menus`
--

CREATE TABLE IF NOT EXISTS `2web_social_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `site_id` int(1) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `2web_social_menus`
--

INSERT INTO `2web_social_menus` (`id`, `title`, `site_id`, `is_active`) VALUES
(1, 'Facebook', 1, 1),
(2, 'Tweeter', 1, 1),
(3, 'Linkedin', 1, 1),
(4, 'Google Plus', 1, 1),
(5, 'Youtube', 1, 1),
(6, 'Instagram', 1, 1),
(7, 'Tumblr', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_social_settings`
--

CREATE TABLE IF NOT EXISTS `2web_social_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `social_menus_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sequence` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `2web_social_settings`
--

INSERT INTO `2web_social_settings` (`id`, `site_id`, `social_menus_id`, `link`, `sequence`) VALUES
(2, 1, 1, 'https://www.facebook.com/breakoutsask/', 1),
(3, 1, 2, 'https://twitter.com/@breakoutsask', 2),
(4, 1, 4, 'https://plus.google.com/116531603847839473427', 3);

-- --------------------------------------------------------

--
-- Table structure for table `2web_team`
--

CREATE TABLE IF NOT EXISTS `2web_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `excert` text NOT NULL,
  `description` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL,
  `banner_photo` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `2web_team`
--

INSERT INTO `2web_team` (`id`, `site_id`, `title`, `designation`, `excert`, `description`, `facebook`, `twitter`, `instagram`, `youtube`, `google_plus`, `linkedin`, `display_order`, `banner_photo`, `is_active`) VALUES
(1, 1, 'Victoria Smith', 'Director', 'test', '<pre>\r\nSed bibendum justo id dolor\r\nlobortis lacinia dictum..</pre>\r\n', 'https://www.facebook.com', 'https://www.twiter.com', 'https://www.ins.com', 'https://www.utbe.com', 'https://www.googlee.com', 'https://www.lnkd.com', 1, 'our-team-1.jpg', 1),
(2, 1, 'Victoria Smith', 'Director', 'team_component excert', '<p>Sed bibendum justo id dolor lobortis lacinia dictum..</p>\r\n', 'https://www.facebook.com', 'https://www.twiter.com', 'https://www.ins.com', 'https://www.utbe.com', 'https://www.googlee.com', 'https://www.lnkd.com', 4, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `2web_theme_rooms`
--

CREATE TABLE IF NOT EXISTS `2web_theme_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `theme_image` text NOT NULL,
  `theme_background_image` text NOT NULL,
  `theme_button_link` text NOT NULL,
  `display_order` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `2web_theme_rooms`
--

INSERT INTO `2web_theme_rooms` (`id`, `title`, `description`, `theme_image`, `theme_background_image`, `theme_button_link`, `display_order`, `status`) VALUES
(1, 'Dead Professor Society', '<p><span style="font-family: arial,helvetica,sans-serif;">You are newly graduated students from the U of S. Over the course of your enrollment you have made friends with one of the professors,&nbsp;Gregory Watson. A man full of life and adventure, he was never one to do anything conventionally. However you have recently heard that the professor has committed suicide and was found dead in his office&nbsp;on campus. This was shocking news to you as you had just talked with the Professor and he was ecstatic about his new book being released. The whole thing smells fishy and late one night you find yourself on campus and decide to find out for yourself what happened.</span></p>\r\n\r\n<p><span style="font-family: arial,helvetica,sans-serif;">You creep into the office just as security passes by since&nbsp;you know they make a sweep every sixty minutes and you don&#39;t want to be around when they come back. Your goal tonight is the following;&nbsp;find the professor&#39;s book, find out who killed him or how he died and get out before security comes back.</span></p>\r\n\r\n<p><span style="font-family: arial,helvetica,sans-serif;">Good Luck!</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style="font-family: arial,helvetica,sans-serif;">Looking for the Perfect Gift? Try a Gift Voucher!</span></p>\r\n\r\n<p><a href="http://bookeo.com/go/415534KHA6H15107E39485/buyvoucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_buyvoucher_en.png" style="margin: 0px; padding: 0px;" /></a> <a href="http://bookeo.com/go/415534KHA6H15107E39485/voucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_voucher_en.png" style="margin: 0px; padding: 0px;" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Room Description: Storyline, Cyphers, Physical Puzzles</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Difficulty Level: For those that want an immersive experience and to be challenged.</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Number of players: Minimum:&nbsp;2 Maximum: 8&nbsp;Best Group Size: 6</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">**Note: Will allow groups of 10 but must be booked by phone</span></span></address>\r\n', 'professor.jpg', 'theme_crack_bg1.png', 'http://bookeo.com/breakoutrooms?type=415534YEPJ315107E80DD1', 1, 'Active'),
(5, 'MADD Labratory', '<p><span style="font-family: arial,helvetica,sans-serif;">Dr. Deluice seems like a pretty trust worthy individual. His credentials are impeccable and he has won many awards for his work in genetics. So why do you feel so uneasy? Maybe it&#39;s his office,&nbsp;with its confined space and its strange smells, or maybe its because Dr Deluice has a giant syringe in his hands. Whatever it is, something is definitely off about this entire situation.</span></p>\r\n\r\n<p><span style="font-family: arial,helvetica,sans-serif;">All you wanted was some quick cash and all you needed to do was take some diet pills. Little did you know that Dr. Deluice was kidnapping people and injecting them with his experimental serums! You now have 60 minutes before the serum changes you into something horrible and you become a beast of the night!</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href="http://bookeo.com/go/415534KHA6H15107E39485/buyvoucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_buyvoucher_en.png" style="margin: 0px; padding: 0px;" /></a> <a href="http://bookeo.com/go/415534KHA6H15107E39485/voucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_voucher_en.png" style="margin: 0px; padding: 0px;" /></a></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Room Description: Storyline, Logic Problems, Communication</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Difficulty Level: </span></span>Suitable for all experience levels</address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">Number of players:&nbsp;Minimum: 4&nbsp;players&nbsp;Maximum: 10. Best: 8-10</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="font-size: 14px;">** Note: Will allow groups of 12 but must be booked by phone</span></span></address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;">&nbsp;</address>\r\n\r\n<address style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;">&nbsp;</address>\r\n\r\n<p style="margin: 0px; padding: 0px; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;">&nbsp;</p>\r\n', 'rot_c52d02b0-727c-4f9c-b485-ea1f738b0a05.jpg', '', 'http://bookeo.com/breakoutrooms?type=41553PFJ6KW15322E8724D', 3, 'Active'),
(6, 'Code Red: Infiltration', '<p><span style="font-family: arial,helvetica,sans-serif;">The year is 1981. The United States of America and the USSR are on the brink of nuclear war. The Americans are developing a weapon that will win them the war. Russia has trained you and your team as sleeper agents, living as ordinary Americans. Your mission: Infiltrate the Fort Wallaby Army base and steal the documents revealing the&nbsp;location of the new weapon. Mother Russia is counting on you!</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Looking for the Perfect Gift? Try a Gift Voucher!</p>\r\n\r\n<p><a href="http://bookeo.com/go/415534KHA6H15107E39485/buyvoucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_buyvoucher_en.png" style="margin: 0px; padding: 0px;" /></a> <a href="http://bookeo.com/go/415534KHA6H15107E39485/voucher" style="margin: 0px; padding: 0px;" target="_top"><img alt="book now" border="0" src="http://www.bookeo.com/buttons/book_voucher_en.png" style="margin: 0px; padding: 0px;" /></a></p>\r\n\r\n<address><span style="font-size: 14px;">Room Description: Storyline, Puzzles, Advanced Technology</span></address>\r\n\r\n<address><span style="font-size: 14px;">Difficulty Level:&nbsp;Suitable for all experience levels, great for first time players</span></address>\r\n\r\n<address><span style="font-size: 14px;">Number of players:&nbsp;Minimum: 2 players&nbsp;Maximum: 6. Best: 4-6</span></address>\r\n\r\n<address><span style="font-size: 14px;">**Note: Will not allow groups over 6 players</span></address>\r\n\r\n<p>&nbsp;</p>\r\n', 'resize_pic.jpg', '', 'http://bookeo.com/breakoutrooms?type=41553JWWNHA1564C1B8E66', 2, 'Active'),
(7, 'Russian Around', '<h2 style="font-style:italic;"><span style="color:#ff0033;"><span style="font-size:16px;"><span style="font-family:arial,helvetica,sans-serif;"><span id="docs-internal-guid-1310d36f-e793-ba4b-e517-fe85ad090a70"><span style="vertical-align: baseline; white-space: pre-wrap;">We are excited to announce that we have a new Real Life Adventure game available for ONE DAY ONLY! Limited tickets available!</span></span></span></span></span></h2>\r\n\r\n<p><span style="color:#ff0033;"><span id="docs-internal-guid-1310d36f-e793-6991-fff1-d7b5b7a9e4cb"><span style="font-size: 11pt; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;">The U.S Military have managed to catch the Russian spies that have infiltrated Ft. Wallaby Army Base&hellip; well, almost all. One spy remains at large and has evade capture on numerous occasions. Intelligence reports suggest that the elusive spy is in Saskatoon, Sk. You and your team have been recruited to try and locate the missing Russian spy and bring them to justice! Your only weapons are your intellect and imagination. Will you be outwitted? or Will you succeed? </span></span></span></p>\r\n\r\n<p><span style="color:#ff0033;"><span id="docs-internal-guid-1310d36f-e794-3ca7-1cdc-0834b3538db4"><span style="font-size: 11pt; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;">Russian around will only be available for ONE DAY, April 14, 2017 (Good Friday) between 11 am and 5 pm. You must register as a team; anywhere from 2-5 people may be on a team. </span></span><span id="docs-internal-guid-1310d36f-e794-8d03-312b-105b5dc41216"><span style="font-size: 11pt; font-family: Arial; vertical-align: baseline; white-space: pre-wrap;">This game is not a race; you can play at your own pace.</span></span></span></p>\r\n', 'website.png', '', 'http://bookeo.com/breakoutrooms?type=415536PW7T715ADE079CEC', 4, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
