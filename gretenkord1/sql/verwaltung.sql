# phpMyAdmin MySQL-Dump
# version 2.3.0-rc2
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Erstellungszeit: 07. Oktober 2002 um 14:49
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

INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (1, 1, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123365985', 'Vermessung@Bigfoot.de', '165465464646');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (18, 22, '08289', 'Schneeberg', '', '', '', '', '', '');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (32, 36, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '03772', '44365', 'thomas@web.de', '0321332658963');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (31, 35, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '0377244365', '123123123', 'matthias@web.de', '321321321');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (33, 37, '08289', 'Schneeberg', 'Neujahrsstr.', '1', '', '', '', '');
INSERT INTO adresse (id, user_id, PLZ, Ort, Strasse, Nr, Telefon, Handy, EMail, Fax) VALUES (34, 38, NULL, '', '', '', NULL, NULL, NULL, NULL);
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
  user_id int(3) NOT NULL default '0',
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
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='beinhaltet den Namen des Blatt und dessen Pfad';

#
# Daten für Tabelle `blatt1`
#

INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (1, 'Blatt11', 'blatt11.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (2, 'Blatt12', 'blatt12.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (3, 'Blatt13', 'blatt13.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (4, 'Blatt21', 'blatt21.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (5, 'Blatt22', 'blatt22.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (6, 'Blatt23', 'blatt23.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (7, 'Blatt31', 'blatt31.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (8, 'Blatt32', 'blatt32.html', NULL);
INSERT INTO blatt1 (id, blatt_name, blatt_pfad, blatt_verzeichnis) VALUES (9, 'Blatt33', 'blatt33.html', NULL);
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
  PRIMARY KEY  (knoten_id)
) TYPE=MyISAM COMMENT='beinhaltet die einzelnen Gruppen';

#
# Daten für Tabelle `knoten1`
#

INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) VALUES (12, 'Testknoten', 'index.php', 'newsletter', 'aaaaaaaa aaaaaa aaaaaaaa aaaaaaaa aaaaa\r\nbbbbbbbbbb bbbbbbb bbbbbbbbb bbbbbbb\r\nccccccc cccccc		');
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) VALUES (3, 'Knoten3', 'index.html', 'ccc', NULL);
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) VALUES (4, 'Knoten4', 'index.php', NULL, NULL);
INSERT INTO knoten1 (knoten_id, knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) VALUES (5, 'Knoten5', 'index.php', 'rezepte', NULL);
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

INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (1, 1, 1);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (2, 1, 2);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (3, 1, 3);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (4, 2, 4);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (5, 2, 5);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (6, 2, 6);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (7, 3, 7);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (8, 3, 8);
INSERT INTO knoten1_blatt1 (id, knoten_id, blatt_id) VALUES (9, 3, 9);
# --------------------------------------------------------

#
# Tabellenstruktur für Tabelle `kunde`
#

CREATE TABLE kunde (
  id int(4) NOT NULL auto_increment,
  anrede enum('Frau','Herr') NOT NULL default 'Frau',
  name varchar(50) default NULL,
  vorname varchar(50) default NULL,
  telefon varchar(25) default NULL,
  handy varchar(25) default NULL,
  e_mail varchar(35) default NULL,
  datum timestamp(14) NOT NULL,
  strasse varchar(75) NOT NULL default '',
  plz varchar(5) NOT NULL default '',
  hausnummer varchar(5) default NULL,
  ort varchar(75) default NULL,
  bestaetigt enum('Nein','Ja') NOT NULL default 'Nein',
  profil1 varchar(50) default NULL,
  profil2 varchar(50) default NULL,
  profil3 varchar(50) default NULL,
  status enum('unsicher','sicher') NOT NULL default 'unsicher',
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Kundendaten';

#
# Daten für Tabelle `kunde`
#

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

INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (58, 1, 9);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (57, 1, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (56, 1, 4);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (4, 2, 1);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (55, 1, 2);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (51, 34, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (54, 1, 1);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (52, 36, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (50, 35, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (53, 37, 8);
INSERT INTO rechte_user (id, user_id, rechte_id) VALUES (59, 1, 10);
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
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='Rezepttabelle';

#
# Daten für Tabelle `rezepte`
#

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

INSERT INTO test (id, text) VALUES (1, 'aaa');
INSERT INTO test (id, text) VALUES (2, 'bbb');
INSERT INTO test (id, text) VALUES (4, 'ddd');
INSERT INTO test (id, text) VALUES (5, 'eee');
INSERT INTO test (id, text) VALUES (6, 'fff');
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

INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (1, 'Krauss', 'Stephan', 'stephan', 'stephan', 'Superuser');
INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (22, 'Krauss', 'Antje', 'antje', 'antje', '  User');
INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (35, 'Krauss', 'Matthias', 'matthias', 'matthias', '  Redaktion');
INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (36, 'Krauss', 'Thomas', 'thomas', 'thomas', '  Redaktion');
INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (37, 'Max', 'Mustermann', 'max', 'max', '  ');
INSERT INTO user (id, Name, Vorname, Passwort, Benutzername, Bemerkung) VALUES (38, 'Mies', 'Mies', 'mies', 'mies', ' &nbsp;');

