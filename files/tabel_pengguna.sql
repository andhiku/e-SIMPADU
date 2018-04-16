
--
-- Table structure for table `user_tb`
--

DROP TABLE IF EXISTS `user_tb`;
CREATE TABLE IF NOT EXISTS `user_tb` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) DEFAULT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_level` int(5) NOT NULL,
  `user_role` varchar(15) NOT NULL DEFAULT 'operator',
  `inst_kerja` int(11) NOT NULL DEFAULT '0', /* boleh dihapus */
  `status` int(1) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `nip`, `user_nama`, `user_username`, `user_password`, `user_level`, `user_role`, `inst_kerja`, `status`, `last_login`) VALUES
(34, '13456789012345678', 'administrator', 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 0, 'admin', 0, 0, '2016-05-04 17:18:49'),
(35, '12345685', 'Operator', 'operator', '4b583376b2767b923c3e1da60d10de59', 0, 'operator', 0, 0, '2015-11-25 18:30:53');
