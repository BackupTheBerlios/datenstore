# phpMyAdmin MySQL-Dump
# version 2.3.0-rc2
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 18. September 2002 um 08:36
# Server Version: 3.23.51
# PHP-Version: 4.2.2
# Datenbank: `verwaltung`
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `adresse`
#

CREATE TABLE `adresse` (
  `id` int(3) NOT NULL auto_increment,
  `user_id` int(3) NOT NULL default '0',
  `PLZ` varchar(5) default NULL,
  `Ort` varchar(20) NOT NULL default '',
  `Strasse` varchar(40) NOT NULL default '',
  `Nr` varchar(5) NOT NULL default '',
  `Telefon` varchar(15) default NULL,
  `Handy` varchar(15) default NULL,
  `EMail` varchar(40) default NULL,
  `Fax` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Adresstabelle';

#
# Daten für Tabelle `adresse`
#

INSERT INTO `adresse` (`id`, `user_id`, `PLZ`, `Ort`, `Strasse`, `Nr`, `Telefon`, `Handy`, `EMail`, `Fax`) VALUES (1, 1, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123365985', 'Vermessung@Bigfoot.de', '165465464646');
INSERT INTO `adresse` (`id`, `user_id`, `PLZ`, `Ort`, `Strasse`, `Nr`, `Telefon`, `Handy`, `EMail`, `Fax`) VALUES (18, 22, '08289', 'Schneeberg', '', '', '', '', '', '');
INSERT INTO `adresse` (`id`, `user_id`, `PLZ`, `Ort`, `Strasse`, `Nr`, `Telefon`, `Handy`, `EMail`, `Fax`) VALUES (30, 34, '4664', 'efrreq', 'qwrewqerw', '55', '656655', '65654654', 'werweqrwqe', '6565465');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `info`
#

CREATE TABLE `info` (
  `id` int(3) NOT NULL auto_increment,
  `user_id` int(3) NOT NULL default '0',
  `Absender` int(3) NOT NULL default '0',
  `info` text NOT NULL,
  `zeit` timestamp(14) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Tabelle der Userinformationen';

#
# Daten für Tabelle `info`
#

INSERT INTO `info` (`id`, `user_id`, `Absender`, `info`, `zeit`) VALUES (3, 2, 0, 'Textinformation 1 für Antje\r\naaaaaaa aaaaaaa aaaaaaaaaa\r\nbbbbb bbbbbbbbb bbbb\r\ncccccccccccc\r\nddddddddd ddddddddddd', 20020822084347);
INSERT INTO `info` (`id`, `user_id`, `Absender`, `info`, `zeit`) VALUES (4, 2, 0, 'Textinformation 2 für Antje\r\naaaaaaaaaaaaaa\r\nbbbbbbbbbbbb\r\nccccccccccccccccc\r\ndddddddddddd\r\neeeeeeeeeeeeeeeee', 20020822084347);
INSERT INTO `info` (`id`, `user_id`, `Absender`, `info`, `zeit`) VALUES (26, 0, 1, 'ssssssssssss', 20020917145959);
INSERT INTO `info` (`id`, `user_id`, `Absender`, `info`, `zeit`) VALUES (28, 1, 1, 'sdsdsdsdsdsdsdsd', 20020917150045);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rechte`
#

CREATE TABLE `rechte` (
  `id` int(3) NOT NULL auto_increment,
  `Rechte_Art` varchar(40) NOT NULL default '',
  `Modul` varchar(40) NOT NULL default '',
  `Beschreibung` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Tabelle der Module';

#
# Daten für Tabelle `rechte`
#

INSERT INTO `rechte` (`id`, `Rechte_Art`, `Modul`, `Beschreibung`) VALUES (1, 'Benutzer anlegen', 'anlegen', 'anlegen eines neuen User');
INSERT INTO `rechte` (`id`, `Rechte_Art`, `Modul`, `Beschreibung`) VALUES (2, 'Benutzer ändern', 'aendern', 'Userdaten und Rechte ändern');
INSERT INTO `rechte` (`id`, `Rechte_Art`, `Modul`, `Beschreibung`) VALUES (4, 'Rechte anlegen / ändern', 'rechte_aendern', 'Rechte anlegen / ändern');
INSERT INTO `rechte` (`id`, `Rechte_Art`, `Modul`, `Beschreibung`) VALUES (8, 'Information schreiben', 'info', 'schreiben einer Information');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rechte_user`
#

CREATE TABLE `rechte_user` (
  `id` int(3) NOT NULL auto_increment,
  `user_id` int(3) NOT NULL default '0',
  `rechte_id` int(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Brückentabelle Rechte_User';

#
# Daten für Tabelle `rechte_user`
#

INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (41, 1, 8);
INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (40, 1, 4);
INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (39, 1, 2);
INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (4, 2, 1);
INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (38, 1, 1);
INSERT INTO `rechte_user` (`id`, `user_id`, `rechte_id`) VALUES (42, 34, 8);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `user`
#

CREATE TABLE `user` (
  `id` int(3) NOT NULL auto_increment,
  `Name` varchar(40) NOT NULL default '',
  `Vorname` varchar(40) NOT NULL default '',
  `Passwort` varchar(30) NOT NULL default '',
  `Benutzername` varchar(30) NOT NULL default '',
  `Bemerkung` varchar(40) default ' &nbsp;',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM COMMENT='Personentabelle';

#
# Daten für Tabelle `user`
#

INSERT INTO `user` (`id`, `Name`, `Vorname`, `Passwort`, `Benutzername`, `Bemerkung`) VALUES (1, 'Krauss', 'Stephan', 'stephan', 'stephan', 'Superuser');
INSERT INTO `user` (`id`, `Name`, `Vorname`, `Passwort`, `Benutzername`, `Bemerkung`) VALUES (22, 'Krauss', 'Antje', 'antje', 'antje', '  User');
INSERT INTO `user` (`id`, `Name`, `Vorname`, `Passwort`, `Benutzername`, `Bemerkung`) VALUES (34, 'Krauss', 'Thomas', 'thomas', 'thomas', 'Redaktion');

