<?php
// Written for PHP Version 5.3.26, may still be compatible with other versions
class UAStuff {
	private static $ua;
	private static $array = array();

	public function __construct() {
		$this->ua = $_SERVER['HTTP_USER_AGENT'];
	}

	public function getUa() {
		return $ua = $this->ua;
	}
	public function setUa($inputUa) {
		return $this->ua = $inputUa;
	}
	
	// break a User Agent string into logical subsections and store them in an array
	// is possible to develop further
	public function uaToArray($ua) {
		$array = array();

		// start with the first part
		$in = 0;
		$out = strpos($ua, " ");
		$section = substr($ua, $in, $out);
		if (!strpos($section, "(")) {
			array_push($array, $section);
		}

		// then loop the rest
		$i = 0;
		while (!strpos($ua, " ") == false ) {
			$ua = substr($ua, strlen($array[$i])+1);
			if (strpos($ua, " ") == false) { 
				$out = strlen($ua);
				$section = substr($ua, 0, $out);
				array_push($array, $section);
				break;
			}
			if ($ua[0] == "(") {
				$out = strpos($ua, ")")+1;
				$section = substr($ua, 0, $out);
				array_push($array, $section);
			} else {
				$out = strpos($ua, " ");
				$section = substr($ua, 0, $out);
				array_push($array, $section);
			}
			$i++;
		}
		return $array;
	}
	
	// helper methods to simplify display
	public static function ptag($string) {
		$taggedString = "<p>" . $string . "</p>\n";
		echo $taggedString;
	}
	public static function ctag($string) {
		$taggedString = "<p><code>" . $string . "</code></p>\n";
		echo $taggedString;
	}
}
?>
