<?php
/*
	namespace Core;

	class Fault {

		private $obfuscate = false;

		private $production = false;

		private $error = [];

		public function __construct() {
			$this->setErrorReporting();

			$this->setErrorHandler();

			$this->setExceptionHandler();
		}

		public function setErrorHandler() {
			set_error_handler([ $this, 'handleError' ], -1);
		}

		public function setExceptionHandler() {
			set_exception_handler([ $this, 'handle' ]);
		}

		public function setErrorReporting($level = 0) {
			error_reporting($level);
		}

		public function handleError($errno, $errstr, $errfile, $errline) {
			#$e = error_get_last();

			$this->handle(new \ErrorException($errstr, $errno, 0, $errfile, $errline));
		}

		public function handle($e) {
			switch ($e->getCode()) {
				case E_USER_ERROR: $this->error['code'] = 'Error'; break;
				case E_USER_WARNING: $this->error['code'] = 'Warning'; break;
				case E_USER_NOTICE: $this->error['code'] = 'Notice'; break;
				default: $this->error['code'] = 'Unknown Error'; break;
			}

			$this->error['line'] = $e->getLine();
			$this->error['file'] = $e->getFile();
			$this->error['message'] = $e->getMessage();
			$this->error['trace'] = $e->getTraceAsString();

			$this->send();
		}

		private function getError() {
			$error = ($this->obfuscate) ? chunk_split(base64_encode(serialize($this->error))) : implode('<br />', $this->error);

			return $error;
		}

		private function send() {
			if (ob_get_level() > 0) ob_end_clean();

			ob_start();

			header('HTTP/1.1 500 Internal Server Error');

			require(TEMPLATE . '500.php');

			ob_end_flush();

			exit(1);
		}

	}
*/
