CREATE TABLE `UserInfo`(
	`UserInfo_id` int(40) COLLATE utf8_general_ci NOT NULL AUTO_INCREMENT,
	`UserInfo_name` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_email` varchar(40) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_pcode` varchar(240) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_posts` int(40) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_followers` int(40) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_avatar` varchar(40) COLLATE utf8_general_ci NOT NULL,
	`UserInfo_lastlog` varchar(40) COLLATE utf8_general_ci NOT NULL,

	PRIMARY KEY (`UserInfo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Music` (
	`Music_id` int(40) COLLATE utf8_general_ci NOT NULL AUTO_INCREMENT,
	`Music_name` varchar(45) COLLATE utf8_general_ci NOT NULL,
	`Music_size` int(40) COLLATE utf8_general_ci NOT NULL,
	`Music_path` varchar(120) COLLATE utf8_general_ci NOT NULL,
	`Music_artist` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Music_postdate` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Music_postedby` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Music_likes` int(40) COLLATE utf8_general_ci NOT NULL,
	`Music_played` int(40) COLLATE utf8_general_ci NOT NULL,
	`Music_downloads` int(40) COLLATE utf8_general_ci NOT NULL,

	PRIMARY KEY (`Music_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Video` (
	`Video_id` int(40) COLLATE utf8_general_ci NOT NULL AUTO_INCREMENT,
	`Video_name` varchar(60) COLLATE utf8_general_ci NOT NULL,
	`Video_size` int(40) COLLATE utf8_general_ci NOT NULL,
	`Video_path` varchar(120) COLLATE utf8_general_ci NOT NULL,
	`Video_type` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Video_postdate` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Video_postedby` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Video_likes` int(40) COLLATE utf8_general_ci NOT NULL,
	`Video_played` int(40) COLLATE utf8_general_ci NOT NULL,
	`Video_downloads` int(40) COLLATE utf8_general_ci NOT NULL,
	`Video_rank` int(40) COLLATE utf8_general_ci NOT NULL,

	PRIMARY KEY (`Video_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Series` (
	`Series_id` int(40) COLLATE utf8_general_ci NOT NULL AUTO_INCREMENT,
	`Series_name` varchar(60) COLLATE utf8_general_ci NOT NULL,
	`Series_size` int(40) COLLATE utf8_general_ci NOT NULL,
	`Series_path` varchar(120) COLLATE utf8_general_ci NOT NULL,
	`Series_season` varchar(11) COLLATE utf8_general_ci NOT NULL,
	`Series_episode` varchar(11) COLLATE utf8_general_ci NOT NULL,
	`Series_postdate` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Series_postedby` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Series_likes` int(40) COLLATE utf8_general_ci NOT NULL,
	`Series_played` int(40) COLLATE utf8_general_ci NOT NULL,
	`Series_downloads` int(40) COLLATE utf8_general_ci NOT NULL,

	PRIMARY KEY (`Series_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Picture` (
	`Picture_id` int(40) COLLATE utf8_general_ci NOT NULL AUTO_INCREMENT,
	`Picture_name` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Picture_size` int(40) COLLATE utf8_general_ci NOT NULL,
	`Picture_path` varchar(120) COLLATE utf8_general_ci NOT NULL,
	`Picture_postdate` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Picture_postedby` varchar(30) COLLATE utf8_general_ci NOT NULL,
	`Picture_likes` int(40) COLLATE utf8_general_ci NOT NULL,
	`Picture_viewed` int(40) COLLATE utf8_general_ci NOT NULL,
	`Picture_downloads` int(40) COLLATE utf8_general_ci NOT NULL,

	PRIMARY KEY (`Picture_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Application` (
	`Application_id` int(40) NOT NULL AUTO_INCREMENT,
	`Application_name` varchar(30) NOT NULL,
	`Application_size` int(40) NOT NULL,
	`Application_description` varchar(124) NOT NULL,
	`Application_postedby` varchar(30) NOT NULL,
	`Application_likes` int(40) NOT NULL,
	`Application_downloads` int(40) NOT NULL,

	PRIMARY KEY (`Application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Document` (
	`Document_id` int(40) NOT NULL AUTO_INCREMENT,
	`Document_name` varchar(30) NOT NULL,
	`Document_size` int(40) NOT NULL,
	`Document_type` varchar(30) NOT NULL,
	`Document_postedby` varchar(30) NOT NULL,
	`Document_likes` int(40) NOT NULL,
	`Document_downloads` int(40) NOT NULL,

	PRIMARY KEY (`Document_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Comment` (
	`Comment_id` int(40) NOT NULL AUTO_INCREMENT,
	`Comment_object` varchar(30) NOT NULL,
	`Comment_content` varchar(256) NOT NULL,
	`Comment_postedby` varchar(30) NOT NULL,
	`Comment_time` int(40) NOT NULL,

	PRIMARY KEY (`Comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Relationships` (
	`Relationships_id` int(40) NOT NULL AUTO_INCREMENT,
	`Relationships_followed` varchar(64) NOT NULL,
	`Relationships_followedby` varchar(64) NOT NULL,
	`Relationships_followtime` int(40) NOT NULL,

	PRIMARY KEY (`Relationships_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Like` (
	`Like_id` int(40) NOT NULL AUTO_INCREMENT,
	`Like_object` varchar(64) NOT NULL,
	`Like_receiver` varchar(64) NOT NULL,
	`Like_giver` varchar(64) NOT NULL,

	PRIMARY KEY (`Like_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `Download` (
	`Download_id` int(40) NOT NULL AUTO_INCREMENT,
	`Download_object` varchar(64) NOT NULL,
	`Download_receiver` varchar(64) NOT NULL,
	`Download_giver` varchar(64) NOT NULL,
	`Download_type` varchar(14) NOT NULL,

	PRIMARY KEY (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `View` (
	`View_id` int(40) NOT NULL AUTO_INCREMENT,
	`View_object` varchar(64) NOT NULL,
	`View_receiver` varchar(64) NOT NULL,
	`View_giver` varchar(64) NOT NULL,
	`View_type` varchar(14) NOT NULL,

	PRIMARY KEY (`View_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;