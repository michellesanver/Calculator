<?php

spl_autoload_register(function ($class) { 
	$path = __DIR__.'/../'.str_replace('\\', '/', $class).'.php';
	if (is_file($path)) { include $path; } 
});

use Calculator\Calculator as Calculator;

use Calculator\Operator\Addition as Addition;
use Calculator\Operator\Division as Division;
use Calculator\Operator\Modular as Modular;
use Calculator\Operator\Multiplication as Multiplication;
use Calculator\Operator\Subtraction as Subtraction;
use Calculator\Io\Io as Io;

// TODO: Write tests :P
class CalculatorTest extends \PHPUnit_Framework_TestCase 
{
	protected $calculator;

	protected function setUp()
	{
		// Initiate the calculator
		$this->calculator = new Calculator(new Io());

		// Add the operators
		$this->calculator->addOperator(new Addition());
		$this->calculator->addOperator(new Division());
		$this->calculator->addOperator(new Modular());
		$this->calculator->addOperator(new Multiplication());
		$this->calculator->addOperator(new Subtraction());
	}

	public function testAddition()
	{
		$input = "1 + 4";

		$expected = 5;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);
	}

	public function testSubstraction()
	{
		$input = "8 - 9";

		$expected = -1;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);		
	}

	public function testMultiplication()
	{
		$input = "3 * 9";

		$expected = 27;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);		
	}

	public function testDivision()
	{
		$input = "9 / 3";

		$expected = 3;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);		
	}

	public function testCombinedOperations()
	{
		$input = "4 + 5 % 2 + 50";

		$expected = 55;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);		
	}

	public function testPrecedence()
	{
		$input = "2 + 4 * 2";

		$expected = 10;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);	
	}

	public function testSamePrecedence()
	{
		$input = "1 + 1 - 2";

		$expected = 0;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);	
	}

	public function testNegatives()
	{
		$input = "-2 + -2";

		$expected = -4;

		$actual = $this->calculator->calculate($input);

		$this->assertEquals($expected, $actual);		
	}
}