<?php

spl_autoload_register(function ($class) { 
	$path = __DIR__.'/../'.str_replace('\\', '/', $class).'.php';
	if (is_file($path)) { include $path; } 
});

use Calculator\Calculator as Calculator;

use Calculator\Operator\Addition;
use Calculator\Operator\Division;
use Calculator\Operator\Modular;
use Calculator\Operator\Multiplication;
use Calculator\Operator\Subtraction;
use Calculator\Io\Io;

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
		$addition = new Addition();

		$expected = 5;
		$actual = $addition->process(1, 4);

		$this->assertEquals($expected, $actual);
	}

	public function testSubstraction()
	{
		$subtraction = new Subtraction();

		$expected = -1;
		$actual = $subtraction->process(8, 9);

		$this->assertEquals($expected, $actual);		
	}

	public function testMultiplication()
	{
		$multiplication = new Multiplication();

		$expected = 27;

		$actual = $multiplication->process(3, 9);

		$this->assertEquals($expected, $actual);		
	}

	public function testDivision()
	{
		$division = new Division();

		$expected = 3;

		$actual = $division->process(9, 3);

		$this->assertEquals($expected, $actual);		
	}

	public function testModular()
	{
		$modular = new Modular();

		$expected = 1;

		$actual = $modular->process(5, 2);

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