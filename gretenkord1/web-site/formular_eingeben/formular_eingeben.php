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
$tmpl->setBasedir(T_FORMULAR_EINGEBEN);

/************** abspeichern der Werte ****************************/
if($speichern){
	/***************** speichern der Bilder *********************************/
	$i=1;
	$j=0;
	foreach($HTTP_POST_FILES as $name => $inhalt){
		if($HTTP_POST_FILES[$name]['type']=='image/pjpeg' or $HTTP_POST_FILES[$name]['type']=='image/jpeg' or $HTTP_POST_FILES[$name]['type']=='image/gif' or $HTTP_POST_FILES[$name]['type']=='image/png'){  // Kontrolle Dateitype
			$test[$i]="ja";
			if($HTTP_POST_FILES[$name]['size']>20000){
				$test[$i]="nein";  // Kontrolle Dateigroesse
				$fehler[fehler][$j]="Datei: ".$HTTP_POST_FILES[$name][name].", Datei zu gross !";
				$j++;
			}
			}
		else{
			$test[$i]="nein";
			if($HTTP_POST_FILES[$name]['size']>2){
				$fehler[fehler][$j]="Datei: ".$HTTP_POST_FILES[$name][name].", falscher Dateityp !";
				$j++;
			}
		}
	
	// $bild_pfad="/is/htdocs/12468/www.datenstore.de/bilder/";  // Bildpfad - Server
	$bild_pfad="c:/php/gretenkord/bilder/"; // Bildpfad - Lokal
	
	if($test[1]=='ja') move_uploaded_file($minibild1,$bild_pfad.$HTTP_POST_FILES[$name]['name']);
	if($test[2]=='ja') move_uploaded_file($minibild2,$bild_pfad.$HTTP_POST_FILES[$name]['name']);
	if($test[3]=='ja') move_uploaded_file($bild1,$bild_pfad.$HTTP_POST_FILES[$name]['name']);
	if($test[4]=='ja') move_uploaded_file($bild2,$bild_pfad.$HTTP_POST_FILES[$name]['name']);
	$i++;
	}
	
	/********************** speichern der Daten **********************/
	foreach($HTTP_POST_VARS as $name => $inhalt){
		$name=trim($name);
		if(strpos($name,'formular')=='true' or strpos($name,'name_formular')=='true' or strpos($name,'speichern')=='true'){
			
		}
		else{
			if(strlen($inhalt)>0){
				$inhalt=str_replace("\n","<br>",$inhalt);
				echo "&Uuml;bernahme: Name: $name Inhalt: $inhalt <br>";
			}
		}
	}
	
	
	/*************** Neugenerierung Templat ************************/
	$tmpl->readTemplatesFromFile($HTTP_POST_VARS[formular]);
	$tmpl->addVar('gesamt','INFO',$HTTP_POST_VARS[name_formular]);
	$tmpl->addVar('gesamt','USER_ID',$HTTP_POST_VARS[user_id]);
	$tmpl->addVar('gesamt','FORMULAR',$HTTP_POST_VARS[formular]);
	$tmpl->addVar('gesamt','NAME_FORMULAR',$HTTP_POST_VARS[name_formular]);
	if($j>0){  // setzen der Fehlermeldung
		$tmpl->setAttribute('fehler','visibility','visibility');
		$tmpl->addVars('fehler',$fehler);
	}
	$tmpl->displayParsedTemplate();
	$db->close();
	gz_output();
	exit();
}







/********** Formular im Ausgangszustand *****************/
$tmpl->readTemplatesFromFile($HTTP_GET_VARS[formular]);
$tmpl->addVar('gesamt','INFO',$HTTP_GET_VARS[name_formular]);
$tmpl->addVar('gesamt','USER_ID',$HTTP_GET_VARS[user_id]);
$tmpl->addVar('gesamt','FORMULAR',$HTTP_GET_VARS[formular]);
$tmpl->addVar('gesamt','NAME_FORMULAR',$HTTP_GET_VARS[name_formular]);

$tmpl->displayParsedTemplate();
$db->close();
gz_output();
?>
