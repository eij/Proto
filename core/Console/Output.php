<?php

	namespace Core\Console;

	class Output implements OutputInterface {

		public function write($string) {
			fwrite(STDOUT, $string);
		}

	}

