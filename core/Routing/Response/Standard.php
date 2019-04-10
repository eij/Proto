<?php

	namespace Core\Routing;

	class ResponseStandard implements ResponseInterface {

		public $code = 200;

		public $codeText = 'OK';

		public $content = 'text/html';

		public $charset = 'UTF-8';

		public $protocol = 'HTTP/1.1';

		public $headers = [];

		public $body = [];

		public function __construct(array $body = [], array $headers = [], $code = null, $codeText = null, $content = null, $charset = null, $protocol = null) {
			$this->headers = $headers;

			$this->body = $body;
		}

		public function compileHeaders() {
			$this->headers[] = $this->protocol . ' ' . $this->code . ' ' . $this->codeText;

			$this->headers[] = 'Content-Type: ' . $this->content . '; charset=' . $this->charset;
		}

		public function send() {
			$this->compileHeaders();

			if (ob_get_level() === 0) ob_start();

			foreach ($this->headers as $header) header($header);

			foreach ($this->body as $element) echo $element;

			ob_end_flush();

			return true;
		}

	}

