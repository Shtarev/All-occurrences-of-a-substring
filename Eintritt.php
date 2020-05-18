<?php
/* * Andrey Shtarev | www.shtarev.com | 18.05.2020 | PHP
* Class find all occurrences of a substring.
* $eintritt = new Eintritt($str, $elem); // Parameters in arguments: $str - string,  $elem - substring
* $eintritt->wieViel; // number of occurrences
* $eintritt->ergebnisNach; // Array with rows after the string
* $eintritt->ergebnisMit; // Array with rows starting with a sub - string
* $eintritt->ansehen($von); // listing of result $von='mit' - with substring, $von='nach' - later substring
*/

/** Example *************************************************************************************** **/
$str = "Um eine lange Stange schlängelt sich eine lange Schlange."; // string
$elem = "la"; // substring
$eintritt = new Eintritt($str, $elem);
$eintritt->ansehen('mit');
/** *********************************************************************************************** **/

/* Class */
class Eintritt 
{
    public $wieViel;
    public $elemLang;
    public $elem;
    public $ergebnisNach = array();
    public $ergebnisMit = array();
	
    public function Eintritt($str, $elem)  
    {  
        if($this->wieViel = mb_substr_count($str, $elem))
        {  
            $this->elem = $elem;
            $this->ergebnisNach[0]['elemPos'] = 0;  
            $this->ergebnisNach[0]['str'] = $str;
            $this->ergebnisMit[0]['elemPos'] = 0;  
            $this->ergebnisMit[0]['str'] = $str;
            $this->elemLang = mb_strlen($elem);

            for($i = 1, $j = 0; $i <= $this->wieViel; $i++, $j = $j+$this->elemLang)  
            {  
                $elemPos = mb_strpos($this->ergebnisNach[$i-1]['str'], $elem);
                $this->ergebnisNach[$i]['elemPos'] = $this->ergebnisNach[$i-1]['elemPos']+$elemPos+$j;
                $this->ergebnisMit[$i]['elemPos'] = $this->ergebnisNach[$i-1]['elemPos']+$elemPos+$j; 
                $j = 0;  
                $strNachElem = mb_substr($this->ergebnisNach[$i-1]['str'], $elemPos+$this->elemLang); 
                $this->ergebnisNach[$i]['str'] = $strNachElem;
                $this->ergebnisMit[$i]['str'] = $elem.$strNachElem;
            }  
        }  
        else  
        {  
            $this->wieViel = "No substring occurrence in string";  
            $this->ergebnisNach[0]['elemPos'] = "No substring occurrence in string";  
            $this->ergebnisNach[0]['str'] = "No substring occurrence in string";  
        }  
    }  
    
    public function ansehen($von) {
        if($von == 'mit'){ 
            $von = $this->ergebnisMit; 
            $plus = 1;
            $nachMit = "since the subline <b>$this->elem</b>";
        }
        if($von == 'nach'){ 
            $von = $this->ergebnisNach; 
            $plus = 1+$this->elemLang;
            $nachMit = "after a subline <b>$this->elem</b>";
        }
        
        $i = 0;
        foreach($von as $key => $value)
        {
           if($i != 0 ){
               if($value['str'] == ''){
                    echo "String $nachMit. Position  №: ";
                    echo $value['elemPos']+$plus."<br>";
                    echo "ended";
                }
                else{
                    echo $key."-String $nachMit. Position №: ";
                    echo $value['elemPos']+$plus."<br>";
                    echo "<font color=\"#FF6600\">".$value['str']."</font><hr>";
                }
           }
           else {
               echo "<b>Listing:</b><hr>Original string:<br>";
               echo "<font color=\"#0066FF\">".$value['str']."</font><hr>";
           }
           $i++;
        }
        print "Number of occurrences of a subline <b>".$this->elem."</b> at string equally: ".$this->wieViel."<hr>";
    }
}
?>
