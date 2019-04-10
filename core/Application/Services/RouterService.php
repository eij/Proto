<?php

	namespace Application\Services;

	use Core\Service\Service;

	class RouterService extends ApplicationService implements ServiceInterface {

		public function register() {
			$this->service->add('core.router', 'Core\Routing\Router');
		}

	}

