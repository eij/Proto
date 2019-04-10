<?php

	namespace Database;

	class Query {

		private $handle;

		private $query;

		private $count = 0;

		public function __construct(Handle $handle) {
			$this->handle = $handle->get();
		}

		public function getCount() {
			return $this->count;
		}

		public function compile($query) {
			$this->query = $query;

			$q = $this->query['statement'];

			if (isset($this->query['database'])) {
				$q .= ' ' . $this->query['database'];

				if (isset($this->query['using'])) return $q;
			}

			if (isset($this->query['parameters'])) $q .= ' ' . $this->query['parameters'];

			if (isset($this->query['table'])) {
				if (isset($this->query['select']) || isset($this->query['delete']))
					$q .= ' FROM ' . $this->query['table'];
				else
					$q .= ' ' . $this->query['table'];
			}

			if (isset($this->query['join'])) {
				foreach ($this->query['join'] as $key => $statement) {
					$q .= $statement;

					if (isset($this->query['on'])) {
						$q .= $this->query['on'][$key];
					}
				}
			}

			if (isset($this->query['insert']) && isset($this->query['columns']) && isset($this->query['values'])) {
				$q .= ' (' . implode(', ', $this->query['columns']) . ')' . ' VALUES ' . implode(', ', $this->query['values']);
			}

			if (isset($this->query['where'])) {
				$_where = ' WHERE ';

				$whereCount = '0';

				foreach ($this->query['where'] as $w) {
					if ($whereCount > 0) {
						$_where .= ' ' . $w['chain'] . ' ';

						array_pop($w);
					}

					$w['value'] = "'" . $w['value'] . "'";

					$_where .= trim(implode(' ', $w));

					$whereCount++;
				}

				$q .= $_where;
			}

			if (isset($this->query['orderBy'])) {
				$_orderBy = ' ORDER BY ';

				$_orderBy_count = 0;

				foreach ($this->query['orderBy'] as $_orderBy_parameter => $_orderBy_direction) {
					if ($_orderBy_count > 0) $_orderBy .= ', ';

					if (is_numeric($_orderBy_parameter)) {
						$_orderBy_parameter = $_orderBy_direction;
						$_orderBy_direction = 'ASC';
					}

					$_orderBy .= $_orderBy_parameter . ' ';

					$_orderBy .= ($_orderBy_direction == 'ASC' || $_orderBy_direction == 'DESC') ? $_orderBy_direction : '';

					$_orderBy_count++;
				}

				$q .= $_orderBy;
			}

			if (isset($this->query['get']) && $this->query['get'] != null) $q .= ' LIMIT ' . $this->query['get'];

			return trim($q);
		}

		public function exec($query, $raw = null) {
			if (!$raw) $q = $this->compile($query);

			$this->count++;

			$speed = microtime(true);

			$q = $this->handle->query($q);

			$speed = number_format(microtime(true) - $speed, 5, '.', ',');

			return (object)[ 'query' => $q, 'number' => $this->count, 'speed' => $speed ];
		}

	}

?>
