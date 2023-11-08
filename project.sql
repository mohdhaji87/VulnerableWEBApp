SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO `role` (`role_id`, `role_type`) VALUES
(1, 'Admin'),
(2, 'User');

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `isAdmin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`user_id`, `isAdmin`) VALUES
('21', 1);

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar_id` varchar(255) DEFAULT '654abcb599cde8.95483491_ehklfjmoigpqn.jpeg',
  `role_id` tinyint(4) DEFAULT '2',
  `isEnabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `avatar_id`, `role_id`, `isEnabled`) VALUES
(21, 'admin', SHA1('admin'), 'admin@admin.admin', '654abcb599cde8.95483491_ehklfjmoigpqn.jpeg', 1, 1),
(10, 'test', SHA1('test'), 'test@test.test', '654945ae205062.32022954_lgjqmnohkipef.jpeg', 2, 1);
COMMIT;
