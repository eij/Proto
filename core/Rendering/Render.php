<?php

	namespace Core\Rendering;

	use RuntimeException;

	class Render implements RenderInterface {

		private $path;

		private $extension = '.php';

		public function __construct() {
		}

		public function view($template, $parameters = null) {
			$element = APPLICATION_DATA . 'Template/' . $template . $this->extension;

			if (!file_exists($element)) {
				$element = FRAMEWORK_DATA . 'Template/404.php';

				if (!file_exists($element)) throw new RuntimeException(sprintf("Render: template 404 not found.", $element));
			}

			return $this->draw($element, $parameters);
		}

		public function draw($element, $parameters = null) {
			if ($parameters && is_array($parameters)) extract($parameters, EXTR_PREFIX_SAME, '_');

			ob_start();

			include $element;

			$output = ob_get_clean();

			return $output;
		}

		public function get404($path) {
			return $this->view('404', [ '_path' => $path ]);
		}

	}

