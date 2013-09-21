<?php

namespace Calculator\Operator;

class Addition extends AbstractOperator {
	protected $token = '+';

	/**
	 * {@inheritdoc }
	 */
	public function process($base, $subject) {
		return $base + $subject;
	}
}
