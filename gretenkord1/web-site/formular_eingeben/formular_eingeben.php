<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc');  // zentrale Funktionsdatei

/*************** lokale Includedateien **********************/
include_once(PHP_FORMULAR_EINGEBEN.'/formular_eingeben_function.inc');


/************************* Steuerungsblock ***********************/
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$zugang = $db->connect();
$tmpl = new patTemplate();

/************** abspeichern der Werte ****************************/
if($speichern){
	foreach($HTTP_GET_VARS as $name => $inhalt){
		if((strpos($name,'bild') or strpos($name,'minibild')) and $inhalt !=''){
			$teile=explode("\\",$inhalt); // Zerlegung Pfad
			$anzahl=count($teile);
			copy($inhalt,"C:/php/gretenkord/kunde/bilder/".$teile[$anzahl-1]); 
		}
	}
}


/********** Formular im Ausgangszustand *****************/
$tmpl->setBasedir(T_FORMULAR_EINGEBEN);
$tmpl->readTemplatesFromFile($HTTP_GET_VARS[formular]);
$tmpl->addVar('gesamt','INFO',$HTTP_GET_VARS[name_formular]);
$tmpl->addVar('gesamt','USER_ID',$HTTP_GET_VARS[user_id]);
$tmpl->addVar('gesamt','FORMULAR',$HTTP_GET_VARS[formular]);
$tmpl->addVar('gesamt','NAME_FORMULAR',$HTTP_GET_VARS[name_formular]);

$tmpl->displayParsedTemplate();
$db->close();
gz_output();
?>
