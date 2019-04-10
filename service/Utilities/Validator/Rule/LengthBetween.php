<?php

	namespace Service\Validator;

	class LengthBetween {

		private $lengthMin;

		private $lengthMax;

		public function __construct($lengthMin, $lengthMax) {
			$this->lengthMin = $lengthMin;

			$this->lengthMax = $lengthMax;
		}

		public function validate($value) {
			$length = strlen($value);

			if ($length < $this->lengthMin || $length > $this->lengthMax) return false;

			return true;
		}

	}

?>
