<?php
  
  //////////////////////////////////////
  //
  //  CLASS PHILLIPIANSTREE
  //
  //
  //   ----------------------------------------=
  //   VERSION  -  DATE
  //   ----------------------------------------=
  // 
  //   1.1   -    06/25/02
  //
  //   ----------------------------------------=
  //   CHANGES 
  //   ----------------------------------------=
  //   
  //   - @fhelly                 -  v. 1.1     - 06/22/02 add node_id so you can sort the node_info array as you need   
  //   
  //   - @fhelly                 -  v. 1.0.2  - 06/19/02 add comments corrections   
  //
  //   - @fhelly                  -  v. 1.0.1  - 06/18/02 add node_params                 
  //
  //   - @fhelly                  -  v. 1.0     - 06/17/02 s                 
  //      Main changes :
  //      - defined as a class
  //      - no limit of level
  //      – comments
  //      - close all children when a node is closed by user
  //      - simplification of $node_status values
  //      - close all nodes  | open all nodes
  //      - theme params : css classes and images
  //   
  //   - @Ralph.Smith        -  v.           - 03/03/01                 
  //   
  //   
  //   
  //   ----------------------------------------=
  //   AUTHORS
  //  ----------------------------------------=
  // 
  //   Original idea and script By: Ralph Smith, Ralph.Smith.1@excite.com 
  //   Created 3/3/01
  //   
  //   Modified 06/18/02 by François Helly,francois.helly@wanadoo.fr
  // 
  // 
  //   ----------------------------------------=
  //   NOTES
  //   ----------------------------------------=
  // 
  //   $node_info should look like this: 
  //   $node_info = "node_id,node_label, node_type, node_status, node_link, node_target, node_level, node_parent, node_child,node_params" 
  //  node_id             - the id of the node
  //  node_label     - what word(s) should appear beside the icon 
  //  node_type     - the first node is the starter node and has not type 
  //              - b : branching (Appears with a plus or minus depending on the state of the node 
  //              - bl: branching L (Places at the end of a tree on any level other than 1, has the same features as branch 
  //               - j  : junction (Like a branch but with out the plus or minus) 
  //               - t : terminal node (The final node of the menu, does not branch) 
  //   node_status    - o : open , c : closed (initially set to close unless you have a need for a particular folder to be open at loading 
  //  node_link        - where the label will link to 
  //  node_target    - the target of the link, nothing in this area points the link at the current window 
  //  node_level     - 0, 1, 2, 3 , .......   - how many levels you need 
  //  node_parent    - p : yes, the node is a parent; n : no, the node is not a parent 
  //  node_child      - the node_id  of the parent node, or n - if the node is not a child 
  //   node_params      - vars to get in the node symbol element's url   (optional)
  // 
  //   ----------------------------------------=
  //   TODO
  //   ----------------------------------------=
  // 
  //   Add possiibility of attribute onmouseover | onclick | etc. in each element (symbol & label)
  //   = dhtml effects
  // 
  // 
  //////////////////////////////////////


  class PhillipiansTree
  {
       

       //////////////
       //  THEME
       //////////////

       /*
       the class name you want to use for the symbol element
       string
       */
       var $symbol_class;
      
       /*
       the class name you want to use for the node label element
       string
       */
       var $label_class;

       /*
       the main table attributes
       string | integer
       */
       var $border;
       var $cellspacing;
       var $cellpadding;
       var $bgcolor;

       /*
       if you want an horizontal line beetween all nodes
       boolean
       */
       var $hor_line;

       /*
       the horizontal line color
       boolean
       */
       var $hor_line_color;

       /*
       the horizontal line color
       boolean
       */
       var $hor_line_height;

       /*
       the node_status array value
       array
       */
       var $node_status;

       /*
       set it to 1 when you want to close all the nodes
       boolean
       */
       var $close_all;
       
       /*
       set it to 1 when you want to open all the nodes
       boolean
       */
       var $open_all;
       
       /*
       set it to 0 if you don't want to display the starter node : node at indice 0 in the node_info array
       boolean
       */
       var $starter_node;
       
       /*
       The starter node bgcolor
       string
       */
       var $starter_bgcolor; 
 
       /*
       The starter node height
       string
       */
       var $starter_height;

       /*
       The starter node cellpadding
       string
       */
       var $starter_cellpadding;

       /*
       The starter node class
       string
       */
       var $starter_class;


       /**
       ** Class constructor
       ** set the default theme
       ** @param  symbol_class                string     The symbol element class
       ** @param label_class                    string      The label element class
       ** @param  border                          string      The border of the main table
       ** @param  cellspacing                   string       The cellspacing of the main table
       ** @param  cellpadding                    string      The cellpadding of the main table
       ** @param  bgcolor                        string       The bgcolor of the node rows
       ** @param  width                           string       The width of the main table
       ** @param  hor_line                       boolean     If you want an horizontal line row beetween all nodes' row
       ** @param  hor_line_color             string       The bgcolor of the horizontal line row
       ** @param  hor_line_height             integer    The height of the horizontal line row
       ** @param  starter_node                boolean    The on | off value for displaying or not the starter node
       ** @param  starter_bgcolor             string      The height of the horizontal line row
       ** @param  starter_height              boolean    The height of the starter node's table
       ** @param  starter_cellpadding       integer    The cellpadding of the starter node's table
       ** @param  starter_class                string      The class of the starter node label
       **/
       function PhillipiansTree()
       {
            $this->symbol_class                 ="symb";
            $this->label_class                     ="label";
            $this->border                           ="";
            $this->cellspacing                     ="";
            $this->cellpadding                     ="";
            $this->bgcolor                          ="";
            $this->width                             ="";
            $this->width                             ="";
            $this->hor_line                         ="";
            $this->hor_line_color               ="";
            $this->hor_line_height              ="";
            $this->starter_node                  = 1;
            $this->starter_bgcolor              = "";
            $this->starter_height                = "";
            $this->starter_cellpadding         = "";
            $this->starter_class                  = "";
       }


  	/**
	 ** Sets the horizontal line values
       ** @param  hor_line                   boolean    If you want an horizontal line row beetween all nodes' row
       ** @param  hor_line_color          string      The bgcolor of the horizontal line row
       ** @param  hor_line_height         integer    The height of the horizontal line row
	 ** @returns void
	 ** @scope public
	 **/
	function set_hor_line($hor_line="",$hor_line_color="",$hor_line_height="")
	{
	    $this->hor_line                      = $hor_line;
	    $this->hor_line_color            = $hor_line_color;
	    $this->hor_line_height           = $hor_line_height;
	}


  	/**
	 ** Sets the starter node display off  |  on and define theme
       ** @param      starter_node                          boolean    set it to 0 = no starter node
       ** @param      starter_bg_color                   string      The starter node bgcolor
       ** @param      starter_height                       string       The starter node height
       ** @param      starter_cellpadding                integer       The starter node cellpadding
       ** @param      starter_class                         string       The starter node class
	 ** @returns   void
	 ** @scope      public
	 **/
	function set_starter_node($starter_node="",$starter_bgcolor="",$starter_height="",$starter_cellpadding="",$starter_class="")
	{
	    $this->starter_node                 = $starter_node;
	    $this->starter_bgcolor             = $starter_bgcolor;
	    $this->starter_height               = $starter_height;
	    $this->starter_cellpadding        = $starter_cellpadding;
	    $this->starter_class                   = $starter_class;
	}

  	/**
	 ** Sets the tree classes
	 ** @param symb_class    string  The symbol element class
	 ** @param lab_class        string  The label element class
	 ** @returns void
	 ** @scope public
	 **/
	function set_classes($symb_class="",$lab_class="") 
	{
	    $this->symbol_class     = $symb_class;
	    $this->label_class         = $lab_class;
	}

  	/**
	 ** Sets the tree theme
	 ** @param val The tree cellspacing
	 ** @returns void
	 ** @scope public
	 **/
	function set_cellspacing($val="") 
	{
	    $this->cellspacing = $val;
	}

  	/**
	 ** Sets the tree cellpadding
	 ** @param val The node cellpadding
	 ** @returns void
	 ** @scope public
	 **/
	function set_cellpadding($val="") 
	{
	    $this->cellpadding = $val;
	}

  	/**
	 ** Sets the tree width
	 ** @param val The tree width
	 ** @returns void
	 ** @scope public
	 **/
	function set_width($val="") 
	{
	    $this->width = $val;
	}

  	/**
	 ** Sets the nodes backgroundcolor
	 ** @param val The tree bgcolor
	 ** @returns void
	 ** @scope public
	 **/
	function set_bgcolor($val="") 
	{
	    $this->bgcolor = $val;
	}

  	/**
	 ** Gets the nodes backgroundcolor
	 ** @returns string The background color value
	 ** @scope public
	 **/
	function get_bgcolor() 
	{
	   return  $this->bgcolor;
	}


  	/**
	 ** Sets the nodes symbols
	 ** @param val The symbols' array
	 ** @returns void
	 ** @scope public
	 **/
	function set_symbols($val="") 
	{
	    $this->symbols = $val;
	    /* if you are not sure of your syntax
	    echo "<script>alert('";
	    echo "lnode : ";
	    echo $this->symbols['lnode'];
	    echo"');</script>\n";
	    */
	}
       
       function display_tree($node_info,$ns,$chg_node,$check_nodes="")
       {
             $node_id         =array();
             $node_label      = array();
             $node_type       = array();
             $this->node_status    = array();
             $node_target    = array();
             $node_level      = array();
             $node_parent    = array();
             $node_child       = array();
             $node_params   = array();
             $indent_val       = array();

             $num_nodes = count($node_info);
             
             for($d=0;$d<$num_nodes;$d++)
             { 
                  $node_array=explode(",", $node_info[$d]);
                  $node_id[$d]                    = $node_array[0];              
                  $node_label[$d]               =$node_array[1];
                  $node_type[$d]               =$node_array[2];
                  $this->node_status[$d]             =$node_array[3];
                  $node_link[$d]                 =$node_array[4];
                  $node_target[$d]             =$node_array[5];
                  $node_level[$d]               =$node_array[6];
                  $node_parent[$d]             =$node_array[7];
                  $node_child[$d]                =$node_array[8];
                  $node_params[$d]            =$node_array[9];
                   
            } 
            
            $this->create_html($node_id,$node_label,$node_type,$node_link,$node_target,$node_level,$node_parent,$node_child,$node_params,$ns,$chg_node,$check_nodes);
       }
       


	/**
       ** Outputs whole menu
       ** @param node_info            array    The node's array 
       ** @param ns                      array    The array of user's node status  
       ** @param chg_node            integer  The user clicked node = node's indice in node_info array
       ** @param check_nodes       boolean  Set it to 1 if you want to check the node array
       ** @returns                         string   The whole html menu
       ** @scope public
       **/
        function create_html($node_id,$node_label,$node_type,$node_link,$node_target,$node_level,$node_parent,$node_child,$node_params,$ns,$chg_node,$check_nodes="")
        { 
             $num_nodes = count($node_id);
             
             for($d=0;$d<$num_nodes;$d++)
             { 
                if(empty($ns[$node_id[$d]])) :
                    $this->node_status[$d] = "c"; 
                else :
                   $this->node_status[$d]= "o"; 
                endif;
                
            } 
               if($chg_node): 
                 for($f=0;$f<$num_nodes;$f++)
                 {
                       if($node_id[$f] == $chg_node && $this->node_status[$f]=="o"):
                           $this->node_status[$f]="c";
                           $this->node_status  = $this->close_all_children($f,$node_child,$node_id);
                       elseif($node_id[$f] == $chg_node) : 
                           $this->node_status[$f]="o"; 
                       endif;
                 }
             endif;

            ////////// if you want to check your $node_info array
            if(!empty($check_nodes)) :
                for ($e = 0;$e < $num_nodes; $e++)
                { 
                    print "num: $e - $node_id[$e] : $node_label[$e] : $node_type[$e] : $this->node_status [$e] : $node_link[$e] : $node_target[$e] : $node_level[$e] : $node_parent[$e] : $node_child[$e] : $node_params[$e]<br>\n "; 
                 }
            endif;

            $ns=""; 

           if ($this->close_all==1)
               $this->close_all_nodes();

           if ($this->open_all==1)
               $this->open_all_nodes();
            
            ////////// if you want :  cross-browser background : $this->bgcolor   |   a cellspacing : $this->cellspacing   |    a border : $this->border   |    a  width, for example 100%
            print"\t<table";
            if (!empty($this->border)) print " border=\"". $this->border  ."\""; else print " border=\"0\"";
            if (!empty($this->cellspacing)) print " cellspacing=\"". $this->cellspacing  ."\""; else print " cellspacing=\"0\"";
            print " cellpadding=\"0\"";
            if (!empty($this->width)) print " width=\"". $this->width  ."\"";
            print ">\n";
            
            for($i=0;$i<$num_nodes;$i++)
            {
              /////// the starter node : tree title
             if(empty($node_level[$i]) && $this->starter_node == 1) :
                     if ($this->hor_line ==1) print $this->display_hor_line( );  
                     print "\t\t<tr";
                     if (!empty($this->starter_bgcolor)) print " bgcolor=\"". $this->starter_bgcolor  ."\"";
                     print ">\n";
                     print "\t\t\t<td";
                     if (!empty($this->starter_height)) print " height=\"". $this->starter_height  ."\"";
                     print ">\n";
                     print"\t\t\t\t<table border=\"0\" cellspacing=\"0\"";
                     if (!empty($this->starter_cellpadding)) print " cellpadding=\"". $this->starter_cellpadding  ."\""; else print " cellpadding=\"0\"";
                     if (!empty($this->width)) print " width=\"". $this->width  ."\"";
                     print ">\n";
                     print "\t\t\t\t\t<tr>\n";
                     print "\t\t\t\t\t\t<td valign=\"middle\" align=\"left\" class=\"". $this->symbol_class ."\"nowrap>"; 
                     print $this->symbols['starter'];
                     print"</td>\n";
                     print "\t\t\t\t\t\t<td valign=\"middle\"";
                     if(empty($this->starter_class)) print " class=\"". $this->label_class ."\""; else print " class=\"". $this->starter_class ."\"";
                     /////////// if you want a left alignment of node labels when width=100%
                     if ($this->width == "100%") print " width=\"98%\"";
                     print " nowrap>"; 
                     print"$node_label[0]"; 
                     print"</td>\n";
                     print "\t\t\t\t\t</tr>\n";
                     print "\t\t\t\t</table>\n"; 
                     print "\t\t\t</td>\n";
                     print "\t\t</tr>\n";
               /////// always display the level 1
               elseif ($node_level[$i]==1):
                     $this->display_node($node_id,$node_label[$i],$node_type[$i],$node_link[$i],$node_target[$i],$i,$node_level[$i],$indent_val[$i],$node_params[$i]); 
                     //////// check if the node is a parent
                     if(($node_parent[$i] =="p") && ($this->node_status[$i] =="o")): 
                          ///////// the level to display
                          //////// if the node is a parent : displays branches
                         $this->display_submenu($i,$node_id,$indent_val[$i],$node_label,$node_type,$node_link,$node_target,$node_level,$node_parent,$node_child,$node_params);
                     endif;
               endif;
             }
            if ($this->hor_line ==1) print $this->display_hor_line( );  
            print "\t\t</table>\n";
        }
       
	/**
       ** Outputs childs  branches
       ** @param  i                     integer The parent's indice in the node_info array
       ** @param indent_val_i    string  The node's indent value :  default images   |   your own
       ** @param node_label       array  The node's label array
       ** @param node_type       array  The node's type array
       ** @param node_link         array  The node's link array
       ** @param node_target     array  The node's target array
       ** @param node_level       array  The node's level array
       ** @param node_parent    array  The node's parent array
       ** @param node_child       array  The node's child array
       ** @param node_params   array  The node's params array
       ** @returns                      string   The whole open branches for the parent opened node
       ** @scope private 
       **/
        function display_submenu($i,$node_id,$indent_val_i,$node_label,$node_type,$node_link,$node_target,$node_level,$node_parent,$node_child,$node_params="")
        {
              $num_nodes=count($node_label); 
              ///////// read all the nodes
              for($a=0;$a<$num_nodes;$a++)
              { 
                   //////// find the child of the parent at indice  $i
                   if($node_child[$a] == $node_id[$i]): 
                       //////// edit the node's indentation 
                       if($node_type[$i]== "bl") :
                           $indent_val[$a] = $indent_val_i ;
                           $indent_val[$a] .= $this->symbols['space'];
                       else :
                          $indent_val[$a] = $indent_val_i ;
                          $indent_val[$a] .=$this->symbols['lnode'];
                      endif;
                      //////// display the child 
                      $this->display_node($node_id,$node_label[$a],$node_type[$a],$node_link[$a],$node_target[$a],$a,$node_level[$a],$indent_val[$a],$node_params[$a]); 
                      //////// check if the node is a parent
                      if(($node_parent[$a]=="p") && ($this->node_status[$a]=="o")): 
                          //////// if the node is a parent : displays branches
                          for($b=1;$b<=$num_nodes;$b++)
                          { 
                              //////// find the child of the parent at indice  $a
                              if($node_child[$b]=="$node_id[$a]"): 
                                    //////// edit the node's indentation 
                                    if($node_type[$a]== "bl") :
                                        $indent_val[$b]  = $indent_val[$a] ;
                                        $indent_val[$b] .= $this->symbols['space'];
                                    else :
                                        $indent_val[$b] = $indent_val[$a] ;
                                        $indent_val[$b] .= $this->symbols['lnode'];
                                    endif;
                                    $this->display_node($node_id,$node_label[$b],$node_type[$b],$node_link[$b],$node_target[$b],$b,$node_level[$b],$indent_val[$b],$node_params[$b]); 
                                    //////// check if the node is a parent
                                    if(($node_parent[$b]=="p") && ($this->node_status[$b]=="o")):
                                         //////// if the node is a parent : displays branches
                                        $this->display_submenu($b,$node_id,$indent_val[$b],$node_label,$node_type,$node_link,$node_target,$node_level,$node_parent,$node_child,$node_params);
                                    endif;
                              endif; 
                           } 
                        endif; 
                   endif;
               }
        } 


        /**
        ** Create the ns array value in the change node's url
        ** @param node_status     array    The node's status array
        ** @returns  ns_value       string    The ns values to write in the url
        ** @scope private 
        **/
        function node_status_values($node_id)
        { 
            reset($this->node_status);
            $ns_value = "";
            $num_nodes=count($this->node_status); 
            for($i=0;$i<$num_nodes;$i++)
            { 
                if($this->node_status[$i]=="o") $ns_value .= "&ns[$node_id[$i]]=$this->node_status[$i]"; 
            }
            return $ns_value;
        } 

	/**
       ** Changes the node_status value for the children of a node closed by user
       ** @param chg_node         integer   The indice in the node_info array of the node's closed by user
       ** @param node_status     array     The node's status array
       ** @param node_child       array     The node's child array
       ** @returns                      array     The node's status array
       ** @scope private 
       **/
        function close_all_children($chg_node,$node_child,$node_id)
        {
              reset($this->node_status);
             $num_nodes=count($this->node_status); 
             for($i=0;$i<$num_nodes;$i++)
             { 
                 if($node_child[$i] == $node_id[$chg_node] && $this->node_status[$i] == "o") :
                       $this->close_all_children($i,$node_child,$node_id);
                       $this->node_status[$i] = "c";
                  endif;
              }
              return $this->node_status;
        }

	/**
       ** Outputs node label with or without link
       ** @param node_link         array    The node's link array
       ** @param node_target     array    The node's target array
       ** @param node_label        string   The node's label value
       ** @returns                       string   The node's label string
       ** @scope private
       **/
        function return_node_label($node_link,$node_target,$node_label)
        {
            if($node_link==""): 
               $node_label = "<span class=\"" . $this->label_class ."\">".  $node_label  ."&nbsp;&nbsp;&nbsp;&nbsp;</span>"; 
            else: 
                if(!$node_target): 
                    $node_label = "<a href=\"$node_link\" class=\"" . $this->label_class ."\">". $node_label  ."</a>&nbsp;&nbsp;&nbsp;&nbsp;"; 
                 else: 
                    $node_label = "<a href=\"$node_link\"target=\"$node_target\" class=\"" . $this->label_class ."\">". $node_label ."</a>&nbsp;&nbsp;&nbsp;&nbsp;"; 
                endif; 
             endif; 
             return $node_label;
        }
        
       /**
       ** Outputs node html
       ** @param node_label_i          string   The node's label value
       ** @param node_type_i           string    The node's type value   :    "b"   |   "bl   |   "j"   |   "t"
       ** @param node_link_i            string    The node's link value
       ** @param node_target_i        sting      The node's target value
       ** @param  i                           integer   The node's indice in the node_info array
       ** @param node_st_i               string    The node's status value :    "c"  |  "o"
       ** @param node_level_i           integer  The node's level value
       ** @param indent_val_i           string    The node's indent value
        ** @param node_params_i      array     The node's params value
       ** @returns                             void       Print the node's html string
       ** @scope private 
       **/
        function display_node($node_id,$node_label_i,$node_type_i,$node_link_i,$node_target_i,$i,$node_level_i,$indent_val_i,$node_params_i="")
        {
            global $PHP_SELF;
            //echo "<script>alert('". $node_type_i  ."');</script>\n";
            switch ($node_type_i)
            {
                ////// Is the node a T branching node? 
                case "b":  
                    $icons = "<a href=\"". $PHP_SELF ."?"; 
                    $icons .= "chg_node=". $node_id[$i]; 
                    $icons .=  $node_params_i;
                    $icons .= $this->node_status_values($node_id); 
                    $icons .= "\" class=\"". $this->symbol_class;
                    $icons .= "\">";
                    // Is the node open or closed? 
                    if($this->node_status[$i] =="o"): 
                        $icons .= $this->symbols['minus_T'];
                        $icons .= $this->symbols['open']; 
                    elseif($this->node_status[$i] =="c"): 
                        $icons .= $this->symbols['plus_T'];
                        $icons .= $this->symbols['closed']; 
                    endif; 
                    $icons .= "</a>"; 
                    break;
                ////// Is the node a L branching node? 
               case "bl": 
                    $icons = "<a href=\"". $PHP_SELF ."?"; 
                    $icons .= "chg_node=". $node_id[$i]; 
                    $icons .=  $node_params_i;
                    $icons .= $this->node_status_values($node_id); 
                    $icons .= "\" class=\"". $this->symbol_class;
                    $icons .= "\">";
                   ////// Is the node open or closed? 
                    if($this->node_status[$i] =="o"): 
                        $icons .= $this->symbols['minus_L'];
                        $icons .= $this->symbols['open']; 
                    elseif($this->node_status[$i] =="c"): 
                        $icons .= $this->symbols['plus_L'];
                        $icons .= $this->symbols['closed']; 
                    endif; 
                    $icons .= "</a>"; 
                    break;
                ////// Is the node a junction node? (Node in the middle of the tree that does not branch any further. 
                case "j": 
                    $icons = $this->symbols['none_T'];
                    $icons .= $this->symbols['closed']; 
                     ////// Is the node a terminating node? (Terminating nodes can not have branches.) 
                    break;
                ////// Is the node a terminal node? (Node in the middle of the tree that does not branch any further. 
                case "t": 
                      $icons  = $this->symbols['none_L'];
                      $icons .= $this->symbols['closed']; 
                      break;
            }
            
            
            if ($this->hor_line ==1) print $this->display_hor_line( );  
            print "\t\t<tr";
            if (!empty($this->bgcolor)) print " bgcolor=\"". $this->bgcolor  ."\"";
            print ">\n";
            print "\t\t\t<td>\n";
            print"\t\t\t\t<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"";
            if (!empty($this->cellpadding)) print " cellpadding=\"". $this->cellpadding  ."\""; else print " cellpadding=\"0\"";
            if (!empty($this->width)) print " width=\"". $this->width  ."\"";
            print ">\n";
            print "\t\t\t\t\t<tr>\n";
            if ($node_level_i>1) :
                print "\t\t\t\t\t\t<td valign=\"middle\" class=\"".  $this->symbol_class  ."\" nowrap>";
                print $indent_val_i;
                print "</td>\n"; 
            endif;
            print "\t\t\t\t\t\t<td valign=\"middle\" class=\"".  $this->symbol_class  ."\" nowrap>"; 
            print $icons."</td>\n";
            print "\t\t\t\t\t\t<td valign=\"middle\" class=\"".  $this->label_class  ."\"";
            /////////// if you want a left alignment of node labels when width=100%
            if ($this->width == "100%") print " width=\"98%\"";
            print " nowrap>";           
            print $this->return_node_label($node_link_i,$node_target_i,$node_label_i);
            print "</td>\n";
            print "\t\t\t\t\t</tr>\n";
            print "\t\t\t\t</table>\n"; 
            print "\t\t\t</td>\n";
            print "\t\t</tr>\n";
      }
      
      
  	/**
	 ** Close all the nodes in the node_status array
        ** @param node_status     array    The node's status array
	 ** @returns void
	 ** @scope private
	 **/
      function close_all_nodes()
      {
          $num_nodes=count($this->node_status);
           for($i=1;$i<=$num_nodes;$i++)
            { 
                $this->node_status[$i]="c"; 
            }
          return $this->node_status;
       }
  
  	/**
	 ** Open all the nodes in the node_status array
        ** @param node_status     array    The node's status array
	 ** @returns void
	 ** @scope private
	 **/
      function open_all_nodes()
      {
          $num_nodes=count($this->node_status);
           for($i=1;$i<=$num_nodes;$i++)
            { 
                $this->node_status[$i]="o"; 
            }
          return $this->node_status;
       }

  	/**
	 ** Create the html row if hor_line is on
        ** @param    hor_line_color     string       The row bgcolor
        ** @param    hor_line_height    string       The cell and image height
	 ** @returns                              string       The hor line html string
	 ** @scope private
	 **/
       function display_hor_line()
       {
                $hor_line = "\t\t<tr";
                $hor_line .= " bgcolor=\"". $this->hor_line_color  ."\"";
                $hor_line .= " height=\"". $this->hor_line_height ."\"";
                $hor_line .= ">\n";
                $hor_line .= "\t\t\t<td height=\"". $this->hor_line_height ."\">";
                $hor_line .= "<img src=\"" .$this->symbols['hor_line_src'] ."\" width=\"".  $this->hor_line_height  ."\" height=\"". $this->hor_line_height ."\">";
                $hor_line .= "</td>\n";
                $hor_line .= "\t\t</tr>\n";
                return $hor_line;
      }
  
  ///// END OF CLASS
  }
 
?>