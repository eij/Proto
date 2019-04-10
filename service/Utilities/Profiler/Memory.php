<?php

	namespace Service\Utilities\Profiler;

	class Memory {

		private $units = [ 'b','kb','mb','gb','tb','pb' ];

		private $asHuman = false;

		public function getUsed() {
			$size = memory_get_usage(true);

			if ($this->asHuman) $size = $this->convert($size);

			return $size;
		}

		public function getPeak() {
			$size = memory_get_peak_usage(true);

			if ($this->asHuman) $size = $this->convert($size);

			return $size;
		}

		public function asHuman() {
			$this->asHuman = true;

			return $this;
		}

		private function convert($size) {
			return round($size / pow(1024, ($i = floor(log($size, 1024)))), 5) . ' ' . $this->units[$i];
		}

	}

?>
