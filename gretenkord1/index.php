<?
if($HTTP_POST_VARS){
	foreach($HTTP_POST_VARS as $name => $inhalt){
		$formular_string .= $name."=".$inhalt."&";
	}
	$laenge=strlen($formular_string);
	$formular_string=substr($formular_string,0,$laenge-1);
}

echo "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<html>
<head>
	<title>Startseite Benutzerverwaltung</title>
</head>
<frameset  cols='26%,*' border='0' frameborder='0' framespacing='0'>
    <frame name='navi' src='web-site/leiste/leiste.php?".$formular_string."' marginwidth='0' marginheight='0' scrolling='auto' frameborder='0' noresize>
    <frame name='haupt' src='web-site/start/zugang.php?".$formular_string."' marginwidth='0' marginheight='0' scrolling='auto' frameborder='0' noresize>
</frameset>
</html>";
?>
