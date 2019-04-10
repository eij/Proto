<?php

	namespace Application\Services;

	use Core\Service\Service;

	class ResponseService extends ApplicationService implements ServiceInterface {

		public function register() {
			$this->service->add('core.response', 'Core\Routing\Response');
		}

	}

