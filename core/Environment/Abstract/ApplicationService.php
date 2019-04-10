<?php

	namespace Application\Services;

	use Core\Service\Service;

	abstract class ApplicationService {

		protected $service;

		public function __construct(Service $service) { $this->service = $service; }

	}

?>
