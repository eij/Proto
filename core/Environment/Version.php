<?php

	namespace Core;

	class Version {

		const NAME = 'Proto';

		const MAJOR = 0;

		const MINOR = 1;

		const PATCH = 0;

		public static function get() : string { return implode('.', [ self::MAJOR, self::MINOR, self::PATCH ]); }

		public static function name() : string { return self::NAME; }

		public static function major() : string { return self::MAJOR; }

		public static function minor() : string { return self::MINOR; }

		public static function patch() : string { return self::PATCH; }

	}

