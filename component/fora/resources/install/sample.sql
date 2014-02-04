--
-- Dumping sample data for table `data`.`fora_comments`
--

INSERT INTO `data``fora_comments` (`fora_comment_id`, `fora_topic_id`, `text`, `created_on`, `created_by`, `modified_on`, `modified_by`)
VALUES
	(4, 1, '<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam id dolor id nibh ultricies vehicula ut id elit. Donec ullamcorper nulla non metus auctor fringilla. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor.</p>\r\n', '2014-02-04 14:05:08', 1, NULL, NULL);


--
-- Dumping sample data for table `data`.`fora_topics`
--

INSERT INTO `data``fora_topics` (`fora_topic_id`, `fora_forum_id`, `title`, `slug`, `text`, `votes`, `hits`, `fora_comment_id`, `commentable`, `published`, `status`, `sticky`, `latest_activity_on`, `last_commented_by`, `last_commented_by_name`, `last_commented_by_site`, `total_comments`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`)
VALUES
	(1, 1, 'Risus Ipsum', 'risus-ipsum', '<p>Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>\r\n', NULL, 2, 0, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-02-04 14:04:23', NULL, NULL, 1, '2014-02-04 14:05:08'),
	(2, 2, 'Sit Ligula', 'sit-ligula', '<p>Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean lacinia bibendum nulla sed consectetur. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>\r\n', NULL, 0, 0, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-02-04 14:03:55', NULL, NULL, NULL, NULL),
	(3, 3, 'Pharetra Euismod Magna', 'pharetra-euismod-magna', '<p>Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper.</p>\r\n', NULL, 0, 0, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-02-04 14:04:08', NULL, NULL, NULL, NULL),
	(4, 4, 'Nullam Vestibulum Pharetra', 'nullam-vestibulum-pharetra', '<p>Sed posuere consectetur est at lobortis. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur blandit tempus porttitor. Aenean lacinia bibendum nulla sed consectetur. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>\r\n', NULL, 0, 0, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, '2014-02-04 14:03:44', NULL, NULL, NULL, NULL);


--
-- Dumping sample data for table `data`.`fora_users`
--

INSERT INTO `data`.`fora_users` (`fora_user_id`, `users_user_id`, `site`, `name`, `email`, `check_date`)
VALUES
	(1, 1, '9999', 'Administrator', NULL, NULL);
