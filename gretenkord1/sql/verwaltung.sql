# phpMyAdmin MySQL-Dump
# version 2.3.0-rc2
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 11. Oktober 2002 um 12:59
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
  adresse_bestaetigt enum('nein','ja') NOT NULL default 'nein',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Adresstabelle';

#
# Daten für Tabelle `adresse`
#

INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (1, 1, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123365985', 'Vermessung@Bigfoot.de', '165465464646', 'ja');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (18, 22, '08289', 'Schneeberg', '', '', '', '', '', '', 'ja');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (32, 36, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '03772', '44365', 'thomas@web.de', '0321332658963', 'nein');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (31, 35, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123123123', 'matthias@web.de', '321321321', 'nein');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (33, 37, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '', '', '', '', 'nein');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax, adresse_bestaetigt) VALUES (34, 38, NULL, '', '', '', NULL, NULL, NULL, NULL, 'nein');
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `angebot`
#

CREATE TABLE angebot (
  id int(11) NOT NULL auto_increment,
  bezeichnung varchar(75) NOT NULL default '',
  datum timestamp(14) NOT NULL,
  dauer int(14) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='aktuelle Angebote';

#
# Daten für Tabelle `angebot`
#

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `archiv`
#

CREATE TABLE archiv (
  id int(4) NOT NULL auto_increment,
  ueberschrift varchar(50) default NULL,
  teil_ueberschrift1 varchar(50) default NULL,
  teil_ueberschrift2 varchar(50) default NULL,
  kurztext1 text,
  kurztext2 text,
  langtext1 text,
  langtext2 text,
  minibild1 varchar(75) default NULL,
  minibild2 varchar(75) default NULL,
  bild1 varchar(75) default NULL,
  bild2 varchar(75) default NULL,
  user_id int(3) default NULL,
  datum timestamp(14) NOT NULL,
  user_id_kontrolle int(3) default NULL,
  kunde_id int(3) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Archivtabelle der Beiträge';

#
# Daten für Tabelle `archiv`
#

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `blatt1`
#

CREATE TABLE blatt1 (
  id int(3) NOT NULL auto_increment,
  blatt_name varchar(75) NOT NULL default '',
  blatt_pfad varchar(150) NOT NULL default '',
  blatt_verzeichnis varchar(50) default NULL,
  blatt_aktiv enum('checked','') NOT NULL default 'checked',
  blatt_info text,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='beinhaltet den Namen des Blatt und dessen Pfad';

#
# Daten für Tabelle `blatt1`
#

INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (1, 'Knoten1_Blatt1', 'index.html', 'rezepte', 'checked', 'Knoten1\r\nBlatt1			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (2, 'Knoten1_Blatt2', 'index.php', 'email', 'checked', 'Knoten1\r\nBlatt2			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (3, 'Knoten2_Blatt2', 'index.php', 'email', 'checked', 'Knoten2\r\nBlatt2			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (4, 'Knoten2_Blatt3', 'index.php', 'email', 'checked', 'Knoten2\r\nBlatt3			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (5, 'Knoten1_Blatt3', 'index.html', 'email', 'checked', 'Knoten 1\r\nBlatt 3		');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (6, 'Knoten1_Blatt4', 'index.php', 'gaestebuch', 'checked', 'Knoten 1\r\nBlatt 4			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (7, 'Knoten4_Blatt1', 'index.html', 'newsletter', 'checked', 'Knoten4\r\nBlatt 2			');
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis, blatt_aktiv, blatt_info) VALUES (8, 'Knoten4_Blatt2', 'index.php', 'newsletter', 'checked', 'Knoten4\r\nBlatt2			');
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

INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (3, 2, 0, 'Textinformation 1 für Antje\r\naaaaaaa aaaaaaa aaaaaaaaaa\r\nbbbbb bbbbbbbbb bbbb\r\ncccccccccccc\r\nddddddddd ddddddddddd', 20020822084347);
INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (32, 0, 1, 'gggggggggggggg', 20020920145655);
INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (36, 0, 1, 'wwwwwwwww\r\nddddddddddd\r\neeeeeeeeeeee', 20020923091510);
INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (37, 1, 1, 'Diese Information kommt von Matthias !', 20020923091558);
INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (33, 0, 1, 'aaaaaaaaaaa\r\naaaaaaaaaaaaaa\r\naaaaaaaaaaaaaaa', 20020923084617);
INSERT INTO info (id, user_id, Absender, info, zeit) VALUES (34, 1, 1, 'oweruerzgweuzrwure\r\ndddddddddddddddd\r\nwertrewtete', 20020923084735);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `kategorie_rezepte`
#

CREATE TABLE kategorie_rezepte (
  id int(3) NOT NULL auto_increment,
  kategorie varchar(75) default NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Kategorie der Rezepte';

#
# Daten für Tabelle `kategorie_rezepte`
#

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `knoten1`
#

CREATE TABLE knoten1 (
  knoten_id int(3) NOT NULL auto_increment,
  knoten_name varchar(75) NOT NULL default '',
  knoten_pfad varchar(75) NOT NULL default '',
  knoten_verzeichnis varchar(50) default NULL,
  knoten_info varchar(100) default NULL,
  knoten_aktiv enum('checked','') NOT NULL default 'checked',
  PRIMARY KEY  (knoten_id)
) TYPE=MyISAM COMMENT='beinhaltet die einzelnen Gruppen';

#
# Daten für Tabelle `knoten1`
#

INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (15, 'Knoten 1', 'index.html', 'newsletter', 'Knoten 1			', 'checked');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (16, 'Knoten 2', 'index.html', 'email', 'Knoten 2			', 'checked');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (17, 'Knoten 3', 'index.php', 'rezepte', 'Knoten 3		', 'checked');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (18, 'Knoten 4', 'index.php', 'gaestebuch', 'Knoten 4		', 'checked');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (19, 'Knoten 5', 'index.html', 'newsletter', 'Knoten 5		', 'checked');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info, knoten_aktiv) VALUES (20, 'Knoten 6', 'index.php', 'email', 'Knoten 6			', 'checked');
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

INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (1, 15, 1);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (2, 15, 2);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (3, 16, 3);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (4, 16, 4);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (5, 15, 5);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (6, 15, 6);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (7, 18, 7);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (8, 18, 8);
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

INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (1, 'Benutzer anlegen', 'anlegen', 'anlegen eines neuen User');
INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (2, 'Benutzer ändern', 'aendern', 'Userdaten und Rechte ändern');
INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (4, 'Rechte anlegen / ändern', 'rechte_aendern', 'Rechte anlegen / ändern');
INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (8, 'Information schreiben', 'info', 'schreiben einer Information');
INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (9, 'Kommunikation', 'kommunikation', 'Kommunikationstabelle');
INSERT INTO rechte (id, Rechte_Art, Modul, Beschreibung) VALUES (10, 'Verwaltung Knoten/Blatt', 'knoten_blatt', 'Verwaltung Knoten / Blatt');
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

INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (114, 1, 10);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (113, 1, 9);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (112, 1, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (4, 2, 1);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (111, 1, 4);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (51, 34, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (110, 1, 2);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (52, 36, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (50, 35, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (53, 37, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (109, 1, 1);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (116, 22, 1);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (117, 22, 8);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rezepte`
#

CREATE TABLE rezepte (
  id int(3) NOT NULL auto_increment,
  kategorie_id int(3) default NULL,
  kunde_id int(3) default NULL,
  schlagworte text,
  kurztext text,
  bezeichnung varchar(75) default NULL,
  abschnitt1 text,
  abschnitt2 text,
  abschnitt3 text,
  abschnitt4 text,
  abschnitt5 text,
  datum timestamp(14) NOT NULL,
  bild varchar(75) default NULL,
  empfehlung enum('Nein','Ja') NOT NULL default 'Nein',
  rezept_ueberprueft enum('Nein','Ja') NOT NULL default 'Nein',
  rezept_note tinyint(1) default NULL,
  dauer_zubereitung int(3) default NULL,
  aufwand_zubereitung enum('simpel','normal','extrem') NOT NULL default 'simpel',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Rezepttabelle';

#
# Daten für Tabelle `rezepte`
#

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `rezepte_info`
#

CREATE TABLE rezepte_info (
  id int(5) NOT NULL auto_increment,
  rezepte_id int(3) NOT NULL default '0',
  kunde_id int(4) NOT NULL default '0',
  kurz_info varchar(75) default NULL,
  info text,
  datum timestamp(14) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Bemerkungen der Kunden zu den Rezepten';

#
# Daten für Tabelle `rezepte_info`
#

# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `user`
#

CREATE TABLE user (
  id int(3) NOT NULL auto_increment,
  Anrede varchar(10) default NULL,
  Name varchar(40) NOT NULL default '',
  Vorname varchar(40) NOT NULL default '',
  Passwort varchar(30) NOT NULL default '',
  Benutzername varchar(30) NOT NULL default '',
  aktiv varchar(6) NOT NULL default 'passiv',
  Bemerkung varchar(40) default ' &nbsp;',
  datum timestamp(14) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Personentabelle';

#
# Daten für Tabelle `user`
#

INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (1, 'Herr', 'Krauss', 'Stephan', 'stephan', 'stephan', 'aktiv', 'Super', 20021011102017);
INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (22, 'Frau', 'Krauss', 'Antje', 'antje', 'antje', 'aktiv', 'User', 20021011102017);
INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (35, NULL, 'Krauss', 'Matthias', 'matthias', 'matthias', 'passiv', '  Redaktion', 20021011102017);
INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (36, NULL, 'Krauss', 'Thomas', 'thomas', 'thomas', 'passiv', '  Redaktion', 20021011102017);
INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (37, NULL, 'Max', 'Mustermann', 'max', 'max', 'passiv', '  ', 20021011102017);
INSERT INTO user (id, Anrede, Name, Vorname, Passwort, Benutzername, aktiv, Bemerkung, datum) VALUES (38, NULL, 'Mies', 'Mies', 'mies', 'mies', 'passiv', ' &nbsp;', 20021011102017);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `user_profil`
#

CREATE TABLE user_profil (
  id int(3) NOT NULL auto_increment,
  user_id int(3) NOT NULL default '0',
  profil1 varchar(50) default NULL,
  profil2 varchar(50) default NULL,
  profil3 varchar(50) default NULL,
  user_status enum('unsicher','sicher') NOT NULL default 'unsicher',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Tabelle beinhaltet Benutzerprofil';

#
# Daten für Tabelle `user_profil`
#


