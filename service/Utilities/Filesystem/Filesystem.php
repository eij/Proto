<?php

	namespace Service\Utilities\Filesystem;

	class Filesystem {

		public function exists($element) {
			return file_exists($element);
		}

		public function isReadable($element) {
			return is_readable($element);
		}

		public function isWriteable($element) {
			return is_writeable($element);
		}

		public function isFile($element) {
			return is_file($element);
		}

		public function isDirectory($element) {
			return is_dir($element);
		}

		public function getSize($filename) {
			return filesize($filename);
		}

		public function getExtension($filename) {
			return pathinfo($filename, PATHINFO_EXTENSION);
		}

		public function write($element, $content, $flags = 0) {
			return file_put_contents($element, $content, $flags);
		}

		public function read($element) {
			return file_get_contents($element);
		}

		public function delete($element) {
			if (is_file($element)) {
				unlink($element);
			}
			else if (is_dir($element)) {
				$elements = new FilesystemIterator($element);

				foreach ($elements as $item) $this->delete($item->getPathname());

				rmdir($path);
			}

			return true;
		}

	}

?>
