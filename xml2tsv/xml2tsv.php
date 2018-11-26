<?php
// ini_set('memory_limit', '1024M'); // or you could use 1G
// use above for large xml files

/*
// Program       : Convert XML to TSV (Tab Separated Values) file
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2018-11-26
// Usage Notes   : Appended in this file
// Reference     : http://www.jonasjohn.de/snippets/php/read-and-write-tab-files.htm
*/

class XMLParser  {

    // raw xml
    private $rawXML;

    // xml parser
    private $parser = null;

    // arrays returned by the xml parser
    private $valueArray = array();
    private $keyArray = array();

    // array for dealing with duplicate keys
    private $duplicateKeys = array();

    // return data
    private $output = array();
    private $status;

    function __construct($xml) {
        $this->rawXML = $xml;
        $this->parser = xml_parser_create();
        return $this->parse();
    }

    private function parse() {

        $parser = $this->parser;

        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); // Dont mess with my cAsE sEtTings
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);   // Dont bother with empty info
        if(!xml_parse_into_struct($parser, $this->rawXML, $this->valueArray, $this->keyArray)){
            $this->status = 'error: '.xml_error_string(xml_get_error_code($parser)).' at line '.xml_get_current_line_number($parser);
            return false;
        }
        xml_parser_free($parser);

        $this->findDuplicateKeys();

        // tmp array used for stacking
        $stack = array();        
        $increment = 0;

        foreach($this->valueArray as $val) {
            if($val['type'] == "open") {
                //if array key is duplicate then send in increment
                if(array_key_exists($val['tag'], $this->duplicateKeys)){
                    array_push($stack, $this->duplicateKeys[$val['tag']]);
                    $this->duplicateKeys[$val['tag']]++;
                }
                else{
                    // else send in tag
                    array_push($stack, $val['tag']);
                }
            } elseif($val['type'] == "close") {
                array_pop($stack);
                // reset the increment if they tag does not exists in the stack
                if(array_key_exists($val['tag'], $stack)){
                    $this->duplicateKeys[$val['tag']] = 0;
                }
            } elseif($val['type'] == "complete") {
                //if array key is duplicate then send in increment
                if(array_key_exists($val['tag'], $this->duplicateKeys)){
                    array_push($stack, $this->duplicateKeys[$val['tag']]);
                    $this->duplicateKeys[$val['tag']]++;
                }
                else{               
                    // else send in tag
                    array_push($stack,  $val['tag']);
                }
                $this->setArrayValue($this->output, $stack, $val['value']);
                array_pop($stack);
            }
            $increment++;
        }

        $this->status = 'success: xml was parsed';
        return true;

    }

    private function findDuplicateKeys() {

        for($i=0;$i < count($this->valueArray); $i++) {
            // duplicate keys are when two complete tags are side by side
            if($this->valueArray[$i]['type'] == "complete"){
                if( $i+1 < count($this->valueArray) ){
                    if($this->valueArray[$i+1]['tag'] == $this->valueArray[$i]['tag'] && $this->valueArray[$i+1]['type'] == "complete"){
                        $this->duplicateKeys[$this->valueArray[$i]['tag']] = 0;
                    }
                }
            }
            // also when a close tag is before an open tag and the tags are the same
            if($this->valueArray[$i]['type'] == "close"){
                if( $i+1 < count($this->valueArray) ){
                    if(    $this->valueArray[$i+1]['type'] == "open" && $this->valueArray[$i+1]['tag'] == $this->valueArray[$i]['tag'])
                        $this->duplicateKeys[$this->valueArray[$i]['tag']] = 0;
                }
            }
           
        }
       
    }

    private function setArrayValue(&$array, $stack, $value) {
        if ($stack) {
            $key = array_shift($stack);
            $this->setArrayValue($array[$key], $stack, $value);
            return $array;
        } else {
            $array = $value;
        }
    }

    public function getOutput() {
        return $this->output;
    }
   
    public function getStatus() {
        return $this->status;   
    }
}

    //
    // save an array as tab seperated text file
    //
     
    function write_tabbed_file($filepath, $array, $save_keys=false) {
        $content = '';
     
        reset($array);
        foreach ($array as $key => $val) {
     
            // replace tabs in keys and values to [space]
            $key = str_replace("\t", " ", $key);
            $val = str_replace("\t", " ", $val);
     
            if ($save_keys){ $content .=  $key."\t"; }
     
            // create line:
            $content .= (is_array($val)) ? implode("\t", $val) : $val;
            $content .= "\n";
        }
     
        if (file_exists($filepath) && !is_writeable($filepath)){ 
            return false;
        }
        if ($fp = fopen($filepath, 'w+')){
            fwrite($fp, $content);
            fclose($fp);
        }
        else { return false; }
        return true;
    }

    //
    // load a tab seperated text file as array
    //
    function load_tabbed_file($filepath, $load_keys=false) {
        $array = array();
     
        if (!file_exists($filepath)){ return $array; }
        $content = file($filepath);
     
        for ($x=0; $x < count($content); $x++){
            if (trim($content[$x]) != ''){
                $line = explode("\t", trim($content[$x]));
                if ($load_keys) $array[$x] = $line;
                else $array[] = $line;
            }
        }
        return $array;
    }


//	Example Usage

    $xml_file = 'Tomato.xml';
    $xml = file_get_contents($xml_file);

    $p = new XMLParser($xml);
    $xmlarray = $p->getOutput();
//    echo print_r($xmlarray, true);

    $save_keys = true;
    $i=0;
    foreach ($xmlarray as $parts) {
        $i++;
        $filepath = "out$i.tsv";    
        write_tabbed_file($filepath, $parts, $save_keys);
        echo $filepath . " written<br>\n";
    }
    echo 'Done';
?>
    