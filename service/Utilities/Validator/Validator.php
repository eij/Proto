<?php

	namespace Service\Validator;

	class Validator {

		private $rules = [];

		private $isValid = true;

		private $value;

		public function value($value) {
			$this->rules = [];

			$this->value = $value;

			return $this;
		}

		public function length($length) {
			return $this->addRule(new Length($length));
		}

		public function lengthBetween($lengthMin, $lengthMax) {
			return $this->addRule(new LengthBetween($lengthMin, $lengthMax));
		}

		public function alphanumeric() {
			return $this->addRule(new Alphanumeric);
		}

		public function beginsWithAlphanumeric() {
			return $this->addRule(new BeginsWithAlphanumeric);
		}

		public function endsWithAlphanumeric() {
			return $this->addRule(new EndsWithAlphanumeric);
		}

		public function noSymbolRepetition() {
			return $this->addRule(new NoSymbolRepetition);
		}

		public function email() {
			return $this->addRule(new Email);
		}

		public function addRule($rule) {
			$this->rules[] = $rule;

			return $this;
		}

		public function isValid() {
			return $this->isValid;
		}

		public function validate() {
			foreach ($this->rules as $rule) {
				if ($rule->validate($this->value) == false) {
					$this->isValid = false;

					break;
				}
			}

			return $this->isValid();
		}

	}

?>
