<?php

	namespace Service\Validator;

	class EndsWithAlphanumeric {

		private $regex = '/[^A-Za-z0-9]/';

		public function validate($value) {
			$value = substr($value, -1);

			if (preg_match($this->regex, $value) === 1) return false;

			return true;
		}

	}

?>
