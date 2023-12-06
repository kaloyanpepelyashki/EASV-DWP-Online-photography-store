DROP DATABASE IF EXISTS AdminLoginDB;
CREATE DATABASE AdminLoginDB;
USE AdminLoginDB;

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
)