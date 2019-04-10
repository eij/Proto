<?php

	namespace Database\Statement;

	class Using {

		private $query;

		private $statement = 'USE';

		private $database;

		public function __construct(\Database\Query $query, $database) {
			$this->query = $query;

			$this->database = $database;

			$this->exec();
		}

		public function exec() {
			return $this->query->exec([
				'using'				=> true,

				'statement'			=> $this->statement,
				'database'			=> $this->database,
			]);
		}

	}

?>
