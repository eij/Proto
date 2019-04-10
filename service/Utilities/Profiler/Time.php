<?php

	namespace Service\Utilities\Profiler;

	class Time {

		private $start;

		public function start() {
			$this->start = microtime(true);
		}

		public function stop() {
			$this->stop = microtime(true);
		}

		public function inMs() {
			$time = $this->stop - $this->start;

			return number_format($time, 8);
		}

	}

?>
