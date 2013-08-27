# Before Nooku migration

ALTER TABLE police_demo_5388.pol_banner RENAME police_demo_5388.banner;
ALTER TABLE police_demo_5388.pol_bannerclient RENAME police_demo_5388.bannerclient;
ALTER TABLE police_demo_5388.pol_bannertrack RENAME police_demo_5388.bannertrack;
ALTER TABLE police_demo_5388.pol_categories RENAME police_demo_5388.categories;
ALTER TABLE police_demo_5388.pol_components RENAME police_demo_5388.components;
ALTER TABLE police_demo_5388.pol_contact_details RENAME police_demo_5388.contact_details;
ALTER TABLE police_demo_5388.pol_content RENAME police_demo_5388.content;
ALTER TABLE police_demo_5388.pol_content_frontpage RENAME police_demo_5388.content_frontpage;
ALTER TABLE police_demo_5388.pol_content_rating RENAME police_demo_5388.content_rating;
ALTER TABLE police_demo_5388.pol_core_acl_aro RENAME police_demo_5388.core_acl_aro;
ALTER TABLE police_demo_5388.pol_core_acl_aro_groups RENAME police_demo_5388.core_acl_aro_groups;
ALTER TABLE police_demo_5388.pol_core_acl_aro_sections RENAME police_demo_5388.core_acl_aro_sections;
ALTER TABLE police_demo_5388.pol_core_acl_groups_aro_map RENAME police_demo_5388.core_acl_groups_aro_map;
ALTER TABLE police_demo_5388.pol_core_log_items RENAME police_demo_5388.core_log_items;
ALTER TABLE police_demo_5388.pol_core_log_searches RENAME police_demo_5388.core_log_searches;
ALTER TABLE police_demo_5388.pol_groups RENAME police_demo_5388.groups;
ALTER TABLE police_demo_5388.pol_menu RENAME police_demo_5388.menu;
ALTER TABLE police_demo_5388.pol_menu_types RENAME police_demo_5388.menu_types;
ALTER TABLE police_demo_5388.pol_messages RENAME police_demo_5388.messages;
ALTER TABLE police_demo_5388.pol_messages_cfg RENAME police_demo_5388.messages_cfg;
ALTER TABLE police_demo_5388.pol_modules RENAME police_demo_5388.modules;
ALTER TABLE police_demo_5388.pol_modules_menu RENAME police_demo_5388.modules_menu;
ALTER TABLE police_demo_5388.pol_newsfeeds RENAME police_demo_5388.newsfeeds;
ALTER TABLE police_demo_5388.pol_plugins RENAME police_demo_5388.plugins;
ALTER TABLE police_demo_5388.pol_poll_data RENAME police_demo_5388.poll_data;
ALTER TABLE police_demo_5388.pol_poll_date RENAME police_demo_5388.poll_date;
ALTER TABLE police_demo_5388.pol_poll_menu RENAME police_demo_5388.poll_menu;
ALTER TABLE police_demo_5388.pol_polls RENAME police_demo_5388.polls;
ALTER TABLE police_demo_5388.pol_sections RENAME police_demo_5388.sections;
ALTER TABLE police_demo_5388.pol_stats_agents RENAME police_demo_5388.stats_agents;
ALTER TABLE police_demo_5388.pol_templates_menu RENAME police_demo_5388.templates_menu;
ALTER TABLE police_demo_5388.pol_users RENAME police_demo_5388.users;
ALTER TABLE police_demo_5388.pol_weblinks RENAME police_demo_5388.weblinks;

CREATE TABLE `session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(50) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;