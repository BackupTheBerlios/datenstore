<?
/************ Werte der Bloecke ************/
$passiv[ID][0]="1";
$passiv[ID][1]="2";
$passiv[ID][2]="3";
$passiv[PFAD][0]="aaaaaaaaa";
$passiv[PFAD][1]="bbbbbbbbb";
$passiv[PFAD][2]="ccccccccc";
$passiv[NAME][0]="Knoten1";
$passiv[NAME][1]="Knoten2";
$passiv[NAME][2]="Knoten3";

$aktiv[ID][3]="4";
$aktiv[PFAD][3]="dddddddddd";
$aktiv[NAME][3]="Knoten4";

/************* globale Includedateien ***********************/
include_once('patTemplate.inc');


/************* Ausgangswerte **************/

$tmpl = new patTemplate();
$tmpl->setBasedir('c:/php/navigation');
$tmpl->readTemplatesFromFile('navigation2.ihtml');

$tmpl->addVars('block1',$passiv);

$tmpl->addVars('block2',$aktiv);

$tmpl->dump();
$tmpl->displayParsedTemplate();

?>
