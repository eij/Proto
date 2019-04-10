<?php

	namespace Service\Utilities;

	class Random {

		public static function alphanumeric($length) {
			return bin2hex(random_bytes($length));
		}

		public static function number($from, $to) {
			return random_int($from, $to);
		}

	}

?>
