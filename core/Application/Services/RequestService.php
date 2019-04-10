<?php

	namespace Application\Services;

	use Core\Service\Service;

	class RequestService extends ApplicationService implements ServiceInterface {

		public function register() {
			$this->service->add('core.request', 'Core\Routing\Request');
		}

	}

