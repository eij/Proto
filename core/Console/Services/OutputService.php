<?php

	namespace Console\Services;

	use Core\Service\Service;

	class OutputService extends ConsoleService implements ServiceInterface {

		public function register() {
			$this->service->add('core.output', 'Core\Console\Output');
		}

	}

