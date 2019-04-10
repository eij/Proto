<?php

	namespace Console\Services;

	use Core\Service\Service;

	abstract class ConsoleService {

		protected $service;

		public function __construct(Service $service) { $this->service = $service; }

	}

?>
