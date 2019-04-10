<?php

	namespace Core\Routing;

	class Placeholder {

		private $identifiers = [
			':int',
			':str',
			':alphanum',
		];

		private $replacements = [
			'(\d+)',
			'([a-zA-Z]+)',
			'([a-zA-Z0-9]+)',
		];

		public function compile($pattern) {
			$pattern = '#^' . str_replace($this->identifiers, $this->replacements, $pattern) . '$#i';

			return $pattern;
		}

	}

