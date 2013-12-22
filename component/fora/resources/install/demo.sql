INSERT INTO `categories` (`categories_category_id`, `parent_id`, `attachments_attachment_id`, `title`, `slug`, `image`, `table`, `description`, `published`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `ordering`, `access`, `params`)
VALUES
	(1, 0, 0, 'Docman Forum', '', '', 'fora_forums', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '');


INSERT INTO `fora_forums` (`fora_forum_id`, `categories_category_id`, `type`, `title`, `slug`, `text`, `ordering`, `published`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`)
VALUES
	(1, 4, 'issue', 'article', 'article', '<p>sdfasfasdf</p>\r\n', 0, 1, '2013-10-07 18:36:04', 1, '2013-10-07 16:43:42', 1, NULL, NULL),
	(2, 4, 'issue', 'Issue', 'issue', '', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 4, 'question', 'questions', 'question', '', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 4, 'idea', 'idea', 'idea', '', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO `fora_topics` (`fora_topic_id`, `fora_forum_id`, `title`, `slug`, `text`, `votes`, `hits`, `comments_comment_id`, `commentable`, `published`, `status`, `sticky`, `latest_activity_on`, `last_commented_by`, `last_commented_by_name`, `total_comments`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`)
VALUES
	(1, 1, 'test', 'test', '<p>Topic text should come here</p>\r\n', 1, 565, 0, 0, 1, NULL, 0, NULL, NULL, NULL, NULL, 1, '2013-11-20 15:14:53', 1, '2013-12-17 10:18:10', 1, '2013-12-17 12:14:48'),
	(2, 2, 'issue 1', 'test', '<p>test</p>\r\n', 0, 2, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 1, '2013-11-19 10:51:39', NULL, NULL, 1, '2013-12-03 10:58:36');
