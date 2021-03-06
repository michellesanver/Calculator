<?php

spl_autoload_register(function ($class) { 
	$path = __DIR__.'/'.str_replace('\\', '/', $class).'.php'; if (is_file($path)) { include $path; } 
});

use Calculator\Calculator as Calculator;

use Calculator\Operator\Addition;
use Calculator\Operator\Division;
use Calculator\Operator\Modular;
use Calculator\Operator\Multiplication;
use Calculator\Operator\Subtraction;
use Calculator\Io\Io;

// Initiate the calculator
$calculator = new Calculator(new Io());

// Add the operators
$calculator->addOperator(new Addition());
$calculator->addOperator(new Division());
$calculator->addOperator(new Modular());
$calculator->addOperator(new Multiplication());
$calculator->addOperator(new Subtraction());

// Run the calculator
$calculator->run();
