<?
/************ Modul Archivkontrolle ***********************/

/********** globale Includedateien ********************/
include_once('../../php/key.inc'); // Zugangsdaten
include_once(PHP_PFAD.'patTemplate.inc'); // Templatklasse
include_once(PHP_PFAD.'patDbc.inc'); // Datenbankklasse
include_once(PHP_PFAD.'function.inc'); // globale Funktionsdatei

/*********** locale Includedateien *******************/
include_once(PHP_ARCHIV_KONTROLLE.'/archiv_kontrolle_function.inc');

$tmpl = new patTemplate();
$tmpl->setBasedir(T_ARCHIV_KONTROLLE);
$tmpl->readTemplatesFromFile('archiv_kontrolle.ihtml');
$db = new patMysqlDbc($db_host,$db_name,$db_user,$db_pass);
$db->connect();

/************ Suchen ***********************/
if($HTTP_POST_VARS[suchen]){
	
	/************* suche nach Schlagwoertern *************************/
	if(strlen($HTTP_POST_VARS[schlagwort])>2){  // Schlagwoerter
		$query1 ="select * from archiv where ";
		$HTTP_POST_VARS[schlagwort]=trim($HTTP_POST_VARS[schlagwort]);
		$schlagwort=explode(" ",$HTTP_POST_VARS[schlagwort]);
		$anzahl1=count($schlagwort);
		for($i=0;$i<$anzahl1;$i++){
				$query1 .="ueberschrift like '%$schlagwort[$i]%' or teil_ueberschrift1 like '%$schlagwort[$i]%' or ";
				$query1 .="teil_ueberschrift2 like '%$schlagwort[$i]%' or kurztext1 like '%$schlagwort[$i]%' or ";
				$query1 .="kurztext2 like '%$schlagwort[$i]%' or ";
		}
		$query1=substr($query1,0,-4);
	}
	
	/*************** suche nach Datum *********************/
	if($HTTP_POST_VARS[datum]=='kleiner' or $HTTP_POST_VARS[datum]=='groesser'){  // Datum
		$datum1=$HTTP_POST_VARS[jahr].$HTTP_POST_VARS[monat].$HTTP_POST_VARS[tag]."000000";
		if(strlen($query1)==0){  // wenn vorher keine Schlagwoerter
			$query1 ="select * from archiv where ";
		}
		else{
			$query1 .=" and "; // wenn vorher Schlagwoerter
		}
		
		if($HTTP_POST_VARS[datum]=='kleiner'){ // Datum kleiner
			$query1 .=" datum < '$datum1'";
		}
		else{
			$query1 .=" datum > '$datum1'";  // Datum groesser
		}
	}
	
	/************** suche nach aktiven User ****************/
	if($HTTP_POST_VARS[user]>0){
		if(strlen($query1)==0){  // wenn keine Frage vorher
			$query1 ="select * from archiv where ";
		}
		else{
			$query1 .=" and "; // wenn vorher eine Frage
		}
		
		$query1 .="user_id=$user";
		echo "<hr>".$query1."<hr>";
	}
	
	/********* leere Abfrage *******************/
	if(strlen($query1)==0){  // leere Abfrage
		$query1="select * from archiv where user_id_kontrolle=0";
	}
}
else{ // Erststart
	$query1="select * from archiv where user_id_kontrolle=0";
}



	$antwort1=$db->query($query1);
	$anzahl=$db->affected_rows();
	$antwort1=array_bildung($antwort1);
	if($anzahl>0){
		$antwort1[datum]=zeit_anpassung($antwort1[datum]);
		$antwort1[user_id_kontrolle]=status_anpassung($antwort1[user_id_kontrolle]);
		// $antwort1[id]=user_wandel($antwort1[id],$db);
		$tmpl->setAttribute('liste','visibility','visibility');
		$tmpl->addVars('inhalt',$antwort1);
	}
	else{
		$tmpl->addVar('gesamt','INFO','keie Datens&auml;tze vorhanden !');
	}
	$query1 ="select id,Name,Vorname from user order by Name,Vorname";  // eintragen der aktiven User
	$antwort=$db->query($query1);
	$antwort=array_bildung($antwort);
	$tmpl->addVars('name',$antwort);
	

//$tmpl->dump();
$tmpl->displayParsedTemplate();
$db->close();
gz_output();
?>
