<?
/************ Werte der Bloecke ************/
$array_passiv[knoten_id][0]="1";
$array_passiv[knoten_id][1]="2";
$array_passiv[knoten_id][2]="3";
$array_passiv[knoten_pfad][0]="aaaaaaaaa";
$array_passiv[knoten_pfad][1]="bbbbbbbbb";
$array_passiv[knoten_pfad][2]="ccccccccc";
$array_passiv[knoten_name][0]="Knoten1";
$array_passiv[knoten_name][1]="Knoten2";
$array_passiv[knoten_name][2]="Knoten3";

$array_aktiv[knoten_id][3]="4";
$array_aktiv[knoten_pfad][3]="dddddddddd";
$array_aktiv[knoten_name][3]="Knoten4";

/************* globale Includedateien ***********************/
include_once('patTemplate.inc');


/************* Ausgangswerte **************/

$tmpl = new patTemplate();
$tmpl->setBasedir('c:/php/navigation');
$tmpl->readTemplatesFromFile('navigation2.ihtml');


$tmpl->setAttribute('passiv','visibility','visibility');
$tmpl->addVars('passiv',$array_passiv);

$tmpl->setAttribute('aktiv','visibility','visibility');
$tmpl->addVars('aktiv',$array_aktiv);

$tmpl->dump();
$tmpl->displayParsedTemplate();

?>
