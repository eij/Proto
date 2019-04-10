<?php

	namespace Database;

	class Handle {

		private $host = 'localhost';

		private $driver = 'mysql';

		private $charset = 'utf8';

		private $collation = 'utf8_unicode_ci';

		private $handle;

		public function __construct(Array $parameters) {
			if (!isset($parameters['dsn'])) {
				$parameters['host'] = (!isset($parameters['host'])) ? $this->host : $parameters['host'];
				$parameters['driver'] = (!isset($parameters['driver'])) ? $this->driver : $parameters['driver'];

				$dsn = $parameters['driver'] . ':host=' . $parameters['host'];

				if ($parameters['driver'] == 'dblib') {
					ini_set('mssql.charset', 'UTF-8');

					$dsn .= (!isset($parameters['charset'])) ? ';charset=' . $this->charset : ';charset=' . $parameters['charset'];
				}
			}

			$this->handle = new \PDO($dsn, $parameters['username'], $parameters['password']);

			$this->handle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->handle->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

			if ($parameters['driver'] == 'mysql' || $parameters['driver'] == 'mysqli') {
				if (isset($parameters['charset'])) $this->charset = $parameters['charset'];
				if (isset($parameters['collation'])) $this->collation = $parameters['collation'];

				$this->handle->query('SET NAMES "' . $this->charset . '" COLLATE "' . $this->collation . '"');
				$this->handle->query('SET CHARACTER SET "' . $this->charset . '"');
			}
		}

		public function get() { return $this->handle; }

	}

?>
