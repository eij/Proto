<?php

	namespace Service\Authenticator;

	class Status {

		const REGISTERED = 99;

		#	Activation		1xx

		const EXPIRED = 101;

		const ACTIVATED = 102;

		#	Login			2xx

		const LOGGED_IN = 201;

		const LOGGED_OUT = 202;

		const THROTTLED = 203;

		#	Abuses			3xx

		const BANNED = 301;

		const TEMP_BANNED = 302;

		#	Recovery		4xx

		const PASSWORD_RESET = 401;

	}

?>
