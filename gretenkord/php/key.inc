<?
/******** 'key.inc' fuer Datenbank  *****************/
$db_host = "localhost";
$db_name = "verwaltung";
$db_user = "walter";
$db_pass = "walter";

/********* allgemeine Pfade ************/
define('PFAD','c:/php/adressdatenbank/');  // allgemeiner Serverpfad
define('PHP_PFAD',PFAD.'php/');  // PHP - Pfad
define('TEMPLAT_PFAD',PFAD.'template/');  // Template - Pfad

/********* Templatpfade *******************/
define('T_START',TEMPLAT_PFAD.'start/'); // Templat - Pfad, Modul 'start'
define('T_LEISTE',TEMPLAT_PFAD.'leiste/'); // Templat - Pfad, Modul 'leiste'
define('T_ANLEGEN',TEMPLAT_PFAD.'anlegen/');  // Templat - Pfad, Modul 'anlegen'

/************* PHP - Pfade *****************/
define('PHP_START',PHP_PFAD.'start/');  // PHP - Pfad, Modul 'start'
define('PHP_LEISTE',PHP_PFAD.'leiste/');  // PHP - Pfad, Modul 'leiste'
define('PHP_ANLEGEN',PHP_PFAD.'anlegen/');  // PHP - Pfad, Modul 'anlegen'


?>
