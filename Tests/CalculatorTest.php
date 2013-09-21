<?php

spl_autoload_register(function ($class) { 
	$path = __DIR__.'/'.str_replace('\\', '/', $class).'.php'; if (is_file($path)) { include $path; } 
});

use Calculator\Calculator as Calculator;

// TODO: Write tests :P
class CalculatorTest extends \PHPUnit_Framework_TestCase 
{
	protected $calculator;

	public function testAddition()
	{
		new Calculator();
		$expected = 1;
		$actual = 1;

		$this->assertEquals($expected, $actual);
	}
}