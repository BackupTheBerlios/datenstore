<?
/************ Modul Archivkontrolle der einzelnen Artikel ***********************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // globale Funktionsdatei

/*********** locale Includedateien *******************/
include_once(PHP_ARCHIV_KONTROLLE.'/archiv_kontrolle_function.inc');

$tmpl = new patTemplate();
$tmpl->setBasedir(T_ARCHIV_KONTROLLE);
$tmpl->readTemplatesFromFile('archiv_kontrolle_einzel.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$db->connect();


$tmpl->displayParsedTemplate();
$db->close();
gz_output();
?>

