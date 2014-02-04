--
-- Dumping data for table `data`.`fora_categories`
--

INSERT INTO `data`.`fora_categories` (`fora_category_id`, `parent_id`, `attachments_attachment_id`, `title`, `slug`, `image`, `table`, `description`, `published`, `ordering`, `access`, `params`)
VALUES
	(1, 0, 0, 'General', 'general', '', '', '', 0, 0, 0, '');


--
-- Dumping data for table `data`.`fora_forums`
--

INSERT INTO `data`.`fora_forums` (`fora_forum_id`, `fora_category_id`, `type`, `title`, `slug`, `text`, `ordering`, `published`)
VALUES
	(1, 1, 'article', 'Announcements', 'announcements', '', 0, 1),
	(2, 1, 'issue', 'Tickets', 'tickets', '', 0, 1),
	(3, 1, 'idea', 'Ideas', 'ideas', '', 0, 1),
	(4, 1, 'article', 'Documentation', 'documentation', '', 0, 1);
