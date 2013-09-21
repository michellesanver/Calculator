<?php

namespace Calculator\Operator;

class Multiplication extends AbstractOperator {
	protected $token = '*';
	protected $precedence = 1;

	/**
	 * {@inheritdoc }
	 */
	public function process($base, $subject) {
		return $base * $subject;
	}
}
