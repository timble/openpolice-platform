
INSERT INTO `users` (`users_user_id`, `name`, `email`, `enabled`, `send_email`, `users_role_id`, `last_visited_on`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `activation`, `params`, `uuid`)
VALUES
	(NULL, 'Administrator', 'admin@localhost.home', 1, 1, 25, '', NULL, NULL, NULL, NULL, NOW(), '', '', '', UUID());

INSERT INTO `users_passwords` (`email`, `expiration`, `hash`, `reset`) VALUES
('admin@localhost.home', NULL, '$2y$10$UT7uLipGnbJbTcjZ6D.OAeVByFn.2ZpPmd.thZ5e5xHLwKXAxdvNG', '');
