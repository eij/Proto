<?php

	namespace Database\Statement;

	class Select extends Where {

		private $query;

		private $statement = 'SELECT';

		private $parameters = '*';

		private $table;

		private $join;

		private $on;

		private $orderBy;

		protected $where;

		public function __construct(\Database\Query $query, $parameters = null) {
			$this->query = $query;

			if (is_array($parameters))
				$this->parameters = implode(', ', $parameters);
			else if (isset($parameters))
				$this->parameters = $parameters;
		}

		public function distinct() {
			$this->statement .= ' DISTINCT';

			return $this;
		}

		public function from($table) {
			$this->table = $table;

			return $this;
		}

		public function joinInner($table) {
			$this->join[] = ' INNER JOIN ' . $table;

			return $this;
		}

		public function on($parameter1, $parameter2, $operator) {
			$this->on[] = ' ON ' . implode($operator, [ $parameter1, $parameter2 ]);

			return $this;
		}

		public function orderBy($parameter, $direction = null) {
			if (is_array($parameter))
				$this->orderBy = $parameter;
			else
				$this->orderBy = [ $parameter => $direction ];

			return $this;
		}

		public function get($limit = null) {
			return $this->query->exec([
				'select'			=> true,

				'statement'			=> $this->statement,
				'parameters'			=> $this->parameters,
				'table'				=> $this->table,
				'join'				=> $this->join,
				'on'				=> $this->on,
				'where'				=> $this->where,
				'orderBy'			=> $this->orderBy,
				'get'				=> $limit,
			]);
		}

	}

?>
