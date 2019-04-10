<?php

	namespace Core\Console;

	class Input {

		public function getArgs() {
			return array_shift($_SERVER['argv']);
		}

	}

