<?
/********** Modul Rechte anlegen / loeschen *******************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // globale Funktionsdatei

/********* lokale Includedateien ****************/
include_once(PHP_RECHTE_AENDERN.'/rechte_aendern_function.inc');  // lokale Funktionssammlung

$tmpl = new patTemplate();
$tmpl->setBasedir(T_RECHTE_AENDERN);
$tmpl->readTemplatesFromFile('rechte_aendern.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$db->connect();

/********* neues Recht eintragen ****************/
if($HTTP_POST_VARS[anlegen]){
	$query1 = "insert into rechte (Rechte_Art, Modul, Beschreibung) values ";
	$query1 .= "('$HTTP_POST_VARS[rechte_art]', '$HTTP_POST_VARS[modul]', ";
	$query1 .= "'$HTTP_POST_VARS[beschreibung]')";
	$db->query($query1);
}

/********** Recht loeschen *******************/
if($HTTP_POST_VARS[rechte_id]){
	$query1="delete from rechte where id=$HTTP_POST_VARS[rechte_id]";
	$db->query($query1);
	$query1="delete from rechte_user where rechte_id=$HTTP_POST_VARS[rechte_id]";
	$db->query($query1);
}


/********* Rechte anzeigen ************/
$query1="select * from rechte order by Rechte_Art";
$antwort1 = $db->query($query1);
$antwort1 = array_bildung($antwort1);
$tmpl->addVars('liste',$antwort1);

$tmpl->displayParsedTemplate();
$db->close();
?>
