<?
/********** globale Includedateien *******************/
include_once('patTemplate.inc'); // Templatklasse

/******************* Testen Templat *************************/
if($HTTP_POST_VARS[testen] and $HTTP_POST_VARS[test]=='parsen'){
	$tmpl = new patTemplate();
	$tmpl->setBasedir('c:/php/gretenkord/templat_test');
	$tmpl->readTemplatesFromFile($HTTP_POST_VARS[datei]);
	$tmpl->displayParsedTemplate();
}

/**************** Erstellung Templat ***************************/
if($HTTP_POST_VARS[testen] and $HTTP_POST_VARS[test]=='erstellen'){
	
	/********* Ausgabe der Uebersichtsdatei **********/
	$datei_ausg=$HTTP_POST_VARS[datei];
	$laenge=strlen($datei_ausg);
	$datei_eing=substr($datei_ausg,0,$laenge-5);
	$datei_eing=$datei_eing."html";
	$inhalt="aaa";
	$fp1=fopen($datei_eing,"w+");
	$fp2=fopen($datei_ausg,"r");
	$tabelle=0; // Startwert
	while(!feof($fp2)){  // Beginn Schleife
		$zeile=fgets($fp2,256);
		$zeile=trim($zeile);
		$zeile1="";
		
		if(eregi("(<table*){1}",$zeile)){  // wenn vorher Tabelle
			$tabelle=1;
			$wert1 = $zeile;
		}
		if(eregi("(</table*)",$zeile)){
			$tabelle=0;
		}
		
		/********* wenn Block *************/
		if(eregi("(<pattemplate:*)",$zeile) or eregi("(</pattemplate:*)",$zeile)) $zeile=bloecke_darstellen($zeile,$tabelle,$wert1); 
		
		/*********** Darstellung der Formulardaten *************/
		$zeile=formulardaten($zeile);
		
		fputs($fp1,$zeile);  // Ausgabe in Datei
		
	}
		fclose($fp1);
		fclose($fp2);
}

/**
* diese Funktion stellt die Bloecke dar
*
*
*/
function bloecke_darstellen($string,$tabelle,$wert1){

	if($tabelle==1){
		$wert="</table>";
	}
	else{
		$wert="";
	}
	
	$wert .= "<table width='100%'><tr>";
	
	if(eregi("(<pattemplate:tmpl){1}",$string)){
		$wert2 = eregi_replace("(<pattemplate:)","<td style='color:blue;' BGCOLOR='#FD871C'>Anfang pattemplate:",$string);
	}
	if(eregi("(</pattemplate:tmpl){1}",$string)){
		$wert2 = eregi_replace("(</pattemplate:)","<td style='color:blue;' BGCOLOR='#FD871C'>Ende pattemplate:",$string);
	}
	if(eregi("(<pattemplate:sub){1}",$string)){
		$wert2 = eregi_replace("(<pattemplate:)","<td style='color:blue;' BGCOLOR='yellow'>Anfang pattemplate:",$string);
	}
	if(eregi("(</pattemplate:sub){1}",$string)){
		$wert2 = eregi_replace("(</pattemplate:)","<td style='color:blue;' BGCOLOR='yellow'>Ende pattemplate:",$string);
	}
	
	$laenge=count($wert2);
	$wert2 = trim($wert2);
	$wert .= substr($wert2,0,$laenge-2);
	
	$wert .=  "</td></tr></table>";
	
	if($tabelle==1){
	 $wert .= $wert1;
	}

	return $wert;
}

	/**
	* Darstellung der Variablennamen eines Formular
	*
	*/
	function formulardaten($zeile){
		$zeile_neu="";
		$teile1=explode("<",$zeile);
		for($i=1;$i<count($teile1);$i++){
			if(eregi("input",$teile1[$i]) or eregi("select",$teile1[$i]) or eregi("textarea",$teile1[$i])){
				$variable1=$teile1[$i];
				$variable2=explode(" ",$variable1);
				for($j=0;$j<count($variable2);$j++){
					if(eregi("name=",$variable2[$j])){
						$variable3=substr($variable2[$j],6,strlen($variable2[$j])-1);
						$variable3=ereg_replace(">","",$variable3);
						if(strlen($variable3)>0){
							$variable3="<div style='color:red'>$".substr($variable3,0,-1)."</div>";
						}
					}
				}
				$zeile_neu .= "<".$teile1[$i].$variable3;
			}
			else{
				$zeile_neu .= "<".$teile1[$i];
			}
		}
	return $zeile_neu;
	}

/***************** Templat ansehen ***********/
if($HTTP_POST_VARS[test]=='ansehen'){
	header ("Location: aendern.html");  // Umleitung des Browsers
}
?>


