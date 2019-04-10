<?php

	namespace Core\Routing;

	interface RouteInterface {

		public function getMethod() : string;

		public function getPattern() : string;

		public function getAction();

		public function getDescription() : string;

	}

