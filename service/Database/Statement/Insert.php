<?php

	namespace Database\Statement;

	class Insert extends Where {

		private $query;

		private $statement = 'INSERT INTO';

		private $columns;

		private $values;

		private $table;

		protected $where;

		public function __construct(\Database\Query $query, Array $parameters) {
			$this->query = $query;

			$this->columns = array_keys($parameters);

			$this->values = array_values($parameters);
		}

		public function into($table) {
			$this->table = $table;

			return $this;
		}

		public function exec() {
			return $this->query->exec([
				'insert'			=> true,

				'statement'			=> $this->statement,
				'columns'			=> $this->columns,
				'values'			=> $this->values,
				'table'				=> $this->table,
				'where'				=> $this->where,
			]);
		}

	}


?>
