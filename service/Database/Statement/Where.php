<?php

	namespace Database\Statement;

	class Where {

		private $operators = [ '=', '!=', '<', '<=', '>', '>=', '<>', 'LIKE' ];

		private $chains = [ 'AND', 'OR', '||', '&&' ];

		public function where($parameter, $operator, $value, $chain = null) {
			if (!in_array($operator, $this->operators)) throw new \Exception('Wrong WHERE operator.');

			if (isset($chain) && !in_array($chain, $this->chains)) throw new \Exception('Wrong WHERE chain.');

			$this->where[] = [ 'parameter' => $parameter, 'operator' => $operator, 'value' => $value, 'chain' => $chain ];

			return $this;
		}

		public function whereLike($parameter, $pattern, $chain = null) {
			$this->where($parameter, 'LIKE', $pattern, $chain);

			return $this;
		}

	}

?>
