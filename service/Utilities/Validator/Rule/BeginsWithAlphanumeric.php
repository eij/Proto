<?php

	namespace Service\Validator;

	class BeginsWithAlphanumeric {

		private $regex = '/[^A-Za-z0-9]/';

		public function validate($value) {
			$value = substr($value, 0, 1);

			if (preg_match($this->regex, $value) === 1) return false;

			return true;
		}

	}

?>
