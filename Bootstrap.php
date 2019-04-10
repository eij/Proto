<?php

	#	Set the root path

	define('BASE', realpath(dirname(__FILE__)) . '/');

	#	Core loading with style

	class BootQueue extends SplPriorityQueue {

		public function __construct(Iterator $iterator) {
			foreach ($iterator as $item) {
				if (preg_match('/(core\/Environment)/i', $item->getRealPath())) $this->insert($item, 4);
				else $this->insert($item, 1);
			}
		}

	}

	$core = new BootQueue(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(BASE . 'core/', RecursiveDirectoryIterator::SKIP_DOTS)));

	foreach ($core as $file) require $file;

	#	Set the custom error handler

	#$fault = new Core\Fault;

?>
