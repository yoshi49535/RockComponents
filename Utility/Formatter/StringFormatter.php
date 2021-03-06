<?php
/****
 *
 * Description:
 *      
 * 
 * $Date$
 * Rev    : see git
 * Author : Yoshi Aoki <yoshi@44services.jp>
 * 
 *  This file is part of the Rock package.
 *
 * For the full copyright and license information, 
 * please read the LICENSE file that is distributed with the source code.
 *
 ****/

namespace Rock\Component\Utility\Formatter\StringFormatter;

class StringFormatter
{
	static protected 
	  $line_delim  = "\n",
	  $indent      = "\t";
	protected
	  $indentLevel = 0,
	  $lines       = array();
	public function __construct(string $value)
	{
		$this->parse($value);
	}
	public function parse(string $value)
	{
		$lines = explode(static::$line_delim, $value);
		foreach($lines as $line)
		{
			$level  = 0;
			while(strpos($line, static::$indent) === 0)
			{
				$level++;
				$line = substr($line, strlen(static::$indent));
			}

			$this->push($line, $level);
		}
		
		return $this;
	}

	static function setLineDelimiter($delim)
	{
		static::$line_delim  = $delim;
	}
	static function setIndent($indent)
	{
		static::$indent      = $indent;
	}
}
