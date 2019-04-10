<?php

	namespace Database\Statement;

	class Delete {

		private $statement = 'DELETE';

		private $parameters = '*';

		private $table;

		public function __construct(\Database\Query $query, $parameters = null) {
			$this->query = $query;

			if (is_array($parameters))
				$this->parameters = implode(', ', $parameters);
			else if (isset($parameters))
				$this->parameters = $parameters;
		}

		public function from($table) {
			$this->table = $table;

			return $this;
		}

		public function exec() {
			return $this->query->exec([
				'delete'			=> true,

				'statement'			=> $this->statement,
				'parameters'		=> $this->parameters,
				'table'				=> $this->table,
			]);
		}

	}

?>
