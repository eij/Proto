<?php

	use Core\Console\Input;

	use Core\Console\Output;

	class ConsoleApplication {

		public $service;

		public function __construct() {
			$this->service = new Service;

			$this->bootCore();
		}

		public function bootCore() {
			$services = new FilesystemIterator(CONSOLE_SERVICES, FilesystemIterator::SKIP_DOTS);

			foreach ($services as $service) {
				$name = 'Console\\Services\\' . mb_substr($service->getFilename(), 0, -4);

				(new $name($this->service))->register();
			}
		}

		public function deploy() {
		}

	}

