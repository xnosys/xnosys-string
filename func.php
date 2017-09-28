<?php
	
	return function () {
		
		$nowhitespace = function ($string) {
			return preg_replace('~\x{00a0}~', '', str_replace(array("\n","\f","\r","\t","\s","\0","\x0B"," "), '', $string));
		};
		
		$random = function ($length, $characters=false) use ($nowhitespace) {
			$length = abs(intval($length));
			$characters = ((is_string($characters) && strlen($characters)) ? $nowhitespace($characters) : false);
			return call_user_func(function ($l, $c) {
				$s = '';
				for ($i = 0, $t = strlen($c); $i < $l; $i++) {
					$s .= $c[rand(0, $t-1)];
				}
				return $s;
			}, (($length < 2147483647) ? $length : 2147483647), (!$characters ? '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' : $characters));
		};
		
		return array(
			'nowhitespace' => $nowhitespace,
			'random' => $random
		);
		
	};
	
?>