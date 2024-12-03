DROP DATABASE IF EXISTS `sample_cms`;
CREATE DATABASE `sample_cms`;
USE `sample_cms`;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(50) NOT NULL auto_increment,
  `post_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `comment_content` varchar(50) NOT NULL,
  `comment_date` varchar(50) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY (`post_id`),
  KEY (`user_id`)
);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL auto_increment,
  `post_type_id` int(11) NOT NULL,
  `post_status_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_excerpt` varchar(255) NOT NULL,
  `post_author_id` int(11) NOT NULL,
  PRIMARY KEY  (`post_id`),
  KEY (`post_type_id`)
  

);

DROP TABLE IF EXISTS `post_types`;
CREATE TABLE `post_types` (
  `post_type_id` int(11) NOT NULL auto_increment,
  `post_type` varchar(50) NOT NULL,
  PRIMARY KEY  (`post_type_id`)
  

);

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `user_email_address` varchar(255) NOT NULL,
  `user_display_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_salt` date NOT NULL,
  `user_date_registered` date NOT NULL,
  PRIMARY KEY  (`user_id`)
);

