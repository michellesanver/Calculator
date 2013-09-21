<?php

namespace Calculator\Operator;

class Subtraction extends AbstractOperator {
	
	protected $token = '-';

	/**
	 * {@inheritdoc }
	 */
	public function process($base, $subject) {
		return $base - $subject;
	}

}
