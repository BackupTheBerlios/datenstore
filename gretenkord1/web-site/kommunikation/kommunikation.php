<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'check.inc');  // Kontrollklasse Formular
include_once(PHP_PFAD.'function.inc');  // zentrale Funktionsdatei

$tmpl = new patTemplate();
$tmpl->setBasedir(T_KOMMUNIKATION);
$tmpl->readTemplatesFromFile('kommunikation.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$zugang = $db->connect();
$query1="select * from user,adresse where user.id=adresse.user_id order by Name,Vorname";
$antwort1=$db->query($query1);
$antwort1=array_bildung($antwort1);
$tmpl->addVars('liste',$antwort1);

$db->close();
$tmpl->displayParsedTemplate();
?>
