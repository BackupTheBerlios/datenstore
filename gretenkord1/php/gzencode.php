<? 
ob_start();
ob_implicit_flush(0); 

function can_gzip(){ 
    global $HTTP_ACCEPT_ENCODING;    
    if (headers_sent() || connection_aborted()){ 
        return 0; 
    } 
    if (strpos($HTTP_ACCEPT_ENCODING, 'x-gzip') !== false) return "x-gzip"; 
    if (strpos($HTTP_ACCEPT_ENCODING,'gzip') !== false) return "gzip"; 
    return 0; 
} 

/***** Kommprresionseinstellung!              ****************************/
/***** $level = compression level 0-9, 0=none, 9=max               *******/
/***** $debug = debug ausgabe zum testen  0=off, 1=on              *******/
/***** $trim = überflüssiger HTML-Code wird entfernt  0=off, 1=on  *******/

function gz_output($level=9,$debug=1,$trim=1){ 
    $ENCODE = can_gzip(); 
    if ($ENCODE){ 
        print "\n<!-- Use compress $ENCODE -->\n"; 
        $Contents = ob_get_contents(); 
        ob_end_clean();

       if($trim){
         $Contents = str_replace("\n", ' ', $Contents); 
         $Contents = str_replace("\r", ' ', $Contents); 
         $Contents = preg_replace('=([[:space:]]{2,})=im', '', $Contents);
         $Contents = trim($Contents);
       }

         

        if ($debug){ // Wenn debug nicht 0, dann ausgabe!
            $s = "<font size\"1\" face=\"arial,verdana\" color=\"#868686\"><p>gzip compressed | zipped: ".sprintf ("%01.2f",((strlen(gzcompress($Contents,$level)))/1024))." kBytes | unzipped: ". sprintf ("%01.2f", ( (strlen($Contents) )/1024 ))." kBytes</font>"; 
            //$s .= "<br>Compressed length: ";
            $Contents .= $s; 
        }

        header("Content-Encoding: $ENCODE");  	
        print "\x1f\x8b\x08\x00\x00\x00\x00\x00"; 
        $Size = strlen($Contents); 
        $Crc = crc32($Contents); 
        $Contents = gzcompress($Contents,$level);
        $Contents = substr($Contents, 0, strlen($Contents) - 4); 
        
        print $Contents;
        print pack('V',$Crc); 
        print pack('V',$Size); 
        exit; 
    }else{ 
        ob_end_flush(); 
        exit; 
    } 
} 
?>