<?
/******** 'key.inc' fuer Datenbank  *****************/
$db_host = "localhost";
$db_name = "verwaltung";
$db_user = "walter";
$db_pass = "walter";

/********* allgemeine Pfade ************/
define('PFAD','c:/php/gretenkord/');  // allgemeiner Serverpfad
define('PHP_PFAD',PFAD.'php/');  // PHP - Pfad
define('TEMPLAT_PFAD',PFAD.'template/');  // Template - Pfad

/********* Templatpfade *******************/
define('T_START',TEMPLAT_PFAD.'start/'); // Templat - Pfad, Modul Benutzer 'start'
define('T_LEISTE',TEMPLAT_PFAD.'leiste/'); // Templat - Pfad, Modul Benutzer 'leiste'
define('T_ANLEGEN',TEMPLAT_PFAD.'anlegen/');  // Templat - Pfad, Modul Benutzer 'anlegen'
define('T_AENDERN',TEMPLAT_PFAD.'aendern');  // Templat - Pfad, Modul Benutzer 'aendern'
define('T_RECHTE_AENDERN',TEMPLAT_PFAD.'rechte_aendern');  // Templat - Pfad, Modul Rechte 'aendern'
define('T_INFO',TEMPLAT_PFAD.'info');  // Templat - Pfad, Modul 'information schreiben'
define('T_KOMMUNIKATION',TEMPLAT_PFAD.'kommunikation'); // Templat - Pfad, Modul 'kommunikation'
define('T_KNOTEN_BLATT',TEMPLAT_PFAD.'knoten_blatt'); // Templat - Pfad , Modul Knoten/Blatt anlegen/aendern

/************* PHP - Pfade *****************/
define('PHP_START',PHP_PFAD.'start/');  // PHP - Pfad, Modul Benutzer 'start'
define('PHP_LEISTE',PHP_PFAD.'leiste/');  // PHP - Pfad, Modul Benutzer 'leiste'
define('PHP_ANLEGEN',PHP_PFAD.'anlegen/');  // PHP - Pfad, Modul Benutzer 'anlegen'
define('PHP_AENDERN',PHP_PFAD.'aendern');  // PHP - Pfad, Modul Benutzer 'aendern'
define('PHP_RECHTE_AENDERN',PHP_PFAD.'rechte_aendern');  // PHP - Pfad, Modul Rechte 'aendern'
define('PHP_INFO',PHP_PFAD.'info');  // PHP - Pfad, Modul 'information schreiben'
define('PHP_KOMMUNIKATION',PHP_PFAD.'kommunikation');  // PHP - Pfad, Modul 'kommunikation'
define('PHP_KNOTEN_BLATT',PHP_PFAD.'knoten_blatt');  // PHP - Pfad, Modul 'knoten_blatt'

?>
