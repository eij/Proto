<?php

	namespace Service\Validator;

	class Email {

		public function validate($value) {
			if (filter_var($value, FILTER_VALIDATE_EMAIL) == false) return false;

			return true;
		}

	}

?>
