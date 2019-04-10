<?php

	namespace Database;

	class Database {

		private $query;

		public function __construct(Array $parameters) {
			$this->query = new Query(new Handle($parameters));			
		}

		public function using($database) {
			return new Statement\Using($this->query, $database);
		}

		public function select($parameters = null) {
			return new Statement\Select($this->query, $parameters);
		}

		public function insert($values = null) {
			return new Statement\Insert($this->query, $values);
		}

		public function delete($parameters = null) {
			return new Statement\Delete($this->query, $parameters);
		}

		public function raw($query) {
			return $this->query->exec($query, true);
		}

		public function getQueryCount() {
			return $this->query->getCount();
		}

	}

?>
