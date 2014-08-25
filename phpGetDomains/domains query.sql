SELECT registrar, chtype, chdate, COUNT(*) AS domains FROM domainlist 
GROUP BY registrar, chtype, chdate WITH ROLLUP;

SELECT registrar, chdate, chtype, COUNT(*) AS domains FROM domainlist 
GROUP BY registrar, chdate, chtype WITH ROLLUP;

CREATE TABLE `domainlist` (
  `registrar` varchar(100) NOT NULL,
  `chdate` date NOT NULL,
  `domainname` varchar(200) NOT NULL,
  `chtype` varchar(10) NOT NULL,
  `svrname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`registrar`,`chdate`,`domainname`,`chtype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/* 
	http://www.dailychanges.com/net4india.com/2014-08-24/
	Data valid from 2014-08-06
*/




