<html>
	<head>
		<title>Cascading Menu</title>
		<style media="screen" type="text/css">
			<!--
			.symbols,a.symbols:link,a.symbols:hover,a.symbols:alink,a.symbols:visited { color: #333333; font-size: 11px; font-family: Arial, Helvetica, Geneva, Swiss, SunSans-Regular; text-decoration: none }
			.starter,a.starter:link,a.starter:alink,a.starter:visited { color: #333333; font-size: 13px; font-family: Arial, Helvetica, Geneva, Swiss, SunSans-Regular; text-decoration: none }
			.name,a.name:link,a.name:alink,a.name:visited { color: #333333; font-size: 11px; font-family: Arial, Helvetica, Geneva, Swiss, SunSans-Regular; text-decoration: none }
			a.starter:hover,a.name:hover {text-decoration: underline }
			//-->
		</style>
	</head> 
	<body bgcolor="white">
       	<table width="100%" cellpadding="8" cellspacing="0" border="0" height="24">
       		<tr>
       			<td class="starter">
       				<a href="<?php echo $PHP_SELF; ?>?close=1" class="starter">Close all nodes&nbsp;<img src="closeall_on.gif" border="0" align="middle"></a><a href="<?php echo $PHP_SELF; ?>?open=1" class="starter"><img src="openall_on.gif" border="0" align="middle">&nbsp;Open all nodes</a>
       			</td>
       		</tr>
       	</table>
<?php
   include "class.phillipianstree-1.1.php";


    //////////// define manually or create from a database your node info tree
    $node_info[0] = "0,Title,,o,,,0,p,n";
    $node_info[1] ="1,Door Decs,j,c,pictures.php,_new,1,n,0";
    $node_info[2] ="2,Bulletin Boards,b,c,bb.php,,1,p,0";
    $node_info[3]="3,Halls,b,c,,,1,p,0";
    $node_info[4]="4,Miscellaneous,bl,c,http://www.dice.com,_new,1,p,0";
    $node_info[5]="5,Apartments,j,c,,,2,p,3";
    $node_info[6]="6,N.Carrick,b,c,,,2,p,3";
    $node_info[7]="7,S.Carrick,b,c,,,2,p,3";
    $node_info[8]="8,Clement,j,c,,,2,p,3";
    $node_info[9]="9,Gibbs,j,c,,,2,p,3";
    $node_info[10]="10,Greve,j,c,,,2,p,3";
    $node_info[11]="11,Hess,j,c,,,2,p,3";
    $node_info[12]="12,Humes,j,c,,,2,p,3";
    $node_info[13]="13,Massey,j,c,,,2,p,3";
    $node_info[14]="14,Melrose,j,c,,,2,p,3";
    $node_info[15]="15,Morrill,bl,c,,,2,p,2";
    $node_info[16]="16,Reese,j,c,,,2,p,3";
    $node_info[17]="17,Strong,j,c,,,2,p,3";
    $node_info[18]="18,Univ.Apartments,t,c,,,2,p,3";
    $node_info[19]="19,Misc0,j,c,crack.php,_thiswindow,2,n,4";
    $node_info[20]="20,Staff,bl,c,login.php,,3,p,15";
    $node_info[21]="21,Misc1,j,c,crack.php,_thiswindow,2,n,4";
    $node_info[22]="22,Staff,t,c,login.php,,3,p,6";
    $node_info[23]="23,Misc2,j,c,crack.php,_thiswindow,2,n,4";
    $node_info[24]="24,Misc3,t,c,login.php,,2,n,4";
    $node_info[25]="25,Essai+,bl,c,hello.php,,3,p,7";
    $node_info[26]="26,Niv4,j,c,Niv4.php,,4,n,25";
    $node_info[27]="27,Niv4,bl,c,Niv4.php,,4,p,25";
    $node_info[28]="28,Niv4,j,c,Niv4.php,,4,p,20";
    $node_info[29]="29,Niv4,j,c,Niv4.php,,4,n,20";
    $node_info[30]="30,Niv4,bl,c,Niv4.php,,4,p,20";
    $node_info[31]="31,Niv5,bl,c,Niv5.php,,5,p,30";
    $node_info[32]="32,Niv5,j,c,Niv5.php,,5,n,27";
    $node_info[33]="33,Niv5,j,c,Niv5.php,,5,n,27";
    $node_info[34]="34,Niv5,t,c,Niv5.php,,5,n,27";
    $node_info[35]="35,Niv6,t,c,Niv6.php,,6,n,31";

  ////////// instantiate your tree
  $tree = new PhillipiansTree;
  $tree->open_all        = $open;
  $tree->close_all        = $close;
  
  $tree->set_classes("symbols","name");

  ////////// you can configure the theme outside or inside the class (i. e. if you want flag colors inside add :  condition + $this->set_bgcolor("yourflagcolor") in the main loop)
  //$tree->set_bgcolor("#f5f5f5");
  //$tree->set_cellspacing(1);
  //$tree->set_width("100%");
  //$tree->set_hor_line(1,"#333333",2);
   
  ////////// uncomment if you don't want the starter node to be displayed
  $tree->set_starter_node(0);

  ////////// you can configure the theme outside or inside the class (i. e. if you want different images or symbols inside add :  condition + $this->set_symbols(yournew symbol array) in the nodes creation loops)
   $arr =  array(
      "starter"               =>  "<img border=\"0\" height=\"22\" src=\"Open.gif\" align=\"middle\">",
      "open"                    =>  "<img border=\"0\" height=\"22\" src=\"Open.gif\" align=\"middle\">",
      "plus_L"                 =>  "<img border=\"0\" height=\"22\" src=\"PlusL.gif\" align=\"middle\">",
      "closed"                 =>  "<img border=\"0\" height=\"22\" src=\"Closed.gif\" align=\"middle\">",
      "none_L"                =>  "<img border=\"0\" height=\"22\" src=\"NoneL.gif\" align=\"middle\">",
      "none_T"                =>  "<img border=\"0\" height=\"22\" src=\"NoneT.gif\" align=\"middle\">",
      "minus_L"               =>  "<img border=\"0\" height=\"22\" src=\"MinusL.gif\" align=\"middle\">",
      "plus_T"                  =>  "<img border=\"0\" height=\"22\" src=\"PlusT.gif\" align=\"middle\">",
      "minus_T"                =>  "<img border=\"0\" height=\"22\" src=\"MinusT.gif\" align=\"middle\">",
      "lnode"                    =>   "<img border=\"0\" height=\"22\" src=\"Inode.gif\" align=\"middle\">",
      "space"                   =>  "<img border=\"0\" height=\"22\" src=\"space.gif\" align=\"middle\">",
      "hor_line_src"         =>   "pixel.gif"
      );

  $tree->set_symbols($arr);
  ////////// display your tree
  $tree->display_tree($node_info,$ns,$chg_node,0);
?>
	</body>
</html>
