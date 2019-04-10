<?php

	namespace Service\Validator;

	class Length {

		private $length;

		public function __construct($length) { $this->length = $length; }

		public function validate($value) {
			$length = strlen($value);

			if ($length < $this->length || $length > $this->length) return false;

			return true;
		}

	}

?>
