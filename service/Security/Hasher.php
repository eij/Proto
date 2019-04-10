<?php

	namespace Security;

	class Hasher {

		public function hash($value) {
			return password_hash($value, PASSWORD_DEFAULT);
		}

		public function verify($value, $hash) {
			return password_verify($value, $hash);
		}

	}

?>
