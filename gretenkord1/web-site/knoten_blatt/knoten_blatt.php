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

/********************* loeschen von Knoten ***************/
if($loeschen_knoten){
	$query1="delete from knoten1 where knoten_id=$knoten_id";
	$antwort1=$db->query($query1);
	unset($loeschen_knoten);
}

/**************** hinzufuegen von Knoten **************/
if($hinzufuegen_knoten){
	$HTTP_POST_VARS[knoten_info]=htmlentities($HTTP_POST_VARS[knoten_info]);
	$query1 ="insert into knoten1 (knoten_name, knoten_pfad, knoten_verzeichnis, knoten_info) ";
	$query1 .="values ('$HTTP_POST_VARS[knoten_name]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_pfad]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_verzeichnis]', ";
	$query1 .="'$HTTP_POST_VARS[knoten_info]')";
	$antwort1=$db->query($query1);
	unset($hinzufuegen_knoten);
}


/************************** Veraenderung der Knoteneinstellungen ******************/
if($aendern_knoten){
	$query1 ="update knoten1 set knoten_name='$HTTP_POST_VARS[knoten_name]', ";
	$query1 .="knoten_pfad='$HTTP_POST_VARS[knoten_pfad]', ";
	$query1 .="knoten_verzeichnis='$HTTP_POST_VARS[knoten_verzeichnis]' ";
	$query1 .="where knoten_id=$knoten_id";
	$antwort1=$db->query($query1);
	unset($aendern_knoten);
}

/************ Anzeige der Einstellungen *************/
if(!$aendern_knoten and !$loeschen_knoten and !$info_knoten and !$blatt and !$hinzufuegen_knoten){
	$query1="select * from knoten1 order by knoten_name";
	$antwort1=$db->query($query1);
	$antwort1=array_bildung($antwort1);
	$tmpl->setAttribute('knoten','visibility','visibility');
	$tmpl->setAttribute('knoten_liste','visibility','visibility');
	$verzeichnis=verzeichnis(KUNDE);  // Abfrage der Verzeichnisse
	$verzeichnis1=verzeichnis_simple($verzeichnis);
	$tmpl->addVar('knoten','KNOTEN_VERZEICHNIS1',$verzeichnis1);
	$antwort1[knoten_verzeichnis]=knoten_pulldown($verzeichnis,$antwort1[knoten_verzeichnis]);
	$antwort1[knoten_pfad]=seite_pulldown($antwort1[knoten_pfad]);  // Namen der Hauptblaetter werden abgeglichen
	$tmpl->addVars('knoten_liste',$antwort1);
}



$tmpl->displayParsedTemplate();
//$tmpl->dump();
$db->close();  // Verbindung zur Datenbank aufheben
?>
