<?php

	namespace Core\Routing;

	class Request {

		public function getProtocol() : string {
			return (
				(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ||
				(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ||
				(isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
			) ? 'https' : 'http';
		}

		public function getMethod() : string {
			return $_SERVER['REQUEST_METHOD'] ?? 'GET';
		}

		public function getPath() : string {
			$path = '/';

			if (isset($_SERVER['REQUEST_URI'])) $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

			return rawurldecode($path);
		}

		public function getQuery() : string {
			return $_SERVER['QUERY_STRING'] ?? '';
		}

		public function getQueryParameters() : array {
			parse_str($this->getQuery(), $parameters);

			return $parameters;
		}

		public function getLanguage() : string {
			$locale = 'en';

			if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				$locale = \locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
			}

			return $locale;
		}

		public function isSecure() : bool {
			return ($this->getProtocol() == 'https') ? true : false;
		}

		public function isAjax() : bool {
			return (isset($this->server['HTTP_X_REQUESTED_WITH']) && ($this->server['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'));
		}


	}

