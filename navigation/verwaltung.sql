# phpMyAdmin MySQL-Dump
# version 2.3.0-rc2
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 01. Oktober 2002 um 10:43
# Server Version: 3.23.51
# PHP-Version: 4.2.2
# Datenbank: `verwaltung`
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `adresse`
#

CREATE TABLE adresse (
  id int(3) NOT NULL auto_increment,
  user_id int(3) NOT NULL default '0',
  PLZ varchar(5) default NULL,
  Ort varchar(20) NOT NULL default '',
  Strasse varchar(40) NOT NULL default '',
  Nr varchar(5) NOT NULL default '',
  Telefon varchar(15) default NULL,
  Handy varchar(15) default NULL,
  EMail varchar(40) default NULL,
  Fax varchar(40) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Adresstabelle';

#
# Daten für Tabelle `adresse`
#

INSERT INTO adresse VALUES (1, 1, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123365985', 'Vermessung@Bigfoot.de', '165465464646'),
(18, 22, '08289', 'Schneeberg', '', '', '', '', '', ''),
(32, 36, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '03772', '44365', 'thomas@web.de', '0321332658963'),
(31, 35, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123123123', 'matthias@web.de', '321321321'),
(33, 37, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '', '', '', ''),
(34, 38, NULL, '', '', '', NULL, NULL, NULL, NULL);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `blatt1`
#

CREATE TABLE blatt1 (
  id int(3) NOT NULL auto_increment,
  blatt_name varchar(75) NOT NULL default '',
  blatt_pfad varchar(150) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='beinhaltet den Namen des Blatt und dessen Pfad';

#
# Daten für Tabelle `blatt1`
#

INSERT INTO blatt1 VALUES (1, 'Blatt11', 'blatt11.html'),
(2, 'Blatt12', 'blatt12.html'),
(3, 'Blatt13', 'blatt13.html'),
(4, 'Blatt21', 'blatt21.html'),
(5, 'Blatt22', 'blatt22.html'),
(6, 'Blatt23', 'blatt23.html'),
(7, 'Blatt31', 'blatt31.html'),
(8, 'Blatt32', 'blatt32.html'),
(9, 'Blatt33', 'blatt33.html');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `info`
#

CREATE TABLE info (
  id int(3) NOT NULL auto_increment,
  user_id int(3) NOT NULL default '0',
  Absender int(3) NOT NULL default '0',
  info text NOT NULL,
  zeit timestamp(14) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Tabelle der Userinformationen';

#
# Daten für Tabelle `info`
#

INSERT INTO info VALUES (3, 2, 0, 'Textinformation 1 für Antje\r\naaaaaaa aaaaaaa aaaaaaaaaa\r\nbbbbb bbbbbbbbb bbbb\r\ncccccccccccc\r\nddddddddd ddddddddddd', 20020822084347),
(32, 0, 1, 'gggggggggggggg', 20020920145655),
(36, 0, 1, 'wwwwwwwww\r\nddddddddddd\r\neeeeeeeeeeee', 20020923091510),
(37, 1, 1, 'Diese Information kommt von Matthias !', 20020923091558),
(33, 0, 1, 'aaaaaaaaaaa\r\naaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaa', 20020923084617),
(34, 1, 1, 'oweruerzgweuzrwure\r\ndddddddddddddddd\r\nwertrewtete', 20020923084735);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `knoten1`
#

CREATE TABLE knoten1 (
  knoten_id int(3) NOT NULL auto_increment,
  knoten_name varchar(75) NOT NULL default '',
  knoten_pfad varchar(75) NOT NULL default '',
  PRIMARY KEY  (knoten_id)
) TYPE=MyISAM COMMENT='beinhaltet die einzelnen Gruppen';

#
# Daten für Tabelle `knoten1`
#

INSERT INTO knoten1 VALUES (1, 'Knoten1', 'blatt10.html'),
(2, 'Knoten2', 'blatt20.html'),
(3, 'Knoten3', 'blatt30.html'),
(4, 'Knoten4', 'blatt40.html'),
(5, 'Knoten5', 'blatt50.html');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `knoten1_blatt1`
#

CREATE TABLE knoten1_blatt1 (
  id int(3) NOT NULL auto_increment,
  knoten_id int(3) NOT NULL default '0',
  blatt_id int(3) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Brückentabelle Knoten - Blatt';

#
# Daten für Tabelle `knoten1_blatt1`
#

INSERT INTO knoten1_blatt1 VALUES (1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rechte`
#

CREATE TABLE rechte (
  id int(3) NOT NULL auto_increment,
  Rechte_Art varchar(40) NOT NULL default '',
  Modul varchar(40) NOT NULL default '',
  Beschreibung varchar(40) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Tabelle der Module';

#
# Daten für Tabelle `rechte`
#

INSERT INTO rechte VALUES (1, 'Benutzer anlegen', 'anlegen', 'anlegen eines neuen User'),
(2, 'Benutzer ändern', 'aendern', 'Userdaten und Rechte ändern'),
(4, 'Rechte anlegen / ändern', 'rechte_aendern', 'Rechte anlegen / ändern'),
(8, 'Information schreiben', 'info', 'schreiben einer Information'),
(9, 'Kommunikation', 'kommunikation', 'Kommunikationstabelle');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rechte_user`
#

CREATE TABLE rechte_user (
  id int(3) NOT NULL auto_increment,
  user_id int(3) NOT NULL default '0',
  rechte_id int(3) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Brückentabelle Rechte_User';

#
# Daten für Tabelle `rechte_user`
#

INSERT INTO rechte_user VALUES (46, 1, 8),
(45, 1, 4),
(44, 1, 2),
(4, 2, 1),
(43, 1, 1),
(51, 34, 8),
(47, 1, 9),
(52, 36, 8),
(50, 35, 8),
(53, 37, 8);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `test`
#

CREATE TABLE test (
  id int(3) NOT NULL auto_increment,
  text varchar(20) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM PACK_KEYS=0 DELAY_KEY_WRITE=1 COMMENT='Testtabelle ';

#
# Daten für Tabelle `test`
#

INSERT INTO test VALUES (1, 'aaa'),
(2, 'bbb'),
(4, 'ddd'),
(5, 'eee'),
(6, 'fff');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `user`
#

CREATE TABLE user (
  id int(3) NOT NULL auto_increment,
  Name varchar(40) NOT NULL default '',
  Vorname varchar(40) NOT NULL default '',
  Passwort varchar(30) NOT NULL default '',
  Benutzername varchar(30) NOT NULL default '',
  Bemerkung varchar(40) default ' &nbsp;',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Personentabelle';

#
# Daten für Tabelle `user`
#

INSERT INTO user VALUES (1, 'Krauss', 'Stephan', 'stephan', 'stephan', 'Superuser'),
(22, 'Krauss', 'Antje', 'antje', 'antje', '  User'),
(35, 'Krauss', 'Matthias', 'matthias', 'matthias', '  Redaktion'),
(36, 'Krauss', 'Thomas', 'thomas', 'thomas', '  Redaktion'),
(37, 'Max', 'Mustermann', 'max', 'max', '  '),
(38, 'Mies', 'Mies', 'mies', 'mies', ' &nbsp;');

