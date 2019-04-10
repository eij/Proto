<?php

	namespace Core\Service;

	use Closure;
	use ReflectionClass;
	use ReflectionFunction;
	use ReflectionMethod;
	use RuntimeException;

	class Service {

		#	core.router => Core\Routing\Router

		private $aliases = [];

		#	Core\Routing\Router => instance

		private $instances = [];

		#	Core\Routing\Router => Core\Routing\Request

		private $dependencies = [];

		#	namespace.class => Directory/of/Class.php

		private $includes = [];

		public function __construct() {
			$data = include FRAMEWORK_DATA . 'Config/Services.php';

			foreach ($data as $name => $parameters) {
				if (!isset($parameters['name'])) continue; #	TODO: log wrong written service

				$dependencies = (isset($parameters['dependencies'])) ? $parameters['dependencies'] : [];

				$includes = (isset($parameters['includes'])) ? $parameters['includes'] : [];

				$this->add($name, $parameters['name'], $dependencies, $includes);
			}
		}

		public function add(string $alias, $mixed, array $dependencies = [], array $includes = []) : bool {
			#	is it an object?

			if (is_object($mixed)) {
				$class = get_class($mixed);

				$this->aliases[$alias] = $class;

				$this->instances[$class] = $mixed;

				$this->dependencies[$class] = $dependencies;
			}

			#	or a class name?

			else {
				#	do we have a class?

				if (class_exists($mixed)) {
					$this->aliases[$alias] = $mixed;

					$this->dependencies[$mixed] = $dependencies;
				}

				#	no, but we can include it's files on call

				else {
					if (!empty($includes)) {
						$this->aliases[$alias] = $mixed;

						$this->includes[$mixed] = $includes;

						$this->dependencies[$mixed] = $dependencies;
					}

					#	got no files?

					else {
						throw new RuntimeException(sprintf("Service: assuming %s is a class name. Unable to find any file to load it.", $alias));
					}
				}
			}

			return true;
		}

		public function get(string $service) {
			#	if empty, don't

			if (!trim($service) || $service == '\\') return;

			#	if it's an alias, resolve it

			if ($this->isAlias($service)) $service = $this->getClass($service);

			#	already initialized?

			if ($this->hasInstance($service)) {
				return $this->getInstance($service);
			}

			#	if the class exists, return its instance

			if (class_exists($service)) {
				$instance = $this->getClassInstance($service);
			}

			#	otherwise try to include its files

			else {
				$this->loadClass($service);

				$instance = $this->getClassInstance($service);
			}

			if ($instance instanceof $service) {
				$this->instances[$service] = $instance;

				return $instance;
			}

			else {
				throw new RuntimeException(sprintf("Service: coudln't initialize instance of %s", $service));
			}
		}

		public function call(callable $callable, $args = false) {
			#	closure

			if ($callable instanceof Closure) {
				return $this->getClosureCall($callable);
			}

			#	class

			else {
				if (is_array($callable)) {
					if (isset($callable[1])) {
						$reflection = new ReflectionMethod($callable[0], $callable[1]);

						$dependencies = $this->resolveDynamicDependencies($reflection->getParameters());

						if ($args) $dependencies = array_merge($dependencies, $args);

						return $reflection->invokeArgs(new $callable[0], $dependencies);
					}

				}

				else {
					return $this->getClassInstance($callable);
				}
			}
		}

		private function getClosureCall(Closure $closure) {
			$reflection = new ReflectionFunction($closure);

			#	closure has no dependencies

			if ($reflection->getNumberOfParameters() == 0) {
				return $closure();
			}

			#	resolve closure dependencies

			else {
				#	TODO: change this
				return $closure(...$this->resolveDynamicDependencies($reflection->getParameters()));
			}
		}

		private function getClassInstance($class) {
			$reflection = new ReflectionClass($class);

			if ($reflection->isInterface()) throw new RuntimeException(sprintf("Service: trying to initialize instance of '%s'.", $class));

			if (!$reflection->isInstantiable()) throw new RuntimeException(sprintf("Service: cannot initialize '%s'.", $class));

			#	the constructor has no dependencies

			if (!$reflection->getConstructor()) {
				$this->instances[$class] = $reflection->newInstance();
			}

			#	resolve dependencies

			else {
				$dependencies = $this->resolveDependencies($reflection);

				$this->instances[$class] = $reflection->newInstanceArgs($dependencies);
			}

			return $this->instances[$class];
		}

		private function resolveDependencies(ReflectionClass $reflection) {
			$class = $reflection->getName();

			#	resolve defined dependencies

			if ($this->hasDependencies($class)) {
				$dependencies = $this->getDependencies($class);

				return $this->resolveStaticDependencies($dependencies);
			}

			#	resolve dynamically

			else {
				$constructor = $reflection->getConstructor();

				$dependencies = $constructor->getParameters();

				return $this->resolveDynamicDependencies($dependencies);
			}
		}

		private function resolveStaticDependencies(array $dependencies) : array {
			$instances = [];

			foreach ($dependencies as $dependency) {
				$instances[] = $this->get($dependency);
			}

			return $instances;
		}

		private function resolveDynamicDependencies(array $dependencies) : array {
			$instances = [];

			foreach ($dependencies as $dependency) {
				if ($dependency->isOptional()) continue;

				$type = $dependency->getType();

				if ($type) $instances[] = $this->get('\\' . $type);
			}

			return $instances;
		}

		public function loadClass($alias) : bool {
			foreach ($this->includes[$alias] as $file) require_once SERVICE . $file;

			return true;
		}

		public function isAlias($alias) : bool {
			return isset($this->aliases[$alias]);
		}

		public function getClass($alias) : string {
			return $this->aliases[$alias];
		}

		public function hasInstance($class) : bool {
			return isset($this->instances[$class]);
		}

		public function getInstance($class) {
			return $this->instances[$class];
		}

		public function hasDependencies($class) : bool {
			return (isset($this->dependencies[$class]) && !empty($this->dependencies[$class]));
		}

		public function getDependencies($class) : array {
			return $this->dependencies[$class];
		}

	}

