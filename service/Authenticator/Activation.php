<?php

	namespace Service\Authenticator;

	class Activation {

		public function generate($user) {
			#	TODO: generate and store the activation code.

			$code = \Service\Utilities\Random::alphanumeric(32);

			return $code;
		}

		public function complete($user) {}

		public function isExpired($user) {
			#	TODO: remove activation.
		}

	}

?>
