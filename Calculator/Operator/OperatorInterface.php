<?php

namespace Calculator\Operator;

interface OperatorInterface {
	public function process($base, $subject);
	public function getToken();
	public function getPrecedence();
}
