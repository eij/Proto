<?php

	namespace Core\Routing;

	use FilesystemIterator;
	use RecursiveDirectoryIterator;
	use RecursiveIteratorIterator;

	class Router {

		private $methods = [ 'GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'PATCH', 'OPTIONS', 'TRACE', 'CONNECT' ];

		private $routes = [];

		private $request;

		private $placeholder;

		private $fromAppDirectory = true;

		public function __construct(Request $request, Placeholder $placeholder) {
			$this->request = $request;

			$this->placeholder = $placeholder;

			if ($this->fromAppDirectory) $this->loadRoutes();
		}

		public function addRoute($method, $pattern, Callable $action, $before = null, $after = null, $description = null) : Router {
			if (!in_array($method, $this->methods)) throw new InvalidMethodException("Router: using an invalid method. %s ", $method);

			$this->routes[] = new Route($method, $pattern, $action, $before, $after, $description);

			return $this;
		}

		private function loadRoutes() : bool {
			$requests = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(APPLICATION_DATA . 'Route/', FilesystemIterator::SKIP_DOTS));

			foreach ($requests as $request) {
				$file = $request->getPathname();

				$extension = pathinfo($file, PATHINFO_EXTENSION);

				if ($extension == 'php' && is_readable($file)) require $file;
			}

			return true;
		}

		public function match() {
			foreach ($this->routes as $route) {
				if ($this->request->getMethod() != $route->getMethod()) continue;

				if (!preg_match($this->placeholder->compile($route->getPattern()), $this->request->getPath(), $args)) {
					continue;
				}
				else {
					if (isset($args) && count($args) > 0) {
						#	TODO: match only the args

						array_shift($args);

						$route->args = $args;
					}

					return $route;
				}
			}

			return false;
		}

	}

