<?php

	namespace Service\Validator;

	class Alphanumeric {

		private $regex = '/[^a-z_\-.0-9]/i';

		public function validate($value) {
			if (preg_match($this->regex, $value)) return false;

			return true;
		}

	}

?>
