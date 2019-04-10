<?php

	namespace Service\Session;

	class Session {

		public function __destruct() {
			$this->close();
		}

		public function using($adapter) {
			switch ($adapter) {
				case 'native': return true;

				case 'redis': {
					$adapter = 'Session\SessionRedis';

					require_once VENDOR . 'Predis/Autoloader.php';

					\Predis\Autoloader::register();

					session_set_save_handler(new $adapter(new \Predis\Client));

					break;
				}

				default: return true;
			}

			return true;
		}

		public function start() {
			if (session_status() != PHP_SESSION_ACTIVE) session_start();
		}

		public function close() {
			session_write_close();
		}

		public function set($key, $value) {
			$_SESSION[$key] = $value;
		}

		public function get($key) {
			if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

			return false;
		}

		public function delete($key) {
			unset($_SESSION[$key]);
		}

		public function destroy() {
			$_SESSION = [];

			session_destroy();

			return true;
		}

	}

?>
