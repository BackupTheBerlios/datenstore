<?
echo "<html>
<head>
<body BGCOLOR='#FDD67B'>
<h2 ALIGN='center' STYLE='color:blue'>Erstellung einer &Uuml;bersichtsdatei<br>
aus Einer Templatdatei
</H2>
<table ALIGN='center' border='1' bordercolor='blue'>
<tr>
<form ACTION='templat_darstellung.php' METHOD='post'>
<td>Templatdatei: </TD><td ALIGN='center'><input TYPE='File' NAME='datei_ausg'></TD></TR>
<tr><td COLSPAN='2' ALIGN='center'><input TYPE='Submit' NAME='erstellen' value=' erstellen '></TD>
</FORM>
</TR>
</TABLE>
</BODY>
</HEAD>
</HTML>";


if($erstellen and is_file($datei_ausg)){
	
	$form[input]="<input";
	$form[textarea]="<textarea";
	$form[select]="<select";
	
	/********* Ausgabe der Uebersichtsdatei **********/
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
		
		/************* wenn Platzhalter ******************/
		for($i=0;$i<strlen($zeile);$i++){
			$zeichen=substr($zeile,$i,1);
			if($zeichen=="{"){
				$zeichen="<div STYLE='color:red'>{";
			}
			if($zeichen=="}"){
				$zeichen="}</div>";
			}
			$zeile1 .=$zeichen;
		}
		
		
		fputs($fp1,$zeile1);  // Ausgabe in Datei
		
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
?>
