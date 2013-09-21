<?php

namespace Calculator\Io;

class Io implements IoInterface {

	/**
	 * Reads input from the console.
	 * 
	 * @return String Returns the input.
	 */
	public function read() 
	{
		$input = trim(fgets(STDIN));

		if (empty($input))
		{
			return null;
		}

		return $input;
	}

	/**
	 * Write given input with or without new line.
	 * 
	 * @param  mixed $output  The output to write.
	 * @param  boolean $newline Wether or not there's a new line
	 */
	public function write($output = '', $newline = true)
	{
		if ( ! is_string($output))
		{
			$output = print_r($output, true);
		}

		if ($newline)
		{
			$output .= PHP_EOL;
		}

		fwrite(STDOUT, $output);
	}
}
