<?php
public class UAStuff {
	private static $ua = $_SERVER['HTTP_USER_AGENT'];
	private static $array = array();
	public static function uaToArray($ua) {
		$array = array();

		// start with the first part
		$in = 0;
		$out = strpos($ua, " ");
		$word = substr($ua, $in, $out);
		if (!strpos($word, "(")) {
			array_push($array, $word);
		}

		// then loop the rest
		$i = 0;
		while (!strpos($ua, " ") == false ) {
			$ua = substr($ua, strlen($array[$i])+1);
			if (strpos($ua, " ") == false) { 
				$out = strlen($ua);
				$word = substr($ua, 0, $out);
				array_push($array, $word);
				break;
			}
			if ($ua[0] == "(") {
				$out = strpos($ua, ")")+1;
				$word = substr($ua, 0, $out);
				array_push($array, $word);
			} else {
				$out = strpos($ua, " ");
				$word = substr($ua, 0, $out);
				array_push($array, $word);
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
