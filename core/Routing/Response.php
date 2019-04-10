<?php

	namespace Core\Routing;

	class Response {

		private $codes = [

			#	1xx Informational

			100 => 'Continue',
			101 => 'Switching Protocols',
			102 => 'Processing',
			103 => 'Checkpoint',

			#	2xx Success

			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			207 => 'Multi-Status',
			208 => 'Already Reported',
			226 => 'IM Used',

			#	3xx Redirection

			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			307 => 'Temporary Redirect',
			308 => 'Permanent Redirect',

			#	4xx Client Error

			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Payload Too Large',
			414 => 'URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Range Not Satisfiable',
			417 => 'Expectation Failed',
			418 => 'I\'m a teapot',
			419 => 'Authentication Timeout',
			421 => 'Misdirected Request',
			422 => 'Unprocessable Entity',
			423 => 'Locked',
			424 => 'Failed Dependency',
			426 => 'Upgrade Required',
			428 => 'Precondition Required',
	 		429 => 'Too Many Requests',
	 		431 => 'Request Header Fields Too Large',
			449 => 'Retry With',
			450 => 'Blocked by Windows Parental Controls',
			451 => 'Unavailable For Legal Reasons',
			498 => 'Invalid Token',
			499 => 'Token required',

			#	5xx Server Error

			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			506 => 'Variant Also Negotiates',
			507 => 'Insufficient Storage',
			508 => 'Loop Detected',
			509 => 'Bandwidth Limit Exceeded',
			510 => 'Not Extended',
			511 => 'Network Authentication Required',
			530 => 'User access denied',

		];

		private $code = 200;

		private $content = 'text/html';

		private $charset = 'UTF-8';

		private $protocol = 'HTTP/1.1';

		private $body = [];

		private $headers = [];

		private $asJson = false;

		public function status($code) : Response {
			if (isset($this->codes[$code])) $this->code = $code;

			return $this;
		}

		public function content($type) : Response {
			$this->content = $type;

			return $this;
		}

		public function charset($charset) : Response {
			$this->charset = $charset;

			return $this;
		}

		public function protocol($protocol) : Response {
			$this->protocol = $protocol;

			return $this;
		}

		public function asJson() : Response {
			$this->asJson = true;

			return $this;
		}

		public function addHeader($string) : Response {
			$this->headers[] = $string;

			return $this;
		}

		public function addBody($string) : Response {
			$this->body[] = $string;

			return $this;
		}

		public function send() {
			if ($this->asJson) {
				$response = new ResponseJSON($this->body, $this->headers, $this->code, $this->codes[$this->code], $this->content, $this->charset, $this->protocol);
			}
			else {
				$response = new ResponseStandard($this->body, $this->headers, $this->body, $this->headers, $this->code, $this->codes[$this->code], $this->content, $this->charset, $this->protocol);
			}

			return $response->send();
		}

	}

