<?
/*********** Modulsteuerung 'knoten_blatt' ****************************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // zentrale Funktionsklasse

/********* lokale Includedateien ****************/
include_once(PHP_KNOTEN_BLATT.'/knoten_blatt_function.inc');  // lokale Funktionssammlung

$tmpl = new patTemplate();
$tmpl->setBasedir(T_KNOTEN_BLATT);
$tmpl->readTemplatesFromFile('knoten_blatt.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass); // Verbindung zur Datenbank
$db->connect();

if($aendern_knoten){  // wenn Knoten geaendert wird
	$query1="UPDATE knoten1 set knoten_name='$HTTP_POST_VARS[knoten_name]', knoten_pfad='$HTTP_POST_VARS[knoten_pfad]', knoten_verzeichnis='$HTTP_POST_VARS[knoten_verzeichnis]' 
	 where knoten_id=$HTTP_POST_VARS[knoten_id]";
	$db->query($query1);
	unset($aendern_knoten);
}


if(!$aendern_knoten and !$hinzufuegen_knoten and !$loeschen_knoten and !$blattverwaltung_knoten){  // Gesamtuebersicht
	verzeichnisse_bestimmen();
	$query1="select * from knoten1 order by knoten_id";
	$antwort1=$db->query($query1);
	$antwort1=array_bildung($antwort1);
	
	$tmpl->setAttribute('knoten','visibility','visibility');
	$tmpl->setAttribute('knoten_liste','visibility','visibility');
	$tmpl->addVars('knoten_liste',$antwort1);
}

$tmpl->displayParsedTemplate();
$db->close();  // Verbindung zur Datenbank aufheben
?>
