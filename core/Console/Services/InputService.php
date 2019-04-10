<?php

	namespace Console\Services;

	use Core\Service\Service;

	class InputService extends ConsoleService implements ServiceInterface {

		public function register() {
			$this->service->add('core.input', 'Core\Console\Input');
		}

	}

