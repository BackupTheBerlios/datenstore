<?
/********** Modul Rechte anlegen / loeschen *******************/

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
	$query1 ="select * from archiv where ";
	if(strlen($HTTP_POST_VARS[schlagwort])>2){
		$HTTP_POST_VARS[schlagwort]=trim($HTTP_POST_VARS[schlagwort]);
		$schlagwort=explode(" ",$HTTP_POST_VARS[schlagwort]);
		echo "Anzahl: ".$anzahl1=count($schlagwort);
		for($i=0;$i<$anzahl1;$i++){
			if($i<$anzahl1-1){
				$query1 .="ueberschrift like %$schlagwort[$i]% or ";
			}
			else{
				$query1 .="ueberschrift like %$schlagwort[$i]%";
			}
		}
	}
	
}
else{
	$query1="select * from archiv where user_id_kontrolle=0";
}

	$antwort1=$db->query($query1);
	$anzahl=$db->affected_rows();
	$antwort1=array_bildung($antwort1);
	if($anzahl>0){
		$antwort1[datum]=zeit_anpassung($antwort1[datum]);
		$antwort1[user_id_kontrolle]=status_anpassung($antwort1[user_id_kontrolle]);
		$tmpl->setAttribute('liste','visibility','visibility');
		$tmpl->addVars('inhalt',$antwort1);
	}
	else{
		$tmpl->addVar('gesamt','INFO','keien ungepr&uuml;ften Datens&auml;tze vorhanden !');
	}

//$tmpl->dump();
$tmpl->displayParsedTemplate();
$db->close();
gz_output();
?>
