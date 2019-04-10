<?php

	namespace Core\Routing;

	class Route implements RouteInterface {

		public $method;

		public $pattern;

		public $action;

		public $before;

		public $after;

		public $description;

		public $args = [];

		public function __construct($method = null, $pattern = null, $action = null, $before = null, $after = null, $description = null) {
			$this->method = $method;

			$this->pattern = $pattern;

			$this->action = $action;

			$this->description = $description;
		}

		public function getMethod() : string { return $this->method; }

		public function getPattern() : string { return $this->pattern; }

		public function getAction() { return $this->action; }

		public function getDescription() : string { return $this->description; }

		public function getActionBefore() { return $this->before; }

		public function getActionAfter() { return $this->after; }

	}

