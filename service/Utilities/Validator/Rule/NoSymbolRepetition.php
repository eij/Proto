<?php

	namespace Service\Validator;

	class NoSymbolRepetition {

		private $regex = '/[_\-.]{2,}/';

		public function validate($value) {
			if (preg_match($this->regex, $value)) return false;

			return true;
		}

	}

?>
