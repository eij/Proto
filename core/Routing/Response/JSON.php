<?php

	namespace Core\Routing;

	class ResponseJSON extends ResponseStandard implements ResponseInterface {

		public $content = 'application/json';

		public $headers = [];

		public $body = [];

		public function __construct(array $body = [], array $headers = []) {
			$this->headers = $headers;

			$this->body = $body;

			$this->compileBody();
		}

		public function compileBody() {
			foreach ($this->body as &$element) {
				if (is_array($element)) $element = json_encode($element);
			}
		}

	}

