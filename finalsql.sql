CREATE TABLE IF NOT EXISTS `users` (

  `user` varchar(80) PRIMARY KEY,
  `pass` varchar(80) NOT NULL,
  `branch` varchar(10) DEFAULT NULL,
  `post` varchar(10) NOT NULL,
  `year` varchar(10) DEFAULT NULL,
  `chk` int(1) DEFAULT 0

);

INSERT INTO `users` (`user`, `pass`,`post`) VALUES
('admin', 'admin','admin'),
('cmhod', 'cmhod','cmhod'),
('ifhod', 'ifhod','ifhod');

CREATE TABLE IF NOT EXISTS `cm_feed` (
  
  `subject` varchar(20) NOT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `year` varchar(10) NOT NULL,
);

CREATE TABLE IF NOT EXISTS `cm_subject` (
  `s_id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `year` varchar(20) NOT NULL
) ;

CREATE TABLE IF NOT EXISTS `if_feed` (
  
  `subject` varchar(20) NOT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `year` varchar(10) NOT NULL,
);

CREATE TABLE IF NOT EXISTS `if_subject` (
  `s_id` int(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `year` varchar(20) NOT NULL
) ;


CREATE TABLE IF NOT EXISTS `ques` (
  `q_id` int(2) NOT NULL,
  `question` varchar(900) NOT NULL
);
