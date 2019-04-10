<?php

	namespace Core\Routing;

	use Closure;
	use ReflectionFunction;
	use ReflectionMethod;

	use Core\Service\Service;

	class Dispatcher {

		private $request;

		private $response;

		private $router;

		private $service;

		private $route;

		public function __construct(Request $request, Response $response, Router $router, Service $service) {
			$this->request = $request;

			$this->response = $response;

			$this->router = $router;

			$this->service = $service;
		}

		public function dispatch() : Response {
			$this->route = $this->router->match();

			#	Our route

			if ($this->route instanceof RouteInterface) {
				$this->dispatchCurrent();
			}

			#	No route found

			else {
				$this->response->status(404);

				$this->route = new Route($this->request->getMethod(), null, function(\Core\Rendering\Render $render, Request $request) { return $render->get404($request->getPath()); });

				$this->dispatchCurrent();
			}

			return $this->response;
		}

		private function dispatchCurrent() {
			$return = $this->service->call($this->route->getAction(), $this->route->args);

			$this->response->addBody($return);
		}

		private function dispatchBefore() {
			if (isset($this->route->before)) $this->service->call($this->route->getActionBefore());
		}

		private function dispatchAfter() {
			if (isset($this->route->after)) $this->service->call($this->route->getActionAfter());
		}

	}

