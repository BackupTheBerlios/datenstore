<?
/********** globale Includedateien *******************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
// include_once(PHP_PFAD.'function.inc');  // zentrale Funktionsdatei

/*************** lokale Includedateien **********************/
// include_once(PHP_FORMULAR_EINGEBEN.'/formular_eingeben_function.inc');

/************************* Steuerungsblock ***********************/
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$zugang = $db->connect();
$tmpl = new patTemplate();
$tmpl->setBasedir(T_FORMULAR_EINGEBEN);

/************** abspeichern der Werte ****************************/
if($speichern){
	/********************** speichern der Daten **********************/
	foreach($HTTP_POST_VARS as $name => $inhalt){
		if($name!='formular' and $name!='name_formular' and $name!='speichern'){  // ausfiltern unerwuenschter Variablen
			if(strlen($inhalt)>0){
				$inhalt=str_replace("\n","<br>",$inhalt);  // Zeilenumbruch
				$spalte .=$name.", ";
				$spalten_wert .="'".$inhalt."', ";
			}
		}
	}
	$spalten_wert=substr($spalten_wert,0,-2);
	$spalte=substr($spalte,0,-2);
	$query1="insert into archiv(".$spalte.") values(".$spalten_wert.")";  // Zusammenbau Eingabe-Query
	$eingabe1=$db->query($query1);
	$bildzusatz=$db->insert_id();
	
	/***************** speichern der Bilder *********************************/
	$i=1;
	$j=0;
	foreach($HTTP_POST_FILES as $name => $inhalt){
	if($HTTP_POST_FILES[$name]['type']=='image/pjpeg') $bildtest="jpeg"; // Ermittlung Bildformat
	if($HTTP_POST_FILES[$name]['type']=='image/jpeg') $bildtest="jpeg";
	if($HTTP_POST_FILES[$name]['type']=='image/gif') $bildtest="gif";
	if($HTTP_POST_FILES[$name]['type']=='image/png') $bildtest="png";
	
	
		if($bildtest){  // Kontrolle Dateitype
			$test[$i]="ja";
			if($HTTP_POST_FILES[$name]['size']>20000){  // max. Groesse Dateiupload
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
	
		$bild_pfad="/is/htdocs/12468/www.datenstore.de/bilder/";  // Bildpfad - Server
		// $bild_pfad="c:/php/gretenkord/bilder/"; // Bildpfad - Lokal
		
		/************* Upload der Bilddateien und Eintragung in Tabelle 'archiv' ******************/
		if($test[1]=='ja'){
			move_uploaded_file($minibild1,$bild_pfad."minibild1_".$bildzusatz.".".$bildtest);
			$update="minibild1_".$bildzusatz.".".$bildtest;
			$query2="update archiv set minibild1='$update' where id='$bildzusatz'";
			$db->query($query2);
		}
		if($test[2]=='ja'){
			move_uploaded_file($minibild2,$bild_pfad."minibild2_".$bildzusatz.".".$bildtest);
			$update="minibild2_".$bildzusatz.".".$bildtest;
			$query2="update archiv set minibild2='$update' where id='$bildzusatz'";
			$db->query($query2);
		}
		if($test[3]=='ja'){
			move_uploaded_file($bild1,$bild_pfad."bild1_".$bildzusatz.".".$bildtest);
			$update="bild1_".$bildzusatz.".".$bildtest;
			$query2="update archiv set bild1='$update' where id='$bildzusatz'";
			$db->query($query2);
		}
		if($test[4]=='ja'){
			move_uploaded_file($bild2,$bild_pfad."bild2_".$bildzusatz.".".$bildtest);
			$update="bild2_".$bildzusatz.".".$bildtest;
			$query2="update archiv set bild2='$update' where id='$bildzusatz'";
			$db->query($query2);
		}
		
	$i++;
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
