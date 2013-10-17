<?php
namespace RomanNumeral;
/**
 * openTag/RomanNumeral
 *
 * @category   openTag, RomanNumeral
 * @package    RomanNumeral 
 * @copyright  Copyright (c) 2013 openTag
 * @license    ?
 */
 
interface iRomanNumeral {
  public function generate($integer); // convert from int -> roman
  public function parse($string); // convert from roman -> int
}

/**
 * Description of RomanNumeral
 *
 * @author mrhelly
 */
class RomanNumeral /*implements iRomanNumeral*/ {

  private $_magnitude;
//Statics.
  protected $maxInt = 3999;
  protected $NumeralMapping = array(
	  'I' => 1,
	  'V' => 5,
	  'X' => 10,
	  'L' => 50,
	  'C' => 100,
	  'D' => 500,
	  'M' => 1000
	);

  protected $command;
  protected $input;
  protected $decimal;
  protected $romannotation;

  public function __construct($input) {
    $this->command = "info";
	$this->input = trim($input);
	
    if(is_numeric($this->input)) {
		//if int - generate
		//in range $maxInt
	    if(round($this->input)<=$this->maxInt) {
	    	$this->command = "generate";
	    } else {
	    	$this->command = "error";
	    }
	    // echo "Int";
    } else if($this->isValidString($input)) {
        //else if romannumeral - parse
        //in range
        //valid string
        $this->command = "parse";
        // echo "RomanNumeral";
    }
    //execute.
  }

  // convert from int -> roman
  public function execute($command = NULL) {
  	
  	if(is_null($command)===true) {
		if(is_null($this->command)===true) {
	  		return "error";
	  	} else {
	  		$command = $this->command;
	  	}
    }
	
    switch($command) {
      case 'generate':
		  return $this->generate((int) $this->input);
        break;
      case 'parse':
		  return $this->parse(strtoupper($this->input));
        break;
      default:
		  return "There was an error, maybe a bad entry above?";
// Usage:
// $>node romannumerals.js {command} {int}
// Commands:
  // generate: Generate from Integer
   // $>node romannumerals.js generate {int}
  // parse: Generate from Roman Numeral
   // $>node romannumerals.js parse {roman numeral}";
        break;
    }
  }

  // check roman string
  private function isValidString($string) {
	  if(is_string($string)  === true) {
	  	$StringArray = explode("", $string);
		if(count($StringArray)>12) {
			return false;
		}
		$Numerals = array_keys($this->NumeralMapping);
		foreach($StringArray as $TestString) {
	  		if(in_array($TestString, $Numerals)===false) {
	  			return false;
	  		}
	  	}
		return true;
	  }
	  return false;
  }
  
  // convert from int -> roman
  public function generate($integer) {

	  if(!is_nan($integer)) {
	  		
		$RomanNumerals = array_keys($this->NumeralMapping);
		$NumeralValues = array_values($this->NumeralMapping);
	  	$deltavalue = $integer;
		$Magnitude = array();
		$Index = count($RomanNumerals) - 1;
		
	  	while($deltavalue > 0) {
			$count = floor($deltavalue / $NumeralValues[$Index]);
		    // var count = parseInt(dv / parseInt(RomanNumbers[$Index],10),10);
		    //Special Cases, if we are about to place more than 3 of a specified value, 
		    // ( check if ) it is better to place the next (lower) numeral before the current numeral
		    if($count > 3) {
		      array_push($Magnitude, $RomanNumerals[$Index]);
		      $deltavalue += $NumeralValues[$Index];
		      array_push($Magnitude, $RomanNumerals[$Index+1]);
		      $deltavalue -= $NumeralValues[$Index+1];
		      $count -= 3;
		    } else {
		      // Keep adding Numeral until count is 0.
		      while($count > 0) {
		        array_push($Magnitude, $RomanNumerals[$Index]);
		        $deltavalue -= $NumeralValues[$Index];
		        $count--;
		      }
		    }
	    	$Index--;
	    }
		return implode('', $Magnitude);
	  } else {
	    return "Recieved value is NOT a valid integer.";
	  }
  }

  // convert from roman -> int
  public function parse($string) {
	$Numerals = str_split($string);
	$LastIndex = -1;
	$CurrentIndex = -1;
	$Magnitude = 0;
	$RomanNumerals = array_keys($this->NumeralMapping);
	$NumeralValues = array_values($this->NumeralMapping);
	$NumeralMapping = array_reverse($this->NumeralMapping);

	$Numerals = array_reverse($Numerals);
	foreach($Numerals as $Value) {
		if(isset($NumeralMapping[$Value])===true) {
			$Idx = -1;
			foreach($RomanNumerals as $Index => $Numeral) {
				if($Value == $Numeral) {
					$Idx = $Index;
				}
			}
			$CurrentIndex = $Idx;
		} else {
			return "Recieved value is NOT a valid String.";
		}
	    if($CurrentIndex < $LastIndex) {
	      $Magnitude = $Magnitude - $NumeralValues[$CurrentIndex];
	    } else {
	      $Magnitude = $Magnitude + $NumeralValues[$CurrentIndex];
	    }
    	$LastIndex = $CurrentIndex;
	}
	return $Magnitude;
  }

}