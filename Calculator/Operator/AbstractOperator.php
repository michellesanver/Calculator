<?php

namespace Calculator\Operator;

abstract class AbstractOperator implements OperatorInterface {
	
	protected $token = false;
	protected $precedence = 0;

	/**
	 * Processes the operator.
	 * 
	 * @param  $base    The base of the operation.
	 * @param  $subject The subject of the operation.
	 * @return A result!
	 */
	public function process($base, $subject) {

	}

	/**
	 * @return  String Returns the given token.
	 * @throws  Exception If no token is specified.
	 */
	public function getToken() {
		
		if( ! $this->token) {
			throw new \Exception(__CLASS__.' should define a token');
		}

		return $this->token;
	}

	/**
	 * @return Returns the precedence.
	 */
	public function getPrecedence() {
		return $this->precedence;
	}
}
