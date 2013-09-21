<?php

namespace Calculator;

use Calculator\Io\IoInterface;
use Calculator\Operator\OperatorInterface;

class Calculator {

	protected $operators = array();
	protected $io = false;
	protected $expressions = array();

	/**
	 * We need to define an IO.
	 * @param IoInterface $io The defines io, needs read and write.
	 */
	public function __construct(IoInterface $io)
	{
		$this->io = $io;
	}

	/**
	 * Runs the calculator.
	 */
	public function run() 
	{
		$this->io->write("Enter a calculation and press enter to continue (empty line to quit):", true);
		$this->io->write("CALCULATION: ", false);

		while($calculation = $this->io->read()) {
			$result = $this->calculate($calculation);
			$this->io->write("Result = " . $result.PHP_EOL, true);
			$this->io->write("CALCULATION: ", false);
		}

	}

	/**
	 * Adds an operator to the calculator.
	 * 
	 * @param Operator $operator The operator to add.
	 */
	public function addOperator(OperatorInterface $operator) {
		$this->operators[$operator->getToken()] = $operator;
	}

	/**
	 * Calculates the expressions array to one final sum.
	 * 
	 * @return The resulting calculation.
	 */
	public function calculate($input)
	{
		$this->expressions = explode(' ', $input);
		$maxPrecedence = $this->getMaxPrecedence();

		for($precedenceIndex = $maxPrecedence; $precedenceIndex >= 0; $precedenceIndex--) {
			$precedenceList = $this->getPrecedenceOperatorArray($precedenceIndex);			
			$this->calculateOperators($precedenceList);
		}

		// The result
		return $this->expressions[0];
	}

	/**
	 * Gets max precedence from the operators array.
	 * 
	 * @return int The max precedence in the operators array.
	 */
	protected function getMaxPrecedence()
	{
		$maxPrecedence = 0;

		foreach($this->operators as $operator) 
		{
			if($operator->getPrecedence() > $maxPrecedence) {
				$maxPrecedence = $operator->getPrecedence();
			}
		}

		return $maxPrecedence;
	}

	/**
	 * Gets an array containing only the operators with certain precedence.
	 * 
	 * @param  Int $precedence The precedence to base the array on
	 * @return Array An array containing only the operators with given precedence.
	 */
	protected function getPrecedenceOperatorArray($precedence)
	{
		$precedenceOperatorArray = array();

		foreach($this->operators as $operator) {
			
			if($operator->getPrecedence() == $precedence) {
				$precedenceOperatorArray[$operator->getToken()] = $operator;
			}

		}

		return $precedenceOperatorArray;
	}

	/**
	 * Calculates a certain list of operators.
	 * @param  Array $operators The operatorarray to calculate.
	 */
	protected function calculateOperators(Array $operators)
	{
		foreach($this->expressions as $index => &$part)
		{
			if( ! array_key_exists($part, $operators) ) {
				continue;
			}

			$operator = $operators[$part];

			// Calculate
			$base = $this->expressions[$index-1];
			$subject = $this->expressions[$index+1];

			$sum = $operator->process($base, $subject);

			// Replace expression
			$this->replaceExpressionWithSum($index, $sum);
		}
	}

	/**
	 * Alters the parts array replacing 3 parts with a sum.
	 * 
	 * @param  Int $index The position of the operator/token.
	 * @param  Float $sum The sum to replace the index with.
	 */
	protected function replaceExpressionWithSum($index, $sum)
	{
		$this->expressions[$index-1] = null;
		$this->expressions[$index+1] = null;
		$this->expressions[$index] = $sum;

		$this->expressions = array_values(array_filter($this->expressions, 'strlen'));
	}
}
