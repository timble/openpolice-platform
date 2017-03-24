SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_TIME_ZONE=@@TIME_ZONE, TIME_ZONE='+00:00';
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`extensions_extension_id`, `title`, `name`, `params`, `enabled`)
VALUES
	(7, 'Contacts', 'com_contacts', '', 1),
	(19, 'Files', 'com_files', 'pload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nimage_path=images\nrestrict_uploads=1\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html', 1),
	(20, 'Articles', 'com_articles', '', 1),
	(23, 'Languages', 'com_languages', '', 1),
	(25, 'Pages', 'com_pages', '', 1),
	(28, 'Extensions', 'com_extensions', '', 1),
	(31, 'Users', 'com_users', 'allowUserRegistration=\"0\"\nnew_usertype=\"18\"\nuseractivation=\"1\"\nfrontend_userparams=\"1\"\npassword_length=\"5\"\npassword_expire=\"0\"\nrecaptcha_public_key=\"\"\nrecaptcha_private_key=\"\"\nmaximum_login_attempts=5\nlockout_time=900', 1),
	(32, 'Cache', 'com_cache', '', 1),
	(34, 'Activities', 'com_activities', '', 1),
	(35, 'Dashboard', 'com_dashboard', '', 1),
	(36, 'Districts', 'com_districts', '', 1),
	(37, 'Traffic', 'com_traffic', '', 1),
	(38, 'News', 'com_news', '', 1),
	(39, 'Streets', 'com_streets', '', 1),
	(40, 'Questions', 'com_questions', '', 1),
	(41, 'Police', 'com_police', '', 1),
	(42, 'Support', 'com_support', '', 1),
	(43, 'About', 'com_about', '', 1),
	(44, 'Uploads', 'com_uploads', '', 1),
	(45, 'Press', 'com_press', '', 1),
	(46, 'BIN', 'com_bin', '', 1),
	(47, 'Analytics', 'com_analytics', '', 1),
	(48, 'Found', 'com_found', '', 1),
	(49, 'Wanted', 'com_wanted', '', 1),
	(50, 'Statistics', 'com_statistics', '', 1);



--
-- Dumping data for table `files_containers`
--

INSERT INTO `files_containers` (`files_container_id`, `slug`, `title`, `path`, `parameters`)
VALUES
	(1,'files-files','Files','files','{\"thumbnails\": true,\"maximum_size\":\"10485760\",\"allowed_extensions\": [\"bmp\", \"csv\", \"doc\", \"gif\", \"ico\", \"jpg\", \"jpeg\", \"odg\", \"odp\", \"ods\", \"odt\", \"pdf\", \"png\", \"ppt\", \"swf\", \"txt\", \"xcf\", \"xls\"],\"allowed_mimetypes\": [\"image/jpeg\", \"image/gif\", \"image/png\", \"image/bmp\", \"application/x-shockwave-flash\", \"application/msword\", \"application/excel\", \"application/pdf\", \"application/powerpoint\", \"text/plain\", \"application/x-zip\"],\"allowed_media_usergroup\":3}'),
	(2,'attachments-attachments','Attachments','attachments','{\"thumbnails\": false,\"maximum_size\":\"10485760\",\"allowed_extensions\": [\"bmp\", \"csv\", \"doc\", \"gif\", \"ico\", \"jpg\", \"jpeg\", \"odg\", \"odp\", \"ods\", \"odt\", \"pdf\", \"png\", \"ppt\", \"sql\", \"swf\", \"txt\", \"xcf\", \"xls\"],\"allowed_mimetypes\": [\"image/jpeg\", \"image/gif\", \"image/png\", \"image/bmp\", \"application/x-shockwave-flash\", \"application/msword\", \"application/excel\", \"application/pdf\", \"application/powerpoint\", \"text/plain\", \"application/x-zip\"]}');


--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `primary`)
VALUES
	(1,'admin','English (United Kingdom)','English (United Kingdom)','en-GB','en',1,1),
	(2,'site','English (United Kingdom)','English (United Kingdom)','en-GB','en',1,1);


--
-- Dumping data for table `languages_tables`
--

INSERT INTO `languages_tables` (`languages_table_id`, `extensions_extension_id`, `name`, `unique_column`, `enabled`)
VALUES
	(1,20,'articles','articles_article_id',0),
	(2,20,'categories','categories_category_id',0);


--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `users_group_id`, `title`, `slug`, `link_url`, `link_id`, `type`, `published`, `hidden`, `home`, `extensions_extension_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `params`)
VALUES
	(1, 1, 0, 'Home', 'home', 'option=com_police&view=page&layout=homepage', NULL, 'component', 1, 1, 1, 41, 1, NULL, NULL, NULL, NULL, NULL, 0, 'page_title=\"Open Police\"'),
	(2, 2, 0, 'Dashboard', 'dashboard', 'option=com_dashboard&view=dashboard', NULL, 'component', 1, 0, 0, 35, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(3, 2, 1, 'Pages', 'pages', 'option=com_pages&view=pages', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(4, 2, 0, 'Content', 'content', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(5, 2, 0, 'Files', 'files', 'option=com_files&view=files', NULL, 'component', 1, 0, 0, 19, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(6, 2, 1, 'Users', 'users', 'option=com_users&view=users', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(7, 2, 1, 'Extensions', 'extensions', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(8, 2, 1, 'Settings', 'settings', 'option=com_extensions&view=settings', NULL, 'component', 1, 0, 0, 28, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(9, 2, 0, 'Tools', 'tools', NULL, NULL, 'separator', 1, 0, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(10, 2, 0, 'Activity Logs', 'activity-logs', 'option=com_activities&view=activities', NULL, 'component', 1, 0, 0, 34, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(11, 2, 1, 'Clean Cache', 'clean-cache', 'option=com_cache&view=items', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(12, 2, 1, 'Articles', 'articles', 'option=com_articles&view=articles', NULL, 'component', 1, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(14, 2, 0, 'Contacts', 'contacts', 'option=com_contacts&view=contacts', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(15, 2, 1, 'Languages', 'languages', 'option=com_languages&view=languages', NULL, 'component', 1, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(16, 2, 1, 'Articles', 'articles', 'option=com_articles&view=articles', NULL, 'component', 1, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(17, 2, 1, 'Categories', 'categories', 'option=com_articles&view=categories', NULL, 'component', 1, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(20, 2, 0, 'Contacts', 'contacts', 'option=com_contacts&view=contacts', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(21, 2, 1, 'Categories', 'categories', 'option=com_contacts&view=categories', NULL, 'component', 1, 0, 0, 7, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(22, 2, 1, 'Languages', 'languages', 'option=com_languages&view=languages', NULL, 'component', 1, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(23, 2, 1, 'Components', 'components', 'option=com_languages&view=components', NULL, 'component', 1, 0, 0, 23, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(24, 2, 1, 'Pages', 'pages', 'option=com_pages&view=pages', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(25, 2, 1, 'Menus', 'menus', 'option=com_pages&view=menus', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(26, 2, 1, 'Modules', 'modules', 'option=com_pages&view=modules', NULL, 'component', 1, 0, 0, 25, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(27, 2, 0, 'Users', 'users', 'option=com_users&view=users', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(28, 2, 0, 'Groups', 'groups', 'option=com_users&view=groups', NULL, 'component', 1, 0, 0, 31, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(29, 2, 1, 'Items', 'items', 'option=com_cache&view=items', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(30, 2, 1, 'Groups', 'groups', 'option=com_cache&view=groups', NULL, 'component', 1, 0, 0, 32, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(31, 2, 1, 'Terms', 'terms', 'option=com_articles&view=terms', NULL, 'component', 1, 0, 0, 20, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL),
	(32, 2, 0, 'Questions', 'questions', 'option=com_questions&view=questions', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:35:06', NULL, NULL, NULL, NULL, 0, ''),
	(33, 2, 0, 'Questions', 'questions', 'option=com_questions&view=questions', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:35:47', NULL, NULL, NULL, NULL, 0, ''),
	(34, 2, 0, 'Categories', 'categories', 'option=com_questions&view=categories', NULL, 'component', 0, 0, 0, 40, 1, '2013-04-28 19:36:02', NULL, NULL, NULL, NULL, 0, ''),
	(36, 1, 0, 'Licences and permits', 'licences-and-permits', 'option=com_articles&view=articles&category=1', NULL, 'component', 1, 0, 0, 20, 1, '2013-04-28 19:37:58', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Find out how to apply for a licence or permit.\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(37, 1, 0, 'News', 'news', 'option=com_news&view=articles', NULL, 'component', 1, 1, 0, 38, 1, '2013-04-28 19:41:46', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(39, 1, 0, 'Road safety', 'road-safety', 'option=com_police&view=page&layout=catalogue', NULL, 'component', 1, 0, 0, 37, 1, '2013-04-28 19:44:21', NULL, NULL, NULL, NULL, 0, 'show_create_date=\"0\"\nshow_modify_date=\"0\"\npage_title=\"\"\npage_description=\"Includes fine, road safety checks, accident, parking.\"'),
	(40, 1, 0, 'About us', 'about-us', 'option=com_articles&view=articles&category=11', NULL, 'component', 1, 0, 0, 20, 1, '2013-04-28 19:50:18', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Includes organisation, jobs, projects and regulations\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(41, 1, 0, 'Contact us', 'contact', 'option=com_police&view=page&layout=catalogue', NULL, 'component', 1, 0, 0, 20, 1, '2013-04-28 19:50:47', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Contact the police in emergency or non-emergency situations\"'),
	(42, 1, 0, 'Prevention', 'prevention', 'option=com_articles&view=articles&category=4', NULL, 'component', 1, 0, 0, 40, 1, '2013-04-28 19:52:30', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Decrease the chances of crime happening to you.\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(43, 1, 0, 'Your neighbourhood', 'your-neighbourhood', 'option=com_districts&view=relations', NULL, 'component', 1, 0, 0, 36, 1, '2013-04-28 19:52:41', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"The neighbourhood officer is your primary point of contact with the police\"'),
	(44, 1, 0, 'Services', 'services', 'option=com_contacts&view=contacts&category=2', NULL, 'component', 1, 0, 0, 7, 1, '2013-04-28 19:52:53', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Includes reception, hospitality, road safety, students and communication\"'),
	(45, 2, 0, 'News', 'news', 'option=com_news&view=articles', NULL, 'component', 1, 0, 0, 38, 1, '2013-04-28 20:05:02', NULL, NULL, NULL, NULL, 0, ''),
	(47, 2, 0, 'Traffic', 'traffic', 'option=com_traffic&view=articles', NULL, 'component', 1, 0, 0, 37, 1, '2013-05-11 15:29:00', NULL, NULL, NULL, NULL, 0, 'articles_per_page=\"10\"'),
	(53, 2, 0, 'Districts', 'districts', 'option=com_districts&view=districts', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:37:42', NULL, NULL, NULL, NULL, 0, ''),
	(54, 2, 0, 'Districts', 'districts', 'option=com_districts&view=districts', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:37:52', NULL, NULL, NULL, NULL, 0, ''),
	(55, 2, 0, 'Officers', 'officers', 'option=com_districts&view=officers', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:38:01', NULL, NULL, NULL, NULL, 0, ''),
	(56, 2, 0, 'Relations', 'relations', 'option=com_districts&view=relations', NULL, 'component', 1, 0, 0, 36, 1, '2013-05-12 14:38:14', NULL, NULL, NULL, NULL, 0, ''),
	(57, 2, 0, 'Streets', 'streets', 'option=com_streets&view=streets', NULL, 'component', 1, 0, 0, 39, 1, '2013-05-12 14:38:41', NULL, NULL, NULL, NULL, 0, ''),
	(66, 1, 0, 'Emergency and support lines', 'emergency-and-support-lines', 'option=com_contacts&view=contacts&category=3', NULL, 'component', 1, 0, 0, 7, 1, '2013-05-13 14:28:47', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"List of emergency and support telephone numbers\"'),
	(89, 1, 0, 'Downloads', 'downloads', 'option=com_files&view=directory&folder=downloads&layout=table', NULL, 'component', 0, 1, 0, 19, 1, '2013-05-17 12:50:26', NULL, NULL, NULL, NULL, 0, 'show_folders=\"1\"\nhumanize_filenames=\"1\"\nlimit=\"-1\"\nsort=\"name\"\ndirection=\"asc\"\npage_title=\"\"'),
	(92, 2, 0, 'Support', 'support', 'option=com_support&view=tickets', NULL, 'component', 1, 0, 0, 45, 1, '2013-09-25 13:36:11', NULL, NULL, NULL, NULL, 0, ''),
	(93, 2, 0, 'About us', 'about-us', 'option=com_about&view=articles', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:41:43', NULL, NULL, NULL, NULL, 0, ''),
	(94, 2, 0, 'Articles', 'articles', 'option=com_about&view=articles', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:42:47', NULL, NULL, NULL, NULL, 0, ''),
	(95, 2, 0, 'Categories', 'categories', 'option=com_about&view=categories', NULL, 'component', 1, 0, 0, 43, 1, '2013-10-03 14:42:55', NULL, NULL, NULL, NULL, 0, ''),
	(96, 2, 0, 'Traffic', 'traffic', 'option=com_traffic&view=articles', NULL, 'component', 1, 0, 0, 37, 1, '2014-01-17 14:56:07', NULL, NULL, NULL, NULL, 0, ''),
	(97, 2, 0, 'Categories', 'categories', 'option=com_traffic&view=categories', NULL, 'component', 1, 0, 0, 37, 1, '2014-01-17 14:56:18', NULL, NULL, NULL, NULL, 0, ''),
	(98, 2, 0, 'Hours', 'hours', 'option=com_contacts&view=hours', NULL, 'component', 1, 0, 0, 7, 1, '2014-02-13 11:14:14', NULL, NULL, NULL, NULL, 0, ''),
	(99, 2, 1, 'Import', 'import', 'option=com_uploads&view=uploads', NULL, 'component', 1, 0, 0, 44, 1, '2014-04-23 13:50:40', NULL, NULL, NULL, NULL, 0, ''),
	(100, 2, 0, 'Press', 'press', 'option=com_press&view=articles', NULL, 'component', 1, 0, 0, 45, 1, '2014-04-25 09:36:08', NULL, NULL, NULL, NULL, 0, ''),
	(101, 1, 0, 'Press', 'press', 'option=com_press&view=articles', NULL, 'component', 1, 1, 0, 45, 1, '2014-04-25 09:51:10', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(102, 2, 0, 'BIN', 'bin', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:40', NULL, NULL, NULL, NULL, 0, ''),
	(103, 2, 0, 'Districts', 'districts', 'option=com_bin&view=districts', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:24:50', NULL, NULL, NULL, NULL, 0, ''),
	(104, 2, 0, 'Relations', 'relations', 'option=com_bin&view=relations', NULL, 'component', 0, 0, 0, 46, 1, '2014-06-11 09:25:13', NULL, NULL, NULL, NULL, 0, ''),
	(106, 1, 0, 'Terms and conditions', 'terms-and-conditions', 'option=com_police&view=page&layout=terms', NULL, 'component', 1, 1, 0, 41, 1, '2014-09-08 10:05:14', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(107, 1, 0, 'Cookies', 'cookies', 'option=com_police&view=page&layout=cookies', NULL, 'component', 1, 1, 0, 41, 1, '2014-09-08 10:05:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(108, 1, 0, 'Search', 'search', 'option=com_questions&view=questions&layout=search', NULL, 'component', 0, 1, 0, 40, 1, '2014-10-16 14:38:09', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(109, 2, 0, 'Analytics', 'analytics', 'option=com_analytics&view=analytic', NULL, 'component', 1, 0, 0, 47, 1, '2014-11-28 13:18:18', NULL, NULL, NULL, NULL, 0, ''),
	(110, 1, 0, 'Fine', 'fine', 'option=com_articles&view=articles&category=7', NULL, 'component', 1, 0, 0, 20, 1, '2014-12-01 17:28:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Penalty points, fines and driving bans\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(111, 1, 0, 'Accident', 'accident', 'option=com_articles&view=articles&category=8', NULL, 'component', 1, 0, 0, 20, 1, '2014-12-01 17:28:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"How to report a traffic accident and further information\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(112, 1, 0, 'Regulations', 'regulations', 'option=com_articles&view=articles&category=9', NULL, 'component', 1, 0, 0, 20, 1, '2014-12-01 17:28:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Rules and regulation for driving any vehicle on road\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(113, 1, 0, 'Road safety checks', 'road-safety-checks', 'option=com_traffic&view=articles&category=19', NULL, 'component', 1, 0, 0, 20, 1, '2014-12-01 17:28:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Planning and results of our road safety checks\"'),
	(114, 1, 0, 'Results', 'results', 'option=com_traffic&view=articles&category=19&layout=results&results=true', NULL, 'component', 1, 1, 0, 20, 1, '2014-12-01 17:28:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(115, 2, 0, 'Found', 'found', 'option=com_found&view=items', NULL, 'component', 1, 0, 0, 48, 1, '2015-01-30 15:15:12', NULL, NULL, NULL, NULL, 0, ''),
	(116, 1, 0, 'Found', 'found-items', 'option=com_found&view=items', NULL, 'component', 1, 1, 0, 48, 1, '2015-01-30 15:48:04', NULL, NULL, NULL, NULL, 0, ''),
	(117, 1, 0, 'Wanted', 'wanted', 'option=com_wanted&view=sections', NULL, 'component', 1, 1, 0, 49, 1, '2015-02-17 14:06:24', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(118, 2, 0, 'Wanted', 'wanted', 'option=com_wanted&view=articles', NULL, 'component', 1, 0, 0, 49, 1, '2015-02-17 14:07:56', NULL, NULL, NULL, NULL, 0, ''),
	(119, 1, 0, 'Statistieken', 'statistieken', 'option=com_statistics&view=cities', NULL, 'component', 0, 1, 0, 50, 1, '2015-03-25 17:13:31', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"'),
	(120, 1, 0, 'Parking', 'parking', 'option=com_articles&view=articles&category=10', NULL, 'component', 1, 0, 0, 20, 1, '2017-01-27 10:33:31', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"On parking in the city\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(121, 1, 0, 'Declaration or report', 'declaration-or-report', 'option=com_articles&view=articles&category=6', NULL, 'component', 1, 0, 0, 20, 1, '2017-01-27 10:33:31', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"Including reporting suspected crimes or disturbance\"\narticles_per_page=\"99\"\nsort_by=\"title\"'),
	(122, 1, 0, 'Police stations', 'police-stations', 'option=com_contacts&view=contacts&category=1', NULL, 'component', 1, 0, 0, 7, 1, '2013-04-28 19:52:53', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"\npage_description=\"List of all the police stations across our territory\"'),
	(123, 1, 0, 'Search', 'search', 'option=com_police&view=page&layout=search\n', NULL, 'component', 1, 1, 0, 41, 1, '2014-09-08 10:05:27', NULL, NULL, NULL, NULL, 0, 'page_title=\"\"');

--
-- Dumping data for table `pages_closures`
--

INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(1, 1, 0),
	(2, 2, 0),
	(3, 3, 0),
	(4, 4, 0),
	(5, 5, 0),
	(6, 6, 0),
	(7, 7, 0),
	(8, 8, 0),
	(9, 9, 0),
	(10, 10, 0),
	(11, 11, 0),
	(12, 12, 0),
	(14, 14, 0),
	(15, 15, 0),
	(16, 16, 0),
	(17, 17, 0),
	(20, 20, 0),
	(21, 21, 0),
	(22, 22, 0),
	(23, 23, 0),
	(24, 24, 0),
	(25, 25, 0),
	(26, 26, 0),
	(27, 27, 0),
	(28, 28, 0),
	(29, 29, 0),
	(30, 30, 0),
	(31, 31, 0),
	(32, 32, 0),
	(33, 33, 0),
	(34, 34, 0),
	(36, 36, 0),
	(37, 37, 0),
	(39, 39, 0),
	(40, 40, 0),
	(41, 41, 0),
	(42, 42, 0),
	(43, 43, 0),
	(44, 44, 0),
	(45, 45, 0),
	(47, 47, 0),
	(53, 53, 0),
	(54, 54, 0),
	(55, 55, 0),
	(56, 56, 0),
	(57, 57, 0),
	(66, 66, 0),
	(89, 89, 0),
	(92, 92, 0),
	(93, 93, 0),
	(94, 94, 0),
	(95, 95, 0),
	(96, 96, 0),
	(97, 97, 0),
	(98, 98, 0),
	(99, 99, 0),
	(100, 100, 0),
	(101, 101, 0),
	(102, 102, 0),
	(103, 103, 0),
	(104, 104, 0),
	(106, 106, 0),
	(107, 107, 0),
	(108, 108, 0),
	(109, 109, 0),
	(110, 110, 0),
	(111, 111, 0),
	(112, 112, 0),
	(113, 113, 0),
	(114, 114, 0),
	(115, 115, 0),
	(116, 116, 0),
	(117, 117, 0),
	(118, 118, 0),
	(119, 119, 0),
	(120, 120, 0),
	(121, 121, 0),
	(122, 122, 0),
	(123, 123, 0),
	(3, 24, 1),
	(3, 25, 1),
	(3, 26, 1),
	(4, 12, 1),
	(4, 14, 1),
	(4, 32, 1),
	(4, 45, 1),
	(4, 47, 1),
	(4, 53, 1),
	(4, 93, 1),
	(4, 100, 1),
	(4, 102, 1),
	(4, 115, 1),
	(4, 118, 1),
	(6, 27, 1),
	(6, 28, 1),
	(7, 8, 1),
	(9, 10, 1),
	(9, 11, 1),
	(9, 15, 1),
	(9, 57, 1),
	(9, 99, 1),
	(9, 109, 1),
	(11, 29, 1),
	(11, 30, 1),
	(12, 16, 1),
	(12, 17, 1),
	(12, 31, 1),
	(14, 20, 1),
	(14, 21, 1),
	(14, 98, 1),
	(15, 22, 1),
	(15, 23, 1),
	(32, 33, 1),
	(32, 34, 1),
	(36, 108, 1),
	(39, 110, 1),
	(39, 111, 1),
	(39, 112, 1),
	(39, 113, 1),
	(39, 120, 1),
	(41, 43, 1),
	(41, 44, 1),
	(41, 66, 1),
	(41, 122, 1),
	(47, 96, 1),
	(47, 97, 1),
	(53, 54, 1),
	(53, 55, 1),
	(53, 56, 1),
	(93, 94, 1),
	(93, 95, 1),
	(102, 103, 1),
	(102, 104, 1),
	(113, 114, 1),
	(4, 16, 2),
	(4, 17, 2),
	(4, 20, 2),
	(4, 21, 2),
	(4, 31, 2),
	(4, 33, 2),
	(4, 34, 2),
	(4, 54, 2),
	(4, 55, 2),
	(4, 56, 2),
	(4, 94, 2),
	(4, 95, 2),
	(4, 96, 2),
	(4, 97, 2),
	(4, 98, 2),
	(4, 103, 2),
	(4, 104, 2),
	(9, 22, 2),
	(9, 23, 2),
	(9, 29, 2),
	(9, 30, 2),
	(39, 114, 2);



--
-- Dumping data for table `pages_menus`
--

INSERT INTO `pages_menus` (`pages_menu_id`, `application`, `title`, `slug`, `description`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`)
VALUES
	(1,'site','Main Menu','mainmenu','The main menu for the site',1,NULL,NULL,NULL,NULL,NULL),
	(2,'admin','Menubar','menubar','1',1,NULL,NULL,NULL,NULL,NULL);


--
-- Dumping data for table `pages_modules`
--

INSERT INTO `pages_modules` (`pages_module_id`, `title`, `content`, `ordering`, `position`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `published`, `name`, `access`, `params`, `extensions_extension_id`, `application`)
VALUES
	(1,'Main Menu','',2,'navigation',1,NULL,1,'2013-04-28 19:51:32',NULL,NULL,1,'mod_menu',0,'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"0\"\nend_level=\"1\"\nshow_children=\"never\"\nclass=\"\"\ncache=\"1\"',25,'site'),
	(2,'Left Menu','',1,'left',NULL,NULL,62,'2013-04-18 17:05:29',1,'2013-08-02 19:37:11',1,'mod_menu',0,'menu_id=\"1\"\nshow_title=\"0\"\nstart_level=\"2\"\nend_level=\"0\"\nshow_children=\"active\"\nclass=\"nav nav--list\"\ncache=\"0\"',25,'site'),
	(4,'Breadcrumbs','',1,'breadcrumbs',1,'2013-05-07 13:17:47',NULL,NULL,0,'0000-00-00 00:00:00',1,'mod_breadcrumbs',0,'showHome=1\nhomeText=Home\nshowLast=1',25,'site');


--
-- Dumping data for table `pages_modules_pages`
--

INSERT INTO `pages_modules_pages` (`pages_module_id`, `pages_page_id`)
VALUES
	(1, 0),
	(2, 39),
	(2, 40),
	(2, 41),
	(2, 42),
	(2, 43),
	(2, 44),
	(2, 66),
	(2, 110),
	(2, 111),
	(2, 112),
	(2, 113),
	(2, 114),
	(4, 0),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1);


--
-- Dumping data for table `pages_orderings`
--

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(1, 00000000005, 00000000001),
	(2, 00000000002, 00000000001),
	(3, 00000000005, 00000000002),
	(4, 00000000001, 00000000003),
	(5, 00000000004, 00000000004),
	(6, 00000000008, 00000000005),
	(7, 00000000003, 00000000006),
	(8, 00000000001, 00000000001),
	(9, 00000000007, 00000000008),
	(10, 00000000001, 00000000001),
	(11, 00000000002, 00000000002),
	(12, 00000000001, 00000000008),
	(14, 00000000003, 00000000005),
	(15, 00000000005, 00000000005),
	(16, 00000000001, 00000000001),
	(17, 00000000002, 00000000001),
	(20, 00000000002, 00000000001),
	(21, 00000000001, 00000000002),
	(22, 00000000002, 00000000001),
	(23, 00000000001, 00000000002),
	(24, 00000000003, 00000000001),
	(25, 00000000001, 00000000002),
	(26, 00000000002, 00000000003),
	(27, 00000000002, 00000000001),
	(28, 00000000001, 00000000002),
	(29, 00000000002, 00000000001),
	(30, 00000000001, 00000000002),
	(31, 00000000003, 00000000002),
	(32, 00000000009, 00000000002),
	(33, 00000000001, 00000000002),
	(34, 00000000002, 00000000003),
	(36, 00000000003, 00000000003),
	(37, 00000000006, 00000000002),
	(39, 00000000005, 00000000005),
	(40, 00000000006, 00000000006),
	(41, 00000000001, 00000000001),
	(42, 00000000004, 00000000004),
	(43, 00000000003, 00000000001),
	(44, 00000000002, 00000000003),
	(45, 00000000005, 00000000001),
	(47, 00000000008, 00000000003),
	(53, 00000000010, 00000000006),
	(54, 00000000001, 00000000001),
	(55, 00000000002, 00000000002),
	(56, 00000000003, 00000000003),
	(57, 00000000008, 00000000003),
	(66, 00000000004, 00000000004),
	(89, 00000000003, 00000000008),
	(92, 00000000006, 00000000007),
	(93, 00000000006, 00000000004),
	(94, 00000000001, 00000000001),
	(95, 00000000002, 00000000002),
	(96, 00000000002, 00000000001),
	(97, 00000000001, 00000000002),
	(98, 00000000003, 00000000003),
	(99, 00000000004, 00000000004),
	(100, 00000000007, 00000000010),
	(101, 00000000008, 00000000009),
	(102, 00000000002, 00000000011),
	(103, 00000000001, 00000000001),
	(104, 00000000002, 00000000002),
	(106, 00000000002, 00000000010),
	(107, 00000000009, 00000000011),
	(108, 00000000001, 00000000001),
	(109, 00000000001, 00000000006),
	(110, 00000000002, 00000000002),
	(111, 00000000001, 00000000001),
	(112, 00000000004, 00000000004),
	(113, 00000000005, 00000000005),
	(114, 00000000001, 00000000001),
	(115, 00000000004, 00000000012),
	(116, 00000000004, 00000000012),
	(117, 00000000007, 00000000004),
	(118, 00000000010, 00000000013),
	(119, 00000000002, 00000000013),
	(120, 00000000003, 00000000003),
	(121, 00000000002, 00000000002),
	(122, 00000000004, 00000000004),
	(123, 00000000005, 00000000005);


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_user_id`, `name`, `email`, `enabled`, `send_email`, `users_role_id`, `last_visited_on`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `activation`, `params`, `uuid`)
VALUES
	(1,'Administrator','admin@example.com',1,1,25,'2013-11-05 14:23:08',NULL,NULL,1,'2013-11-05 14:23:08',NULL,NULL,'','timezone=\n\n','3b8abc10-b038-11e2-9296-102175e93138'),
	(2,'Demo','demo@example.com',1,1,24,'2013-11-05 14:23:08',NULL,NULL,1,'2013-11-05 14:23:08',NULL,NULL,'','timezone=\n\n','d6557afc-e5f6-4371-8cf8-c6ca1a55f674');


--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`users_group_id`, `name`, `description`)
VALUES
	(1,'Super Administrators','');


--
-- Dumping data for table `users_groups_users`
--

INSERT INTO `users_groups_users` (`users_group_id`, `users_user_id`)
VALUES
	(1,1);


--
-- Dumping data for table `users_passwords`
--

INSERT INTO `users_passwords` (`email`, `expiration`, `hash`, `reset`)
VALUES
	('admin@example.com',NULL,'$2y$10$j6EOjAGYAVYACaMsq3XXIOBt6B78vAsRChA7P83MACnBPM7wSxqPC',''),
  ('demo@example.com',NULL,'$2y$10$j6EOjAGYAVYACaMsq3XXIOBt6B78vAsRChA7P83MACnBPM7wSxqPC','');


--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`users_role_id`, `name`, `description`)
VALUES
	(18,'Registered',''),
	(19,'Author',''),
	(20,'Editor',''),
	(21,'Publisher',''),
	(23,'Manager',''),
	(24,'Administrator',''),
	(25,'Super Administrator','');


--
-- Dumping data for table `data`.`migrations`
--

INSERT INTO `data`.`migrations` (`version`)
VALUES
	('20140128171714'),
	('20140210180553'),
	('20140210182142'),
	('20140213093449'),
	('20140226140336'),
	('20140423154536'),
	('20140425110733'),
	('20140506144536'),
	('20140513103119'),
	('20140521225101'),
	('20140527134654'),
	('20140527145756'),
	('20140611110955'),
	('20140624142915'),
	('20140709160452'),
	('20140729104645'),
	('20140814155605'),
	('20140826120903'),
	('20140905144230'),
	('20140908125316'),
	('20140912154909'),
	('20140930104334'),
	('20141002140309'),
	('20141007122400'),
	('20141008173735'),
	('20141014133051'),
	('20141014150834'),
	('20141015142634'),
	('20141016131242'),
	('20141020121231'),
	('20141106154330'),
	('20141120102449'),
	('20141121084421'),
	('20141124143621'),
	('20141202100748'),
	('20141202150020'),
	('20141208093326'),
	('20141215133413'),
	('20141229165401'),
	('20141230094246'),
	('20150114110644'),
	('20150126135412'),
	('20150129141704'),
	('20150130144902'),
	('20150203101627'),
	('20150217141024'),
	('20150220150040'),
	('20150316123140'),
	('20150316150423'),
	('20150319173233'),
	('20150325170809'),
	('20150327161957'),
	('20150417123758'),
	('20150513125338'),
	('20150912125005'),
	('20150914095530');


--
-- Dumping data for table `data`.`police_zones`
--

INSERT INTO `data`.`police_zones` (`police_zone_id`, `platform`, `titles`, `language`, `phone_emergency`, `phone_information`, `email`, `social`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`)
VALUES
	('default', NULL, '{\"en\":\"Open Police\"}', 1, '123 456 789', NULL, 'info@example.com', '{\"twitter\":{\"en\":\"OpenPoliceBE\"},\"facebook\":{\"en\":\"\"}}', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');



SET SQL_MODE=@OLD_SQL_MODE;
SET TIME_ZONE=@OLD_TIME_ZONE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
