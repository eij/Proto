<?php

	namespace Service\Session;

	class SessionRedis implements \SessionHandlerInterface {

		private $handle;

		private $prefix = 'session.';

		private $ttl;

		public function __construct(\Predis\Client $handle, $prefix = null) {
			$this->handle = $handle;

			if (isset($prefix)) $this->prefix = $prefix;

			$this->ttl = ini_get('session.gc_maxlifetime');
		}

		public function open($path, $name) { }

		public function read($id) {
			$id = $this->prefix . $id;

			$data = $this->handle->get($id);

			$this->handle->expire($id, $this->ttl);

			return $data;
		}

		public function write($id, $data) {
			$id = $this->prefix . $id;

			$this->handle->set($id, $data);

			$this->handle->expire($id, $this->ttl);
		}

		public function close() {
			unset($this->handle);
		}

		public function gc($ttl) { }

		public function destroy($id) {
			$this->handle->del($this->prefix . $id);
		}

	}


?>
