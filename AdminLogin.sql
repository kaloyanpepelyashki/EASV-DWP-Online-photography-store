
CREATE TABLE IF NOT EXISTS `Admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
)