<?php

	use Core\Service\Service;
	use Core\Routing\Dispatcher;

	class Application {

		public $service;

		public $router;

		public function __construct() {
			$this->service = new Service;

			$this->bootCore();

			$this->router = $this->service->get('core.router');
		}

		protected function bootCore() {
			$services = new FilesystemIterator(APPLICATION_SERVICES, FilesystemIterator::SKIP_DOTS);

			foreach ($services as $service) {
				$name = 'Application\\Services\\' . mb_substr($service->getFilename(), 0, -4);

				(new $name($this->service))->register();
			}
		}

		public function get($pattern, $action, $before = null, $after = null, $description = null) {
			$this->router->addRoute('GET', $pattern, $action, $before, $after, $description);

			return $this;
		}

		public function post($pattern, $action, $description = null) {
			$this->router->addRoute('POST', $pattern, $action, $description);

			return $this;
		}

		public function put($pattern, $action, $description = null) {
			$this->router->addRoute('PUT', $pattern, $action, $description);

			return $this;
		}

		public function delete($pattern, $action, $description = null) {
			$this->router->addRoute('DELETE', $pattern, $action, $description);

			return $this;
		}

		public function head($pattern, $action, $description = null) {
			$this->router->addRoute('HEAD', $pattern, $action, $description);

			return $this;
		}

		public function patch($pattern, $action, $description = null) {
			$this->router->addRoute('PATCH', $pattern, $action, $description);

			return $this;
		}

		public function options($pattern, $action, $description = null) {
			$this->router->addRoute('OPTIONS', $pattern, $action, $description);

			return $this;
		}

		public function trace($pattern, $action, $description = null) {
			$this->router->addRoute('TRACE', $pattern, $action, $description);

			return $this;
		}

		public function deploy() {
			$dispatcher = new Dispatcher($this->service->get('core.request'), $this->service->get('core.response'), $this->service->get('core.router'), $this->service);

			$response = $dispatcher->dispatch();

			$response->send();

			return true;
		}

	}

