<?
$wert=mysql_connect ('localhost','walter','walter');
$result = mysql_db_query ("verwaltung","select * from knoten1");
while ($row = mysql_fetch_array ($result)) {
    echo $row["knoten_id"]."<br>";
    echo $row["knoten_name"]."<hr>";
}
mysql_free_result ($result);
mysql_close($wert);
?>
