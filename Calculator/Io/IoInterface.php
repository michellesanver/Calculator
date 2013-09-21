<?php

namespace Calculator\Io;

interface IoInterface {
	public function read();
	public function write($output = '', $newline = true);
}
