<?
/********** Modul Rechte anlegen / loeschen *******************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // globale Funktionsdatei


$tmpl = new patTemplate();
$tmpl->setBasedir(T_INFO);
$tmpl->readTemplatesFromFile('info.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$db->connect();

/********* speichern der Info ************/
if($HTTP_POST_VARS[senden]){
	$HTTP_POST_VARS[info]=trim($HTTP_POST_VARS[info]);
	if(strlen($HTTP_POST_VARS[info])>0){
		$query1="insert into info (user_id, info, Absender) values ('$HTTP_POST_VARS[empfaenger]', '$HTTP_POST_VARS[info]', '$HTTP_POST_VARS[user]')";
		$db->query($query1);
	}
}

/********* Abfragen der User ****************/
$query1="select * from user order by Name";
$abfrage1 = $db->query($query1);
$abfrage1 = array_bildung($abfrage1);
$tmpl->addVars('auswahl',$abfrage1);
$tmpl->addVar('gesamt','USER',1);

$tmpl->displayParsedTemplate();
$db->close();
?>
